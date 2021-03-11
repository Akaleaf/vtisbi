  <?php 
  require_once __DIR__ . '/../connect/connect.php';
  if(isset($_GET['submit'])) 
{
	$search_text = trim($_GET['search_text']);
	$SearchProductResult = mysqli_query($connect," SELECT * FROM `product` WHERE `product_name`='$search_text'" );
	$SearchProducts = mysqli_fetch_all($SearchProductResult,MYSQLI_ASSOC);
 #echo '<meta http-equiv="refresh" content="0;URL=/">';
 
}


?>