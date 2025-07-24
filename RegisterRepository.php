<?php

    class RegisterRepository {

        private $database;

        public function __construct($database){
            $this->database = $database;
        }

        public function getUserByEmail($email){
            $sql_select="select * from user_information where email=?";
            return $this->database->query($sql_select,[$email]);
        }

        public function insertUser($name,$email,$password){
            $sql_insert="insert into user_information (name, email, password) values (?,?,?)";
            return $this->database->query($sql_insert,[$name,$email,$password]);
        }
    }
    
?>