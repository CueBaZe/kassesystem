<?php
session_start();
session_unset();
session_destroy();
header("location: ../../elements/login_page.php");
?>