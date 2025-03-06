document.getElementById('submitbtn').addEventListener("click", function(event) {
    event.preventDefault(); // Prevent page refresh

    let itemname = document.getElementById('nameinput').value.trim();
    let itemprice = document.getElementById('priceinput').value.trim();
    let fileinput = document.getElementById('uploadinput').files[0];

    if (!itemname || !itemprice || !fileinput) {
        alert("All fields are required!");
        return;
    }

    let barcode = Math.floor(10000000 + Math.random() * 90000000); // Generate 8-digit barcode

    let formdata = new FormData();
    formdata.append("itemname", itemname);
    formdata.append("itemprice", itemprice);
    formdata.append("uploadpicture", fileinput);
    formdata.append("barcode", barcode);

    fetch("../elements/additem_page.php", {
        method: "POST",
        body: formdata
    }) 
    .then(response => response.text()) // Get response as text
    .then(data => {
        console.log("Server Response:", data); // Show success or error message
    })
    .catch(error => console.error("Error:", error));
});
