<?php

    class LoginController{

        private $user;

        public function __construct($user){
                $this->user = $user;
        }

        public function handleLoginRequest(){
            if($_SERVER["REQUEST_METHOD"]=="POST"){
                $email = $_POST["email"] ?? null;
                $this->user->setEmail($email);
                $password = $_POST["password"] ?? null;
                $this->user->setPassword($password);
            }else{
                return ["status" => "error", "message" => "method must be post"];
            }
        }

        public function verifyTheDataLogin(){
            if(!$this->user->getEmail() || !$this->user->getPassword()){
                return ["status" => "error", "message" => "you entered data not complete"];
            }
        } 
    }

?>