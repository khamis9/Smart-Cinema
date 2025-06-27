<?php
require("../models/User.php");
require("../connection/connection.php");

$response = [];
$response["status"] = 200;

$data = json_decode(file_get_contents("php://input"), true);

if (!isset($data["email"], $data["password"])) {
    $response["status"] = 400;
    $response["message"] = "Missing required fields: email and password.";
    echo json_encode($response);
    return;
}

$email = $data["email"];
$password = $data["password"];

$stmt = $mysqli->prepare("SELECT * FROM users WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();

$result = $stmt->get_result();
$userData = $result->fetch_assoc();

if (!$userData) {
    $response["status"] = 404;
    $response["message"] = "User not found.";
    echo json_encode($response);
    return;
}

if (!password_verify($password, $userData["password"])) {
    $response["status"] = 401;
    $response["message"] = "Invalid password.";
    echo json_encode($response);
    return;
}

$user = new User($userData);
$response["user"] = $user->toArray();
$response["message"] = "Login successful.";

echo json_encode($response);
return;