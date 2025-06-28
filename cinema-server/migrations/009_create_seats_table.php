<?php
require("../connection/connection.php");

$query = "CREATE TABLE IF NOT EXISTS seats (
    id INT AUTO_INCREMENT PRIMARY KEY,
    booking_id INT NOT NULL,
    seat_number VARCHAR(10) NOT NULL,
    row_number VARCHAR(10) NOT NULL,
    status VARCHAR(50) DEFAULT 'booked',
    FOREIGN KEY (booking_id) REFERENCES bookings(id) ON DELETE CASCADE
)";
$stmt = $mysqli->prepare($query);
$stmt->execute();

echo "seats table created successfully";
