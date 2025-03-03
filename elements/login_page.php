<?php
session_start();
$display_email = isset($_COOKIE['cookie_email']) ? $_COOKIE['cookie_email'] : "";
$checked = isset($_COOKIE['cookie_rem']) ? "checked" : "";
?>
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
    <body onload = "deleteLastClosedTime()">
        <div class="container mt-4">
            <div class="row">
                <div class="col-8 text-center mx-auto wrapper">
                    <h3 class="title">Login</h3>
                    <form action="login_page.php" method="POST">
                    <div class="inputbox mx-auto col-10 col-sm-8 col-md-6">
                        <i class='bx bx-user'></i>
                        <input type="text" name="email" class="emailinput" id="email" placeholder="Email" value="<?=$display_email?>">
                    </div>

                    <div class="inputbox mx-auto col-10 col-sm-8 col-md-6">
                        <i onclick="showpass()" class='bx bx-hide' id="showpass"></i>
                        <input type="password" name="password" class="passwordinput" id="password" placeholder="Password">
                    </div>

                    <div class="rem">
                        <input type="checkbox" name="rem" class="rembox" <?= $checked ?>>
                        <label for="rem">Remember me</label>
                    </div>

                    <div class="errorbox">
                        <?php
                        include '../php/scripts/connect.php';

                        if(isset($_POST['login'])) {
                            $email = $_POST['email'];
                            $rem = "1";
                            $password = md5($_POST['password']);
                            $errors = array();

                            if(empty($email) || empty($password)) {
                                array_push($errors, "All fields are required!");
                            }

                            $stmt = $conn->prepare("SELECT * FROM user WHERE email = ? AND password = ?");
                            $stmt->bind_param("ss", $email, $password);
                            $stmt->execute();
                            $result = $stmt->get_result();
                            
                            if($result->num_rows > 0) {
                                $row = $result->fetch_assoc();
                                $_SESSION['email'] = $row['email'];
                                $_SESSION['id'] = $row['id'];
                                $_SESSION['role'] = $row['role'];

                                if(isset($_POST['rem'])) {
                                    setcookie('cookie_email', $email, time() + 60*60*24*7, '/');
                                    setcookie('cookie_rem', $rem, time() + 60*60*24*7, '/');
                                } else {
                                    if(isset($_COOKIE['cookie_email'])) {
                                        setcookie('cookie_email', $email, time() - 60*60*24*7, '/');
                                    }

                                    if(isset($_COOKIE['cookie_rem'])) {
                                        setcookie('cookie_rem', $rem, time() - 60*60*24*7, '/');
                                    }
                                }
                                header("location: ../index.php");
                            } else {
                                array_push($errors, "Incorrect Email or Password.");
                            }
                            $stmt->close();

                            if(count($errors) > 0) {
                                foreach($errors as $error) {
                                    echo "<div><p class='alert'>$error</p></div>";
                                }
                            }
                        }
                        $conn->close();
                        ?>
                    </div>

                    <div class="login_button_box">
                        <input type="submit" name="login" class="login_button col-8" value="Login">
                    </div>

                    <div class="reg">
                        <label class="reg-text">Don't have an account? <a href="register_page.php">Register</a></label>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </body>

    <script src="../php/scripts/showpass.js"></script>
    <script>
    function deleteLastClosedTime() {
        localStorage.removeItem('lastClosedTime');
    }
    </script>
    </html>