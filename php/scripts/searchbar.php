<?php
session_start();
include("connect.php");

if (isset($_POST['searchItems']) && !$_POST['searchItems'] == null) {
    $searched = $_POST['searchItems'] . "%"; // Match categories starting with input
    $stmt = $conn->prepare("SELECT * FROM items WHERE category LIKE ? OR name LIKE ?");
    $stmt->bind_param("ss", $searched, $searched);
} else {
    $stmt = $conn->prepare("SELECT * FROM items"); // Get all items if no input
}

$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    while ($data = mysqli_fetch_assoc($result)) {
        ?>
        <div class="col-12 col-sm-6 col-md-4 col-lg-3 d-flex">
            <div class="boxes p-4 mt-4 text-center">
                <div class="row justify-content-center">
                    <?php if ($_SESSION['role'] == "admin") { ?>
                    <form class="text-end mb-2" action="elements/edititem_page.php" method="POST">
                        <button class="editItem col-2" name="editItem" value="<?php echo $data['barcode']?>"><i class='bx bx-pencil'></i></button>
                    </form>
                    <?php } ?>
                    
                    <img src="./images/<?php echo $data['picture_path']; ?>" class="img-fluid col-12" alt="Uploaded Image">
                    <h3 class="item-name col-12"><?php echo $data['name']; ?></h3>
                    <p class="item-price col-12">Price: <?php echo $data['price']; ?> $</p>
                    
                    <form action="php/scripts/addToCart.php" method="POST">
                        <button class="addToCart col-8" name="addItem" value="<?php echo $data['barcode']; ?>">Add to cart</button>
                    </form>

                    <?php if ($_SESSION['role'] == "admin") { ?>
                    <form action="php/scripts/delete.php" method="POST">
                        <button class="deleteItem col-8" name="deleteItem" value="<?php echo $data['barcode']; ?>">Delete Item</button>
                    </form>
                    <?php } ?>
                    
                    <p class="item-category text-start col-6"><?php echo $data['category']; ?></p>
                    <p class="item-barcode text-end col-6"><?php echo $data['barcode']; ?></p>
                </div>
            </div>
        </div>
        <?php
    }
} else {
    echo "<h3 class='text-center' id='noItems'>No items found...</h3>";
}
?>
