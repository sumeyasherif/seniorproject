<?php
require_once __DIR__ . '/../config/Database.php';

class Booking
{
    private $conn;
    private $table = "bookings";

    public function __construct()
    {
        $db = new Database();
        $this->conn = $db->getConnection();
    }

    public function create($data)
    {
        $query = "INSERT INTO " . $this->table . " (user_id, booking_type, reference_id, start_date, end_date, status) VALUES (:user_id, :booking_type, :reference_id, :start_date, :end_date, :status)";
        $stmt = $this->conn->prepare($query);

        $status = 'PENDING';
        return $stmt->execute([
            ':user_id' => $data['user_id'],
            ':booking_type' => $data['booking_type'],
            ':reference_id' => $data['reference_id'],
            ':start_date' => $data['start_date'],
            ':end_date' => $data['end_date'],
            ':status' => $status
        ]);
    }

    public function getByUser($user_id)
    {
        $query = "SELECT * FROM " . $this->table . " WHERE user_id = :user_id ORDER BY created_at DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
