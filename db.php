<?php
    $host="localhost";
    $dbname="users";
    $user="root";
    $pass="";

    try {

    $connection=new pdo("mysql:host=$host;dbname=$dbname;charset=utf8",$user,$pass);

    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    } catch (pdoexception $e) {

    die("فشل الاتصال بقاعدة البيانات: " . $e->getMessage());

    }



?>