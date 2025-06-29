<?php
require("../connection/connection.php");

$bookings = [
    [1, 1, 30.00, 'confirmed'], // user_id, showtime_id, total_price, status
    [2, 2, 20.00, 'pending'],
    [3, 3, 8.00, 'confirmed'],
];

foreach ($bookings as $b) {
    $user_id = $b[0];
    $showtime_id = $b[1];
    $total_price = $b[2];
    $status = $b[3];

    $stmt = $mysqli->prepare("INSERT INTO bookings (user_id, showtime_id, total_price, status) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("iids", $user_id, $showtime_id, $total_price, $status);
    $stmt->execute();
}

echo "bookings inserted successfully";
