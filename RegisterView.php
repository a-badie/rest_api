<?php
    // register.php
    require_once 'DatabaseClient.php';
    require_once 'RegisterValidator.php';
    require_once 'RegisterRepository.php';
    require_once 'RegisterService.php';
    require_once 'RegisterController.php';

    $db = database::getConnection();
    $repo = new RegisterRepository($db);
    $validator = new RegisterValidator();
    $service = new RegisterService($validator, $repo);
    $controller = new RegisterController($service);

    $controller->handleRegisterRequest();


?>