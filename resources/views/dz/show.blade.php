<!--Наследование кода из шаблона main-->
@extends('layout\main')

<!--тайтл-->
@section('page-title')
	{{$shop->title}}
@endsection

<!--контент-->
@section('content')  
<h1>{{$shop->title}} / Товар магазина</h1>
<a href="/" class="back-button">На главную</a>
	<div class="articles one">
			<div class="post">
				<h2>{{ $shop->title }}</h2>
				<p>{!! $shop->anons !!}</p>
				<p>{!! $shop->category !!}</p>
				<p>{!! $shop->price !!} руб.</p>
				<br><hr>
				<a href="/public/shop/{{$shop->id}}/edit">Редактировать товара</a>
			{!! Form::open(['method' => 'DELETE', 'action' => ['ShopController@destroy', $shop->id]]) !!}
				{{ Form::submit('Удалить', ['class' => 'delete-button']) }}
			{!! Form::close() !!}
			</div>
	</div>
@endsection

