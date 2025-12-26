<?php
require_once __DIR__ . "/../models/User.php";

class AuthController {
    private $user;

    public function __construct(){
        $this->user = new User();
    }

    public function register($data){
        if($this->user->register($data['role_id'], $data['full_name'], $data['email'], $data['password'], $data['phone'])){
            return ["status"=>true, "message"=>"User registered"];
        }else{
            return ["status"=>false, "message"=>"Registration failed"];
        }
    }

    public function login($data){
        $user = $this->user->login($data['email'], $data['password']);
        if($user){
            return ["status"=>true, "user"=>$user];
        }else{
            return ["status"=>false, "message"=>"Invalid credentials"];
        }
    }
}
