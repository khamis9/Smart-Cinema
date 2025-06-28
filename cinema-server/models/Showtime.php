<?php
require_once("Model.php");

class Showtime extends Model {
    private int $id;
    private int $movie_id;
    private int $screen_id;
    private string $start_time;

    protected static string $table = "showtimes";

    public function __construct(array $data) {
        $this->id = $data["id"];
        $this->movie_id = $data["movie_id"];
        $this->screen_id = $data["screen_id"];
        $this->start_time = $data["start_time"];
    }

    public function toArray() {
        return [
            "id" => $this->id,
            "movie_id" => $this->movie_id,
            "screen_id" => $this->screen_id,
            "start_time" => $this->start_time
        ];
    }
}
