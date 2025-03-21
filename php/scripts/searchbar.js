document.addEventListener("DOMContentLoaded", function () {
    loadItems();

    document.getElementById('searchbar').addEventListener('keyup', function () {
        loadItems(this.value); // Load filtered items when typing
    });

    function loadItems(searchValue = "") {
        let xhr = new XMLHttpRequest();
        xhr.open("POST", "php/scripts/searchbar.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                document.getElementById("itemsContainer").innerHTML = xhr.responseText;
            }
        };
        xhr.send("searchItems=" + searchValue);
    }
});
