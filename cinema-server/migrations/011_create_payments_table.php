<?php
require("../connection/connection.php");

$query = "CREATE TABLE IF NOT EXISTS payments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    booking_id INT NOT NULL,
    payment_method VARCHAR(100) NOT NULL,
    amount DECIMAL(8,2) NOT NULL,
    payment_time DATETIME DEFAULT CURRENT_TIMESTAMP,
    status VARCHAR(50) DEFAULT 'completed',
    FOREIGN KEY (booking_id) REFERENCES bookings(id) ON DELETE CASCADE
)";
$stmt = $mysqli->prepare($query);
$stmt->execute();

echo "payments table created successfully";
