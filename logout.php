<?php
    session_start();
    $returnPage = $_GET["returnPage"];
    $_SESSION["loggedIn"] = false;
    unset($_SESSION["name"]);
    header ('Location: '.$returnPage);
?>