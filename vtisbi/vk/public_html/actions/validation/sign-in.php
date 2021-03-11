<?php
//error_reporting(0);
session_start();
require_once __DIR__.'/../connect/connect.php';
if (isset($_POST["log-inButton"])) :
$email=trim($_POST['log-inEmail']);
$password=trim($_POST['log-inPassword']);
$password = md5($password.'rty5rtyuyt');

$check_user=mysqli_query($connect,"SELECT * FROM `user` WHERE `email`='$email' and `password`='$password' ");

if (mysqli_num_rows($check_user) === 1){
	$user=mysqli_fetch_assoc($check_user);
	$_SESSION['user']=[
		"user_id"=>$user['user_id'],
		"name"=>$user['name'],
		"lastName"=>$user['lastName'],
		"email"=>$user['email'],
		"address"=>$user['address'],
		"telephone"=>$user['telephone'],
		"password"=>$user['password']
	];
	$_SESSION['authSuccess_message']='Успешная авторизация';
	header("Location:../../../../includes/sign-in-up.php");
} else{
       $_SESSION['authError_message']='Номер телефона или пароль введены неправильно';
	header("Location:../../../../includes/sign-in-up.php");
}
   $connect->close();
endif;
?>

