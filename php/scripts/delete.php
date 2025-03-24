<?php
include("connect.php");

if(isset($_POST['deleteItem'])) {
    $barcode = $_POST['deleteItem'];

    $stmt = $conn->prepare("SELECT * FROM items WHERE barcode = ?"); //select items where barcode = $barcode
    $stmt->bind_param("s", $barcode);
    $stmt->execute();
    $result = $stmt->get_result();

    if($result->num_rows > 0) { //check if num_rows is bigger than 0
        $sql = $conn->prepare("SELECT picture_path FROM items WHERE barcode = ?");
        $sql->bind_param("s", $barcode);
        $sql->execute();
        $result = $sql->get_result();

        if($result->num_rows > 0) { //deletes the picture from folder
            while($row = $result->fetch_assoc()) {
                if(file_exists('../../images/' . $row['picture_path'])) {
                    if (!unlink('../../images/' . $row['picture_path'])) {
                        die("Error deleting the file.");
                    } 
                }
            }
        }
        $stmt = $conn->prepare("DELETE FROM items WHERE barcode = ?"); //deletes the item
        $stmt->bind_param("s", $barcode);

        if($stmt->execute()) {
            header("location: ../../index.php");
        }
    }
}
?>