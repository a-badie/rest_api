<?php

    require_once 'user.php';
    require_once 'service.php';
    require_once 'db.php';
    require_once 'repository.php';

    class LoginFacade {         // use Facede pattern
        private $log1;
        private $log2;
        private $db;
        private $log3;

        public function __construct(){
            $this->log1 = new user();
            $this->log2 = new service($this->log1);
            $this->db = database::obFromDatabase();
            $this->log3 = new repository($this->log1,$this->log2,$this->db);
        }

        public function login(){
            $this->log2->handleRequest();
            $this->log3->verifyTheDataLogin();
            $this->log3->email_exist();
            $this->log3->getinfo();
            $this->log3->compare_password();
            $this->log3->returnInsertTokens();  
        }
    }

?>