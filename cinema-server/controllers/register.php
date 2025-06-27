<?php
require("../models/User.php");
require("../connection/connection.php");

$response = [];
$response["status"] = 200;

$data = json_decode(file_get_contents("php://input"), true);

if (!isset($data["name"], $data["email"], $data["password"])){
    $response["status"] = 400;
    $response["message"] = "missing: name, email, pass";
    echo json_encode($response);
    return;
}

$name = $data["name"];
$email = $data["email"];
$phone = $data["phone"];
$password = password_hash($data["password"], PASSWORD_DEFAULT);

$stmt = $mysqli->prepare("INSERT INTO users (name, email, phone, password) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ssss", $name, $email, $phone, $password);

if ($stmt->execute()) {
    $response["message"] = "registered successfully";
} else {
    $response["status"] = 500;
    $response["message"] = "registration failed" . $mysqli->error;
}

echo json_encode($response);
return;