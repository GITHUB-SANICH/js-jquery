@extends('layout.main')

<!--тайтл-->
@section('page-title')
	Авторизация
@endsection

@section('content')
<h1>Авторизация</h1><br>
<a href="/" class="back-button">На главную</a><br>
      <form method="POST" action="/login" class="article-form">
      @csrf

		<label for="email">Email</label>
		<input id="email" type="email" name="email" value="{{ old('email') }}" placeholder="Введите Email"></input>

		<label for="password">Пароль</label>
		<input id="password" type="password" name="password" value="{{ old('password') }}" placeholder="Введите пароль"></input>
   
		<input type="checkbox" name="remember" id="remember" class="login-btn" {{ old('remember') ? 'checked' : ''}}></input>
		<label for="remember">
				Запомнить меня
		</label>

		<input type="submit" value="Авторизоваться" style="width: 175px;"></input>
@endsection
