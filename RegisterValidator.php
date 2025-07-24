<?php

    class RegisterValidator {

        public function verifyTheDataRegister($name,$email,$password){

            if(!$name || !$email || !$password){
                throw new Exception("Data must be complete");
            }

            if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
                throw new Exception("Email is wrong");
            }

            if(strlen($password)<=6){
                throw new Exception("password is weak");
            }

            return true;
        }

        public function hash($password){
            return password_hash($password,PASSWORD_DEFAULT);
        }

    }
    
?>