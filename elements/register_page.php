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
                    <form action="register_page.php" method="POST">
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
                        <input type="checkbox" name="terms" class="termbox">
                        <label for="rem">Accept <a href="">terms and conditions</a></label>
                    </div>

                    <div class="errorbox">
                        <?php
                        include '../php/scripts/connect.php';

                        if(isset($_POST['register'])) {

                            $name = $_POST['name'];
                            $email = $_POST['email'];
                            $password = $_POST['password'];
                            $errors = array();

                            if(empty($name) || empty($email) || empty($password)) {
                                array_push($errors, "All fields are required!");
                            }

                            if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                                array_push($errors, "Email is not valid!");
                            }

                            if(strlen($password) < 8) {
                                array_push($errors, "Password must be 8 characters long!");
                            }

                            $stmt = $conn->prepare("SELECT * FROM user WHERE email = ?");
                            $stmt->bind_param("s", $email);
                            $stmt-> execute();
                            $result = $stmt->get_result();

                            if($result->num_rows > 0) {
                                array_push($email, "Email already exists!");
                            }

                            if(!isset($_POST['terms'])) {    
                                array_push($errors, "You must accept terms and conditions!");
                            }

                            if(count($errors) > 0) {
                                foreach($errors as $error) {
                                    echo "<div class='alert'>$error</div>";
                                }
                            } else {
                                $password = md5($password);
                                $role = "user";
                                $stmt = $conn->prepare("INSERT INTO user (name, email, password, role) VALUES (?, ?, ?, ?)");
                                $stmt->bind_param("ssss", $name, $email, $password, $role);

                                if($stmt->execute()) {
                                    header("location: login_page.php");
                                    exit();
                                } else {
                                    echo "ERROR:" . $conn->error;
                                }
                            }
                            $stmt->close();
                        }
                        $conn->close();
                        ?>
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