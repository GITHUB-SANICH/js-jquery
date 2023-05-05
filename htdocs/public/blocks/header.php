<header>
	 <!-- Bootstrap CSS -->
	 <!--<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">-->
    <!-- font-awesome -->
    <!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">-->
		<!-- Секция первая -->
		<div class="container middle">
			<!-- лого -->
			<div class="logo">
				<img src="/public/img/logo_kot_crazy.svg" alt="logo">
				<span>Уберем все лишнее из ссылки!</span>
			</div>	
			<!-- кнопки авторизации -->
			<div class="heder-menu">
				<a href="/">Главная</a>
				<a href="/contact">Контакты</a>
				<a href="/contact/about">Про нас</a>


				<!-- если куки не нулевое -->
				<?php if($_COOKIE['login'] == ''): ?>
				<a href="/user/auth">
					Войти
				</a>
				<a href="/user/reg">
					Регистрация
				</a>
				<!-- если пользователь авторизован -->
				<?php else: ?>
					<a href="/user/dashboard">
						<button class="btn dashboard">Кабинет пользователя</button>
					</a>
				<?php endif; ?>

			</div>
		</div>
	</header>