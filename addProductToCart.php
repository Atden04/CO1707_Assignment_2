<?php
//https://stackoverflow.com/questions/44392273/php-add-value-to-existing-array-in-cookie-on-button-click
$cart = null;
$pid = $_GET['pid'];
$returnPage = $_GET['returnPage'];
$cookie_name = "cartProductIds";

if (!empty($_COOKIE[$cookie_name])) {
    $cart = unserialize($_COOKIE[$cookie_name]);
    array_push($cart, $pid);
} else {
    $cart = array();
    array_push($cart, $pid);
}

echo $returnPage;

setcookie($cookie_name, serialize($cart), time() + (86400 * 30), "/");  //sets cookie for a month, 86400 = 1 day
if ($returnPage == "item.php") {
    header ('Location: '.$returnPage.'?pid='.$pid);
} else {
    header ('Location: '.$returnPage.'#productId'.$pid);
}
?>