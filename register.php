<?php

    header("Content-Type: application/json");
    require_once("db.php");
    require_once("register_oop.php");    
    require_once("validation.php");


    $db = new database();
    $connection=$db->conn();
    $ob=new register($connection);
    $ob->handle_request();
    $validate = new validation($connection);
    $validate->validation_register($ob->setname(),$ob->setemail(),$ob->setpassword()); 
    $ob->hash();
    $ob->verify_register();










?>