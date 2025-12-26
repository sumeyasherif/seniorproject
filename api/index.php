<?php
header("Content-Type: application/json");

// include controllers
require_once __DIR__ . "/../controllers/AuthController.php";
require_once __DIR__ . "/../controllers/HotelController.php";
require_once __DIR__ . "/../controllers/RoomController.php";
require_once __DIR__ . "/../controllers/CarController.php";
require_once __DIR__ . "/../controllers/EventController.php";

// get action from URL
$action = $_GET['action'] ?? '';

// main switch
switch ($action) {

    case "register":
        $data = json_decode(file_get_contents("php://input"), true);
        $auth = new AuthController();
        echo json_encode($auth->register($data));
        break;

    case "login":
        $data = json_decode(file_get_contents("php://input"), true);
        $auth = new AuthController();
        echo json_encode($auth->login($data));
        break;

    case "hotels":
        require_once '../controllers/HotelController.php';
        $hotel = new HotelController();
        echo json_encode($hotel->getHotels());
        break;

    case "update_hotel":
        require_once '../controllers/HotelController.php';
        $hotel = new HotelController();
        $data = json_decode(file_get_contents("php://input"), true);
        echo json_encode($hotel->updateHotel($data));
        break;

    case "delete_hotel":
        require_once '../controllers/HotelController.php';
        $hotel = new HotelController();
        $data = json_decode(file_get_contents("php://input"), true); // Using POST/DELETE with body
        echo json_encode($hotel->deleteHotel($data['id']));
        break;

    case "cars":
        require_once '../controllers/CarController.php';
        $car = new CarController();
        echo json_encode($car->getCars());
        break;

    case "create_car":
        require_once '../controllers/CarController.php';
        $car = new CarController();
        $data = json_decode(file_get_contents("php://input"), true);
        echo json_encode($car->createCar($data));
        break;

    case "update_car":
        require_once '../controllers/CarController.php';
        $car = new CarController();
        $data = json_decode(file_get_contents("php://input"), true);
        echo json_encode($car->updateCar($data));
        break;

    case "delete_car":
        require_once '../controllers/CarController.php';
        $car = new CarController();
        $data = json_decode(file_get_contents("php://input"), true);
        echo json_encode($car->deleteCar($data['id']));
        break;

    case "events":
        require_once '../controllers/EventController.php';
        $event = new EventController();
        echo json_encode($event->getEvents());
        break;

    case "create_event":
        require_once '../controllers/EventController.php';
        $event = new EventController();
        $data = json_decode(file_get_contents("php://input"), true);
        echo json_encode($event->createEvent($data));
        break;

    case "update_event":
        require_once '../controllers/EventController.php';
        $event = new EventController();
        $data = json_decode(file_get_contents("php://input"), true);
        echo json_encode($event->updateEvent($data));
        break;

    case "delete_event":
        require_once '../controllers/EventController.php';
        $event = new EventController();
        $data = json_decode(file_get_contents("php://input"), true);
        echo json_encode($event->deleteEvent($data['id']));
        break;

    case "book":
        require_once '../controllers/BookingController.php';
        $booking = new BookingController();
        $data = json_decode(file_get_contents("php://input"), true);
        echo json_encode($booking->createBooking($data));
        break;

    case "my_bookings":
        require_once '../controllers/BookingController.php';
        $booking = new BookingController();
        echo json_encode($booking->getUserBookings($_GET['user_id']));
        break;

    case "pay":
        require_once '../controllers/PaymentController.php';
        $payment = new PaymentController();
        $data = json_decode(file_get_contents("php://input"), true);
        echo json_encode($payment->process($data));
        break;

    case "notifications":
        require_once '../controllers/NotificationController.php';
        $notif = new NotificationController();
        echo json_encode($notif->getUserNotifications($_GET['user_id']));
        break;

    case "admin_users":
        // Mocked because AdminController doesn't exist yet, returning hardcoded or implemented later
        // In real app: $admin->getAllUsers()
        echo json_encode([
            "status" => true,
            "data" => [
                ["id" => 1, "name" => "Admin User", "role" => "admin", "status" => "Active"],
                ["id" => 2, "name" => "Hotel Manager", "role" => "hotel_manager", "status" => "Active"],
                ["id" => 3, "name" => "Tourist One", "role" => "tourist", "status" => "Active"]
            ]
        ]);
        break;

    case "admin_bookings":
        // Mocked
        echo json_encode([
            "status" => true,
            "data" => [
                ["id" => 101, "item" => "Blue Sky Hotel", "user" => "Tourist One", "status" => "Confirmed"],
                ["id" => 102, "item" => "Toyota Corolla", "user" => "Tourist One", "status" => "Pending"]
            ]
        ]);
        break;

    case "admin_payments":
        // Mocked
        echo json_encode([
            "status" => true,
            "data" => [
                ["id" => 501, "amount" => "3500", "user" => "Tourist One", "status" => "Paid"],
                ["id" => 502, "amount" => "3000", "user" => "Tourist One", "status" => "Paid"]
            ]
        ]);
        break;

    default:
        echo json_encode([
            "status" => false,
            "message" => "Invalid API action"
        ]);
        break;
}

