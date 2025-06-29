<?php
require("../models/User.php");
require("../models/Preferences.php");
require("../models/Movie.php");
require("../models/Showtime.php");
require("../connection/connection.php");

$response = ["status" => 200];

if (!isset($_GET["user_id"])) {
    $response["status"] = 400;
    $response["message"] = "Missing user_id";
    echo json_encode($response);
    return;
}

// Auto-book based on favorite genre for this user
$user_id = $_GET["user_id"];
/** @var Preferences $pref */
$pref = Preferences::find($mysqli, $user_id);
if ($pref !== null) {
    $genre_id = $pref->getGenreId();
}

$query = $mysqli->prepare("SELECT showtimes.id, movies.name FROM showtimes
JOIN movies ON showtimes.movie_id = movies.id
JOIN movie_genres ON movies.id = movie_genres.movie_id
WHERE movie_genres.genre_id = ? ORDER BY showtimes.start_time ASC LIMIT 1");
$query->bind_param("i", $genre_id);
$query->execute();
$result = $query->get_result();
$showtime = $result->fetch_assoc();

if (!$showtime) {
    $response["message"] = "No showtime found for preferred genre.";
    echo json_encode($response);
    return;
}

$stmt = $mysqli->prepare("INSERT INTO bookings (user_id, showtime_id, total_price, status) VALUES (?, ?, ?, 'confirmed')");
$default_price = 10.00;
$stmt->bind_param("iid", $user_id, $showtime["id"], $default_price);
$stmt->execute();

$response["message"] = "Auto-booked for " . $showtime["name"];
$response["booking_id"] = $stmt->insert_id;
echo json_encode($response);
