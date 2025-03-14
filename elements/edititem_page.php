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
                    <h3 class="title mt-4 col-12">Edit Item (<?php echo $_POST['editItem']?>)</h3>
                    <?php
                    $barcode = $_POST['editItem'];

                    $stmt = $conn->prepare("SELECT * FROM items WHERE barcode = ?");
                    $stmt->bind_param("i", $barcode);
                    $stmt->execute();
                    $result = $stmt->get_result();

                    while($data = $result->fetch_assoc()) {

                    ?>
                    <p class="itemName mb-4"><?php echo $data['name']; ?></p>
                    <div class="messages"></div>
                    <form action="edititem_page.php" method="POST">
                        <div class="inputbox">
                            <input type="file" class="mx-auto mb-4" name="inputFile" id="fileInput">
                            <input type="number" class="col-8 mb-4" name="inputPrice" id="priceInput" placeholder="<?php echo $data['price']; ?>$">
                            <input type="number" class="col-8 mb-4" name="inputBarcode" id="barcodeInput" placeholder="<?php echo $barcode?>"> 
                        </div>
                        <div class="buttonbox">
                            <input type="submit" id="savebtn" class="btn savebtn mb-4" value="Save">
                        </div>
                    </form>
                </div>
                <?php
                }
                ?>

            </div>
        </div>
    </div>
</body>
</html>