<?php

    class repository {

        private $repo3;
        private $sql;
        private $result;
        private $date_insert;
        private $date_result;
        private $token_insert;
        private $token_result;

        public function __construct($database){
            $this->repo3 = $database;
        }

        public function select($email){
            $this->sql="select * from user_information where email=?";
            $this->result=$this->repo3->getConnection()->prepare($this->sql);
            $this->result->execute([$email]);
            return $this->result;
        }

        public function register_insert($name,$email,$password){
            $this->date_insert="insert into user_information (name, email, password) values (?,?,?)";
            $this->date_result=$this->repo3->getConnection()->prepare($this->date_insert);
            $this->date_result->execute([$name,$email,$password]);
            return $this->date_result;
        }

        public function insert_token($token,$user_id){
            $this->token_insert = "INSERT INTO token (token, user_id) VALUES (?, ?)";
            $this->token_result = $this->repo3->getConnection()->prepare($this->token_insert);
            $this->token_result->execute([$token,$user_id]);
            return $this->token_result;
        }
    }
    
?>