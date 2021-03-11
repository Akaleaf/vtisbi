<?php 
error_reporting(0);
session_start();
require_once 'connect/connect.php';

$limit = 4; 

if((int)$cart_page > $count_of_page)  $cart_page = 1;

if ((isset($_POST["product_id"])) && (isset($_POST["addToCart"]))) $cart_product_id = $_POST["product_id"]; else $cart_product_id = 0;

if (!isset($_SESSION['user'])) :
	if (isset($_POST["accept_order"])) header("Location:../../../includes/sign-in-up.php");

	if (!isset($_GET['cart_page']))  $cart_page = 1 ; else  $cart_page = htmlspecialchars($_GET['cart_page']) ;
   if (ctype_digit($cart_page) === false) $cart_page = 1;
$array_in_query = implode(',',$_SESSION["cart_products_array"]);

	$cart_count_query = mysqli_query($connect,"SELECT count(*) FROM `product`  WHERE `product_id` IN ($array_in_query) ");
   $cart_count_array = mysqli_fetch_array($cart_count_query,MYSQLI_NUM);
   $count_of_cart_product = $cart_count_array[0];
   $cart_product_limit = 4; 
   $start = ($cart_page*$cart_product_limit) - $cart_product_limit;
   $cart_count_of_page = ceil($count_of_cart_product / $cart_product_limit);


$_SESSION['cart_products_array'][] = $cart_product_id;
$session_array = $_SESSION["cart_products_array"];

foreach($_SESSION['cart_products_array'] as $key => $item){
    if ($item == 0){
      unset($_SESSION['cart_products_array'][$key]);
    }
}

$array_in_query = implode(',',$_SESSION["cart_products_array"]);

$cart_products = mysqli_query($connect,"SELECT * FROM `product` WHERE `product_id` IN ($array_in_query) LIMIT $cart_product_limit OFFSET $start");
$cart_products_array = mysqli_fetch_all($cart_products,MYSQLI_ASSOC);

$count_cart_products = mysqli_query($connect,"SELECT SUM(`product_price`) FROM `product` WHERE `product_id` IN ($array_in_query) ");
$count_cart_products_array = mysqli_fetch_array($count_cart_products);



if (isset($_POST["delete_from_cart"])):
	$delete_product_id = trim($_POST["delete_from_cart"]);
	foreach($_SESSION['cart_products_array'] as $key => $item){
    if ($item == $delete_product_id){
      unset($_SESSION['cart_products_array'][$key]);
      header("Location:../../../includes/cart.php");
    }
}

endif;

else :

	if (!isset($_GET['cart_page']))  $cart_page = 1 ; else  $cart_page = htmlspecialchars($_GET['cart_page']) ;
   if (ctype_digit($cart_page) === false) $cart_page = 1;

$id_user = $_SESSION['user']["user_id"];
$session_array = $_SESSION["cart_products_array"];



