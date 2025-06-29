<?php
require("../connection/connection.php");

$response = ["status" => 200];
$data = json_decode(file_get_contents("php://input"), true);

if (!isset($data["name"], $data["trailer"], $data["cast"], $data["rating"])) {
    $response["status"] = 400;
    $response["message"] = "Missing movie data";
    echo json_encode($response);
    return;
}

$stmt = $mysqli->prepare("INSERT INTO movies (name, trailer, cast, rating) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ssss", $data["name"], $data["trailer"], $data["cast"], $data["rating"]);
$stmt->execute();

$response["message"] = "Movie added successfully";
$response["movie_id"] = $stmt->insert_id;
echo json_encode($response);
