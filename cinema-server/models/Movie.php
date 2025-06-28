<?php
require_once("Model.php");

class Movie extends Model {
    private int $id;
    private string $title;
    private string $description;
    private string $trailer_url;
    private string $release_date;
    private string $rating;
    private array $genres = [];

    protected static string $table = "movies";

    public function __construct(array $data){
        $this->id = $data["id"];
        $this->title = $data["title"];
        $this->description = $data["description"];
        $this->trailer_url = $data["trailer_url"];
        $this->release_date = $data["release_date"];
        $this->rating = $data["rating"];
    }

    public function loadGenres(mysqli $mysqli){
        $sql = "SELECT g.id, g.name 
                FROM genres g 
                INNER JOIN movie_genres mg ON g.id = mg.genre_id 
                WHERE mg.movie_id = ?";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param("i", $this->id);
        $stmt->execute();
        $result = $stmt->get_result();

        while ($row = $result->fetch_assoc()) {
            $this->genres[] = $row;
        }
    }

    public function toArray(): array {
        return [
            "id" => $this->id,
            "title" => $this->title,
            "description" => $this->description,
            "trailer_url" => $this->trailer_url,
            "release_date" => $this->release_date,
            "rating" => $this->rating,
            "genres" => $this->genres
        ];
    }

    public static function all(mysqli $mysqli): array {
        $sql = "SELECT * FROM " . static::$table;
        $stmt = $mysqli->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();

        $movies = [];
        while ($row = $result->fetch_assoc()) {
            $movie = new static($row);
            $movie->loadGenres($mysqli);
            $movies[] = $movie;
        }

        return $movies;
    }

    public static function find(mysqli $mysqli, int $id): ?Movie {
        $sql = "SELECT * FROM " . static::$table . " WHERE id = ?";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $data = $stmt->get_result()->fetch_assoc();

        if (!$data) return null;

        $movie = new static($data);
        $movie->loadGenres($mysqli);
        return $movie;
    }
}
