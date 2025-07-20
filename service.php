<?php

    class service {

        private $repo;
        private $user;
        private $repeate;
        private $hashd;
        private $info;
        private $token;

        public function __construct($repo,$user){
            $this->repo = $repo;
            $this->user = $user;
        }

        public function verifyTheDataRegister(){
            if(!$this->user->getName() || !$this->user->getEmail() || !$this->user->getPassword()){
                echo json_encode([
                    "status"=>"error",
                    "message"=>"he entered data not complete"
                ]);
                exit;
            }
        }

        public function checkPassword(){
            if(strlen($this->user->getPassword())<=6){
                echo json_encode([
                    "status"=>"error",
                    "message"=>"password is too weak"
                ]);
                exit;
            }
        }

        public function syntaxOfEmail(){
            if(!filter_var($this->user->getEmail(),FILTER_VALIDATE_EMAIL)){
                echo json_encode([
                    "status"=>"error",
                    "message"=>"email not correct"
                ]);
                exit;
            }
        }
        

        public function email_reapet($email){
            $this->repeate = $this->repo->select($email);
            if($this->repeate->rowCount()>0){
                echo json_encode([
                    "status"=>"error",
                    "message"=>"email already exists"
                ]);
                exit;
            }
        }

        public function hash($password){
            return $this->hashd=password_hash($password,PASSWORD_DEFAULT);
        }

        public function returnMessage($name,$email,$password){
            $insert=$this->repo->register_insert($name,$email,$this->hash($password));
            if($insert){
                echo json_encode([
                    "status"=>"success",
                    "message"=>"sucess register"
                ]);
                exit;
            }else{
                echo json_encode([
                    "status"=>"failed",
                    "message"=>"failed register"
                ]);
                exit;
            }
        }

        public function verifyTheDataLogin(){
            if(!$this->user->getEmail() || !$this->user->getPassword()){
                echo json_encode([
                    "status"=>"error",
                    "message"=>"he entered data not complete"
                ]);
                exit;
            }
        } 

        public function email_exist(){
            if($this->repo->select($this->user->getEmail())->rowCount()==0){
                echo json_encode([
                    "status"=>"error",
                    "message"=>"email not found"
                ]);
                exit;
            }
        }

        public function getinfo(){
            $this->info = $this->repo->select($this->user->getEmail())->fetch(PDO::FETCH_ASSOC);
            return $this->info;
        }

        public function compare_password(){
            if(!password_verify($this->user->getPassword(),$this->info["PASSWORD"])){
                echo json_encode([
                    "status"=>"error",
                    "message"=>"password error"
                ]);
                exit;
            }
        }

        public function generationToken(){
            return $this->token = bin2hex(random_bytes(32));
        } 

        public function returnInsertTokens(){
            $this->token = $this->generationToken();
            $this->getinfo();
            if($this->repo->insert_token($this->token,$this->info["id"])){
                echo json_encode([
                    "status"=>"sucess",
                    "message"=>"sucess insert tokens"
                ]);
                exit;
            }else {
                echo json_encode([
                    "status"=>"failed",
                    "message"=>"failed insert tokens"
                ]);
                exit;            
            }
        }

    }
    
?>