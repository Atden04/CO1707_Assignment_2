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





    /*$rowsExistingEmail = mysqli_query($connection, "SELECT * FROM `tbl_users` WHERE user_email LIKE '$email'");
                    $countRows = mysqli_num_rows($rowsExistingEmail);
                    if ($countRows == 0) {   //if no rows then account with provided email doesn't exist
                        //get num rows for next id and add data to databse.
                        $rowsInTable = mysqli_query($connection, "SELECT * FROM tbl_users;");
                        $id = mysqli_num_rows($rowsInTable)+1;
                        
                        echo "<script>alert('You\`re account has now been registered. You can now log in via the cart. ');</script>";
                    } else {
                        echo "<script>alert('An account already exists with the email provided. Please log in via the cart.');</script>";
                    }
                    

                    
                }*/


}

echo "<script>alert('Your order has successfully been created.');";
echo "window.location.href = 'cart.php';</script>";
?>