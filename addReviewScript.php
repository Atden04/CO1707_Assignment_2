<?php
session_start();
$connection = require_once 'conn.php';

$userID = $_SESSION["userID"];
$pid = $_GET['pid'];
$title = processInput($_POST["title"]);
$comment = processInput($_POST["comment"]);
$rating = $_POST["rating"];

mysqli_query($connection, "INSERT INTO `tbl_reviews`(`user_id`, `product_id`, `review_title`, `review_desc`, `review_rating`) VALUES ('$userID','$pid','$title','$comment','$rating')");

header ("location: item.php?pid=".$pid);

function processInput($data) {

    $data = trim($data);

    $data = stripslashes($data);

    $data = htmlspecialchars($data);

    return $data;

    }
?>