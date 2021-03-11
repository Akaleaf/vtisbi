
<?
define("APP_ID",'7786897'); //ID приложения
define("APP_SECRET",'tA4aEgqZLhsTxOE5xBJi'); //Защищённый ключ
define("REDIRECT_URI",'http://a9274715.beget.tech/actions/vk.php'); //Доверенный redirect URI, там, где лежит этот файл

if(!isset($_GET['code'])) { //Получение code 
    $url = "https://oauth.vk.com/authorize?client_id=".APP_ID."&scope=offline&redirect_uri=".REDIRECT_URI."&response_type=code&v=5.73"; 
    header("Location:".$url);
    exit(); 
} else {    // получение $token
    $result = false;
    $params = array(
        'client_id' => APP_ID,
        'client_secret' => APP_SECRET,
        'redirect_uri' => REDIRECT_URI,
        'code' => $_GET['code']
    );
    $token = json_decode(file_get_contents('https://oauth.vk.com/access_token?'.urldecode(http_build_query($params))), true);
    echo 'token: ';
    echo $token;
    echo '<br>';

    if (isset($token['access_token'])) { // получение информации о юзере
        $params = array(
            'user_ids' => $token['user_id'],
            'fields'  => 'first_name,last_name,nickname,screen_name,sex,bdate,city,country,timezone,photo,photo_medium,photo_big,has_mobile,rate,contacts,education,online,counters',
            'access_token' => $token['access_token'],
            'v' => '5.73'
        );        
        $get_params = http_build_query($params);                
        $result = json_decode(file_get_contents('https://api.vk.com/method/users.get?'. $get_params));

        // информация о юзере
        $bdate = $result -> response[0] -> bdate;    
        $first_name = $result -> response[0] -> first_name;    
        $last_name = $result -> response[0] -> last_name;   
        $photo_medium = $result -> response[0] -> photo_medium;
    } else {
        exit('Обибка');
    }

    // вывод информации о юзере
    if ($result) {
        echo '<br />';
        echo "ID : " . $params[user_ids] . '<br />';
        echo "Имя пользователя: " . $first_name . '<br />';
        echo "ф пользователя: " . $last_name . '<br />';
        echo "День Рождения: " . $bdate . '<br />';
        echo '<img src="' . $photo_medium . '" />'; echo "<br />";
    }
}
if($_GET['error']) {
   exit($_GET['error_description']);
}
?>


/*
<?php

if (!$_GET['code']) {
    exit('error code');
}

$params = array(
	'client_id'     => '7786897',
	'client_secret' => 'tA4aEgqZLhsTxOE5xBJi',
	'redirect_uri'  => 'http://a9274715.beget.tech/actions/vk.php',
	'code'          => $_GET['code']
);

$secret = 'tA4aEgqZLhsTxOE5xBJi';
$id = '7786897';
$token = file_get_contents('https://oauth.vk.com/access_token?' . urldecode(http_build_query($params)));
$token = json_decode($token, true);

echo ' 454 <br>';
echo 'code: ';
print_r($_GET['code']);
echo '<br>';
echo ' 123 <br>';
echo 'token: ';
print_r($token);

if ($token) {
    exit('error token');
}

var_dump($token);

?>
*/