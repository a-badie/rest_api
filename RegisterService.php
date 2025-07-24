<?php

    class RegisterService {

        private $validate;
        private $repo;

        public function __construct($validate,$repo){
            $this->validate = $validate;
            $this->repo = $repo;
        }

        public function register_result($name,$email,$password){
            $this->validate->verifyTheDataRegister($name,$email,$password);
            $emailcount=$this->repo->getUserByEmail($email);
            if($emailcount->rowCount()>0){
                throw new Exception("email repeate");
                exit;
            }
            $hashdPassword=$this->validate->hash($password);
            $result=$this->repo->insertUser($name,$email,$hashdPassword); 
            if(!$result){
                throw new Exception("failed register");
                exit;
            }
        }
    }
    
?>