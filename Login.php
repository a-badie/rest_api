<?php

    require_once 'user.php';
    require_once 'service.php';
    require_once 'db.php';
    require_once 'repository.php';
    require_once 'controller.php';
    require_once 'validation.php';

    class Login {          
        private $log1;
        private $log2;
        private $log3;
        private $db;
        private $log4;
        private $log5;

        public function __construct(){
            $this->log1 = new user();
            $this->log2 = new controller($this->log1);
            $this->db = database::obFromDatabase();
            $this->log3 = new repository($this->db);
            $this->log4 = new validate($this->log3);
            $this->log5 = new service($this->log4);
        }

        public function login(){
            $this->log2->handleRequest();
            $this->log2->verifyTheDataLogin();
            $this->log4->email_exist($this->log1->getEmail());
            $this->log4->getinfo($this->log1->getEmail());
            $this->log4->compare_password($this->log1->getPassword());
            $this->log5->returnInsertTokens($this->log1->getEmail());  
        }
    }
            $re = new Login();
            $re->login();

?>