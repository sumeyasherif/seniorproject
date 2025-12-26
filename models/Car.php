<?php
require_once __DIR__ . '/../config/Database.php';

class Car
{
    private $conn;
    private $table = "cars";

    public function __construct()
    {
        $db = new Database();
        $this->conn = $db->getConnection();
    }
    //xz
    public function getAll()
    {
        $query = "SELECT * FROM " . $this->table;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create($data)
    {
        $query = "INSERT INTO " . $this->table . " (model, company_name, price_per_day, image_url) VALUES (:model, :company, :price, :image_url)";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([
            ':model' => $data['name'], // Frontend sends 'name'
            ':company' => "Rental Co.", // Default or passed
            ':price' => $data['location'], // Frontend sends 'location' as generic detail field, mapped to price
            ':image_url' => ""
        ]);
    }

    public function update($data)
    {
        $query = "UPDATE " . $this->table . " SET model = :model, price_per_day = :price WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([
            ':id' => $data['id'],
            ':model' => $data['name'],
            ':price' => $data['location']
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
