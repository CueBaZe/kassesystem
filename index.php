<?php
    session_start();

    if(!isset($_SESSION['email'])) {
        header("location: elements/login_page.php");
        exit();
    }

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
            <div class="col-3 d-flex">
                <div class="boxes p-4 mt-4 text-center">
                    <img src="./images/<?php echo $data['picture_path']; ?>" class="img-fluid" alt="Uploaded Image">
                    <h3 class="image-name"><?php echo $data['picture_path']; ?></h3>
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

    