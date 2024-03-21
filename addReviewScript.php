<?php
session_start();
$connection = require_once 'conn.php';

$userID = $_SESSION["userID"];
$pid = $_GET['pid'];
$title = $_POST["title"];
$comment = $_POST["comment"];
$rating = $_POST["rating"];

mysqli_query($connection, "INSERT INTO `tbl_reviews`(`user_id`, `product_id`, `review_title`, `review_desc`, `review_rating`) VALUES ('$userID','$pid','$title','$comment','$rating')");

header ("location: item.php?pid=".$pid);
?>