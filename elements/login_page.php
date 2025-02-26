    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
        <link rel="stylesheet" href="../style/login_page_style.css">
        <title>Login</title>
    </head>
    <body>
        <div class="container mt-4">
            <div class="row">
                <div class="col-8 text-center mx-auto wrapper">
                    <h3 class="title">Login</h3>
                    <form action="">
                    <div class="inputbox mx-auto col-10 col-sm-8 col-md-6">
                        <i class='bx bx-user'></i>
                        <input type="text" name="email" class="emailinput" id="email" placeholder="Email">
                    </div>

                    <div class="inputbox mx-auto col-10 col-sm-8 col-md-6">
                        <i class='bx bx-show' id="showpass"></i>
                        <input type="text" name="password" class="passwordinput" id="password" placeholder="Password">
                    </div>

                    <div class="rem">
                        <input type="checkbox" name="rem" class="rembox">
                        <label for="rem">Remember me</label>
                    </div>

                    <div class="login_button_box">
                        <input type="submit" name="login" class="login_button col-8" value="Login">
                    </div>

                    <div class="reg">
                        <label class="reg-text">Don't have an account? <a href="#">Register</a></label>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </body>
    </html>