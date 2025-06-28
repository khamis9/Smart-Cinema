<?php
require_once("Model.php");

class User extends Model{
    private int $id;
    private string $name;
    private string $email;
    private string $password;
    private string $phone;

    protected static string $table = "users";

    public function setName(string $name) {
        $this->name = $name;
    }

    public function setEmail(string $email) {
        $this->email = $email;
    }

    public function setPhone(string $phone) {
        $this->phone = $phone;
    }


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

    public function update(mysqli $mysqli) {
        $stmt = $mysqli->prepare("UPDATE users SET name = ?, email = ?, phone = ? WHERE id = ?");
        $stmt->bind_param("sssi", $this->name, $this->email, $this->phone, $this->id);
        $stmt->execute();
    }

}

