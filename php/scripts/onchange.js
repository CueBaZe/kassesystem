document.addEventListener("DOMContentLoaded", function () {
    attachCartListeners(); 
});


function attachCartListeners() {
    document.querySelectorAll(".quanity-input").forEach(input => {
        input.addEventListener("change", function () {
            let barcode = this.dataset.barcode;
            let newQuanity = parseInt(this.value);

            if (newQuanity < 0) {
                newQuanity = 0;
            }

            let formData = new FormData();
            formData.append("barcode", barcode);
            formData.append("newQuanity", newQuanity);

            fetch("php/scripts/addToCart.php", {
                method: "POST",
                body: formData
            })
            .then(response => response.json()) 
            .then(data => {
                document.getElementById("cart-items").innerText = "Items: " + data.items;
                document.getElementById("cart-price").innerText = "Price: " + data.price + "$";

                if (newQuanity === 0) {
                    updateCart();
                }
            })
            .catch(error => console.error("Error:", error));
        });
    });
}

function updateCart() {
    fetch("cart.php") 
    .then(response => response.text())
    .then(html => {
        let tempDiv = document.createElement("div");
        tempDiv.innerHTML = html;
        let newContent = tempDiv.querySelector("#box-container");

        if (newContent) {
            document.getElementById("box-container").innerHTML = newContent.innerHTML;
        }

        attachCartListeners();

        return fetch("php/scripts/addToCart.php", {
            method: "POST",
            body: new FormData()
        });
    })
    .then(response => response.json())
    .then(data => {
        document.getElementById("cart-items").innerText = "Items: " + data.items;
        document.getElementById("cart-price").innerText = "Price: " + data.price + "$";
    })
    .catch(error => console.error("Error updating cart:", error));
}
