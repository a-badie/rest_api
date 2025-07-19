<?php

    class repository {
        
        private $repo1;                             //use repository pattern
        private $repo2;
        private $repo3;
        private $repeat;
        private $hashd;
        private $info;
        private $token;

                            //Register page

        public function __construct($user,$service,$database){
            $this->repo1 = $user;
            $this->repo2 = $service;
            $this->repo3 = $database;
        }

        // verify the data complete or not in register:
        public function verifyTheDataRegister(){
            if(!$this->repo1->getName() || !$this->repo1->getEmail() || !$this->repo1->getPassword()){
                $this->repo2->response("error","The entered data not complete");
            }
        }

        //verify the password characters > 6 in register:
        public function checkPassword(){
            if(strlen($this->repo1->getPassword())<=6){
                $this->repo2->response("error","password is too weak");
            }
        }

        //verify syntax of email correct or not in register:
        public function syntaxOfEmail(){
            if(!filter_var($this->repo1->getEmail(),FILTER_VALIDATE_EMAIL)){
                $this->repo2->response("error","email not correct");
            }
        }

        //verify email repeate or not:
        public function email_reapet(){
            $this->repeate = $this->repo3->select($this->repo1->getEmail());
            if($this->repeate->rowCount()>0){
                $this->repo2->response("error","email already exists");
            }
        }

        // convert normal password to password hashd:
        public function hash(){
            return $this->hashd=password_hash($this->repo1->getPassword(),PASSWORD_DEFAULT);
        }

        //return the resulo of register
        public function returnMessage(){
            $insert=$this->repo3->register_insert($this->repo1->getName(),$this->repo1->getEmail(),$this->hash());
            if($insert){
                $this->repo2->response("success","sucess register");
            }else{
                $this->repo2->response("failed","failed register");
            }
        }

                            //Login page

        // verify the data complete or not in login:
        public function verifyTheDataLogin(){
            if(!$this->repo1->getEmail() || !$this->repo1->getPassword()){
                $this->repo2->response("error","The entered data not complete");
            }
        } 

        //verify email exists or not:
        public function email_exist(){
            if($this->repo3->select($this->repo1->getEmail())->rowCount()==0){
                $this->repo2->response("error","email not found");
            }
        }

        //return one row of data
        public function getinfo(){
            $this->info = $this->repo3->select($this->repo1->getEmail())->fetch(PDO::FETCH_ASSOC);
            return $this->info;
        }

        //compare between password in table and user inter in login page
        public function compare_password(){
            if(!password_verify($this->repo1->getPassword(),$this->info["PASSWORD"])){
                $this->repo2->response("error","password error");
            }
        }

        //method return value of insert token
        public function returnInsertTokens(){
            $this->token = $this->repo3->generationToken();
            $this->getinfo();
            if($this->repo3->insert_token($this->token,$this->info["id"])){
                $this->repo2->response("sucess","sucess insert tokens");
            }else {
                $this->repo2->response("failed","failed insert tokens");
            }
        }  
    }
    
?>