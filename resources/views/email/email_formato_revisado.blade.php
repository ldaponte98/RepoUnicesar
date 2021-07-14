<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js"></script>
<style type="text/css">
  .boton_personalizado{
    text-decoration: none;
    padding: 10px !important;
    font-weight: 600 !important;
    font-size: 20px !important;
    color: #ffffff !important;
    background-color: #6ab363 !important;
    border-radius: 6px !important;
    border: 2px solid #6ab363 !important;
    cursor: pointer !important;
  }
  .boton_personalizado:hover{
    color: #3e7541 !important;
    background-color: #ffffff !important;
  }
</style>

<center>
	<br>
	<img src="https://admin.googleusercontent.com/logo-scs-key1559651" height="100px">
	<br>
</center>

<center>
	<br>
	<table>
	<td><img src="https://app.clez.co/images/felicitaciones.gif" height="350px"></div></td>
	<td style="padding-left: 50px !important">
		<b><h1>¡Hola {{ ucfirst(strtolower($nombre_tercero)) }}¡</h1></b>
		<p>El jefe de departamento reviso correctamente el informe de: </p>

        @if(isset($formato))
        <b><h3>{{ $formato }}</h3></b>
        @endif
        @if(isset($asignatura))
        <label><b>Asignatura:</b> {{ $asignatura }} </label><br>
        @endif
        @if(isset($grupo))
        <label><b>Grupo:</b> {{ $grupo }} </label><br>
        @endif
        @if(isset($actividades_complementarias))
        <label><b>Actividades revisadas:</b> {{ $actividades_complementarias }} </label><br>
        @endif
        @if(isset($corte))
        <label><b>Corte:</b> {{ $corte }} </label><br>
        @endif
        @if(isset($periodo_academico))
        <label><b>Periodo academico:</b> {{ $periodo_academico }} </label>
        @endif
		
	</td>
</table>

<a href="http://www2.unicesar.edu.co/unicesar/hermesoft/vortal/miVortal/logueo.jsp" class="boton_personalizado" style="text-decoration: none;
    padding-top: 10px !important;
    padding-bottom:  10px !important;
    padding-left:  70px !important;
    padding-right:  70px !important;
    font-weight: 600 !important;
    font-size: 20px !important;
    color: #ffffff !important;
    background-color: #6ab363 !important;
    border-radius: 6px !important;
    border: 2px solid #6ab363 !important;
    cursor: pointer !important;
    ">Vortal</a>
    <br><br>
</center>


