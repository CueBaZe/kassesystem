<?php
session_start();    
include("../scripts/connect.php");

error_reporting(E_ALL);
ini_set('display_errors', 0);

if(!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

$cart = $_SESSION['cart'];

if (isset($_POST['addItem']) || isset($_POST['newQuanity'])) {

    if(isset($_POST['newQuanity'])) {
        $barcode = $_POST['barcode'];
        $newQuanity = intval($_POST['newQuanity']); // Ensure it's an integer

        //check if quanity = 0 if it is delete item from array
        if($newQuanity !== 0) {
            $cart[$barcode] = $newQuanity;
        } else {
            unset($cart[$barcode]);
        }
    }

    if(isset($_POST['addItem'])) {
        $barcode = $_POST['addItem'];
        if (array_key_exists($barcode, $cart)) {
            $cart[$barcode]++;
        } else {
            $cart[$barcode] = 1;
        }
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
    
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $price += $row['price'] * $numberOfItems;
        }
    }

    $stmt->close();

    $items += $numberOfItems;
}

$_SESSION['items'] = $items;
$_SESSION['price'] = $price;

// Return JSON response
echo json_encode([
    "items" => $items,
    "price" => $price,
]);

exit();
?>
