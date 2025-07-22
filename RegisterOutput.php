<?php

    require_once 'user.php';
    require_once 'RegisterService.php';
    require_once 'db.php';
    require_once 'RegisterRepository.php';
    require_once 'RegisterController.php';
    require_once 'RegisterValidator.php';

    class RegisterOutput {          
        private $user;
        private $controller;
        private $repository;
        private $database;
        private $validation;
        private $service;

        public function __construct(){
            $this->user = new user();
            $this->controller = new RegisterController($this->user);
            $this->database = database::obFromDatabase();
            $this->repository = new RegisterRepository($this->database);
            $this->validation = new RegisterValidator($this->repository);
            $this->service = new RegisterService($this->validation);
        }

        public function register(){
            $this->controller->handleRegisterRequest();
            $this->controller->verifyTheDataRegister();
            $this->validation->checkPassword($this->user->getPassword());
            $this->validation->syntaxOfEmail($this->user->getEmail());
            $this->validation->email_reapet($this->user->getEmail());
            $this->validation->hash($this->user->getPassword());
            $this->service->returnMessage($this->user->getName(),$this->user->getEmail(),$this->user->getPassword());
        }
    }
            $regist = new RegisterOutput();
            $regist->register();

?>