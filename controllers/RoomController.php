<?php
require_once __DIR__ . "/../models/Room.php";

class RoomController {
    private $room;

    public function __construct() {
        $this->room = new Room();
    }

    // List all rooms by hotel_id
    public function listByHotel($hotel_id) {
        return $this->room->getRoomsByHotel($hotel_id);
    }
}
