<?php
require("../models/Seat.php");
require("../connection/connection.php");

$response = ["status" => 200];
$data = json_decode(file_get_contents("php://input"), true);

if (!isset($data["seat_id"]) || !isset($data["status"])) {
    $response["status"] = 400;
    $response["message"] = "Missing seat_id or status";
    echo json_encode($response);
    return;
}

$stmt = $mysqli->prepare("UPDATE seats SET status = ? WHERE id = ?");
$stmt->bind_param("si", $data["status"], $data["seat_id"]);
$stmt->execute();

$response["message"] = "Seat updated";
echo json_encode($response);
