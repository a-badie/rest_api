<?php

require_once("user.php");
require_once("service.php");
require_once("db.php");
require_once("repository.php");

$user = new user();
$user->handleRequest();
$user->verifyTheDataLogin();

$db = new database();
$repo = new repository($db, $user);
$repo->email_exist();
$repo->selectResult();

$service = new service($user); // خليه ياخد نفس الكائن user مش يعمل واحد جديد
$service->compare_password();

$repo->insert_tokens();


?>
