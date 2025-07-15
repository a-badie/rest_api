<?php

    class service extends user{

        private $repo;
        private $user;
        private $information;

        public function __construct(user $user){
            $this->user =$user;
            $this->repo = new repository(new database(), $user);
        }

        public function checkPassword(){
            if(strlen($this->user->getpassword())<=6){
                $this->response(["message" => "password is too weak"],"error");
            }
        }

        public function compare_password(){
            $this->repo->selectResult(); 
            $this->information = $this->repo->getinfo();

            if (!$this->information || !isset($this->information["PASSWORD"])) {
                $this->user->response(["message" => "No user found or password missing"], "error");
            }

            $userPass = $this->user->getpassword();
            $hashedPass = $this->information["PASSWORD"];
            $verify = password_verify($userPass, $hashedPass) ? "true" : "false";

            file_put_contents("debug_password_check.txt", 
                "USER_PASS: " . $userPass . "\n" .
                "HASHED_PASS: " . $hashedPass . "\n" .
                "VERIFY_RESULT: " . $verify
            );

            if(!$verify){
                $this->user->response(["message" => "incorrect password"],"error");
            }
        }

        public function email_test(){
            if(!filter_var($this->user->getemail(),FILTER_VALIDATE_EMAIL)){
                $this->user->response(["message" => "email not correct"],"error");
            }
        }
    }
    
?>