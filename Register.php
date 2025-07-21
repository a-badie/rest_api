<?php

    require_once 'user.php';
    require_once 'service.php';
    require_once 'db.php';
    require_once 'repository.php';
    require_once 'controller.php';
    require_once 'validation.php';

    class Register {          
        private $regist1;
        private $regist2;
        private $regist3;
        private $db;
        private $regist4;
        private $regist5;

        public function __construct(){
            $this->regist1 = new user();
            $this->regist2 = new controller($this->regist1);
            $this->db = database::obFromDatabase();
            $this->regist3 = new repository($this->db);
            $this->regist4 = new validate($this->regist3);
            $this->regist5 = new service($this->regist4);
        }

        public function register(){
            $this->regist2->handleRequest();
            $this->regist2->verifyTheDataRegister();
            $this->regist4->checkPassword($this->regist1->getPassword());
            $this->regist4->syntaxOfEmail($this->regist1->getEmail());
            $this->regist4->email_reapet($this->regist1->getEmail());
            $this->regist4->hash($this->regist1->getPassword());
            $this->regist5->returnMessage($this->regist1->getName(),$this->regist1->getEmail(),$this->regist1->getPassword());
        }
        
    }
            $re = new Register();
            $re->register();

?>