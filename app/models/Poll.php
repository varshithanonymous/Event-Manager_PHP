<?php
require_once __DIR__ . '/../../config/database.php';

class Poll {
    private $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->getConnection();
    }

    public function create($eventId, $question, $options) {
        try {
            $this->conn->beginTransaction();

            $query = "INSERT INTO polls (event_id, question) VALUES (:event_id, :question)";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':event_id', $eventId);
            $stmt->bindParam(':question', $question);
            $stmt->execute();
            $pollId = $this->conn->lastInsertId();

            foreach ($options as $option) {
                $query = "INSERT INTO poll_options (poll_id, option_text) VALUES (:poll_id, :option_text)";
                $stmt = $this->conn->prepare($query);
                $stmt->bindParam(':poll_id', $pollId);
                $stmt->bindParam(':option_text', $option);
                $stmt->execute();
            }

            $this->conn->commit();
            return $pollId;
        } catch (Exception $e) {
            $this->conn->rollBack();
            return false;
        }
    }

    public function getActiveByEvent($eventId, $userId = null) {
        $query = "SELECT * FROM polls WHERE event_id = :event_id AND is_active = 1 ORDER BY created_at DESC LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':event_id', $eventId);
        $stmt->execute();
        $poll = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$poll) return null;

        $poll['options'] = $this->getOptions($poll['id'], $userId);
        $poll['total_votes'] = array_sum(array_column($poll['options'], 'votes'));
        return $poll;
    }

    public function getOptions($pollId, $userId = null) {
        $query = "
            SELECT 
                po.*, 
                (SELECT COUNT(*) FROM poll_votes WHERE poll_option_id = po.id) as votes,
                EXISTS(SELECT 1 FROM poll_votes pv WHERE pv.user_id = :user_id AND pv.poll_option_id = po.id) as user_voted
            FROM poll_options po 
            WHERE po.poll_id = :poll_id
        ";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':poll_id', $pollId);
        $stmt->bindParam(':user_id', $userId);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function vote($optionId, $userId) {
        // First check if user already voted in THIS poll
        $pollQuery = "SELECT poll_id FROM poll_options WHERE id = :option_id";
        $pollStmt = $this->conn->prepare($pollQuery);
        $pollStmt->bindParam(':option_id', $optionId);
        $pollStmt->execute();
        $pollId = $pollStmt->fetchColumn();

        if (!$pollId) return false;

        $checkQuery = "
            SELECT COUNT(*) FROM poll_votes pv
            JOIN poll_options po ON pv.poll_option_id = po.id
            WHERE po.poll_id = :poll_id AND pv.user_id = :user_id
        ";
        $checkStmt = $this->conn->prepare($checkQuery);
        $checkStmt->bindParam(':poll_id', $pollId);
        $checkStmt->bindParam(':user_id', $userId);
        $checkStmt->execute();
        
        if ($checkStmt->fetchColumn() > 0) {
            return false; // Already voted
        }

        $query = "INSERT INTO poll_votes (poll_option_id, user_id) VALUES (:option_id, :user_id)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':option_id', $optionId);
        $stmt->bindParam(':user_id', $userId);
        return $stmt->execute();
    }
}
