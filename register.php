<?php

    header("Content-Type: application/json");
    require_once("db.php");
    require_once("register_oop.php");

    $db = new database();
    $connection=$db->conn();
    $ob=new register($connection);
    $ob->handle_request();
    $ob->validation();
    $ob->hash();
    $ob->verify_register();










?>