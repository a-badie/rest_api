<?php

    require_once 'user.php';
    require_once 'service.php';
    require_once 'db.php';
    require_once 'repository.php';
    require_once 'controller.php';

    class LoginFacade {         
        private $log1;
        private $log2;
        private $log3;
        private $db;
        private $log4;

        public function __construct(){
            $this->log1 = new user();
            $this->db = database::obFromDatabase();
            $this->log3 = new repository($this->db);
            $this->log4 = new service($this->log3,$this->log1);
            $this->log2 = new controller($this->log1,$this->log4);
        }

        public function login(){
            $this->log2->handleRequest();
            $this->log4->verifyTheDataLogin();
            $this->log4->email_exist();
            $this->log4->getinfo();
            $this->log4->compare_password();
            $this->log2->getmessageToken();  
        }
    }
            $re = new LoginFacade();
            $re->login();

?>