<?php
require_once("Model.php");

class Payment extends Model {
    private int $id;
    private int $booking_id;
    private string $payment_method;
    private float $amount;
    private string $payment_time;
    private string $status;

    protected static string $table = "payments";

    public function __construct(array $data) {
        $this->id = $data["id"];
        $this->booking_id = $data["booking_id"];
        $this->payment_method = $data["payment_method"];
        $this->amount = $data["amount"];
        $this->payment_time = $data["payment_time"];
        $this->status = $data["status"];
    }

    public function toArray() {
        return [
            "id" => $this->id,
            "booking_id" => $this->booking_id,
            "payment_method" => $this->payment_method,
            "amount" => $this->amount,
            "payment_time" => $this->payment_time,
            "status" => $this->status,
        ];
    }
}
