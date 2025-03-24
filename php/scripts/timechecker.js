window.addEventListener("load", function() {
    if(!document.cookie.includes('cookie_rem')) { //Checks if the user has the cookie or not
        checkSession(); //runs this function if the user does not have the cookie
    }
})

function checkSession() { //checks how long the user has been off the side
    const lastClosedTime = localStorage.getItem('lastClosedTime');

    if(lastClosedTime) {
        const timeElapsed = Date.now() - parseFloat(lastClosedTime, 10);
        console.log(timeElapsed);

        if(timeElapsed > 5000) {
            fetch('logout.php')
            .then(()=> {
                localStorage.removeItem('lastClosedTime');
                window.location.href = "elements/login_page.php"
            })
        }
    }
}

window.addEventListener("unload", function(event) { //When you unload the side is stores the time
    localStorage.setItem('lastClosedTime', Date.now());
})