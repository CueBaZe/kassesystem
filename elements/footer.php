<?php

$cart = $_SESSION['cart'] ?? [];

$items = 0;
$price = 0;

foreach ($cart as $item => $numberOfItems) {
    $items += $numberOfItems;
    
    $stmt = $conn->prepare("SELECT price FROM items WHERE barcode = ?");
    $stmt->bind_param("i", $item);
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $price += $row['price'] * $numberOfItems;
        }
    } else {
        unset($cart['$item']);
        $items = 0;
    }
}
?>

<div class="container-fluid" name="footer" id="footer">
    <div class="row">
        <div class="row col-6">
            <p class="col-12">Items: <?php echo $items; ?></p>
            <p class="col-12">Price: <?php echo $price; ?>$</p>
        </div>
        <div class="row col-6">
            <div class="buttonBox text-end">
                <button onclick="" class="btn buy col-6 m-4">Buy</button>
            </div>
        </div>
    </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="php/scripts/timechecker.js"></script>
<script src="php/scripts/admin_menu.js"></script>
</html>