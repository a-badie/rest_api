<?php

    require_once 'user.php';
    require_once 'service.php';
    require_once 'db.php';
    require_once 'repository.php';

    class RegisterFacade {          // use Facede pattern
        private $regist1;
        private $regist2;
        private $db;
        private $regist3;

        public function __construct(){
            $this->regist1 = new user();
            $this->regist2 = new service($this->regist1);
            $this->db = database::obFromDatabase();
            $this->regist3 = new repository($this->regist1,$this->regist2,$this->db);
        }

        public function register(){
            $this->regist2->handleRequest();
            $this->regist3->verifyTheDataRegister();
            $this->regist3->checkPassword();
            $this->regist3->syntaxOfEmail();
            $this->regist3->email_reapet();
            $this->regist3->hash();
            $this->regist3->returnMessage();
        }
        
    }

?>