<?php session_start();?>
<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Регистрация</title>
	<!-- Тег индексации страницы -->
	<meta name="description" content="Регистрация">
	<!-- Подулючение стилий -->
	<link rel="stylesheet" href="/public/css/main.css" charset="utf-8">
	<link rel="stylesheet" href="/public/css/form.css" charset="utf-8">
	<script src="https://kit.fontawesome.com/ce25d284a3.js" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
</head> 
<body>
	<!-- хедер -->
	<?php require 'public/blocks/header.php'?>	
	
	<!-- основная часть -->
	<div class="container main">
		<!-- список популярных товаров -->
		<h1>Регистрация</h1>
		<p>В этой форме вы можете зерегистрироваться</p>
		<form action="/user/reg" method="POST" class="form-control">
			<input type="text" name="name" placeholder="Введите имя" value="<?=$_POST['name']?>"><br>
			<input type="email" name="email" placeholder="Введите email" value="<?=$_POST['email']?>"><br>
			<input type="password" name="pass" placeholder="Введите пароль" value="<?=$_POST['pass']?>"><br>
			<input type="password" name="re_pass" placeholder="Повторите пароль" value="<?=$_POST['re_pass']?>"><br>
			<!-- блок с выводом ошибок -->
			<div class="error"><?=$data['message']?></div>
			<!-- кнопка отправки формы -->
			<button class="btn" id="send">Отправить</button>
		</form>
	</div>

	<!-- подвал -->
	<?php require 'public/blocks/footer.php'?>
</body>
</html>