<?php
require("../connection/connection.php");

$query = "CREATE TABLE IF NOT EXISTS screens (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    capacity INT NOT NULL
)";

$stmt = $mysqli->prepare($query);
$stmt->execute();

echo "screens table created successfully";
