<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title>@yield('title')</title>
	<link href="/css/app.css" rel="stylesheet">
	{{-- Tailwindcss --}}
	<script src="https://cdn.tailwindcss.com"></script>
	<style type="text/tailwindcss">
		@layer utilities {
		  .content-auto {
			 content-visibility: auto;
		  }
		}
	 </style>
	 {{-- endTailwindcss --}}
</head>
</head>
<body>
	@yield('content')
	
	<script src="/js/app.js"></script>
</body>
</html>