<?php
    session_start();
    $returnPage = $_GET["returnPage"];
    $_SESSION["loggedIn"] = false;
    unset($_SESSION["userName"]);
    unset($_SESSION["userID"]);
    if (isset($_GET['pid']))
    {
        $pid = $_GET['pid'];
        header ('Location: '.$returnPage.'?pid='.$pid);
    } else {
        header ('Location: '.$returnPage);
    }
?>