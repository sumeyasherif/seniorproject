<?php
require_once __DIR__ . '/../models/Event.php';

class EventController
{
    private $event;

    public function __construct()
    {
        $this->event = new Event();
    }

    public function getEvents()
    {
        return ["status" => true, "data" => $this->event->getAll()];
    }

    public function createEvent($data)
    {
        if ($this->event->create($data)) {
            return ["status" => true, "message" => "Event added successfully"];
        }
        return ["status" => false, "message" => "Failed to add event"];
    }

    public function updateEvent($data)
    {
        if ($this->event->update($data)) {
            return ["status" => true, "message" => "Event updated successfully"];
        }
        return ["status" => false, "message" => "Failed to update event"];
    }

    public function deleteEvent($id)
    {
        if ($this->event->delete($id)) {
            return ["status" => true, "message" => "Event deleted successfully"];
        }
        return ["status" => false, "message" => "Failed to delete event"];
    }
}
