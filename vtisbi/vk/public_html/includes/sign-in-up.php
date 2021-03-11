<?php 
session_start();
require_once '../actions/connect/connect.php';

// Получение данных о пользователе через социальные сети - начало
$s = file_get_contents('http://ulogin.ru/token.php?token=' . $_POST['token'] . '&host=' . $_SERVER['HTTP_HOST']);
$user = json_decode($s, true);
//$user['network'] - соц. сеть, через которую авторизовался пользователь
//$user['identity'] - уникальная строка определяющая конкретного пользователя соц. сети
//$user['first_name'] - имя пользователя
//$user['last_name'] - фамилия пользователя
print_r($user);
// Получение данных о пользователе через социальные сети - конец

$limit = 3; 
$ProductSeeAlso = mysqli_query($connect," SELECT * FROM `product` ORDER BY RAND() LIMIT $limit  ");
$ProductArraySeeAlso = mysqli_fetch_all($ProductSeeAlso,MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
    <!--<meta name="viewport" content="width=device-width, initial-scale=1"/>-->
	
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
	
	<link rel="stylesheet" type="text/css" href="../css/style.css">
    <link rel="stylesheet" type="text/css" href="../css/stylesign-in-up.css">
		<!--<link rel="stylesheet" type="text/css" href="../css/media.css">-->
	<title><?php if (isset($_SESSION['user'])) : ?>
	    Профиль
	    <?php else: ?>
    Регистрация / Авторизация пользователя
<?php endif; ?>
</title>
</head>
<body>
    
    

	<div class="main-screen">
        <?php include "../includes/header.php" ?>
	</div>

</div>

</div><!---main-screen -->

<div class="contentwrapper">
<div class="content ">
    
    <?php include "../includes/menu.php" ?>
    <?php if (!isset($_SESSION['user'])) : ?>
    
	<div class="regwrapper">
    	<div class="head">
    		<p >Авторизация / Регистрация пользователя</p>
    		
    	</div>
    	<!-- Аутентификация пользователя через социальные сети - начало -->
    	<div class="head">
    		<p>
            <script src="//ulogin.ru/js/ulogin.js"></script>
            <div id="uLogin" data-ulogin="
            display=panel;
            theme=flat;
            fields=email;
            optional:first_name,last_name;
            providers=vkontakte,facebook,instagram,twitter,google,youtube,googleplus,lastfm,tumblr;
            hidden=other;
            redirect_uri=http%3A%2F%2Fa9274715.beget.tech%2Factions%2Fvalidation%2Fsign-up-social.php;mobilebuttons=0;">
            </div>
            </p>
        </div>
        <!-- Аутентификация пользователя через социальные сети - конец -->
	<div class="auth-block">
	    
	<div class="message">
        <?php
            if (isset($_SESSION['authError_message'])) {
                echo ' <p class="alert alert-danger error_message">' .$_SESSION['authError_message'] .'</p>' ; unset($_SESSION['authError_message'] ) ;
            }  
        ?>
    </div>
		
        <form action="../actions/validation/sign-in.php" method="POST" >
            <div class="form-group">
           	    <p>Вход в систему:</p>
           	
        	    <input type="email" name="log-inEmail" class="form-control" placeholder="Email" >
        	    <input type="password" name="log-inPassword" class="form-control" placeholder="Пароль" >
        	    
        	    <button type="submit" name="log-inButton" class="">Войти</button>
            </div>
        </form>

	</div>
	<div class="reg-block">
<div class="message">
    
        <?php; 
            if (isset($_SESSION['regSuccess_message'])) {
                echo ' <p class=" alert alert-success success_message">' .$_SESSION['regSuccess_message'] .'</p>' ; unset($_SESSION['regSuccess_message'] );
            }
            if (isset($_SESSION['regError_message'])) {
                echo ' <p class="alert alert-danger error_message">' .$_SESSION['regError_message'] .'</p>' ; unset($_SESSION['regError_message'] );
            }  
        ?>
        
       </div>
		<form action="../actions/validation/sign-up.php" method="POST" >
   <div class="form-group">

   	<p>Регистрация пользователя:</p>
    	<input type="email" name="log-upEmail" class="form-control" placeholder="Email" required>
            <span title="Обязательно для заполнения">*</span> 
    	  
        <input type="password" name="log-upPassword" class="form-control" placeholder="Введите пароль" required>
            <span title="Обязательно для заполнения">*</span>
    	   
        <input type="password" name="Confirmlog-upPassword" class="form-control" placeholder="Подтвердите  пароль" required>
            <span title="Обязательно для заполнения">*</span>
            
       	<input type="text" name="log-upUserName" class="form-control" placeholder="Имя"> 
            <!-- <span title="Обязательно для заполнения">*</span> -->
     	   
       	<input type="text" name="log-upUserLastname" class="form-control" placeholder="Фамилия" >
            <!-- <span title="Обязательно для заполнения">*</span> -->
       	  
        <input type="text" name="log-upUserTelephone" class="form-control" placeholder="Номер телефона">
            <!-- <span title="Обязательно для заполнения">*</span> -->
    	  
    	<input type="text" name="log-upUserAddress" class="form-control" placeholder="Адрес">
            <!-- <span title="Обязательно для заполнения">*</span> -->
    	  
    	
	 
        <button type="submit" name="log-upButton" >Зарегистрироватьcя </button>
	
   </div>
</form>

	</div>
</div>

	<?php else : ?>
		<?php 
    		$user_id = $_SESSION['user']['user_id'];
            $User = mysqli_query($connect," SELECT * FROM `user` where `user_id`='$user_id' ");
            $UserArray = mysqli_fetch_all($User,MYSQLI_ASSOC);
		 ?>
		<div class="profile">
			<div class="head">
		    <p >Ваш профиль</p>
	    </div>
	<div class="profile_data">
			<form action="../actions/profile_edit/change_profile_data.php" method="POST" accept-charset="utf-8" >

		
			<?php foreach ($UserArray as $user) : ?>	
				<?php  
    				$user_LastName=$user["lastName"];
    				$user_Name=$user["name"];
    				$user_Email=$user["email"];
    				$user_Telephone=$user["telephone"];
    				$user_Address=$user["address"];
			    ?>
			 <?php endforeach;  ?>
			

		<div class="row">
			<div class="col-2">Фамилия:</div>
			<div class="col"><input type="text" name="UserLastname" class="form-control" value="<?=$user_LastName?>" ></div>
			<div class="col-1">Имя:</div>
			<div class="col"><input type="text" name="UserName" class="form-control" value="<?=$user_Name?>" ></div>
		</div>
		<div class="row">
			<div class="col-2">Email:</div>
			<div class="col"><input type="email" name="UserEmail" class="form-control"  value="<?=$user_Email?>"></div>
		</div>
		<div class="row">
			<div class="col-3">Номер телефона:</div>
			<div class="col"><input type="text" name="UserTelephone" class="form-control" value="<?=$user_Telephone?>" ></div>
		</div>
		<div class="row">
			<div class="col-2">Адрес:</div>
			<div class="col"><input type="text" name="UserAddress" class="form-control Address" value="<?=$user_Address?>"></div>
		</div>
		

 <button type="submit" name="ChangeProfileData" class="">Сохранить изменения</button>


				</form>
	 
</div><!---profile_data-->
<div class="seeAlso">
<p>Смотрите также:</p>
			<div class="row ">
			<?php foreach ($ProductArraySeeAlso as $productSeeAlso):  ?>
				<div class="col-4">
           <a href="product_info.php?product_id=<?=$productSeeAlso["product_id"]?>&category_id=<?=$productSeeAlso["category_id"]?>">
            	<?php   $show_img = base64_encode($productSeeAlso["product_image"]);                      
                if ($show_img) { ?> <img src="data:image/jpeg;base64,<?=$show_img ?>" alt="" class="product_image" > <?php } else {?>
                <img src="img/default_image.jpg" alt="Нет картинки" class="product_image" > <?php };?>
			<p class="product_name"><?=$productSeeAlso["product_name"]?></p>
			<div class="product_price"><?=$productSeeAlso["product_price"]?> руб</div>
			</a>
			</div>

			<?php endforeach; ?>
			
</div>
		</div>
	<?php endif; ?>
</div> <!---Content---->
</div>
</div>

<?php  include "../includes/footer.php"?>	



	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>


</body>
</html>