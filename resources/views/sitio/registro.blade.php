<!DOCTYPE html>
<html lang="en">
<head>
	<title>Repositorio-Unicesar</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" sizes="30x30" href="Imagenes/iconoupc.png">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="Login/vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="Login/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="Login/fonts/iconic/css/material-design-iconic-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="Login/vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="Login/vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="Login/vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="Login/vendor/select2/select2.min.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="Login/vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="Login/css/util.css">
	<link rel="stylesheet" type="text/css" href="Login/css/main.css">
	  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	     <style type="text/css">
	     	.errores{
            -webkit-boxshadow: 0 0 10px rgba(0, 0, 0, 0.3);
            -moz-box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
            -o-box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
            background: red;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
            color: #fff;
            display: none;
            font-size: 14px;
            margin-top: -40px;
            margin-left: 220px;
            padding: 6px;
            width: 150px;
            position: absolute;
            
        }
        .container-login100{
        	background: url('{{ asset('Imagenes/fondo.jpg') }}');
        	background-size: cover;
        }
        .errores2{
            -webkit-boxshadow: 0 0 10px rgba(0, 0, 0, 0.3);
            -moz-box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
            -o-box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
            background: red;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
            color: #fff;
            display:  none;
            font-size: 14px;
            margin-top: -90px;
            margin-left: -20px;
            padding: 6px;
            width: 190px;
            position: absolute;
           
        }
        .wrap-login100 {
		    width: 50%;
		}
	     </style>


<!--===============================================================================================-->
</head>
<body id="bd">
	
	<div class="limiter">
		
		<div class="container-login100">
			<div class="wrap-login100">
				@if ($errors->first('mensaje') != "")
						<div id="msg" class="alert alert-danger"><strong><?= $errors->first('mensaje')?></strong></div>
						<script>
							setTimeout(()=>{$("#msg").fadeOut()}, 8000)
						</script>
					@endif
				<div id="mensajeprincipal" class="errores2">Esta cuenta no existe</div>
			<form id="form-login" method="POST" action="{{route('validar_registro')}}">
					@csrf
					<input type="hidden" name="_token" value="{{ csrf_token() }}"></input>
					<span class="login100-form-title p-b-26">
						Creacion de cuenta
					</span>
					<center><p>Este apartado es exclusivo para estudiantes activos de la universidad popular del cesar.</p></center>
					<br>
					<div class="wrap-input100 validate-input" data-validate= "Campo vacio">
						<input class="input100" type="text" id="nombres" name="nombres"  required >
						<span class="focus-input100" data-placeholder="Nombre completo"></span>
					</div>
					<div  class="wrap-input100 validate-input" data-validate= "Campo vacio">
						<input class="input100" type="text" id="apellidos" name="apellidos" required >
						<span class="focus-input100" data-placeholder="Apellido completo"></span>
					</div>
					<div  class="wrap-input100 validate-input" data-validate= "Campo vacio">
						<input class="input100" type="text" id="identificacion" name="identificacion" required >
						<span class="focus-input100" data-placeholder="Identificación"></span>
					</div>
					<div  class="wrap-input100 validate-input" data-validate= "Campo vacio">
						<input class="input100" type="email" id="email" name="email" required autocomplete="off" >
						<span class="focus-input100" data-placeholder="Correo electrónico"></span>
					</div>
					<div class="wrap-input100 validate-input" data-validate ="Campo vacio">
						<span class="btn-show-pass">
							<i class="zmdi zmdi-eye"></i>
						</span>
						<input class="input100" type="password" id="clave" name="clave" required >
						<span class="focus-input100" data-placeholder="Contraseña"></span>
					</div>
					<div class="wrap-input100 validate-input" data-validate ="Campo vacio">
						<span class="btn-show-pass">
							<i class="zmdi zmdi-eye"></i>
						</span>
						<input class="input100" type="password" id="clave_confirmacion" name="clave_confirmacion" required >
						<span class="focus-input100" data-placeholder="Confirmacion de contraseña"></span>
					</div>
					
					<div class="wrap-input100 validate-input" data-validate ="Campo vacio">
						
						<input @if($token) readonly value="{{ $token }}" @endif  class="input100" type="text" id="token" name="token" required >
						<span  class="focus-input100" data-placeholder="Codigo de acceso"></span>
					</div>
					

					<div class="container-login100-form-btn">
						<div class="wrap-login100-form-btn">
							<div  class="login100-form-bgbtn"></div>
							<button type="submit" style="cursor: pointer;" class="login100-form-btn" >
								<b>Crear cuenta</b> 
							</button>	
						</div>
					</div><br>
					<center><a style="color: blue;" href="{{ route('index') }}">Iniciar sesion</a></center>
				</form>
			</div>
		</div>
	</div>
	
	<script>
		$("html, body").animate({ scrollTop: 0 }, "slow");
		$("#nombres").focus()
		@if($token)
			$("#token").focus()
		@endif
		
	</script>

	<script src="js/Login.js"></script>
	<script src="Login/js/main.js"></script>

</body>
</html>