<?php
require("../models/Payment.php");
require("../connection/connection.php");

$response = ["status" => 200];

$data = json_decode(file_get_contents("php://input"), true);
if (!isset($data["booking_id"], $data["payment_method"], $data["amount"])) {
    $response["status"] = 400;
    $response["message"] = "Missing fields";
    echo json_encode($response);
    return;
}

$stmt = $mysqli->prepare("INSERT INTO payments (booking_id, payment_method, amount, status) VALUES (?, ?, ?, 'completed')");
$stmt->bind_param("isd", $data["booking_id"], $data["payment_method"], $data["amount"]);
$stmt->execute();

$response["message"] = "Payment recorded";
echo json_encode($response);
