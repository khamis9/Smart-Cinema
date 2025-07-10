<?php
require("../connection/connection.php");

$response = ["status" => 200];
$data = json_decode(file_get_contents("php://input"), true);

if (!isset($data["title"], $data["trailer_url"], $data["rating"], $data["release_date"], $data["description"])) {
    $response["status"] = 400;
    $response["message"] = "Missing movie data";
    echo json_encode($response);
    return;
}

$stmt = $mysqli->prepare("INSERT INTO movies (title, trailer_url, rating, release_date, description) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("sssss", $data["title"], $data["trailer_url"], $data["rating"], $data["release_date"], $data["description"]);
$stmt->execute();

$response["message"] = "Movie added successfully";
$response["movie_id"] = $stmt->insert_id;
echo json_encode($response);
