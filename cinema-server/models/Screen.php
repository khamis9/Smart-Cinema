<?php
require_once("Model.php");

class Screen extends Model {
    private int $id;
    private string $name;
    private int $capacity;

    protected static string $table = "screens";

    public function __construct(array $data) {
        $this->id = $data["id"];
        $this->name = $data["name"];
        $this->capacity = $data["capacity"];
    }

    public function toArray() {
        return [
            "id" => $this->id,
            "name" => $this->name,
            "capacity" => $this->capacity
        ];
    }
}
