<?php
require("../connection/connection.php");

$query = "CREATE TABLE IF NOT EXISTS movies (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    description TEXT,
    trailer_url VARCHAR(500),
    release_date DATE,
    rating VARCHAR(10)
)";

$stmt = $mysqli->prepare($query);
$stmt->execute();

echo "movies table created successfully";