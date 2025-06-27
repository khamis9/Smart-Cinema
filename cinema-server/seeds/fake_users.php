<?php
require("../connection/connection.php");

$users = [
    ["charbel", "charbel@example.com", "70123456", "password1"],
    ["hussein", "hussein@example.com", "76123456", "password2"],
    ["mahmoud", "mahmoud@example.com", "71123456", "password3"]
];

foreach ($users as $u) {
    $name = $u[0];
    $email = $u[1];
    $phone = $u[2];
    $password = password_hash($u[3], PASSWORD_DEFAULT);

    $stmt = $mysqli->prepare("INSERT INTO users (name, email, phone, password) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $name, $email, $phone, $password);
    $stmt->execute();
}

echo "inserted successfully";