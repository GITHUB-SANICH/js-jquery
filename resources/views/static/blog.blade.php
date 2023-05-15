<!--Наследование кода из шаблона main-->
@extends('layout\main')
<!--тайтл-->
@section('page-title')

{{ $title }}

@endsection
@section('content')
<div class="block">
	
	@if(count($params) > 0)
		<p>У нас больше чем 0 статей:</p>
			@foreach($params as $el )
			<div class="dz_stat">
				<div class="dz_stat_titile">{{ $el['title_str'] }}</div>
				<div class="dz_stat_text">{{ $el['text'] }}</div>
				<button class="dz_stat_btn btn btn-succes" type="submit">Детальнее</button>
			</div>
			@endforeach
		@else
			<p>Передаваемый массив пуст</p>
	@endif
	
</div>
@endsection

