<?php
require("../connection/connection.php");

$screens = [
    ["Screen A", 100],
    ["Screen B", 80],
];

foreach ($screens as $s) {
    $name = $s[0];
    $capacity = $s[1];

    $stmt = $mysqli->prepare("INSERT INTO screens (name, capacity) VALUES (?, ?)");
    $stmt->bind_param("si", $name, $capacity);
    $stmt->execute();
}

echo "screens inserted successfully";
