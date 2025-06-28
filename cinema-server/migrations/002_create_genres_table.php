<?php
require("../connection/connection.php");

$query = "CREATE TABLE IF NOT EXISTS genres (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL
)";

$stmt = $mysqli->prepare($query);
$stmt->execute();

echo "genres table created successfully";