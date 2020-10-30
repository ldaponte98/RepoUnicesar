<!DOCTYPE html>
<html>
<head>
	<title>{{ $titulo }}</title>
	<style type="text/css">
		*{
			font-family: Impact, Charcoal, sans-serif;
		}
		.container{
			padding: 50px;
		}
	</style>
</head>
<body>
	<div class="container">
		<center>
			<h1><b>{{ strtoupper($titulo) }}</b></h1>
			<img height="500" src="{{ asset('Imagenes/not-found.gif') }}">
			<h3>@php
				echo $mensaje;
			@endphp</h3>
		</center>
	</div>
</body>
</html>