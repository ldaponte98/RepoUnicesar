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
		.img{
			width: 700px;
    		height: 700px;
		}

	</style>
</head>
<body>
	<div class="container">
		<center>
			<h1><b>{{ strtoupper($titulo) }}</b></h1>
			<h3>
			@php echo $mensaje @endphp</h3>
			<img class="img" src="{{ asset('Imagenes/not-found.gif') }}">
		</center>
	</div>
</body>
</html>