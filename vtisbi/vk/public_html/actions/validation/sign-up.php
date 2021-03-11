<?php
    session_start();
    require_once '../connect/connect.php';
    
    $name =trim($_POST['log-upUserName']);
    $lastName =trim($_POST['log-upUserLastname']);
    $email=trim($_POST['log-upEmail']);
    $address =trim($_POST['log-upUserAddress']);
    $telephone=trim($_POST['log-upUserTelephone']);
    $password=trim($_POST['log-upPassword']);
    $password_confirm=trim($_POST['Confirmlog-upPassword']);
    $passwordCheck = md5($password.'rty5rtyuyt');
    
    $check_user=mysqli_query($connect,"SELECT * FROM `user` WHERE `email`='$email' and `password`='$passwordCheck'");
    
    $user_id = $_SESSION['user']['user_id'];
    if (mysqli_num_rows($check_user) === 1) {
        $_SESSION['error_message']='Пользователь с таким адресом электронной почты уже существует';
        header('Location:../../../../includes/sign-in-up.php');
    } else {
        if ($password === $password_confirm) {
            $password = md5($password.'rty5rtyuyt');
            //mysqli_query($connect,"INSERT INTO `user` ( `name`, `lastName`, `email`, `address`, `telephone`, `password`) VALUES ('$name','$lastName', 
            //    '$email','$address','$telephone','$password')");
            mysqli_query($connect,"INSERT INTO `user` (`email`, `password`) VALUES ('$email','$password')");
            if ($name) {
                mysqli_query($connect, "UPDATE `user` SET `name`='$name' WHERE `email` = '$email'");
            }
            if ($lastName) {
                mysqli_query($connect, "UPDATE `user` SET `lastName`='$lastName' WHERE `email` = '$email'");
            }
            if ($telephone) {
                mysqli_query($connect, "UPDATE `user` SET `telephone`='$telephone' WHERE `email` = '$email'");
            }
            if ($address) {
                mysqli_query($connect, "UPDATE `user` SET `address`='$address' WHERE `email` = '$email'");
            }
            $_SESSION['regSuccess_message']='Успешная регистрация';
            header('Location:../../../../includes/sign-in-up.php');
        } else {
    	    $_SESSION['regError_message']='Пароли не совпадают';
            header('Location:../../../../includes/sign-in-up.php');
        }
    }
    $connect->close();
?>
