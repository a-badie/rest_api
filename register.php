<?php

    header("Content-Type: application/json");
    require_once("user.php");
    require_once("service.php");
    require_once("db.php");
    require_once("repository.php");    

    $regist1 = new user();

    $regist2 = new service($regist1);
    $regist2->handleRequest();

    $regist3 = new database();

    $regist4 = new repository($regist1,$regist2,$regist3);
    $regist4->verifyTheDataRegister();
    $regist4->checkPassword();
    $regist4->syntaxOfEmail();
    $regist4->email_reapet();
    $regist4->hash();
    $regist4->returnMessage();

?>