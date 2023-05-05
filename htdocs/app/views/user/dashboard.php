<?php session_start();?>
<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Кабинет пользователя</title>
	<!-- Тег индексации страницы -->
	<meta name="description" content="Кабинет пользователя">
	<!-- Подулючение стилий -->
	<link rel="stylesheet" href="/public/css/main.css" charset="utf-8">
	<link rel="stylesheet" href="/public/css/user.css" charset="utf-8">
	<script src="https://kit.fontawesome.com/ce25d284a3.js" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
</head> 
<body>
	<!-- хедер -->
	<?php require 'public/blocks/header.php'?>	
	
	<!-- основная часть -->
	<div class="container main">
		<!-- список популярных товаров -->
		<h1>Кабинет пользователя</h1>
		<div class="user-info">
			<p>Добро пожаловать, <b><?=$data['user']['name']?></b></p>
			<!--Тип кодирования данных, enctype, ДОЛЖЕН БЫТЬ указан ИМЕННО так-->
			<form enctype="multipart/form-data" action="/user/dashboard" class="" method="POST">
				<!-- Поле MAX_FILE_SIZE должно быть указано до поля загрузки файла 4000 байт => 500 килобайт-->
				<input type="hidden" name="MAX_FILE_SIZE" value="512000" />
				<!-- Название элемента input определяет имя в массиве $_FILES -->
				Отправить этот файл: <input class="addFile" name="userImg" type="file" />
				<!-- Блок с изображением -->
				<div style="width: 550px;"><img style="width: 100%; margin: 15px 0px;" src="/public/img/imgUsers/<?=$data['user']['image']?>" alt=""></div>
				<!-- блок с выводом ошибок -->
				<div class="error"><?=$data['message']?></div>
				<button type="submit" class="btn" style="display: block;">Загрузить</button>
			</form>
				<form action="/user/dashboard" method="post">
					<!-- скрытый инпут -->
					<input type="hidden" name="exit_btn">
					<button class="btn info">Выйти</button>
				</form>
		</div>
	</div>

	<!-- подвал -->
	<?php require 'public/blocks/footer.php'?>
</body>
</html>