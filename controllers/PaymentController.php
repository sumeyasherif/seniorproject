<?php
require_once __DIR__ . '/../models/Payment.php';

class PaymentController
{
    private $payment;

    public function __construct()
    {
        $this->payment = new Payment();
    }

    public function process($data)
    {
        if (!isset($data['booking_id']) || !isset($data['amount']) || !isset($data['payment_method'])) {
            return ["status" => false, "message" => "Missing payment details"];
        }

        // Mock payment logic: Always success
        if ($this->payment->processPayment($data['booking_id'], $data['amount'], $data['payment_method'])) {
            return ["status" => true, "message" => "Payment successful"];
        }
        return ["status" => false, "message" => "Payment failed"];
    }
}
