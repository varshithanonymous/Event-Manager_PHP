<?php
require_once __DIR__ . '/../models/Poll.php';
require_once __DIR__ . '/../models/Event.php';

class PollController {
    
    public function create($eventId) {
        session_start();
        if (!isset($_SESSION['user_id'])) {
            header('Content-Type: application/json');
            echo json_encode(['status' => 'error', 'message' => 'Unauthorized']);
            exit;
        }

        $eventModel = new Event();
        $event = $eventModel->getById($eventId);
        if (!$event || $event['organizer_id'] != $_SESSION['user_id']) {
            header('Content-Type: application/json');
            echo json_encode(['status' => 'error', 'message' => 'Only organizers can create polls']);
            exit;
        }

        $question = $_POST['question'] ?? '';
        $options = $_POST['options'] ?? []; // Expected as array

        if (empty($question) || count($options) < 2) {
            header('Content-Type: application/json');
            echo json_encode(['status' => 'error', 'message' => 'Invalid question or options']);
            exit;
        }

        $pollModel = new Poll();
        $pollId = $pollModel->create($eventId, $question, $options);

        if ($pollId) {
            echo json_encode(['status' => 'success', 'poll_id' => $pollId]);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to create poll']);
        }
    }

    public function vote($eventId) {
        session_start();
        if (!isset($_SESSION['user_id'])) {
            header('Content-Type: application/json');
            echo json_encode(['status' => 'error', 'message' => 'Unauthorized']);
            exit;
        }

        $optionId = $_POST['option_id'] ?? null;
        if (!$optionId) {
            echo json_encode(['status' => 'error', 'message' => 'Option ID required']);
            exit;
        }

        $pollModel = new Poll();
        // Access check should be done here too - only approved attendees can vote
        $eventModel = new Event();
        $rsvpStatus = $eventModel->getRSVPStatus($eventId, $_SESSION['user_id']);
        $event = $eventModel->getById($eventId);
        $isOrganizer = ($event && $event['organizer_id'] == $_SESSION['user_id']);

        if ($rsvpStatus !== 'approved' && !$isOrganizer) {
            echo json_encode(['status' => 'error', 'message' => 'Only approved attendees can vote']);
            exit;
        }

        if ($pollModel->vote($optionId, $_SESSION['user_id'])) {
            echo json_encode(['status' => 'success']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Already voted or invalid option']);
        }
    }

    public function getActive($eventId) {
        session_start();
        $userId = $_SESSION['user_id'] ?? null;
        $pollModel = new Poll();
        $poll = $pollModel->getActiveByEvent($eventId, $userId);
        
        header('Content-Type: application/json');
        echo json_encode(['status' => 'success', 'poll' => $poll]);
    }
}
