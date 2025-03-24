document.addEventListener("DOMContentLoaded", function () { //run when the side loads
    loadItems(); 

    document.getElementById('searchbar').addEventListener('keyup', function () { //runs when keyup
        loadItems(this.value); // Load filtered items when typing
    });

    function loadItems(searchValue = "") {
        let xhr = new XMLHttpRequest();
        xhr.open("POST", "php/scripts/searchbar.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded"); // Set the request header to indicate form data is being sent

        xhr.onreadystatechange = function () { // Define what happens when the request state changes
            if (xhr.readyState == 4 && xhr.status == 200) { // Check if the request is complete (readyState 4) and successful (status 200)     
                document.getElementById("itemsContainer").innerHTML = xhr.responseText; // Update the inner HTML of the container with the response data
            }
        };
        xhr.send("searchItems=" + searchValue);
    }
});
