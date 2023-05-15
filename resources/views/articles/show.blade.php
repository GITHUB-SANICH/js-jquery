<!--Наследование кода из шаблона main-->
@extends('layout\main')

<!--тайтл-->
@section('page-title')
	{{$data['article']->title}}
@endsection

<!--контент-->
@section('content')  
<h1>{{$data['article']->title}} / Статья на Blog Spot</h1>
<a href="/" class="back-button">На главную</a>
	<div class="articles one">
			<div class="post">
				<img src="/storage/img/articles/{{$data['article']->image}}" alt="">
				<h2>{{ $data['article']->title }}</h2>
				<p>{{ $data['article']->anons }}</p>
				<p>{!! $data['article']->text !!}</p>
				<p><b>Автор: </b> {{ $data['article']->user->name }} </p>
				@auth
				@if(Auth::user()->id == $data['article']->user_id)
					<br><hr><br>
					<a href="/article/{{$data['article']->id}}/edit">Редактровать статью</a>
					{!! Form::open(['method' => 'DELETE', 'action' => ['ArticlesController@destroy', $data['article']->id]]) !!}
						{{ Form::submit('Удалить', ['class' => 'delete-button']) }}
					{!! Form::close() !!}
				@endif
			@endauth
			</div>
	</div>

		{{--{{dd($article)}}--}}
		{{--@if (count($article->comment) > 0)
		<h1>Комментарии</h1>	
		<div class="articles">
			@foreach ($article->comment as $el)
				<div class="post">
					<p><h4>Комментатор:</h4> {{ $el->avtor_comment_id}} </p>
					<p><h4>Текст комментария:</h4> {!! $el->text !!}</p>
				</div> 
			@endforeach
		</div>
		@endif--}}
		
		{{-- Вывод комментариев --}}
		@if(count($data['comments']) > 0)
		<h1>Комментарии</h1>
		<div class="articles">
			@foreach($data['comments'] as $comm)
				<div class="post">
					<p><h4>Комментатор:</h4> {{ $comm->avtor_komm->name }}</p>
					<p><h4>Комментарий:</h4> {!! $comm->text !!}</p>
				</div>
			@endforeach
		</div>
		@endif

		<!--Форма комментирования для авторизованных пользователй -->
		@auth
		<div class="post">
		<h1>Добавление комментария</h1>
		<!--Форма-->
			{!! Form::open(['class' => 'article-form']) !!}

				{{Form::label('text_comment', 'Комментарий')}}
				{{Form::textarea('text_comment', '', ['placeholder' => 'Напишите комментарий', 'id' => 'editor'])}}

				{{Form::submit('Комментировать', ['class' => 'add-button'])}}
				<!--Ссылка на библиотеку для редактирования полей-->
				<script src="https://cdn.ckeditor.com/ckeditor5/34.1.0/classic/ckeditor.js"></script>
				<!--Окно редактирования поля-->
				<script>
					ClassicEditor .create( document.querySelector( '#editor' ));
				</script>
			{!! Form::close() !!}
		</div>
		@endauth
		@endsection

