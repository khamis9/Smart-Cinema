<?php
require("../connection/connection.php");

$query = "CREATE TABLE IF NOT EXISTS users(
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    phone VARCHAR(20),
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";

$execute = $mysqli->prepare($query);
$execute->execute();

echo "users table created successfully";