<?php

    class LoginRepository {

        private $database;

        public function __construct($database){
            $this->database = $database;
        }

        public function getUserByEmail($email){
            $sql_select="select * from user_information where email=?";
            return $this->database->query($sql_select,[$email]);
        }

        public function getInfo($email){
            return $info = $this->getUserByEmail($email)->fetch(PDO::FETCH_ASSOC);
        }
        
        public function insertToken($token,$user_id){
            $token_insert = "INSERT INTO token (token, user_id) VALUES (?, ?)";
            return $this->database->query($token_insert,[$token,$user_id]);
        }

        
    }
    
?>