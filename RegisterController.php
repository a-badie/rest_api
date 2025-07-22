<?php

    class RegisterController{

        private $user;

        public function __construct($user){
                $this->user = $user;
        }

        public function handleRegisterRequest(){
            if($_SERVER["REQUEST_METHOD"]=="POST"){
                $name = $_POST["name"] ?? null;
                $this->user->setName($name);
                $email = $_POST["email"] ?? null;
                $this->user->setEmail($email);
                $password = $_POST["password"] ?? null;
                $this->user->setPassword($password);
            }else{
                return ["status" => "error", "message" => "method must be post"];
            }
        }

        public function verifyTheDataRegister(){
            if(!$this->user->getName() || !$this->user->getEmail() || !$this->user->getPassword()){
                return ["status" => "error", "message" => "you entered data not complete"];
            }
        }
    }

?>