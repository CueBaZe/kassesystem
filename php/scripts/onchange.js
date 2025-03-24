document.addEventListener("DOMContentLoaded", function () { //runs when the side loads
    attachCartListeners(); 
});


function attachCartListeners() {
    document.querySelectorAll(".quanity-input").forEach(input => { //selects all elements with the class quanity-input, and loops the element
        input.addEventListener("change", function () { //adds a eventlistener to the element
            let barcode = this.dataset.barcode; //gets the barcode from the dataset
            let newQuanity = parseInt(this.value); //get the quanity from the input value

            if (newQuanity < 0) { //checks if the newQuanity is bigger than 0
                newQuanity = 0;
            }

            let formData = new FormData(); //makes new formData and adds barcode and newQuanity to the fromData
            formData.append("barcode", barcode);
            formData.append("newQuanity", newQuanity);

            fetch("php/scripts/addToCart.php", { //sends the formdata to addToCart.php with POST
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
    fetch("cart.php") //imports the cart.php
    .then(response => response.text())
    .then(html => {
        let tempDiv = document.createElement("div");
        tempDiv.innerHTML = html;
        let newContent = tempDiv.querySelector("#box-container");

        if (newContent) {
            document.getElementById("box-container").innerHTML = newContent.innerHTML; //loads the newContent
        }

        attachCartListeners(); //adds the eventlisteners again

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
