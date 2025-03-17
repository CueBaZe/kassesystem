document.getElementById('submitbtn').addEventListener("click", function(event) {
    event.preventDefault(); // Prevent default form submission

    let itemname = document.getElementById('nameinput').value.trim();
    let itemprice = document.getElementById('priceinput').value.trim();
    let itemcategory = document.getElementById('categoryinput').value.trim();
    let fileinput = document.getElementById('uploadinput').files[0];

    if (!itemname || !itemprice || !itemcategory || !fileinput) {
        document.getElementById('message').innerHTML = "<p class='text-danger'>All fields are required!</p>";
        return;
    }

    let barcode = Math.floor(10000000 + Math.random() * 90000000); // Generate 8-digit barcode

    let formdata = new FormData();
    formdata.append("itemname", itemname);
    formdata.append("itemprice", itemprice);
    formdata.append("itemcategory", itemcategory);
    formdata.append("uploadpicture", fileinput);
    formdata.append("barcode", barcode);

    fetch("../elements/additem_page.php", {
        method: "POST",
        body: formdata
    }) 
    .then(response => {
        if (!response.ok) {
            throw new Error("Network response was not ok");
        }
        return response.json();
    })
    .then(data => {
        if (data.success) {
            document.getElementById('message').innerHTML = `<p class='text-success'>${data.message}</p>`;
            document.getElementById("addItemForm").reset(); // Clear form
        } else {
            document.getElementById('message').innerHTML = `<p class='text-danger'>${data.message}</p>`;
        }
    })
    .catch(error => {
        console.error("Error:", error);
        document.getElementById('message').innerHTML = "<p class='text-danger'>An error occurred while processing the request.</p>";
    });
}); 
