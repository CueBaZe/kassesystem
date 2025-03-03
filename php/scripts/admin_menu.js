function adminMenu() {
    const adminmenu = document.getElementById('adminmenu');

    if (adminmenu.classList.contains("disabled")) {
        adminmenu.removeAttribute("disabled");
        adminmenu.classList.remove("disabled");
    } else {
        adminmenu.setAttribute("disabled", "true");
        adminmenu.classList.add("disabled");
    }
}