<?php
$cart = null;
$idxToRemove = $_GET['idx'];
$cookie_name = "cartProductIds";

$cart = unserialize($_COOKIE[$cookie_name]);
if (count($cart)==1) {
    // Set the expiration date to one hour ago 
    setcookie($cookie_name, "", time() - 3600); 
}else if ($idx == 0) {
    array_shift($cart);
    setcookie($cookie_name, serialize($cart), time() + (86400 * 30), "/");  //sets cookie for a month, 86400 = 1 day
} else {
    array_splice($cart, $idxToRemove, $idxToRemove);
    setcookie($cookie_name, serialize($cart), time() + (86400 * 30), "/");  //sets cookie for a month, 86400 = 1 day
}

header ('Location: cart.php');
?>