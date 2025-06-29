<?php
require_once("Model.php");

class Seat extends Model {
    private int $id;
    private int $screen_id;
    private string $seat_number;
    private string $status; // available, locked, booked

    protected static string $table = "seats";

    public function __construct(array $data) {
        $this->id = $data["id"];
        $this->screen_id = $data["screen_id"];
        $this->seat_number = $data["seat_number"];
        $this->status = $data["status"];
    }

    public static function allByShowtime(mysqli $mysqli, int $showtime_id): array {
        $sql = "SELECT * FROM seats WHERE showtime_id = ?";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param("i", $showtime_id);
        $stmt->execute();
        $result = $stmt->get_result();

        $seats = [];
        while ($row = $result->fetch_assoc()) {
            $seats[] = new Seat($row);
        }
        return $seats;
    }

    public function toArray() {
        return [
            "id" => $this->id,
            "screen_id" => $this->screen_id,
            "seat_number" => $this->seat_number,
            "status" => $this->status,
        ];
    }
}
