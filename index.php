<?php
    session_start();

    if(!isset($_SESSION['email'])) {
        header("location: elements/login_page.php");
        exit();
    }

    $_SESSION['onpage'] = "catalog";

    include("php/scripts/connect.php");


    include("elements/nav.php");
?>

    <div class="container" id="box-container">
        <div class="row">

<?php
    $query = "SELECT * FROM items";
    $result = mysqli_query($conn, $query);

    while($data = mysqli_fetch_assoc($result)) {
?>
            <div class="col-12 col-sm-6 col-md-4 col-lg-3 d-flex">
                <div class="boxes p-4 mt-4 text-center">
                    <div class="row justify-content-center">
                        <?php
                        if($_SESSION['role'] == "admin") {
                        ?>
                        <form class="text-end mb-2" action="elements/edititem_page.php" method="POST">
                            <button class="editItem col-2" data-bs-toggle="tooltip" title="Edit item" name="editItem" value="<?php echo $data['barcode']?>"><i class='bx bx-pencil'></i></button>
                        </form>
                        <?php
                        }
                        ?>
                        <img src="./images/<?php echo $data['picture_path']; ?>" class="img-fluid col-12" alt="Uploaded Image">
                        <h3 class="item-name col-12"><?php echo $data['name']; ?></h3>
                        <p class="item-price col-12">Price: <?php echo $data['price']; ?> $</p>
                        <form action="php/scripts/addToCart.php" method="POST">
                            <button class="addToCart col-8" name="addItem" value="<?php echo $data['barcode']; ?>">Add to cart</button>
                        </form>
                            <?php
                            if($_SESSION['role'] == "admin") {
                            ?>
                                <form action="php/scripts/delete.php" method="POST">
                                    <button class="deleteItem col-8" name="deleteItem" value="<?php echo $data['barcode']; ?>">Delete Item</button>
                                </form>
                            <?php
                            }
                            ?>
                        
                        <p class="item-barcode text-end col-12"><?php echo $data['barcode'];?></p>
                    </div>
                </div>
            </div>

<?php
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