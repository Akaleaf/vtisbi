<?php
session_start();
unset($_SESSION['user']);
header('Location:../../../../includes/sign-in-up.php');
?>