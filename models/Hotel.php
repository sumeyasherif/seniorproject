<?php
require_once __DIR__ . '/../config/Database.php';

class Hotel
{
    private $conn;
    private $table = "hotels";

    public function __construct()
    {
        $db = new Database();
        $this->conn = $db->getConnection();
    }

    public function getAll()
    {
        $query = "SELECT * FROM " . $this->table;
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

    // Admin methods
    public function create($data)
    {
        $query = "INSERT INTO " . $this->table . " (name, location, description, image_url) VALUES (:name, :location, :description, :image_url)";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([
            ':name' => $data['name'],
            ':location' => $data['location'],
            ':description' => $data['description'],
            ':image_url' => $data['image_url']
        ]);
    }

    public function update($data)
    {
        $query = "UPDATE " . $this->table . " SET name = :name, location = :location, description = :description, image_url = :image_url WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([
            ':id' => $data['id'],
            ':name' => $data['name'],
            ':location' => $data['location'],
            ':description' => $data['description'],
            ':image_url' => $data['image_url']
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
