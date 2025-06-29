<?php
require("../models/Seat.php");
require("../connection/connection.php");

$response = ["status" => 200];

if (!isset($_GET["showtime_id"])) {
    $response["status"] = 400;
    $response["message"] = "Missing showtime_id";
    echo json_encode($response);
    return;
}

$showtime_id = $_GET["showtime_id"];
$seats = Seat::allByShowtime($mysqli, $showtime_id);

$response["seats"] = [];
foreach ($seats as $seat) {
    $response["seats"][] = $seat->toArray();
}

echo json_encode($response);
