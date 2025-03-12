<?php
session_start();
include("../scripts/connect.php");

if(!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

$cart = $_SESSION['cart'];

if(isset($_POST['addItem'])) {
    $barcode = $_POST['addItem'];
    
    if (array_key_exists($barcode, $cart)) {
        $cart[$barcode]++;
    } else {
        $cart[$barcode] = 1;
    }
}

$_SESSION['cart'] = $cart;

// Calculate updated total items and price
$items = 0;
$price = 0;

foreach ($cart as $item => $numberOfItems) {
    $stmt = $conn->prepare("SELECT price FROM items WHERE barcode = ?");
    $stmt->bind_param("i", $item);
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $price += $row['price'] * $numberOfItems;
        }
    }
    $items += $numberOfItems;
    $_SESSION['items'] = $items;
    $_SESSION['price'] = $price;
}

// Return JSON response
echo json_encode([
    "items" => $items,
    "price" => $price
]);

exit();
?>
