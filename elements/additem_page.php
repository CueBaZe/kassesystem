<?php
session_start();
if (!isset($_SESSION['email']) || $_SESSION['role'] !== "admin") {
    header("location: ../index.php");
    exit(); // Stop further execution
}

include("../php/scripts/connect.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and sanitize inputs

    $error_message = "";
    $success_message = "";

    $itemname = trim($_POST['itemname'] ?? '');
    $itemprice = trim($_POST['itemprice'] ?? '');
    $barcode = trim($_POST['barcode'] ?? '');
    $filename = $_FILES['uploadpicture']['name'] ?? '';
    $tempname = $_FILES['uploadpicture']['tmp_name'] ?? '';
    
    if (empty($itemname) || empty($itemprice) || empty($filename) || empty($barcode)) {
        $error_message = "All fields are required!";
    } else {
        // Ensure it's a valid number
        if (!is_numeric($itemprice) || $itemprice < 0) {
            $error_message = "Invalid item price!";
        } else {
            // File upload validation
            $allowed_extensions = ['jpg', 'jpeg', 'png', 'gif'];
            $file_extension = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

            if (!in_array($file_extension, $allowed_extensions)) {
                $error_message = "Invalid file type! Only JPG, JPEG, PNG, and GIF allowed.";
            } else {
                $path = "../images/" . basename($filename);

                $stmt = $conn->prepare("SELECT COUNT(*) FROM items WHERE barcode = ?");
                $stmt->bind_param("s", $barcode);
                $stmt->execute();
                $stmt->bind_result($count);
                $stmt->fetch();
                $stmt->close();

                if ($count > 0) {
                    $error_message = "Barcode already exists. Try again.";
                } else {
                    // Prepare SQL
                    $stmt = $conn->prepare("INSERT INTO items (barcode, name, price, picture_path) VALUES (?, ?, ?, ?)");
                    $stmt->bind_param("ssds", $barcode, $itemname, $itemprice, $filename);
                    
                    if ($stmt->execute() && move_uploaded_file($tempname, $path)) {
                        $success_message = "Item uploaded successfully!";
                    } else {
                        $error_message = "Database error: Could not insert item.";
                    }
                }
            }
        }
    }

    header("Content-Type: application/json"); // Set response type to JSON

    if (!empty($error_message)) {
        echo json_encode(["success" => false, "message" => $error_message]);
        exit();
    } 

    if (!empty($success_message)) {
        echo json_encode(["success" => true, "message" => $success_message]);
        exit();
    }

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
                    <div id="message"></div>
                    <form action="additem_page.php" method="POST" enctype="multipart/form-data">
                        <div class="inputbox">
                            <input type="file" class="mx-auto mb-4 mt-4" name="uploadpicture" id="uploadinput">
                            <input type="text" class="col-8 mb-4" name="itemname" id="nameinput" placeholder="Item Name">
                            <input type="number" class="col-8 mb-4" name="itemprice" id="priceinput" placeholder="Item Price ($)" min="0">
                        </div> 
                        <input type="submit" id="submitbtn" class="btn additembtn" value="Add Item">
                    </form>
                </div>    
            </div>
        </div>
    </div>
</body>
<script src="../php/scripts/barcode.js"></script>
</html>
    