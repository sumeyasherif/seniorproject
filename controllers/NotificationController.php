<?php
require_once __DIR__ . '/../models/Notification.php';

class NotificationController
{
    private $notification;

    public function __construct()
    {
        $this->notification = new Notification();
    }

    public function getUserNotifications($user_id)
    {
        return ["status" => true, "data" => $this->notification->getByUser($user_id)];
    }
}
