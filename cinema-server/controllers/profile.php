<?php
require("../models/User.php");
require("../connection/connection.php");

$response = [];
$response["status"] = 200;

if (!isset($_GET["id"])) {
    $response["status"] = 400;
    $response["message"] = "User ID is required.";
    echo json_encode($response);
    return;
}

$id = $_GET["id"];
$user = User::find($mysqli, $id);

if (!$user) {
    $response["status"] = 404;
    $response["message"] = "User not found.";
    echo json_encode($response);
    return;
}

$response["user"] = $user->toArray();

echo json_encode($response);
return;
