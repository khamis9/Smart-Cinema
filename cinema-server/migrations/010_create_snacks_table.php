<?php
require("../connection/connection.php");

$query = "CREATE TABLE IF NOT EXISTS snacks (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    price DECIMAL(6,2) NOT NULL,
    description TEXT,
    image VARCHAR(255)
)";
$stmt = $mysqli->prepare($query);
$stmt->execute();

echo "snacks table created successfully";
