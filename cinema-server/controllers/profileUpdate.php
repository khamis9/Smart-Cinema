<?php
require("../models/User.php");
require("../connection/connection.php");

$response = [];
$response["status"] = 200;

$data = json_decode(file_get_contents("php://input"), true);

if (!isset($data["id"])) {
    $response["status"] = 400;
    $response["message"] = "Missing user ID.";
    echo json_encode($response);
    return;
}

/** @var User $user */
$user = User::find($mysqli, $data["id"]);

if (!$user) {
    $response["status"] = 404;
    $response["message"] = "User not found.";
    echo json_encode($response);
    return;
}

if (isset($data["name"])) {
    $user->setName($data["name"]);
}

if (isset($data["email"])) {
    $user->setEmail($data["email"]);
}

if (isset($data["phone"])) {
    $user->setPhone($data["phone"]);
}

$user->update($mysqli);

$response["message"] = "User updated successfully.";
$response["user"] = $user->toArray();

echo json_encode($response);
return;
