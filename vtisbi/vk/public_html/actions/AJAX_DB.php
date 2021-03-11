<?php 
require 'DB_Query.php';

 $product_size = ($_POST['ListItemText']);
 $product_nameText = ($_POST['ProductNameText']);



$ProductSize = mysqli_query($connect,"SELECT `Amount_of_product` FROM `product` WHERE `product_name` = '$product_nameText'  AND 
	`product_size` = '$product_size' GROUP BY `product_size` ");
$ProductSizeArray = mysqli_fetch_assoc($ProductSize);
echo 'В наличии: '.$ProductSizeArray["Amount_of_product"];


 
 $connect->close();    
 ?>