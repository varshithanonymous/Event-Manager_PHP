<?php
require_once __DIR__ . '/../models/Event.php';

class EventController {

    public function show($id) {
        $eventModel = new Event();
        $event = $eventModel->getById($id);

        if (!$event) {
            http_response_code(404);
            renderView('404'); 
            return;
        }

        renderView('events/show', ['event' => $event]);
    }

    public function create() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: ' . BASE_URL . 'login');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->handleCreate();
            return;
        }

        renderView('events/create');
    }

    private function handleCreate() {
        $eventModel = new Event();
        
        // Prepare data from POST
        $data = [
            'organizer_id' => $_SESSION['user_id'],
            'title' => $_POST['title'] ?? '',
            'description' => $_POST['description'] ?? '',
            'start_time' => ($_POST['date'] ?? '') . ' ' . ($_POST['time'] ?? ''),
            'location_name' => $_POST['location_name'] ?? '',
            'category' => $_POST['category'] ?? 'Social',
            'image_url' => $_POST['image'] ?? '',
            'latitude' => $_POST['latitude'] ?? null,
            'longitude' => $_POST['longitude'] ?? null
        ];

        $eventId = $eventModel->create($data);

        if ($eventId) {
            header('Content-Type: application/json');
            echo json_encode(['status' => 'success', 'id' => $eventId, 'redirect' => BASE_URL . 'event/' . $eventId]);
        } else {
            header('Content-Type: application/json');
            echo json_encode(['status' => 'error', 'message' => 'Failed to save event']);
        }
        exit;
    }
    
    public function chat($eventId) {
        header('Content-Type: application/json');
        echo json_encode([
            'status' => 'success',
            'messages' => [
                ['user' => 'Alice', 'content' => 'Anyone going from Downtown?', 'time' => '10:00 AM'],
                ['user' => 'Bob', 'content' => 'Yeah, I can drive!', 'time' => '10:05 AM']
            ]
        ]);
        exit;
    }

    public function ticket($eventId) {
        $eventModel = new Event();
        $event = $eventModel->getById($eventId);
        
        if(!$event) {
            http_response_code(404);
            renderView('404');
            return;
        }

        renderView('events/ticket', ['event' => $event]);
    }
}
?>
