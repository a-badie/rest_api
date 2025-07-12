<?php

    header("Content-Type: application/json");
    require_once("db.php");
    require_once("login_oop.php");
    require_once("validation.php");


    $db = new database();
    $connection=$db->conn();
    $ob=new login($connection);
    $ob->handle_request();
    $validate = new validation($connection);
    $validate->validation_login($ob->setemail(),$ob->setpassword());










?>