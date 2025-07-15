<?php

    header("Content-Type: application/json");
    require_once("user.php");
    require_once("service.php");
    require_once("db.php");
    require_once("repository.php");    

    $regist1 = new user();
    $regist1->handleRequest();
    $regist1->verifyTheDataRegister();

    $regist2 = new service($regist1);
    $regist2->checkPassword();
    $regist2->email_test();

    $regist3 = new database();

    $regist4 = new repository($regist3,$regist1);
    $regist4->email_reapet();
    $regist4->insert_data();

?>