@extends('layout.main')

<!--тайтл-->
@section('page-title')
	Регистрация
@endsection

@section('content')
<h1>Регистрация</h1>
<a href="/" class="back-button">На главную</a>
	<form method="POST" action="/register" class="article-form">
		@csrf

		<label for="name">Имя</label>
			<input id="name" type="text" name="name" value="{{ old('name') }}" placeholder="Введите имя">Имя</input>

		<label for="email">Email</label>
			<input id="email" type="email" name="email" value="{{ old('email') }}" placeholder="Введите Email"></input>

		<label for="password">Пароль</label>
			<input id="password" type="password" name="password" value="{{ old('password') }}" placeholder="Введите пароль"></input>

		<label for="password_confirm">Подтверждение пароля</label>
			<input id="password_confirm" type="password" name="password_confirmation" value="{{ old('password_confirmation') }}" placeholder="Введите пароль еще раз"></input>

		<input type="submit" value="Зарегистрироваться" style="width: 175px;"></input>
	</form>
@endsection
