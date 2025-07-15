<?php

    class user{

        private $name;
        private $email;
        private $password;

        public function getname(){
            return $this->name;
        }

        public function getemail(){
            return $this->email;
        }

        public function getpassword(){
            return $this->password;
        }

        public function response($data,$status){
            echo json_encode([
                "status" => $status,
                ...$data
            ]);
            exit;
        }

        public function handleRequest(){
            if($_SERVER["REQUEST_METHOD"]=="POST"){
                $this->name = $_POST["name"] ?? null;
                $this->email = $_POST["email"] ?? null;
                $this->password = $_POST["password"] ?? null;
            }else{
                $this->response(["message" => "method must be post"],"error");
            }
        }

        public function verifyTheDataRegister(){
            if(!$this->name || !$this->email || !$this->password){
                $this->response(["message" => "The entered data is incomplete"],"error");
            }
        }

        public function verifyTheDataLogin(){
            if(!$this->email || !$this->password){
                $this->response(["message" => "The entered data is incomplete"],"error");
            }
        }      
    }

?>