function showpass() {
    input = document.getElementById('password');
    button = document.getElementById('showpass');

    if(input.type === "password") {
        input.type = "text";
        button.classList.remove("bx-hide");
        button.classList.add("bx-show");
    } else {
        input.type = "password";
        button.classList.remove("bx-show");
        button.classList.add("bx-hide");
    }
}