<?php
require("../connection/connection.php");

$genres = ["Action", "Comedy", "Drama", "Sci-Fi", "Horror"];

foreach ($genres as $name) {
    $stmt = $mysqli->prepare("INSERT INTO genres (name) VALUES (?)");
    $stmt->bind_param("s", $name);
    $stmt->execute();
}

echo "genres inserted successfully";