<?php

    header("Content-Type: application/json");
    require_once("LoginFacade.php");

    $lo = new LoginFacade();
    $lo->login();

?>