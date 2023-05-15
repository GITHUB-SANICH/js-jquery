<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<!-- CSRF Token -->
	<meta name="csrf-token" content="{{ csrf_token() }}">
	
	<link rel="stylesheet" href="{{ asset('css\app_dz.css') }}"</link>
	<!--<link rel="stylesheet" href="{{ asset('css\app.css') }}"</link>-->

	<!-- Scripts -->
	<script src="{{ asset('js/app.js') }}" defer></script>
	
	<title>@yield('page-title')</title>

</head>
<body>
	<header class="container">
		<span class="logo">itProger</span>
		<nav>
			<a href="/">Главная</a>
			<a href="/public/shop">Товары</a>
			<a href="/blog">Блог</a>
			<a href="/about-us">Про нас</a>
			<!--<a href="/button" class="button">Войти</a>-->

			<!-- Authentication Links -->
		@guest
			<a href="/register">Регистрация</a>
			<a href="/login" class="button">Войти</a>
		@else
		<a href="/article/add">Добавление статьи</a>
		<a href="/user">{{ Auth::user()->name }}</a>
		<!--Кнопка выхода из учетнйо записи-->	
		<form id="logout-form" action="/logout" method="POST">
			@csrf
			<button type="submit">Выйти</button>
		</form>
		@endguest

		</nav>
	</header>
	<main class="container">
		<!--Блок с оповещением добавления статьи-->
		@include('error_block.messages')
		@yield('content')
	</main>
	<footer>
		Все права защищены
	</footer>
</body>
</html>