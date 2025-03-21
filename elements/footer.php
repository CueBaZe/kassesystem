<?php
$items = $_SESSION['items'];
$price = $_SESSION['price'];
?>
    <div class="container-fluid" name="footer" id="footer">
        <div class="row">
            <div class="row col-6 text-start">
                <p class="col-12" id="cart-items">Items: <?php echo $items; ?></p>
                <p class="col-12" id="cart-price">Price: <?php echo $price; ?>$</p>
            </div>
            <?php
                if($_SESSION['onpage'] == "catalog") {

            ?>
            <div class="row col-6">
                <div class="buttonBox text-end">
                    <button onclick="window.location.href = 'cart.php'" class="btn buy col-6 m-4">Buy</button>
                </div>
            </div>
            <?php
                }
            ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="php/scripts/timechecker.js"></script>
    <script src="php/scripts/admin_menu.js"></script>
    <script src="php/scripts/searchbar.js"></script>
    <script>
        document.getElementById("itemsContainer").addEventListener("click", function (e) {
            if (e.target.classList.contains("addToCart")) {
                e.preventDefault(); // Prevent default form submission

                let formData = new FormData();
                formData.append("addItem", e.target.value);

                fetch("php/scripts/addToCart.php", {
                    method: "POST",
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    document.getElementById("cart-items").innerText = "Items: " + data.items;
                    document.getElementById("cart-price").innerText = "Price: " + data.price + " $";
                })
                .catch(error => console.error("Error:", error));
            }
        });

</script>


</body>
</html>