<?php
require("../connection/connection.php");

$showtimes = [
    ["movie_id" => 1, "screen_id" => 1, "start_time" => "2025-07-01 19:00:00"],
    ["movie_id" => 2, "screen_id" => 2, "start_time" => "2025-07-01 21:00:00"],
    ["movie_id" => 3, "screen_id" => 1, "start_time" => "2025-07-02 18:00:00"]
];

foreach ($showtimes as $s) {
    $stmt = $mysqli->prepare("INSERT INTO showtimes (movie_id, screen_id, start_time) VALUES (?, ?, ?)");
    $stmt->bind_param("iis", $s["movie_id"], $s["screen_id"], $s["start_time"]);
    $stmt->execute();
}

echo "showtimes inserted successfully";
