<?php
session_start();
session_destroy();
unset($_COOKIE['login']);
setcookie('login', null, -1, '/');
header("Location: login.php");
?>