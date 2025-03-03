window.addEventListener("load", function() {
    if(!document.cookie.includes('cookie_rem')) {
        checkSession();
    }
})

function checkSession() {
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

window.addEventListener("unload", function(event) {
    localStorage.setItem('lastClosedTime', Date.now());
})