<?php
require_once __DIR__ . '/../models/Booking.php';

class BookingController
{
    private $booking;

    public function __construct()
    {
        $this->booking = new Booking();
    }

    public function createBooking($data)
    {
        // Basic validation
        if (!isset($data['user_id']) || !isset($data['booking_type']) || !isset($data['reference_id'])) {
            return ["status" => false, "message" => "Missing required fields"];
        }

        if ($this->booking->create($data)) {
            return ["status" => true, "message" => "Booking created successfully"];
        }
        return ["status" => false, "message" => "Booking failed"];
    }

    public function getUserBookings($user_id)
    {
        return ["status" => true, "data" => $this->booking->getByUser($user_id)];
    }
}
