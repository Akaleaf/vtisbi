<?php 
session_start();
require_once '../connect/connect.php';
$name =trim($_POST['UserName']);
$lastName =trim($_POST['UserLastname']);
$email=trim($_POST['UserEmail']);
$address =trim($_POST['UserAddress']);
$telethone=trim($_POST['UserTelephone']);

$user_id = $_SESSION['user']['user_id'];
$updateQuery = mysqli_query($connect,"UPDATE `user` SET `name`='$name',`lastName`='$lastName',`email`='$email',`address`='$address',
	`telephone`='$telethone' WHERE `user_id` = '$user_id'");

   $connect->close();
header("Location:../../../../includes/sign-in-up.php")

 ?>