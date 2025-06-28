<?php
require("../connection/connection.php");

$response = [];
$response["status"] = 200;

$data = json_decode(file_get_contents("php://input"), true);

if (!isset($data["user_id"]) || !isset($data["preferred_communication"])) {
    $response["status"] = 400;
    $response["message"] = "Missing user_id or preferred_communication.";
    echo json_encode($response);
    return;
}

$user_id = $data["user_id"];
$pref = $data["preferred_communication"];

$stmt = $mysqli->prepare("UPDATE preferences SET preferred_communication = ? WHERE user_id = ?");
$stmt->bind_param("si", $pref, $user_id);
$stmt->execute();

$response["message"] = "Preferences updated successfully.";
echo json_encode($response);
return;
