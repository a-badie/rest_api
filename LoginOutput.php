<?php

    require_once 'user.php';
    require_once 'LoginService.php';
    require_once 'db.php';
    require_once 'LoginRepository.php';
    require_once 'LoginController.php';
    require_once 'LoginValidator.php';

    class LoginOutput {          
        private $user;
        private $controller;
        private $repository;
        private $database;
        private $validation;
        private $service;


        public function __construct(){
            $this->user = new user();
            $this->controller = new LoginController($this->user);
            $this->database = database::obFromDatabase();
            $this->repository = new LoginRepository($this->database);
            $this->validation = new LoginValidator($this->repository);
            $this->service = new LoginService($this->validation);
        }

        public function login(){
            $this->controller->handleLoginRequest();
            $this->controller->verifyTheDataLogin();
            $this->validation->email_exist($this->user->getEmail());
            $this->validation->getinfo($this->user->getEmail());
            $this->validation->compare_password($this->user->getPassword());
            $this->service->returnInsertTokens($this->user->getEmail());  
        }
    }
            $login = new LoginOutput();
            $login->login();

?>