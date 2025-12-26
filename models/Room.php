<?php
require_once __DIR__ . "/../config/Database.php";

class Room {
    private $conn;
    private $table = "rooms";

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function getRoomsByHotel($hotel_id) {
        $query = "SELECT * FROM ".$this->table." WHERE hotel_id = :hotel_id ORDER BY id ASC";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":hotel_id", $hotel_id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

