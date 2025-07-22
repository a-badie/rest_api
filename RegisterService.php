<?php

    class RegisterService {

        private $validate;

        public function __construct($validate){
            $this->validate = $validate;
        }

        public function returnMessage($name,$email,$password){
            $insert=$this->validate->returnRegisterInsert($name,$email,$this->validate->hash($password));
            if($insert){
                $this->validate->json_response("success","sucess register");
            }else{
                $this->validate->json_response("failed","failed register");
            }
        }
    }
    
?>