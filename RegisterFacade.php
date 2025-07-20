<?php

    require_once 'user.php';
    require_once 'service.php';
    require_once 'db.php';
    require_once 'repository.php';
    require_once 'controller.php';

    class RegisterFacade {          
        private $regist1;
        private $regist2;
        private $regist3;
        private $db;
        private $regist4;

        public function __construct(){
            $this->regist1 = new user();
            $this->db = database::obFromDatabase();
            $this->regist3 = new repository($this->db);
            $this->regist4 = new service($this->regist3,$this->regist1);
            $this->regist2 = new controller($this->regist1,$this->regist4);
        }

        public function register(){
            $this->regist2->handleRequest();
            $this->regist4->verifyTheDataRegister();
            $this->regist4->checkPassword();
            $this->regist4->syntaxOfEmail();
            $this->regist4->email_reapet($this->regist1->getEmail());
            $this->regist4->hash($this->regist1->getPassword());
            $this->regist2->getmessage();
        }
        
    }
            $re = new RegisterFacade();
            $re->register();

?>