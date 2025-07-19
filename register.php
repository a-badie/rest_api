<?php

    header("Content-Type: application/json");
    require_once("RegisterFacade.php");

    $re = new RegisterFacade();
    $re->register();

?>