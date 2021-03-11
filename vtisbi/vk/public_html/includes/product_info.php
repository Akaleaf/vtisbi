<?php 
session_start();
require_once '../actions/DB_Query.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
<!--<meta name="viewport" content="width=device-width, initial-scale=1"/>-->
	
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
	
	<link rel="stylesheet" type="text/css" href="../css/style.css">
	<!--<link rel="stylesheet" type="text/css" href="../css/media.css">-->
	<link rel="stylesheet" type="text/css" href="../css/product_info.css">
	
	<title><?=$ProductArray["product_name"] ?> </title>
</head>
<body>

	<div class="main-screen">
<?php include "../includes/header.php" ?>

</div><!---main-screen -->

</div>
</div>



<div class="contentwrapper">
	<div class="breadcumb">
	<ul>
	   <li><a href="../index.php">Каталог</a></li>
<li><a href="../index.php?category_id=<?=$ProductCategoryArray["category_id"] ?>"> <?=$ProductCategoryArray["category_name"] ?> </a></li>
	   <li><a class="disabled_" href=""><?=$ProductArray["product_name"] ?> </a></li>
	</ul>
	</div>
<div class="content ">
	  <?php include "../includes/menu.php" ?>
	  
	  <div class="wrap">

	  	<form action="../actions/Add_to_cart.php" method="POST" accept-charset="utf-8">
<input type="hidden" name="product_id" value="<?=$product_id?>">
	  		
	  <div class="product_wrapper ">
		<div class="product_image_box">
		
			<?php   $show_img = base64_encode($ProductArray["product_image"]);                      
                if ($show_img) { ?> <img src="data:image/jpeg;base64,<?=$show_img ?>" alt="" class="image_box" > <?php } else {?>
                <img src="../includes/img/default_image.jpg" alt="Нет картинки" class="image_box" > <?php };?>
			<div class="product_price_"><?=$ProductArray["product_price"]?> руб</div>
		</div>
		<div class="description_box">
			<p ><?=$ProductArray["product_name"] ?></p>	
			<p>Размеры</p>
			<ul> 
	
		          <?php foreach( $ProductSizeArray as $ProductSize): ?>
				       <li ><?=$ProductSize["product_size"]?></li>
			      <?php endforeach; ?>
			   
		  </ul>
		 <!-- <div class="Items">
		  	<?php foreach( $ProductSizeArray as $ProductSize): ?>
				     <div class="ListItem"><?=$ProductSize["product_size"]?></div>  
			      <?php endforeach; ?>

		  </div>-->
		  <p>В наличии: <?=$ProductArray["Amount_of_product"] ?></p>
		  <p>Описание:</p>
		  <p><?=$ProductArray["product_desc"] ?></p>
<input type="submit" value="Добавить в корзину" name="addToCart">
</form>
		</div>
		<p>Смотрите также:</p>

	</div><!---Products-->
		</form>
	<div class="row">
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
   </div> <!---Content---->

	</div>


<?php  include "../includes/footer.php"?>



	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>	
<script src="../js/scripts.js" type="text/javascript" charset="utf-8" async defer></script>
</body>
</html>
