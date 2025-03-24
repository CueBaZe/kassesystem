<?php
    session_start(); //starts the session

    if(!isset($_SESSION['email'])) { //checks if users logged in
        header("location: elements/login_page.php");
        exit();
    }

    $_SESSION['onpage'] = "catalog";

    include("php/scripts/connect.php"); 


    include("elements/nav.php");
?>

    <div class="container" id="box-container">
        <div class="row">
            <div id="itemsContainer" class="row">
                <!--Items will be loaded here-->
            </div>
        </div>
    </div>
<?php
include("elements/footer.php");

if($role == "admin") {
    include("elements/admin_menu.php");
}

?>   