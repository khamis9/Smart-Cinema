<?php
require("../connection/connection.php");

$payments = [
    [1, "card", 30.00, "completed"],
    [2, "cash", 20.00, "pending"],
    [3, "card", 8.00, "completed"],
];

foreach ($payments as $p) {
    $booking_id = $p[0];
    $payment_method = $p[1];
    $amount = $p[2];
    $status = $p[3];

    $stmt = $mysqli->prepare("INSERT INTO payments (booking_id, payment_method, amount, status) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("issd", $booking_id, $payment_method, $amount, $status);
    $stmt->execute();
}

echo "payments inserted successfully";
