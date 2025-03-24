<?php
include("connect.php");

if (isset($_POST['savebtn'])) {
    $barcode = $_POST['realBarcode']; //gets the barcode from a hidden input
    $price = "";
    $category = "";

    if (isset($_FILES['inputFile']) && $_FILES['inputFile']['error'] === UPLOAD_ERR_OK) {
        $filename = $_FILES['inputFile']['name'];  // Original file name
        $tempname = $_FILES['inputFile']['tmp_name']; // Temporary file path

        //Get the old picture path so it can be deleted
        $stmt = $conn->prepare("SELECT * FROM items WHERE barcode = ?");
        $stmt->bind_param("s", $barcode);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            while($data = $result->fetch_assoc()) {
                if(file_exists('../../images/' . $row['picture_path'])) {
                    $oldpicture = $data['picture_path'];

                    //Delete the old picture from the images folder 
                    if (!unlink('../../images/' . $data['picture_path'])) {
                        die("Error deleting the file.");
                    }

                    //upload the new picture to the database and the folder
                    $allowed_extensions = ['jpg', 'jpeg', 'png', 'gif'];
                    $file_extension = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
                    if (!in_array($file_extension, $allowed_extensions)) { //checks if the file extension is in array
                        $error_message = "Invalid file type! Only JPG, JPEG, PNG, and GIF allowed.";
                    } else {
                        $path = "../../images/" . basename($filename);
                        $sql = $conn->prepare("UPDATE items SET picture_path = ? WHERE barcode = ?");
                        $sql->bind_param("ss", $filename, $barcode);
                        $sql->execute();

                        if ($sql->execute() && move_uploaded_file($tempname, $path)) { //set the path into the database and the file into the folder
                            echo "succes!";
                        }
                    }   
                }
            }
            $stmt->close();
        }
    } else {
        echo "File upload failed or no file uploaded! Error Code: " . $_FILES['inputFile']['error'];
    }

    if(!empty($_POST['inputPrice'])) {
        //Change price of item
        $price = floatval($_POST['inputPrice']);
        if ($price > 0) {
            $stmt = $conn->prepare("UPDATE items SET price = ? WHERE barcode = ?");
            $stmt->bind_param("ds", $price, $barcode);
            $stmt->execute();
            $stmt->close();
        }
    }

    if(!empty($_POST['inputcategory'])) {
        //change category of item
        $category = $_POST['inputcategory'];
        $stmt = $conn->prepare("UPDATE items SET category = ? WHERE barcode = ?");
        $stmt->bind_param("ss", $category, $barcode);
        $stmt->execute();
        $stmt->close();
    }
    
    header("location: ../../index.php");
}
?>