<?php
require("../connection/connection.php");

$query = "CREATE TABLE preferences (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    preferred_communication ENUM('email', 'sms', 'none') DEFAULT 'email',
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
)";

$stmt = $mysqli->prepare($query);
$stmt->execute();

echo "preferences table created successfully";
