<?php
require_once __DIR__ . '/../models/Car.php';

class CarController
{
    private $car;

    public function __construct()
    {
        $this->car = new Car();
    }

    public function getCars()
    {
        return ["status" => true, "data" => $this->car->getAll()];
    }

    public function createCar($data)
    {
        if ($this->car->create($data)) {
            return ["status" => true, "message" => "Car added successfully"];
        }
        return ["status" => false, "message" => "Failed to add car"];
    }

    public function updateCar($data)
    {
        if ($this->car->update($data)) {
            return ["status" => true, "message" => "Car updated successfully"];
        }
        return ["status" => false, "message" => "Failed to update car"];
    }

    public function deleteCar($id)
    {
        if ($this->car->delete($id)) {
            return ["status" => true, "message" => "Car deleted successfully"];
        }
        return ["status" => false, "message" => "Failed to delete car"];
    }
}
