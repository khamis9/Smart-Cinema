<?php
require("../connection/connection.php");

$movies = [
    [
        "title" => "Inception",
        "description" => "A mind-bending thriller.",
        "trailer_url" => "https://youtube.com/inception",
        "release_date" => "2010-07-16",
        "rating" => "PG-13",
        "genres" => ["Action", "Sci-Fi"]
    ],
    [
        "title" => "The Notebook",
        "description" => "A romantic drama.",
        "trailer_url" => "https://youtube.com/notebook",
        "release_date" => "2004-06-25",
        "rating" => "PG-13",
        "genres" => ["Drama"]
    ],
    [
        "title" => "Get Out",
        "description" => "A horror mystery.",
        "trailer_url" => "https://youtube.com/getout",
        "release_date" => "2017-02-24",
        "rating" => "R",
        "genres" => ["Horror", "Drama"]
    ]
];

// map genre to id
$genreMap = [];
$result = $mysqli->query("SELECT id, name FROM genres");

while ($row = $result->fetch_assoc()) {
    $genreMap[$row['name']] = $row['id'];
}

// linking movies to genres
foreach ($movies as $m) {
    $stmt = $mysqli->prepare("INSERT INTO movies (title, description, trailer_url, release_date, rating) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $m["title"], $m["description"], $m["trailer_url"], $m["release_date"], $m["rating"]);
    $stmt->execute();

    $movie_id = $stmt->insert_id;

    foreach ($m["genres"] as $gName) {
        if (isset($genreMap[$gName])) {
            $genre_id = $genreMap[$gName];
            $link = $mysqli->prepare("INSERT INTO movie_genres (movie_id, genre_id) VALUES (?, ?)");
            $link->bind_param("ii", $movie_id, $genre_id);
            $link->execute();
        }
    }
}

echo "movies and their genre inserted successfully.";
