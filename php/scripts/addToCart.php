<?php
session_start();
include("connect.php");

if(isset($_POST['addItem'])) {
    $cart = $_SESSION['cart'];

    $barcode = $_POST['addItem'];

    $stmt = $conn->prepare("SELECT * FROM items WHERE barcode = ?");
    $stmt->bind_param("i", $barcode);
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();

    if($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $item = $row['name'];
        }
        if (array_key_exists($item, $cart)) {
            $cart[$item] = $cart[$item] + 1;
        } else {
            $cart[$item] = 1;
        }
    }
    $_SESSION['cart'] = $cart;
    header("location: ../../index.php");
}
?>