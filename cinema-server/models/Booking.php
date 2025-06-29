<?php
require_once("Model.php");

class Booking extends Model {
    private int $id;
    private int $user_id;
    private int $showtime_id;
    private float $total_price;
    private string $booking_time;
    private string $status;

    protected static string $table = "bookings";

    public function __construct(array $data) {
        $this->id = $data["id"];
        $this->user_id = $data["user_id"];
        $this->showtime_id = $data["showtime_id"];
        $this->total_price = $data["total_price"];
        $this->booking_time = $data["booking_time"];
        $this->status = $data["status"];
    }

    public function toArray() {
        return [
            "id" => $this->id,
            "user_id" => $this->user_id,
            "showtime_id" => $this->showtime_id,
            "total_price" => $this->total_price,
            "booking_time" => $this->booking_time,
            "status" => $this->status,
        ];
    }
}
