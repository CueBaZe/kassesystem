<?php
session_start();

if(!isset($_SESSION['email']) || $_SESSION['role'] !== "admin") {
    header("location: ../index.php");

    include("../php/scripts/connect.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../style/additem_page_style.css">
    <title>Admin Page</title>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="wrapper col-6 mx-auto">
                <div class="row text-center justify-content-center">
                    <h3 class="title mt-4">Add Items</h3>
                    <form action="additem_page.php">
                        <div class="inputbox">
                            <input type="file" class="mx-auto mb-4 mt-4" name="uploadpicture" id="uploadinput">
                            <input type="text" class="col-8 mb-4" name="itemname" id="nameinput" placeholder="Item Name">
                            <input type="number" class="col-8 mb-4" name="itemprice" id="priceinput" placeholder="Item Price ($)" min="0">
                        </div> 
                        <button class="btn additembtn">Add Item</button>
                    </form>
                </div>    
            </div>
        </div>
    </div>
</body>
</html>