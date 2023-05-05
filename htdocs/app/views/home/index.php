<!DOCTYPE html>
<html lang="ru">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Главная страница</title>
	<!-- Тег индексации страницы -->
	<meta name="description" content="Главная страница интернета магазина">
	<!-- Подулючение стилий -->
	<link rel="stylesheet" href="/public/css/main.css" charset="utf-8">
	<link rel="stylesheet" href="/public/css/form.css" charset="utf-8">
	<script src="https://kit.fontawesome.com/ce25d284a3.js" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
</head>
<body>
	<!-- хедер -->
	<?php require 'public/blocks/header.php' ?>
	<div class="container main">
		<!-- форма авторизации -->
		<!-- если куки не нулевое -->
		<?php if ($_COOKIE['login'] == '') : ?>
			<div class="form-auth">
				<h1>Сокра.тим</h1>
				<h2>Вам нужно сократить ссылку? Прежде чем это сделать зарегистрируйтесь на сайте</h2>
				<form action="/home/" method="POST" class="form-control">
					<input type="text" name="name" placeholder="Введите имя" value="<?= $_POST['name'] ?>"><br>
					<input type="email" name="email" placeholder="Введите email" value="<?= $_POST['email'] ?>"><br>
					<input type="password" name="pass" placeholder="Введите пароль" value="<?= $_POST['pass'] ?>"><br>
					<input type="password" name="re_pass" placeholder="Повторите пароль" value="<?= $_POST['re_pass'] ?>"><br>
					<!-- блок с выводом ошибок -->
					<div class="error"><?= $data['message'] ?></div>
					<!-- кнопка отправки формы -->
					<button class="btn" id="send">Зарегестрироваться</button>
				</form>
				<h2>Есть аккаунт? Тогда можeте <a href="/user/auth">авторизоваться</a></h2>
			</div>
			<!-- если пользователь авторизован -->
		<?php else : ?>
			<div class="form-auth">
				<h1>Сокра.тим</h1>
				<h2>Вам нужно сократить ссылку? Сейчас мы это сделаем!</h2>
				<form action="/home/" method="POST" class="form-control">
					<input type="text" name="longLink" placeholder="Длинная ссылка" value="<?= $_POST['longLink'] ?>"><br>
					<input type="text" name="shortLink" placeholder="Короткое название" value="<?= $_POST['shortLink'] ?>"><br>

					<!-- блок с выводом ошибок -->
					<div class="error"><?= $data['message'] ?></div>
					<!-- кнопка отправки формы -->
					<button class="btn" id="send">Уменьшить</button>
				</form>
			</div>
		<?php endif; ?>
		<!-- Список сокращенных ссылок -->
		<?php if ($_COOKIE['login'] != '' && $data['links'] != null) : ?>
			<!-- вывод списка ссылок -->
			<div class="list_links">
				<h2>Сокращенные ссылки</h2>
				<?php foreach ($data['links'] as $links) : ?>
					<div class="shortLinkClass" id="<?= $links->short_link ?>" style="padding-bottom: 15px;">
						<p><b>Длинная:</b> <?= $links->long_link ?></p>
						<p><b>Короткая:</b> <a href="/short/<?= $links->short_link ?>"><?=/*$_SERVER['HTTP_HOST'].'/short/'.*/ $links->short_link ?></a></p>
						<button class="btn" id="delLink" onclick="deleteLink('<?= $links->short_link ?>')">Удалить ссылку <i class="fa fa-trash"></i></button>
					</div>
				<?php endforeach; ?>
				<!--скрытый блок с оповещением об ошибке + значение, передаваемое через Ajax-->
				<div id="errorMessage_del"></div>
				<div id="successMessage_del"></div>
			</div>
		<?php endif; ?>
		<!-- подвал -->
		<?php require 'public/blocks/footer.php' ?>
		<!-- Ajax подключение -->
		<?php require 'public/js/connect.php' ?>
		<!-- Ajax запрос -->
		<?php require 'public/js/ajax/deleteLink.php' ?>
	</div>
</body>

</html>