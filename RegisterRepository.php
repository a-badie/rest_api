<?php

    class RegisterRepository {

        private $repo;
        private $sql;
        private $result;
        private $date_insert;
        private $date_result;

        public function __construct($database){
            $this->repo = $database;
        }

        public function select($email){
            $this->sql="select * from user_information where email=?";
            $this->result=$this->repo->getConnection()->prepare($this->sql);
            $this->result->execute([$email]);
            return $this->result;
        }

        public function register_insert($name,$email,$password){
            $this->date_insert="insert into user_information (name, email, password) values (?,?,?)";
            $this->date_result=$this->repo->getConnection()->prepare($this->date_insert);
            $this->date_result->execute([$name,$email,$password]);
            return $this->date_result;
        }
    }
    
?>