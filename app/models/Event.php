<?php
require_once __DIR__ . '/../../config/database.php';

class Event {
    private $conn;
    private $table_name = "events";

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function getAll($limit = 10) {
        if (!$this->conn) return [];
        $query = "SELECT e.*, u.name as organizer_name 
                  FROM " . $this->table_name . " e
                  LEFT JOIN users u ON e.organizer_id = u.id
                  ORDER BY e.created_at DESC
                  LIMIT :limit";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    // Create Event
    public function create($data) {
        if (!$this->conn) return false;
        $query = "INSERT INTO " . $this->table_name . "
                  SET organizer_id=:organizer_id, title=:title, description=:description,
                      start_time=:start_time, location_name=:location_name, 
                      latitude=:latitude, longitude=:longitude, category=:category, image_url=:image_url, created_at=NOW()";
                      
        $stmt = $this->conn->prepare($query);
        
        // Bind parameters (simplified for brevity)
        foreach ($data as $key => $value) {
            $stmt->bindValue(':'.$key, $value);
        }
        
        if ($stmt->execute()) {
             return $this->conn->lastInsertId();
        }
        return false;
    }
    
    public function getById($id) {
        if (!$this->conn) return false;
         $query = "SELECT e.*, u.name as organizer_name 
                  FROM " . $this->table_name . " e
                  LEFT JOIN users u ON e.organizer_id = u.id
                  WHERE e.id = ? 
                  LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>
