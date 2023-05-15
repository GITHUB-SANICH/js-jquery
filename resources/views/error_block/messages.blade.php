<!--Перебор ошибок в форме-->
@if(count($errors) > 0 )
	@foreach ($errors->all() as $el)
		<div class="error-mess">{{ $el }}</div>
	@endforeach
@endif

<!--Вывод сообщения об успешном добавлении статьи-->
@if (session('success'))
	<div class="success-mess">{{	session('success')	}}</div>
@endif

<!--Вывод сообщения об ошибке при добавлении статьи-->
@if (session('error'))
	<div class="error-mess">{{	session('error')	}}</div>
@endif