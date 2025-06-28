<?php 
require("../models/Movie.php");
require("../connection/connection.php");

$response = [];
$response["status"] = 200;

if(!isset($_GET["id"])){
    $movies = Movie::all($mysqli); // returns an array of Movie objects

    $response["movies"] = [];
    foreach($movies as $m){
        $response["movies"][] = $m->toArray(); // convert each Movie object to an array
    }

    echo json_encode($response);
    return;
}

$id = $_GET["id"];
$movie = Movie::find($mysqli, $id);
$response["movie"] = $movie->toArray();

echo json_encode($response);
return;
