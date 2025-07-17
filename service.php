<?php

    class service {

        private $password;

        public function __construct($user){
            $this->ser = $user;
        }

        public function response($status,$message){
            echo json_encode([
                "status" => $status,
                "message" => $message
            ]);
            exit;
        }

        // handle request:
        public function handleRequest(){
            if($_SERVER["REQUEST_METHOD"]=="POST"){
                $name = $_POST["name"] ?? null;
                $this->ser->setName($name);
                $email = $_POST["email"] ?? null;
                $this->ser->setEmail($email);
                $password = $_POST["password"] ?? null;
                $this->ser->setPassword($password);
            }else{
                $this->response("error","method must be post");
            }
        }
    }
    
?>