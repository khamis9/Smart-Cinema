<?php
require("../connection/connection.php");

$response = [];
$response["status"] = 200;

if (!isset($_GET["user_id"])) {
    $response["status"] = 400;
    $response["message"] = "User ID is required.";
    echo json_encode($response);
    return;
}

$user_id = $_GET["user_id"];

$stmt = $mysqli->prepare("SELECT * FROM preferences WHERE user_id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($row = $result->fetch_assoc()) {
    $response["preferences"] = $row;
} else {
    $response["preferences"] = null;
}

echo json_encode($response);
return;
