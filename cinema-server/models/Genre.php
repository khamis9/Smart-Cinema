<?php
require_once("Model.php");

class Genre extends Model {
    private int $id;
    private string $name;

    protected static string $table = "genres";

    public function __construct(array $data){
        $this->id = $data["id"];
        $this->name = $data["name"];
    }

    public function toArray(): array {
        return [
            "id" => $this->id,
            "name" => $this->name
        ];
    }
}
