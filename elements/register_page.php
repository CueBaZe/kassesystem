<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
        <link rel="stylesheet" href="../style/register_page_style.css">
        <title>Register</title>
    </head>
    <body>
        <div class="container mt-4">
            <div class="row">
                <div class="col-8 text-center mx-auto wrapper">
                    <h3 class="title">Register</h3>
                    <form action="">
                    <div class="inputbox mx-auto col-10 col-sm-8 col-md-6">
                        <i class='bx bx-user'></i>
                        <input type="text" name="name" class="nameinput" id="name" placeholder="Name">
                    </div>

                    <div class="inputbox mx-auto col-10 col-sm-8 col-md-6">
                        <i class='bx bx-user'></i>
                        <input type="text" name="email" class="emailinput" id="email" placeholder="Email">
                    </div>

                    <div class="inputbox mx-auto col-10 col-sm-8 col-md-6">
                        <i class='bx bx-show' id="showpass"></i>
                        <input type="text" name="password" class="passwordinput" id="password" placeholder="Password">
                    </div>

                    <div class="terms">
                        <input type="checkbox" name="term" class="termbox">
                        <label for="rem">Accept <a href="">terms and conditions</a></label>
                    </div>

                    <div class="register_button_box">
                        <input type="submit" name="register" class="register_button col-8" value="Register">
                    </div>

                    <div class="login">
                        <label class="login-text">have an account? <a href="login_page.php">Login</a></label>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </body>
    </html>