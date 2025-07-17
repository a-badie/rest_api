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
    $regist4->verifyTheDataLogin();
    $regist4->email_exist();
    $regist4->getinfo();
    $regist4->compare_password();
    $regist4->returnInsertTokens();

?>