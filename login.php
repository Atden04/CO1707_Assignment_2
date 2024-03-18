<?php
    session_start();
    $connection = require_once 'conn.php';
    $myEmail = htmlspecialchars($_POST["email"]);
    $myPassword = htmlspecialchars($_POST["password"]);
    $query = "SELECT * from tbl_users WHERE user_email = '".$myEmail."'";
    $result = mysqli_query($connection, $query);
    $count = mysqli_num_rows($result);
    if ($count == 0) {
        header ('Location: signup.php'); //fail state: username does not exist,
    }else{
        $record = mysqli_fetch_array($result, MYSQLI_ASSOC);
        $dbpassword = $record["user_pass"];
        if ($myPassword == $dbpassword){
            $_SESSION["loggedIn"] = true;
            $_SESSION["name"] = $record["user_full_name"];
            header ('Location: index.php');
        }else{
            header ('Location: cart.php'); //fail state: password does not match,
        }//end if
    }//end if
?>