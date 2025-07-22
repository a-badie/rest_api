<?php

    class RegisterValidator {

        private $repo;
        private $repeate;
        private $hashd;

        public function __construct($repo){
            $this->repo = $repo;
        }

        function json_response($status, $message) { 
            $response = [
                "status" => $status,
                "message" => $message
            ];

            echo json_encode($response);
            exit;
        }

        public function checkPassword($password){
            if(strlen($password)<=6){
                $this->json_response("error","password is too weak");
            }
        }

        public function syntaxOfEmail($email){
            if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
                $this->json_response("error","email not correct");
            }
        }
        
        public function email_reapet($email){
            $this->repeate = $this->repo->select($email);
            if($this->repeate->rowCount()>0){
                $this->json_response("error","email already exists");
            }
        }

        public function hash($password){
            return $this->hashd=password_hash($password,PASSWORD_DEFAULT);
        }

        public function returnRegisterInsert($name,$email,$password){
            return $this->repo->register_insert($name,$email,$password);
        }
    }
    
?>