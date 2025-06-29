<?php
require_once("Model.php");

class Snack extends Model {
    private int $id;
    private string $name;
    private float $price;

    protected static string $table = "snacks";

    public function __construct(array $data) {
        $this->id = $data["id"];
        $this->name = $data["name"];
        $this->price = $data["price"];
    }

    public function toArray() {
        return [
            "id" => $this->id,
            "name" => $this->name,
            "price" => $this->price,
        ];
    }
}
