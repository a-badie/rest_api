
<?php

    class LoginValidator {

        public function verifyTheDataLogin($email,$password){
            if(!$email || !$password){
                throw new Exception("Data must be complete");
            }

            return true;
        }

        public function compare_password($password,$passwordFromDb){
            if(!password_verify($password,$passwordFromDb)){
                throw new Exception("passeord error");
            }
        }
        
        public function generationToken(){
            return $token = bin2hex(random_bytes(32));
        }
    }

?>
