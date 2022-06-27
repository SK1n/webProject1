<?php
session_start();
session_destroy();
unset($_COOKIE['name']);
setcookie('name', null, -1, '/'); 
// Redirect to the login page:
header('Location: ../index.php');
?>