<?php
require_once __DIR__ . '/../config/Database.php';

class Notification
{
    private $conn;
    private $table = "notifications";

    public function __construct()
    {
        $db = new Database();
        $this->conn = $db->getConnection();
    }

    public function getByUser($user_id)
    {
        $query = "SELECT * FROM " . $this->table . " WHERE user_id = :user_id ORDER BY created_at DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function send($user_id, $title, $message)
    {
        $query = "INSERT INTO " . $this->table . " (user_id, title, message) VALUES (:user_id, :title, :message)";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([
            ':user_id' => $user_id,
            ':title' => $title,
            ':message' => $message
        ]);
    }
}
