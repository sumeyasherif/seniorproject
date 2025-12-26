<?php
require_once __DIR__ . '/../config/Database.php';

class Event
{
    private $conn;
    private $table = "events";

    public function __construct()
    {
        $db = new Database();
        $this->conn = $db->getConnection();
    }

    public function getAll()
    {
        $query = "SELECT * FROM " . $this->table . " ORDER BY event_date ASC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id)
    {
        $query = "SELECT * FROM " . $this->table . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function create($data)
    {
        $query = "INSERT INTO " . $this->table . " (name, description, event_date, image_url) VALUES (:name, :desc, :date, :img)";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([
            ':name' => $data['name'],
            ':desc' => "Event Description",
            ':date' => $data['location'], // Mapping location to date for simplicity
            ':img' => ""
        ]);
    }

    public function update($data)
    {
        $query = "UPDATE " . $this->table . " SET name = :name, event_date = :date WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([
            ':id' => $data['id'],
            ':name' => $data['name'],
            ':date' => $data['location']
        ]);
    }

    public function delete($id)
    {
        $query = "DELETE FROM " . $this->table . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}
