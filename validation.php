<?php

    class validate {

        private $repo;
        private $repeate;
        private $hashd;
        private $info;
        private $token;

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

        public function email_exist($email){
            if($this->repo->select($email)->rowCount()==0){
                $this->json_response("error","email not found");
            }
        }

        public function getinfo($email){
            $this->info = $this->repo->select($email)->fetch(PDO::FETCH_ASSOC);
            return $this->info;
        }

        public function compare_password($password){
            if(!password_verify($password,$this->info["PASSWORD"])){
                $this->json_response("error","password error");
            }
        }

        public function generationToken(){
            return $this->token = bin2hex(random_bytes(32));
        }
        
        public function returnInsertToken(){
            return $this->repo->insert_token($this->token,$this->info["id"]);
        }
    }
    
?>