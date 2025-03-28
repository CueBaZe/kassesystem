    <?php
    session_start(); //starts tge session

    if(!isset($_SESSION['email'])) { //checks if users logged in
        header("location: elements/login_page.php");
        exit();
    }

    $_SESSION['onpage'] = "cart";

    include("php/scripts/connect.php");

    include("elements/nav.php");
    ?>

        <div class="container" id="box-container">
            <div class="row">
                <?php
                $cart = $_SESSION['cart'];
                if (!empty($cart)) { //checks if carts is not empty
                    echo "<h3>Your Items:</h3>";
                    foreach ($cart as $item => $numberOfItems) { //loops all items in the cart
                        $stmt = $conn->prepare("SELECT * FROM items WHERE barcode = ?");
                        $stmt->bind_param("i", $item);
                        $stmt->execute();
                        $result = $stmt->get_result();
                        $stmt->close();
    
                        while($data = $result->fetch_assoc()) { //Makes a card foreach item
                    ?>
                            <div class="col-12 col-sm-6 col-md-4 col-lg-3 d-flex">
                                <div class="boxes p-4 mt-4 text-center">
                                    <div class="row justify-content-center">
                                        <img src="./images/<?php echo $data['picture_path']; ?>" class="img-fluid" alt="Uploaded Image">
                                        <h3 class="item-name col-12"><?php echo $data['name']; ?></h3>
                                        <p class="item-price col-12">Price: <?php echo $data['price']; ?> $</p>
                                        <input min="0" type="number" class="quanity-input" data-barcode = "<?php echo $data['barcode']?>" value="<?php echo $numberOfItems?>">
                                        <p class="item-category text-start col-6"><?php echo $data['category'];?></p>
                                        <p class="item-barcode text-end col-6"><?php echo $data['barcode'];?></p>
                                    </div>
                                </div>
                            </div>
                    <?php
                        }
                    }
                }else { //writes this if cart is empty
                    echo "<h3>Your cart is empty:</h3>";
                }
                    ?>
            </div>
        </div>

    <?php
    include("elements/footer.php");

    if($role == "admin") {
        include("elements/admin_menu.php");
    }
    ?>

    <script src="php/scripts/onchange.js"></script>