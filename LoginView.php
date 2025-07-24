<?php

    require_once 'DatabaseClient.php';
    require_once 'LoginValidator.php';
    require_once 'LoginRepository.php';
    require_once 'LoginService.php';
    require_once 'LoginController.php';

    $db = database::getConnection();
    $repo = new LoginRepository($db);
    $validator = new LoginValidator();
    $service = new LoginService($validator, $repo);
    $controller = new LoginController($service);

    $controller->handleLoginRequest();

?>