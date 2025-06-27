<?php 

$db_host = "localhost";
$db_name = "cinema_db";
$db_user = "root";
$db_pass = "";

$mysqli = new mysqli($db_host, $db_user, $db_pass, $db_name);

if ($mysqli->connect_error) {
    die("connection failed". $mysqli->connect_error);
}

?>