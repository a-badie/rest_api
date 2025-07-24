<?php

    class LoginService {

        private $validate;
        private $repo;

        public function __construct($validate,$repo){
            $this->validate = $validate;
            $this->repo = $repo;
        }

        public function Login_result($email,$password){

            $this->validate->verifyTheDataLogin($email,$password);
            $emailcount=$this->repo->getUserByEmail($email);
                if($emailcount->rowCount()==0){
                    throw new Exception("email not found");
                    exit;
                }
            $info=$this->repo->getInfo($email);
            $this->validate->compare_password($password,$info["PASSWORD"]);
            $token=$this->validate->generationToken();
            $result=$this->repo->insertToken($token,$info["id"]); 
                if(!$result){
                    throw new Exception("failed register");
                    exit;
                }
        }
    }
    
?>