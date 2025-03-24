<?php
include("../php/scripts/connect.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../style/edititem_page_style.css">
    <title>Admin page</title>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="wrapper col-6 mx-auto">
                <div class="row text-center justify-content-center">
                    <?php
                    $barcode = isset($_POST['editItem']) ? $_POST['editItem'] : null;

                    if (!$barcode) { //checks if barcode is not set
                        echo "<p class='text-danger'>Error: No item selected for editing.</p>";
                        exit();
                    }
                    ?>
                    <h3 class="title mt-4 col-12">Edit Item (<?php echo $barcode?>)</h3>

                    <?php
                    //Gets the infomation of the item from the database
                    $stmt = $conn->prepare("SELECT * FROM items WHERE barcode = ?");
                    $stmt->bind_param("s", $barcode);
                    $stmt->execute();
                    $result = $stmt->get_result();

                    while($data = $result->fetch_assoc()) {

                    ?>
                    <p class="itemName mb-4"><?php echo $data['name']; ?></p>
                    <div class="messages"></div>
                    <form action="../php/scripts/edititem.php" method="POST" enctype="multipart/form-data">
                        <div class="inputbox">
                            <input type="file" class="mx-auto mb-4" name="inputFile" id="fileInput">
                            <input type="number" class="col-8 mb-4" name="inputPrice" id="priceInput" min="0" step = "0.01" placeholder="<?php echo $data['price']; ?>$">
                            <input type="text" class="col-8 mb-4" name="inputcategory" id="categoryinput" placeholder="<?php echo $data['category']; ?>">
                            <input type="number" class="hiddeninput" name="realBarcode" value="<?php echo $barcode; ?>" hidden>
                        </div>
                        <div class="buttonbox">
                            <input type="submit" name="savebtn" id="savebtn" class="btn savebtn mb-4" value="Save">
                        </div>
                    </form>
                </div>
                <?php
                }
                $stmt->close();
                ?>

            </div>
        </div>
    </div>
</body>
</html>