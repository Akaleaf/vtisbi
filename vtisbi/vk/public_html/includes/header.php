<?php 
require_once __DIR__ . '/../actions/Add_to_cart.php';
//require_once __DIR__ . '/../actions/connect/connect.php';
 ?>
<!DOCTYPE html>
<html lang="en">

<body>
	<div class="headerwrapper">
		<div class="headerL1 container">
			<img src="../includes/img/logo.png" alt="Логотип" class="logo">
			

		<a href="../includes/sign-in-up.php">
			<p >Ваш профиль</p>
			<img src="../includes/img/profile.png" alt="Пользователь" class="user ">
		</a>
		</div>

		<div class="headerL2 container">

			<a href="../index.php">
			
					<img src="../includes/img/merchTisbi.png" alt="#МерчТисби" class="merch "  >
			
				</a>
			<a href="../includes/cart.php">
				<img src="../includes/img/cart.png" alt="Корзина" class="cart">
			</a>
			<p>Общая сумма</p>
			<p><?php
if  (!isset($_SESSION['user'])) {
			 if (!empty($count_cart_products_array)) { echo $count_cart_products_array[0]; } else {echo '0' ;} }
			 else if (!empty($count_cart_products_arrayR))  {echo $count_cart_products_arrayR[0] ;}  else {echo '0' ;}  ?> руб </p>
		
</body>
</html>

