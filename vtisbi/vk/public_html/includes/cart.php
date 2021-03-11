<?php 
session_start();
require_once '../actions/DB_Query.php';
require_once '../actions/Add_to_cart.php';


//print_r($cart_products_array);
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
<!--<meta name="viewport" content="width=device-width, initial-scale=1"/>-->
	
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
	
	<link rel="stylesheet" type="text/css" href="../css/style.css">
	<!--<link rel="stylesheet" type="text/css" href="../css/media.css">-->
	<link rel="stylesheet" type="text/css" href="../css/cart.css">
	
	<title>Корзина</title>
</head>
<body>

	<div class="main-screen">
         <?php include "../includes/header.php" ?>

</div><!---main-screen -->

</div>
</div>



<div class="contentwrapper">
<div class="content ">
	  <?php include "../includes/menu.php" ?>
	  <div class="products">
		<div class="head">
		<p>Корзина</p>
	</div>
<?php if (!isset($_SESSION['user'])) : ?>
	<?php if (!empty($cart_products_array)) :?>
		<?php// print_r($cart_products_array); ?>
	<div class="row">
	<div class="col"><span>Товар</span></div>
	<div class="col-3">Стоимость</div>
	<div class="col-2">Убрать</div>
			</div>
			<form action="" method="POST" accept-charset="utf-8">
			<div class="row">
			
				<?php foreach ($cart_products_array as $unregistered_cart_product) : ?>
            
					<div class="row">
					<div class="col">
						<a href="../includes/product_info.php?product_id=<?=$unregistered_cart_product["product_id"]?>&category_id=<?=$unregistered_cart_product["category_id"]?>">

				<?php   $show_img = base64_encode($unregistered_cart_product["product_image"]);                      
                if ($show_img) { ?> <img src="data:image/jpeg;base64,<?=$show_img ?>" alt="" class="product_image" > <?php } else {?>
                <img src="img/default_image.jpg" alt="Нет картинки" class="product_image" > <?php };?>

						</a>
						<a href="../includes/product_info.php?product_id=<?=$unregistered_cart_product["product_id"]?>&category_id=<?=$unregistered_cart_product["category_id"]?>"><div class="product_name"><?=$unregistered_cart_product["product_name"]?></div></a>
					<!--	<div class="product_size">Размер: <strong>XS</strong></div>-->
					</div>
	                <div class="col-3">
                          <p><?=$unregistered_cart_product["product_price"]?> руб</p>
	                </div>
	                <div class="col-2"><button type="submit" name="delete_from_cart" value="<?=$unregistered_cart_product["product_id"]?>"></button></div>
				</div>


				<?php endforeach; ?>

	
			</div><!---Products row-->
			<div class="row">
				<div class="col-7">
					<div class="wrapper">
					<p>Общая стоимость:</p>
					<p><?=$count_cart_products_array[0]?> руб.</p>	
					</div>
				</div>
				<div class="col-5"><button type="submit" name="accept_order" >Оформить заказ</button></div>
			</div>
				<?php else: ?>
		<h4 style="position: absolute;left:40%;top:100px;">Нет товаров!</h4>
			<?php endif; ?>
</form>
			<?php else: ?> <!-- SESSION USER ELSE-->
			<?php if (!empty($Registred_cart_products_array)) :?>
			<div class="row">
	<div class="col"><span>Товар</span></div>
	<div class="col-3">Стоимость</div>
	<div class="col-2">Убрать</div>
			</div>
			<form action="" method="POST" accept-charset="utf-8">
			<div class="row">

				<?php foreach ($Registred_cart_products_array as $registered_cart_product) : ?>
            
					<div class="row">
					<div class="col">
						<a href="../includes/product_info.php?product_id=<?=$registered_cart_product["product_id"]?>&category_id=<?=$unregistered_cart_product["category_id"]?>">

				<?php   $show_img = base64_encode($registered_cart_product["product_image"]);                      
                if ($show_img) { ?> <img src="data:image/jpeg;base64,<?=$show_img ?>" alt="" class="product_image" > <?php } else {?>
                <img src="img/default_image.jpg" alt="Нет картинки" class="product_image" > <?php };?>

						</a>
						<a href="../includes/product_info.php?product_id=<?=$unregistered_cart_product["product_id"]?>&category_id=<?=$unregistered_cart_product["category_id"]?>"><div class="product_name"><?=$registered_cart_product["product_name"]?></div></a>
						<div class="product_size">Размер: <strong>XS</strong></div>
					</div>
	                <div class="col-3">
                          <p><?=$registered_cart_product["product_price"]?> руб</p>
	                </div>
	                <div class="col-2"><button type="submit" name="delete_from_cart" value="<?=$registered_cart_product["product_id"]?>"></button></div>
				</div>


				<?php endforeach; ?>


	</div>
				<div class="row">
				<div class="col-7">
					<div class="wrapper">
					<p>Общая стоимость:</p>
					<p><?php if  (!isset($_SESSION['user'])) {$count_cart_products_array[0];} 
					else {echo $count_cart_products_arrayR[0] ;}?> руб.</p>	
					</div>
				</div>
				<div class="col-5"><button >Оформить заказ</button></div>
			</div>
				<?php else: ?>
		<h4 style="position: absolute;left:40%;top:100px;">Нет товаров!</h4>
			<?php endif; ?>
</form>
				<?php endif; ?>  <!-- SESSION USER ENDIF-->



<div class="pages">
<ul>
		
<?php pagination_cart($cart_count_of_page,$cart_page);	 ?>
	</ul>	
		
	</div>
	</div><!---Products-->
	
   </div> <!---Content---->

	</div>


<?php  include "../includes/footer.php"?>




</body>
</html>
