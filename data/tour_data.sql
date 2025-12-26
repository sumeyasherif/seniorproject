-- Database: tour_travel_system
CREATE DATABASE IF NOT EXISTS tour_travel_system;
USE tour_travel_system;

-- 1. Roles
CREATE TABLE IF NOT EXISTS roles (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL UNIQUE
);

INSERT IGNORE INTO roles (name) VALUES
('Admin'),
('Tourist'),
('HotelManager'),
('CarManager'),
('EventOrganizer');

-- 2. Users
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    role_id INT NOT NULL,
    full_name VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE,
    phone VARCHAR(20),
    password VARCHAR(255) NOT NULL,
    status ENUM('ACTIVE','BLOCKED') DEFAULT 'ACTIVE',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (role_id) REFERENCES roles(id)
);

-- 3. Hotels
CREATE TABLE IF NOT EXISTS hotels (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(150) NOT NULL,
    location VARCHAR(150) NOT NULL,
    description TEXT,
    image_url VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- 4. Rooms
CREATE TABLE IF NOT EXISTS rooms (
    id INT AUTO_INCREMENT PRIMARY KEY,
    hotel_id INT NOT NULL,
    room_type VARCHAR(100),
    price_per_night DECIMAL(10,2),
    total_rooms INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (hotel_id) REFERENCES hotels(id) ON DELETE CASCADE
);

-- 5. Cars
CREATE TABLE IF NOT EXISTS cars (
    id INT AUTO_INCREMENT PRIMARY KEY,
    company_name VARCHAR(150),
    model VARCHAR(100),
    price_per_day DECIMAL(10,2),
    image_url VARCHAR(255),
    status ENUM('AVAILABLE','RENTED') DEFAULT 'AVAILABLE',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- 6. Events
CREATE TABLE IF NOT EXISTS events (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(150) NOT NULL,
    location VARCHAR(150),
    event_date DATE,
    description TEXT,
    image_url VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- 7. Bookings
CREATE TABLE IF NOT EXISTS bookings (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    booking_type ENUM('HOTEL','CAR') NOT NULL,
    reference_id INT NOT NULL,
    start_date DATE,
    end_date DATE,
    status ENUM('PENDING','CONFIRMED','CANCELLED') DEFAULT 'PENDING',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id)
);

-- 8. Payments
CREATE TABLE IF NOT EXISTS payments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    booking_id INT NOT NULL,
    amount DECIMAL(10,2),
    payment_method VARCHAR(50),
    payment_status ENUM('SUCCESS','FAILED') DEFAULT 'SUCCESS',
    transaction_ref VARCHAR(100),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (booking_id) REFERENCES bookings(id)
);

-- 9. Notifications
CREATE TABLE IF NOT EXISTS notifications (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    title VARCHAR(150),
    message TEXT,
    is_read BOOLEAN DEFAULT FALSE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id)
);

-- Seed Data

-- Hotels
INSERT INTO hotels (name, location, description, image_url) VALUES
('Blue Sky Hotel', 'Addis Ababa', 'Luxury 5-star hotel with modern amenities.', 'https://images.unsplash.com/photo-1501117716987-c8e1ecb210b0'),
('Sunset Resort', 'Bahir Dar', 'Relaxing resort near Lake Tana.', 'https://images.unsplash.com/photo-1560347876-aeef00ee58a1'),
('Mountain View Inn', 'Lalibela', 'Comfortable rooms with amazing mountain views.', 'https://images.unsplash.com/photo-1582719478173-3e6f3fc3e47f'),
('Red Rock Hotel', 'Axum', 'Elegant hotel close to historical sites.', 'https://images.unsplash.com/photo-1600585154340-be6161a56a0c'),
('Riverfront Lodge', 'Gondar', 'Cozy lodge by the river with great service.', 'https://images.unsplash.com/photo-1576675783446-dcd5b2b14d44');

-- Rooms
INSERT INTO rooms (hotel_id, room_type, price_per_night, total_rooms) VALUES
(1, 'Standard Room', 80.00, 20),
(1, 'Deluxe Room', 120.00, 10),
(2, 'Lake View Room', 100.00, 15),
(2, 'Suite', 180.00, 5),
(3, 'Standard Room', 60.00, 25),
(3, 'Deluxe Room', 100.00, 10),
(4, 'Standard Room', 70.00, 20),
(4, 'Suite', 150.00, 5),
(5, 'Standard Room', 50.00, 30),
(5, 'Deluxe Room', 90.00, 10);

-- Cars
INSERT INTO cars (company_name, model, price_per_day, image_url, status) VALUES
('Ethiopia Car Rentals', 'Toyota Corolla', 35.00, 'https://images.unsplash.com/photo-1549921296-3a3b9a4304ef', 'AVAILABLE'),
('Addis Rent-a-Car', 'Toyota Land Cruiser', 70.00, 'https://images.unsplash.com/photo-1598887142486-902d1c32f87a', 'AVAILABLE'),
('Sun Car Hire', 'Hyundai Tucson', 50.00, 'https://images.unsplash.com/photo-1571607384355-6c9b9e5aa9dc', 'AVAILABLE'),
('Blue Sky Cars', 'Ford Explorer', 60.00, 'https://images.unsplash.com/photo-1586190848861-99aa4a171e90', 'AVAILABLE'),
('Lake Rent', 'Kia Sportage', 45.00, 'https://images.unsplash.com/photo-1611095973516-cd9b87d8e9a1', 'AVAILABLE');

-- Events
INSERT INTO events (name, location, event_date, description, image_url) VALUES
('Timkat Festival', 'Addis Ababa', '2026-01-19', 'Ethiopian Orthodox celebration of Epiphany.', 'https://images.unsplash.com/photo-1579338558782-3c51b0e9b5f1'),
('Meskel Festival', 'Addis Ababa', '2026-09-27', 'Finding of the True Cross festival in Ethiopia.', 'https://images.unsplash.com/photo-1593784992744-6fc0a0722e2a'),
('Irreecha Festival', 'Bishoftu', '2026-10-04', 'Oromo thanksgiving festival.', 'https://images.unsplash.com/photo-1581188952237-bcc6cb40917f'),
('Gena (Ethiopian Christmas)', 'Addis Ababa', '2026-01-07', 'Traditional Ethiopian Christmas celebration.', 'https://images.unsplash.com/photo-1600513655197-832f5589d9e0'),
('Fichee-Chambalaalla', 'Oromia', '2026-02-01', 'Oromo New Year festival.', 'https://images.unsplash.com/photo-1570129477492-45c003edd2be');
