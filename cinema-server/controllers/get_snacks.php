<?php
require("../models/Snack.php");
require("../connection/connection.php");

$response = ["status" => 200];
$snacks = Snack::all($mysqli);

$response["snacks"] = [];

/** @var Snack $snack */
foreach ($snacks as $snack) {
    $response["snacks"][] = $snack->toArray();
}

echo json_encode($response);
