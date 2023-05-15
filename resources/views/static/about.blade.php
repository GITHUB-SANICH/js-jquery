<!--Наследование кода из шаблона main-->
@extends('layout\main')
<!--тайтл-->
@section('page-title')
<!--При псевдоимени достаточно было бы указать $header При массиве же достаточно указать ключ передаваемых данных-->
{{ $title }}
@endsection
@section('content')
<div class="block">
	<h1>О нас</h1>
	@if(count($params) > 0)
		<p>У нас больше чем 0 эллементов:</p>
		<ul>
			@foreach($params as $el)
				<li>{{ $el }}</li>
			@endforeach
		</ul>
		@else
			<p>Передаваемый массив пуст</p>
	@endif
</div>
@endsection

