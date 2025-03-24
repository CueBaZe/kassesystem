<?php
$host = "localhost";
$user = "root";
$password = "";
$db = "kasse";

$conn = new mysqli($host, $user, $password, $db); //connects to the database

if(!$conn) {
    die("Connection failed: " . mysqli_connect_error);
}

if($conn->connect_error) {
    die("Failed to connect to DB: " . $conn->connect_error);
}
?>