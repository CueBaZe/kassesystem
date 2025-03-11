<?php
session_start();
include("connect.php");

if(isset($_POST['addItem'])) {
    $cart = $_SESSION['cart'];

    $barcode = $_POST['addItem'];
    
    if (array_key_exists($barcode, $cart)) {
        $cart[$barcode] = $cart[$barcode] + 1;
    } else {
        $cart[$barcode] = 1;
    }
}
$_SESSION['cart'] = $cart;
header("location: ../../index.php");
?>