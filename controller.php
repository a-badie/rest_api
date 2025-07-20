<?php

    class controller{

        private $user;
        private $service;
        private $message;
        private $message_token;

        public function __construct($user,$service){
                $this->user = $user;
                $this->service = $service;
        }

        public function handleRequest(){
            if($_SERVER["REQUEST_METHOD"]=="POST"){
                $name = $_POST["name"] ?? null;
                $this->user->setName($name);
                $email = $_POST["email"] ?? null;
                $this->user->setEmail($email);
                $password = $_POST["password"] ?? null;
                $this->user->setPassword($password);
            }else{
                echo json_encode([
                    "status"=>"error",
                    "message"=>"method must be post"
                ]);
                exit;
            }
        }

        public function getmessage(){
            return $this->message = $this->service->returnMessage($this->user->getName(),$this->user->getEmail(),$this->user->getPassword());
        }

        public function getmessageToken(){
            return $this->message_token = $this->service->returnInsertTokens();
        }
    }

?>