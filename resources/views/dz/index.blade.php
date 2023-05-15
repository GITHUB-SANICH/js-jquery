<!--Наследование кода из шаблона main-->
@extends('layout\main')

<!--тайтл-->
@section('page-title')
	Список товаров
@endsection

<!--контент-->
@section('content')
<a href="/" class="back-button">На главную</a>
<a href="/public/shop/add" class="back-button">Добавление товара</a>
	<div class="articles">
		@foreach ($shop as $el)
			<div class="post">
				<h2>{{ $el->title }}</h2>
				<p><b>Описание товара:</b> {!! $el->anons !!}</p>
				<p><b>Категория товара:</b> {{ $el->category }}</p>
				<p><b>Стоимость товара:</b> {{ $el->price }} руб.</p>
				<a href="/public/shop/{{ $el->id }}">Детальнее</a>
			</div>
		@endforeach
	</div>
@endsection

