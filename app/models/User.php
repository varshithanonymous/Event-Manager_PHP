<?php
require_once __DIR__ . '/../../config/database.php';

class User {
    private $conn;
    private $table_name = "users";

    public $id;
    public $phone;
    public $name;
    public $bio;
    public $interests;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    // Find user by phone
    public function findByPhone($phone) {
        if (!$this->conn) return false;
        $query = "SELECT * FROM " . $this->table_name . " WHERE phone = ? LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $phone);
        $stmt->execute();

        if($stmt->rowCount() > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $this->id = $row['id'];
            $this->phone = $row['phone'];
            $this->name = $row['name'];
            $this->bio = $row['bio'];
            $this->interests = $row['interests'];
            return $row;
        }
        return false;
    }

    // Create new user with just phone (first step)
    public function createWithPhone($phone) {
        if (!$this->conn) return false;
        $query = "INSERT INTO " . $this->table_name . " SET phone = :phone";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':phone', $phone);

        if($stmt->execute()) {
            $this->id = $this->conn->lastInsertId();
            return true;
        }
        return false;
    }

    // Update profile
    public function updateProfile($id, $name, $bio, $interests) {
        if (!$this->conn) return false;
        $query = "UPDATE " . $this->table_name . " 
                  SET name = :name, bio = :bio, interests = :interests 
                  WHERE id = :id";
        
        $stmt = $this->conn->prepare($query);
        
        // Sanitize
        $name = htmlspecialchars(strip_tags($name));
        $bio = htmlspecialchars(strip_tags($bio));
        // Interests assumed to be valid JSON string
        
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':bio', $bio);
        $stmt->bindParam(':interests', $interests);
        $stmt->bindParam(':id', $id);

        return $stmt->execute();
    }
}
?>
