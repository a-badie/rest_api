<?php

    header("Content-Type: application/json");
    require_once("db.php");
    require_once("login_oop.php");

    $db = new database();
    $connection=$db->conn();
    $ob=new login($connection);
    $ob->handle_request();
    $ob->validation();
    $ob->verify_register();










?>