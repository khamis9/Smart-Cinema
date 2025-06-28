<?php 
require("../models/Genre.php");
require("../connection/connection.php");

$response = [];
$response["status"] = 200;

if(!isset($_GET["id"])){
    $genres = Genre::all($mysqli); // returns an array of Genre objects

    $response["genres"] = [];
    foreach($genres as $g){
        $response["genres"][] = $g->toArray(); // convert each Genre object to an array
    }

    echo json_encode($response);
    return;
}

$id = $_GET["id"];
$genre = Genre::find($mysqli, $id);
$response["genre"] = $genre->toArray();

echo json_encode($response);
return;
