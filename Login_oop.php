<?php

    header("Content-Type: application/json");
    require_once("db.php");

    class login{

        private $email;
        private $password;
        private $connection;
        private $sql;
        private $result;
        private $info;
        private $token;
        private $token_insert;
        private $result_insert;
    
        // connect to database by  constructor 
        public function __construct($db){
            $this->connection=$db;
        }

        public function setemail(){
            return $this->email;
        }

        public function setpassword(){
            return $this->password;
        }
    
        // is request method == post
        public function handle_request(){
            if($_SERVER["REQUEST_METHOD"]=="POST"){
            $this->email=$_POST["email"] ?? null;
            $this->password=$_POST["password"] ?? null;
            }else{
                echo json_encode([
                    "status"=>"error",
                    "message"=>"request method must be post"
                ]);
                exit;
            }
        }

        
    }








?>