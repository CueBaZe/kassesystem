<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/nav_style.css">
    <link rel="stylesheet" href="style/footer_style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Kassesystem</title>
</head>
<body>
    <div class="container-fluid" name="nav" id="nav">
        <div class="row">
            <nav class="navbar fixed-top py-3 col-12">
                <a class="navbar-brand logo" href="#">Kasse</a>
                <div class="dropdown">
                    <button type="button" class="btn dropdown-toggle name" data-bs-toggle="dropdown">
                        <?php
                        if(isset($_SESSION['email'])) {
                            $email = $_SESSION['email'];
                            $query = mysqli_query($conn, "SELECT user.* FROM `user` WHERE user.email = '$email'");
                            while($row=mysqli_fetch_array($query)) {
                                echo $row['name'];
                            }
                        }
                        ?>
                    </button>
                    <ul class="dropdown-menu">
                        <li class="dropdown-item">
                            <a href="#" class="nav-link">Account</a>
                        </li>
                        <li class="dropdown-item">
                            <a href="#" class="nav-link">Cart</a>
                        </li>
                        <li><hr class="dropdown-divider"></hr></li> 

                        <?php
                        $role = "";
                        if(isset($_SESSION['role'])) {
                            $role = $_SESSION['role'];
                            if($role == "admin") {
                                echo "<li class='dropdown-item'><a href='#' class='nav-link'>Admin</a></li>";
                            }   
                        }
                        
                        ?>

                        <li class="dropdown-item">
                            <a href="php/scripts/logout.php" class="nav-link">Logout</a>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
    </div>