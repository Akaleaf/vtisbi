<?php
 
	require_once __DIR__ . '/../actions/connect/connect.php';
   
	?>

<!DOCTYPE html>
<html >

<body>
	<div class="menu-wrapper">
	<div class="search">
		<form  method="get" action="../index.php" accept-charset="utf-8">
			<input type="text" placeholder="Поиск" name="search_text">
		    <input type="submit" value="" name="submit">
		</form>
		
	</div>

	<div class="menu ">




<?php  

	$CategoryResult = mysqli_query($connect,"SELECT * FROM `category`" );
	$category = mysqli_fetch_all($CategoryResult,MYSQLI_ASSOC); 

	
			 ?>
	
		<p>Категории</p>
		<ul>

			<?php foreach ($category as $categories): ?>
<li><a href="/index.php?category_id=<?=$categories["category_id"]?>"> <?=$categories["category_name"]?></a></li>

			<?php endforeach; ?>
             
			 <?php if (isset($_SESSION['user'])) : ?>
			<li><a class="exit" href="../actions/validation/sign-out.php">Выход </a></li>
		    <?php endif; ?>
			<!--<li>
				<a href="">Шапки</a>
			</li>
			<li>
				<a href="">Худи</a>
			</li>
			<li>
				<a href="">Свитшот</a>
			</li>
			<li>
				<a href="">Футболки</a>
			</li>
			<li>
				<a href="">Бейсболки</a>
			</li>
			<li>
				<a href="">Маски</a>
			</li>
			<li>
				<a href="">Бомберы</a>
			</li>
			<li>
				<a href="">Рюкзаки</a>
			</li>-->
		</ul>
	</div> <!---Menu---->
	</div>
</body>
</html>
