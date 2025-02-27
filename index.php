<?php
    session_start();

    if(!isset($_SESSION['email'])) {
        header("location: elements/login_page.php");
        exit();
    }

    include("php/scripts/connect.php");

    include("elements/nav.php");
    include("elements/footer.php");

?>

    