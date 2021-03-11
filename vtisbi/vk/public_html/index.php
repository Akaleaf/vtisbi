<?php
    session_start(); 
	require_once  'actions/connect/connect.php';
	require_once 'actions/validation/search.php';
   if (!isset($_GET['page']))  $page = 1 ; else  $page = htmlspecialchars($_GET['page']) ;
   if (ctype_digit($page) === false) $page = 1;

   $FirstCategoryResult = mysqli_query($connect,"SELECT * FROM `category`" );
	$FirstCategory = mysqli_fetch_assoc($FirstCategoryResult);	
	if (!isset($_GET['category_id']))  $category_id = $FirstCategory["category_id"] ; else  $category_id = htmlspecialchars($_GET['category_id']) ;
	if (ctype_digit($category_id) === false) $category_id = $FirstCategory["category_id"];

   $category_count_query = mysqli_query($connect,"SELECT `category_id` FROM `category` WHERE `category_id`= $category_id");
   $category_count_array = mysqli_fetch_all($category_count_query);
   if (empty($category_count_array))  $category_id = $FirstCategory["category_id"]  ; 
  
   $product_count_query = mysqli_query($connect,"SELECT COUNT(DISTINCT `product_name`)  FROM `product`  WHERE `category_id`= $category_id");
   $product_count_array = mysqli_fetch_array($product_count_query,MYSQLI_NUM);
   $count_of_product = $product_count_array[0];
   $product_limit = 9; 
   $start = ($page*$product_limit) - $product_limit;
   $count_of_page = ceil($count_of_product / $product_limit);
   

if((int)$page > $count_of_page)  $start = 0 ; 
	$ProductResult = mysqli_query($connect," SELECT * FROM `product` WHERE `category_id`= $category_id GROUP BY `product_name` LIMIT $product_limit OFFSET $start"  );
	$products = mysqli_fetch_all($ProductResult,MYSQLI_ASSOC);

	function pagination_product($count_of_page,$page,$category_id) {
if ($count_of_page > 1 && $count_of_page < 5) foreach (range(1,$count_of_page) as $p) echo '<li><a href="index.php?category_id='.$category_id.'&page='.$p.'"> '.$p.' </a></li>' ; 
if ($count_of_page > 4 && $page < 5) foreach (range(1,5) as $p) echo '<li><a href="index.php?category_id='.$category_id.'&page='.$p.'"> '.$p.' </a></li>' ; 
if ($count_of_page - 5 < 5 && $page > 5 && $count_of_page - 5 > 0) foreach (range($count_of_page - 4,$count_of_page) as $p) echo '<li><a href="index.php?category_id='.$category_id.'&page='.$p.'"> '.$p.' </a></li>' ; 
if ($count_of_page > 4 && $count_of_page - 5 < 5 && $page == 5) foreach (range($page - 2,$count_of_page) as $p) echo '<li><a href="index.php?category_id='.$category_id.'&page='.$p.'"> '.$p.' </a></li>' ; 
if ($count_of_page > 4 && $count_of_page - 5 > 5 && $page >= 5 && $page <= $count_of_page - 4) foreach (range($page - 2,$page + 2) as $p) echo '<li><a href="index.php?category_id='.$category_id.'&page='.$p.'"> '.$p.' </a></li>' ; 
if ($count_of_page > 4 && $count_of_page - 5 > 5 && $page > $count_of_page - 4) foreach (range($pcount_of_page - 4,$count_of_page) as $p) echo '<li><a href="index.php?category_id='.$category_id.'&page='.$p.'"> '.$p.' </a></li>' ; 
	} 
 ?> 
 

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
<!--<meta name="viewport" content="width=device-width, initial-scale=1"/>-->
	
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<!--<link rel="stylesheet" type="text/css" href="css/media.css">-->
	 <link rel="shortcut icon" href="includes/img/tisbi-icon.jpg" type="image/png">
	<title>Магазин Мерча "Тисби"</title>
</head>
<body>

	<div class="main-screen">
   <?php include "includes/header.php" ?>
		</div>


		<div class="carouselWrapper container">

	<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
  <ol class="carousel-indicators">
    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
   
  </ol>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="includes/img/carousel1.png" class="d-block w-100" alt="...">
    </div>
    <div class="carousel-item">
      <img src="includes/img/carousel2.png" class="d-block w-100" alt="...">
    </div>
     <div class="carousel-item">
      <img src="includes/img/carousel3.jpg" class="d-block w-100" alt="...">
    </div>
    
  </div>
  <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
	</div> <!---carouselWrapper -->

</div>

</div><!---main-screen -->


<div class="contentwrapper">
<div class="content ">
	  <?php include "includes/menu.php" ?>
	
	<div class="products ">

<div class="row">
	
	<?php if(isset($_GET['submit']))  : ?>
	<?php 
    $search_text = trim($_GET['search_text']);
	//$SearchProductResult = mysqli_query($connect," SELECT * FROM `product` WHERE `product_name`='$search_text'" );
	$SearchProductResult = mysqli_query($connect," SELECT * FROM `product` WHERE `product_name` LIKE '%$search_text%'" );
	$SearchProducts = mysqli_fetch_all($SearchProductResult,MYSQLI_ASSOC);
	 ?>
	 <?php if(empty($SearchProducts)) : ?>  
	 	<h4 style="position: absolute;left:20%;top:50px;">По запросу "<?php echo $search_text ?>" ничего не найдено! </h4>

    	<?php else : ?>
<?php foreach ($SearchProducts as $product) : ?>	
      <div class="col-4">
            <a href="includes/product_info.php?product_id=<?=$product["product_id"]?>&category_id=<?=$product["category_id"]?>">
            	<?php   $show_img = base64_encode($product["product_image"]);                      
                if ($show_img) { ?> <img src="data:image/jpeg;base64,<?=$show_img ?>" alt="" class="product_image" > <?php } else {?>
                <img src="includes/img/default_image.jpg" alt="Нет картинки" class="product_image" > <?php };?>
			
			<p class="product_name"><?=$product["product_name"]?></p>
			<div class="product_price"><?=$product["product_price"]?> руб</div>
			</a>
			</div>
	<?php endforeach;  ?>

     <?php endif; ?>


		<?php  else : ?>
    <?php if(empty($products)) : ?>  
  <h4 style="position: absolute;left:40%;top:50px;">Нет товаров!</h4>

    	<?php else : ?>
	<?php foreach ($products as $product): ?>	
		
      <div class="col-4">
        <a href="includes/product_info.php?product_id=<?=$product["product_id"]?>&category_id=<?=$product["category_id"]?>">
             <?php   $show_img = base64_encode($product["product_image"]);                      
            if ($show_img) { ?> <img src="data:image/jpeg;base64,<?=$show_img ?>" alt="" class="product_image" > <?php } else {?>
            <img src="includes/img/default_image.jpg" alt="Нет картинки" class="product_image" > <?php };?>
			  <p class="product_name"><?=$product["product_name"]?></p>
			 <div class="product_price"><?=$product["product_price"]?> руб</div>
		</a>
	  </div>
	
	<?php endforeach;  ?>
<?php endif ?>
<?php endif ?>
</div>
<div class="pages">
<ul>
		<?php 
		pagination_product($count_of_page,$page,$category_id);
	?>
			
	</ul>	
		
	</div>

	</div><!---Products-->
	
</div> <!---Content---->
</div>

<?php  include "includes/footer.php"?>


	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
	
<script src="js/scripts.js" type="text/javascript" charset="utf-8" async defer></script>
</body>
</html>