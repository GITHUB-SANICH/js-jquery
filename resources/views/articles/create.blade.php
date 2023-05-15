<!--Наследование кода из шаблона main-->
@extends('layout\main')

<!--тайтл-->
@section('page-title')
	Добавление статьи
@endsection

<!--контент-->
@section('content')  
<h1>Добавление статьи</h1>
<a href="/" class="back-button">На главную</a>
	<!--Форма-->
	{!! Form::open(['class' => 'article-form', 'enctype' => 'multipart/form-data']) !!}
		{{Form::label('title', 'Название статьи')}}
		{{Form::text('title', '', ['placeholder' => 'Введите название статьи', 'type' => 'text'])}}

		{{Form::label('anons', 'Название анонса')}}
		{{Form::textarea('anons', '', ['placeholder' => 'Введите название анонса'])}}

		{{Form::label('main_image', 'Фото статьи')}}
		{{Form::file('main_image')}}

		{{Form::label('text', 'Текст статьи')}}
		{{Form::textarea('text', '', ['placeholder' => 'Введите текст статьи', 'id' => 'editor'])}}

		{{Form::submit('Добавить статью', ['class' => 'add-button'])}}
		<!--Ссылка на библиотеку для редактирования полей-->
		<script src="https://cdn.ckeditor.com/ckeditor5/34.1.0/classic/ckeditor.js"></script>
		<!--Окно редактирования поля-->
		<script>
			ClassicEditor .create( document.querySelector( '#editor' ));
 		</script>
	{!! Form::close() !!}

@endsection



