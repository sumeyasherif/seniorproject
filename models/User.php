<?php
require_once __DIR__ . "/../config/Database.php";

class User {
    private $conn;
    private $table = "users";

    public function __construct(){
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function register($role_id, $full_name, $email, $password, $phone){
        $query = "INSERT INTO ".$this->table." (role_id, full_name, email, password, phone) VALUES (:role_id, :full_name, :email, :password, :phone)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":role_id", $role_id);
        $stmt->bindParam(":full_name", $full_name);
        $stmt->bindParam(":email", $email);
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $stmt->bindParam(":password", $hashed_password);
        $stmt->bindParam(":phone", $phone);
        return $stmt->execute();
    }

    public function login($email, $password){
        $query = "SELECT * FROM ".$this->table." WHERE email=:email";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":email", $email);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        if($user && password_verify($password, $user['password'])){
            return $user;
        }
        return false;
    }

    // More functions: getProfile(), updateProfile(), changePassword(), etc.
}
