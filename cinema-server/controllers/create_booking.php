<?php
require("../models/Booking.php");
require("../connection/connection.php");

$response = ["status" => 200];

$data = json_decode(file_get_contents("php://input"), true);
if (!isset($data["user_id"], $data["showtime_id"], $data["total_price"])) {
    $response["status"] = 400;
    $response["message"] = "Missing fields";
    echo json_encode($response);
    return;
}

$stmt = $mysqli->prepare("INSERT INTO bookings (user_id, showtime_id, total_price, status) VALUES (?, ?, ?, 'pending')");
$stmt->bind_param("iid", $data["user_id"], $data["showtime_id"], $data["total_price"]);
$stmt->execute();

$response["message"] = "Booking created";
$response["booking_id"] = $stmt->insert_id;

echo json_encode($response);