if (!empty($_SESSION["cart_products_array"])  ) : 
		for ($i = 0; $i <  count($_SESSION["cart_products_array"]); $i++) {
			
			$count =count($_SESSION["cart_products_array"]);
		
			$id_product =  $_SESSION["cart_products_array"][$i];
			$product_to_sale1 = mysqli_query($connect,"SELECT `id_product` FROM `product_to_sale` WHERE `id_user` = '$id_user'");
			$array = mysqli_fetch_all($product_to_sale1);
			$count_query = mysqli_query($connect,"SELECT count(*) FROM `product_to_sale` WHERE `id_user` = '$id_user'");
			$count_query_array = mysqli_fetch_all($count_query);
		
		

	$check_product=mysqli_query($connect,"SELECT * FROM `product_to_sale` WHERE `id_user` = '$id_user' and `id_product` = '$id_product'");

   if (mysqli_num_rows($check_product) >= 1 )
   {} else 
	{ $insertFromArrayQuery = mysqli_query($connect,"INSERT INTO `product_to_sale`  (`id_product`, `id_user`)  
	VALUES ('$id_product','$id_user')");  }
					
				
	} //end for
endif;
$check_product2 = mysqli_query($connect,"SELECT * FROM `product_to_sale` WHERE `id_user` = '$id_user' and `id_product` = '$cart_product_id'");
if ((isset($_POST["product_id"])) && (isset($_POST["addToCart"]))) {

   if (mysqli_num_rows($check_product2) >= 1 )
   {} else 
	{  $insert = mysqli_query($connect,"INSERT INTO `product_to_sale`  (`id_product`, `id_user`)  
	VALUES ('$cart_product_id','$id_user')");  }
}

if (isset($_POST["delete_from_cart"])):
	$delete_product_id = trim($_POST["delete_from_cart"]);
	$id_user = $_SESSION['user']["user_id"];
	$delete_query = mysqli_query($connect,"DELETE FROM `product_to_sale` WHERE `id_user` = '$id_user' AND `id_product` = '$delete_product_id' ");
     header("Location:../../../includes/cart.php");

endif;

$product_to_sale = mysqli_query($connect,"SELECT `id_product` FROM `product_to_sale` WHERE `id_user` = '$id_user'");
while ($row  = mysqli_fetch_array($product_to_sale) ) {
     $id_productsArray[] = $row["id_product"];
}

	
$array_in_queryR = implode(',',$id_productsArray);

 $cart_count_query = mysqli_query($connect,"SELECT count(*) FROM `product`  WHERE `product_id` IN ($array_in_queryR) ");
   $cart_count_array = mysqli_fetch_array($cart_count_query,MYSQLI_NUM);
   $count_of_cart_product = $cart_count_array[0];
   $cart_product_limit = 4; 
   $start = ($cart_page*$cart_product_limit) - $cart_product_limit;
   $cart_count_of_page = ceil($count_of_cart_product / $cart_product_limit);

  




$Registred_Cart_products = mysqli_query($connect,"SELECT * FROM `product` WHERE `product_id` IN ($array_in_queryR) LIMIT $cart_product_limit OFFSET $start");
$Registred_cart_products_array = mysqli_fetch_all($Registred_Cart_products,MYSQLI_ASSOC);

$count_cart_productsR = mysqli_query($connect,"SELECT SUM(`product_price`) FROM `product` WHERE `product_id` IN ($array_in_queryR) ");
$count_cart_products_arrayR = mysqli_fetch_array($count_cart_productsR);

unset($_SESSION["cart_products_array"]);
endif;//SESSION USER

function pagination_cart($cart_count_of_page,$cart_page) {
if ($cart_count_of_page > 1 && $cart_count_of_page < 5) foreach (range(1,$cart_count_of_page) as $p) echo '<li><a href="cart.php?cart_page='.$p.'"> '.$p.' </a></li>' ; 
if ($cart_count_of_page > 4 && $cart_page < 5) foreach (range(1,5) as $p) echo '<li><a href="cart.php?cart_page='.$p.'"> '.$p.' </a></li>' ; 
if ($cart_count_of_page - 5 < 5 && $cart_page > 5 && $cart_count_of_page - 5 > 0) foreach (range($cart_count_of_page - 4,$cart_count_of_page) as $p) echo '<li><a href="cart.php?cart_page='.$p.'"> '.$p.' </a></li>' ; 
if ($cart_count_of_page > 4 && $cart_count_of_page - 5 < 5 && $cart_page == 5) foreach (range($cart_page - 2,$cart_count_of_page) as $p) echo '<li><a href="cart.php?cart_page='.$p.'"> '.$p.' </a></li>' ; 
if ($cart_count_of_page > 4 && $cart_count_of_page - 5 > 5 && $cart_page >= 5 && $cart_page <= $countcart_count_of_page_of_page - 4) foreach (range($cart_page - 2,$cart_page + 2) as $p) echo '<li><a href="cart.php?cart_page='.$p.'"> '.$p.' </a></li>' ; 
if ($cart_count_of_page > 4 && $cart_count_of_page - 5 > 5 && $cart_page > $cart_count_of_page - 4) foreach (range($cart_count_of_page - 4,$cart_count_of_page) as $p) echo '<li><a href="cart.php?cart_page='.$p.'"> '.$p.' </a></li>' ; 
	} 



if (isset($_POST["addToCart"])) header("Location:../../../includes/cart.php");

 ?>
 