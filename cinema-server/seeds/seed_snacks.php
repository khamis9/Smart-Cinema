<?php
require("../connection/connection.php");

$snacks = [
    ["name" => "Popcorn", "price" => 3.50, "description" => "Classic buttered popcorn", "image" => "popcorn.jpg"],
    ["name" => "Soda", "price" => 2.00, "description" => "Refreshing soft drink", "image" => "soda.jpg"],
    ["name" => "Nachos", "price" => 4.50, "description" => "Tortilla chips with cheese", "image" => "nachos.jpg"]
];

foreach ($snacks as $snack) {
    $stmt = $mysqli->prepare("INSERT INTO snacks (name, price, description, image) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("sdss", $snack["name"], $snack["price"], $snack["description"], $snack["image"]);
    $stmt->execute();
}

echo "snacks inserted successfully";
