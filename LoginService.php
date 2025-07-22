<?php

    class LoginService {

        private $validate;

        public function __construct($validate){
            $this->validate = $validate;
        }

        public function returnInsertTokens($email){
            $token = $this->validate->generationToken();
            $info = $this->validate->getinfo($email);
            if($this->validate->returnInsertToken($token,$info["id"])){
                $this->validate->json_response("success","sucess insert tokens");
            }else {
                $this->validate->json_response("failed","failed insert tokens");        
            }
        }
    }
    
?>