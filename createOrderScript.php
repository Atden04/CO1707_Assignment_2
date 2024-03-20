<?php
session_start();
$connection = require_once 'conn.php';
$cookie_name = "cartProductIds";

$cart = unserialize($_COOKIE[$cookie_name]);
// Set the expiration date to one hour ago 
if (!empty($_COOKIE[$cookie_name]) && $_SESSION["loggedIn"]) {
    //setcookie($cookie_name, "", time() - 3600); 

    $rowsInTable = mysqli_query($connection, "SELECT * FROM tbl_orders;");
    $id = mysqli_num_rows($rowsInTable)+1;
    $userID = $_SESSION["userID"];
    $productIDs = unserialize($_COOKIE[$cookie_name]);;
    $productIDs = implode(",",$productIDs); // Use of implode function to convert from array to string

    mysqli_query($connection, "INSERT INTO `tbl_orders`(`order_id`, `order_date`, `user_id`, `product_ids`) VALUES ('$id',NOW(),'$userID','$productIDs')");

    setcookie($cookie_name, "", time() - 3600); //then delete cookie containg order
}

echo "<script>alert('Your order has successfully been created.');";
echo "window.location.href = 'cart.php';</script>";
?>