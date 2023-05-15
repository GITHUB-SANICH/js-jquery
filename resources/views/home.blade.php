@extends('layout.main')

@section('content')
<div class="block">
	<h1>Кабинет пользователя</h1>
	@if (session('status'))
		<div class="success-mess">
				{{ session('status') }}
		</div>
	@endif
<p>Привет, {{ Auth::user()->name }}</p>
<p>{{ Auth::user()->email }}</p>
</div>

<!--условие вывода статей - если у пользователя есть статьи-->
@if (count($articles) > 0)
<div class="articles">
	@foreach ($articles as $el)
		<div class="post">
			<img src="/storage/img/articles/{{$el->image}}" alt="">
			<h2>{{ $el->title }}</h2>
			<p>{{ $el->anons }}</p>
			<p><b>Автор: </b> {{ $el->user->name }} </p>
			<a href="/articles/{{ $el->id }}">Прочитать</a>
		</div>
	@endforeach
</div>
@endif
@endsection
