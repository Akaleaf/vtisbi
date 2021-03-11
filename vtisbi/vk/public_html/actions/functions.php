<?php
require_once 'connect/connect.php';

$limit = 3; 
$FirstProductQuery = mysqli_query($connect," SELECT `product_id` FROM `product` ");
$FirstProductArray = mysqli_fetch_assoc($FirstProductQuery);

$FirstCategoryResult = mysqli_query($connect,"SELECT * FROM `category`" );
	$FirstCategory = mysqli_fetch_assoc($FirstCategoryResult);	
	if (!isset($_GET['category_id']))  $category_id = $FirstCategory["category_id"] ; else  $category_id = htmlspecialchars($_GET['category_id']) ;
	if (ctype_digit($category_id) === false) $category_id = $FirstCategory["category_id"];

   $category_count_query = mysqli_query($connect,"SELECT `category_id` FROM `category` WHERE `category_id`= '$category_id'");
   $category_count_array = mysqli_fetch_all($category_count_query);
   if (empty($category_count_array))  $category_id = $FirstCategory["category_id"]  ; 

if (!isset($_GET['product_id'])) $product_id = $FirstProductArray["product_id"]; else $product_id = $_GET['product_id'];
if (ctype_digit($product_id) === false) $product_id = $FirstProductArray["product_id"];

 $product_count_query = mysqli_query($connect,"SELECT `product_id` FROM `product` WHERE `product_id`='$product_id'");
  $product_count_array = mysqli_fetch_all($product_count_query);
  if (empty($product_count_array))  $product_id = $FirstProductArray["product_id"]; 

$ProductCategoryQuery = mysqli_query($connect," SELECT * FROM `category`  WHERE `category_id` = '$category_id'");
$ProductCategoryArray = mysqli_fetch_assoc($ProductCategoryQuery);

$Product = mysqli_query($connect," SELECT * FROM `product` WHERE `product_id` = '$product_id' ");
$ProductArray = mysqli_fetch_assoc($Product);



$ProductSeeAlso = mysqli_query($connect," SELECT * FROM `product` ORDER BY RAND() LIMIT $limit  ");
$ProductArraySeeAlso = mysqli_fetch_all($ProductSeeAlso,MYSQLI_ASSOC);

//Size of prodct 
  $product_name =$ProductArray["product_name"];
  $ProductSize = mysqli_query($connect," SELECT `product_size` FROM `product` WHERE `product_name` = '$product_name' GROUP BY 
		     	`product_size` ");
  $ProductSizeArray = mysqli_fetch_all($ProductSize,MYSQLI_ASSOC);

 ?>