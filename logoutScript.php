<?php
    session_start();
    $returnPage = $_GET["returnPage"];
    $_SESSION["loggedIn"] = false;
    unset($_SESSION["name"]);
    if (isset($_GET['pid']))
    {
        $pid = $_GET['pid'];
        header ('Location: '.$returnPage.'?pid='.$pid);
    }
    header ('Location: '.$returnPage);
?>