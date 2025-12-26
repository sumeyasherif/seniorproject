<?php
require_once __DIR__ . '/../models/Hotel.php';

class HotelController
{
    private $hotel;

    public function __construct()
    {
        $this->hotel = new Hotel();
    }

    public function getHotels()
    {
        return ["status" => true, "data" => $this->hotel->getAll()];
    }

    public function getHotelDetails($id)
    {
        $data = $this->hotel->getById($id);
        if ($data) {
            return ["status" => true, "data" => $data];
        }
        return ["status" => false, "message" => "Hotel not found"];
    }

    public function updateHotel($data)
    {
        if ($this->hotel->update($data)) {
            return ["status" => true, "message" => "Hotel updated successfully"];
        }
        return ["status" => false, "message" => "Failed to update hotel"];
    }

    public function deleteHotel($id)
    {
        if ($this->hotel->delete($id)) {
            return ["status" => true, "message" => "Hotel deleted successfully"];
        }
        return ["status" => false, "message" => "Failed to delete hotel"];
    }
}
