<?php
require("../connection/connection.php");

$result = $mysqli->query("SELECT id FROM bookings");
$bookings = [];

while ($row = $result->fetch_assoc()) {
    $bookings[] = $row['id'];
}

foreach ($bookings as $booking_id) {
    $seats = [
        ["A", "1"],
        ["A", "2"],
        ["A", "3"]
    ];

    foreach ($seats as [$row_letter, $seat_number]) {
        $full_seat_number = $row_letter . $seat_number;
        $status = "booked";
        
        $stmt = $mysqli->prepare("INSERT INTO seats (booking_id, seat_number, row_number, status) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("isss", $booking_id, $full_seat_number, $row_letter, $status);
        $stmt->execute();
    }
}

echo "seats inserted successfully";
