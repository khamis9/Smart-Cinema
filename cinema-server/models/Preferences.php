<?php
require_once("Model.php");

class Preference extends Model {
    private int $id;
    private int $user_id;
    private string $preferred_communication;

    protected static string $table = "preferences";

    public function __construct(array $data) {
        $this->id = $data["id"];
        $this->user_id = $data["user_id"];
        $this->preferred_communication = $data["preferred_communication"];
    }

    public function toArray() {
        return [
            "id" => $this->id,
            "user_id" => $this->user_id,
            "preferred_communication" => $this->preferred_communication
        ];
    }
}
