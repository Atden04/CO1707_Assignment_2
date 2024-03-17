<?php
//https://stackoverflow.com/questions/44392273/php-add-value-to-existing-array-in-cookie-on-button-click
$cart = null;
$pid = $_POST['id'];
if (!empty($_COOKIE["cartProductIds"])) {
    $cart = unserialize($_COOKIE["cartProductIds"]);
    array_push($cart, $pid);
} else {
    $cart = array();
    array_push($cart, $pid);
}
setcookie("cartProductIds", serialize($cart), time() + 3600, "/");
$_COOKIE["cartProductIds"] = serialize($cart);
?>