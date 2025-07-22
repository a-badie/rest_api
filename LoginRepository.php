<?php

    class LoginRepository {

        private $repo;
        private $token_insert;
        private $token_result;

        public function __construct($database){
            $this->repo = $database;
        }

        public function select($email){
            $this->sql="select * from user_information where email=?";
            $this->result=$this->repo->getConnection()->prepare($this->sql);
            $this->result->execute([$email]);
            return $this->result;
        }
        
        public function insert_token($token,$user_id){
            $this->token_insert = "INSERT INTO token (token, user_id) VALUES (?, ?)";
            $this->token_result = $this->repo->getConnection()->prepare($this->token_insert);
            $this->token_result->execute([$token,$user_id]);
            return $this->token_result;
        }
    }
    
?>