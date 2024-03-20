<?php
$cookie_name = "cartProductIds";

$cart = unserialize($_COOKIE[$cookie_name]);
// Set the expiration date to one hour ago 
if (!empty($_COOKIE[$cookie_name])) {
    setcookie($cookie_name, "", time() - 3600); 
}

echo "<script>alert('Your cart has been emptied.');";
echo "window.location.href = 'cart.php';</script>";
?>