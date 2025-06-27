<?php
require_once("Model.php");

class User extends Model{
    private int $id;
    private string $name;
    private string $email;
    private string $password;
    private string $phone;

    protected static string $table = "users";

    public function __construct(array $data){
        $this->id = $data["id"];
        $this->name = $data["name"];
        $this->email = $data["email"];
        $this->phone = $data["phone"];
        $this->password = $data["password"];
    }

    public function getPassword(): string{
        return $this->password;
    }

    public function toArray(){
        return [
            "id" => $this->id,
            "name" => $this->name,
            "email" => $this->email,
            "phone" => $this->phone,
        ];
    }
}