    <?php
    session_start();

    if(!isset($_SESSION['email'])) {
        header("location: elements/login_page.php");
        exit();
    }

    $_SESSION['onpage'] = "cart";

    include("php/scripts/connect.php");

    include("elements/nav.php");
    ?>

        <div class="container" id="box-container">
            <div class="row">
                <h3>Your Items:</h3>
                <?php
                $cart = $_SESSION['cart'];

                foreach ($cart as $item => $numberOfItems) {
                    $stmt = $conn->prepare("SELECT * FROM items WHERE barcode = ?");
                    $stmt->bind_param("i", $item);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    $stmt->close();

                    while($data = $result->fetch_assoc()) {
                ?>
                        <div class="col-12 col-sm-6 col-md-4 col-lg-3 d-flex">
                            <div class="boxes p-4 mt-4 text-center">
                                <div class="row justify-content-center">
                                    <img src="./images/<?php echo $data['picture_path']; ?>" class="img-fluid" alt="Uploaded Image">
                                    <h3 class="item-name col-12"><?php echo $data['name']; ?></h3>
                                    <p class="item-price col-12">Price: <?php echo $data['price']; ?> $</p>
                                    <input type="number" value="<?php echo $numberOfItems?>">
                                    <p class="item-barcode text-end col-12"><?php echo $data['barcode'];?></p>
                                </div>
                            </div>
                        </div>
                <?php
                    }
                }
                ?>
            </div>
        </div>

    <?php
    include("elements/footer.php");
    ?>