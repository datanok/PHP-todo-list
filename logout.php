<?php

session_start();
unset($_SESSION['username']);
unset($_SESSION['email']);
unset($_SESSION['avatar']);
unset($_SESSION['loggedin']);

$_SESSION['message'] = "You are now logged out";
header("Location: login.php");
 ?>
