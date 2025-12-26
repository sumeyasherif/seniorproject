<?php
require_once __DIR__ . '/../config/Database.php';

class Payment
{
    private $conn;
    private $table = "payments";

    public function __construct()
    {
        $db = new Database();
        $this->conn = $db->getConnection();
    }

    public function processPayment($booking_id, $amount, $method)
    {
        $query = "INSERT INTO " . $this->table . " (booking_id, amount, payment_method, payment_status, transaction_ref) VALUES (:booking_id, :amount, :method, 'SUCCESS', :ref)";
        $stmt = $this->conn->prepare($query);

        // Mock transaction reference
        $ref = "TXN_" . strtoupper(uniqid());

        return $stmt->execute([
            ':booking_id' => $booking_id,
            ':amount' => $amount,
            ':method' => $method,
            ':ref' => $ref
        ]);
    }
}
