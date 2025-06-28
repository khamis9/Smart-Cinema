<?php
require("../connection/connection.php");

$preferences = [
    [1, "email"],
    [2, "sms"],
    [3, "none"]
];

foreach ($preferences as $pref) {
    $stmt = $mysqli->prepare("INSERT INTO preferences (user_id, preferred_communication) VALUES (?, ?)");
    $stmt->bind_param("is", $pref[0], $pref[1]);
    $stmt->execute();
}

echo "preferences inserted successfully.";
