<?php
    session_start();
    require_once '../connect/connect.php';
    
    // Получение данных о пользователе через социальные сети - начало
    $s = file_get_contents('http://ulogin.ru/token.php?token=' . $_POST['token'] . '&host=' . $_SERVER['HTTP_HOST']);
    $user = json_decode($s, true);
    //$user['network'] - соц. сеть, через которую авторизовался пользователь
    //$user['identity'] - уникальная строка определяющая конкретного пользователя соц. сети
    //$user['first_name'] - имя пользователя
    //$user['last_name'] - фамилия пользователя
    print_r($user);
    // Получение данных о пользователе через социальные сети - конец
    
    $name =$user['first_name'];
    $lastName =$user['last_name'];
    $email=$user['email'];
    $address =trim($_POST['log-upUserAddress']);
    $telephone=trim($_POST['log-upUserTelephone']);
    $password=trim($_POST['log-upPassword']);
    $password_confirm=trim($_POST['Confirmlog-upPassword']);
    $passwordCheck = md5($password.'rty5rtyuyt');
    
    $check_user=mysqli_query($connect,"SELECT * FROM `user` WHERE `email`='$email' and `password`='$passwordCheck'");
    
    if (mysqli_num_rows($check_user) === 1) {
        $_SESSION['error_message']='Пользователь с таким email уже существует';
        header('Location:../../../../includes/sign-in-up.php');
    } else {
        if ($password === $password_confirm) {
            $password = md5($password.'rty5rtyuyt');
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
