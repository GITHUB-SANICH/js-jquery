<!--Наследование кода из шаблона main-->
@extends('layout\main')

<!--тайтл-->
@section('page-title')
	Редактирование товара
@endsection

<!--контент-->
@section('content')  
<h1>Редактирование товара</h1>
<a href="/" class="back-button">На главную</a>
	<!--Форма-->
	{!! Form::open(['class' => 'article-form', 'method' => 'PUT']) !!}
		{{Form::label('title', 'Название товара')}}
		{{Form::text('title', $shop->title, ['placeholder' => 'Введите название товара', 'type' => 'text'])}}

		{{Form::label('description', 'Описание товара')}}
		{{Form::textarea('description', $shop->anons, ['placeholder' => 'Опишите товар', 'id' => 'editor'])}}

		{{Form::label('category', 'Категория товара')}}
		{{Form::text('category', $shop->category, ['placeholder' => 'Введите категорию товара'])}}

		{{Form::label('price', 'Цена товара')}}
		{{Form::text('price', $shop->price, ['placeholder' => 'Введите стоимость товара (руб.)'])}}

		{{Form::submit('Изменить товар', ['class' => 'add-button'])}}
		<!--Ссылка на библиотеку для редактирования полей-->
		<script src="https://cdn.ckeditor.com/ckeditor5/34.1.0/classic/ckeditor.js"></script>
		<!--Окно редактирования поля-->
		<script>
			ClassicEditor .create( document.querySelector( '#editor' ));
 		</script>
	{!! Form::close() !!}

@endsection



