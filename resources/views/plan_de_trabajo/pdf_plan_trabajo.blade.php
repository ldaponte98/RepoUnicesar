<!DOCTYPE html>
<html>
<head>
	<title>Informe Plan Trabajo</title>
	<style>
		.page-break {
		    page-break-after: always;
		}
		*{
			font-family:'Helvetica','Verdana','Monaco',sans-serif;
		}
		
	</style>
</head>
<body>
	<script type="text/php">
    if (isset($pdf)) {
        $pdf->page_script('
            $font = $fontMetrics->get_font("Arial, Helvetica, sans-serif", "normal");
            $pdf->text(430, 85, "$PAGE_NUM de $PAGE_COUNT", $font, 8.5);
        ');
    }
</script>
	   <center>
			<table border="1" cellpadding="0" cellspacing="0" width="100%">
				 <tr>
				  <td rowspan="3"><center><img width="50px" height="50px" src="Imagenes/iconoupc.png"></center></td>
				  <td rowspan="2" colspan="4" style="padding-top: 8px; padding-bottom: 8px;"><center><b>UNIVERSIDAD POPULAR DEL CESAR</b></center></td>
				  <td rowspan="1" style="font-size: 11px; padding-left: 5px;">CODIGO: 201-300-PLTRA{{ $plan_trabajo->tercero->id_licencia }}-FOR{{ $plan_trabajo->id_plan_trabajo }}</td>
				 </tr>
				 <tr>
				  <td rowspan="1" style="font-size: 11px; padding-left: 5px;">VERSIÓN: 2</td> 
				 </tr>
				 <tr>
				  <td rowspan="1" colspan="4" style="font-size: 14px">
				  <center >
				  	<div style="margin-top: 10px">
				  PLAN DE TRABAJO
				  	</div>
				  </center></td>
				  <td rowspan="1" style="font-size: 11px; padding-left: 5px;" >Pagina </td>
				 </tr>
			</table>
		</center>

<!--aca comienza la info del registro-->

<style type="text/css">
	div{
		margin-bottom: 10px;
	} 
	p{
		font-weight: bold;
		margin: 3px !important;
	}
	table{
		width: 100%;
	}

	.td_1{
		font-size: 14px;
		width: 1px;
		padding-top: 17px;
		margin-bottom: 0px;

	}
	.td_2{
		font-size: 14px;
		width: 1px;
		padding-top: 9px;
		margin-bottom: 0px;
	}
	.td_3{
		font-size: 14px;
		padding-top: 5px;
		width: 50%
	}
	.pegados_1{
		border-bottom: 0.5px solid #000000;
		margin-top: 8px;
		font-size: 14px;
		width: 100%;
		margin-left: 5px;
		margin-bottom: 0px;
		font-weight: bold;

	}
	.pegados_2{
		border-bottom: 0.5px solid #000000;
		margin-top: 5px;
		font-size: 12px;
		width: 100%;
		margin-left: 5px;
		margin-bottom: 0px;
		font-weight: bold;

	}
	.tabla_1 td{
		padding-left: 10px !important;
		padding-top: 0px !important;
		font-size: 10px;
	}
	.tabla_4 td{
		padding-top: 3px !important;
		padding-bottom: 3px !important;
		font-size: 12px;
	}

	.tabla_2 td{
		padding-left: 10px !important;
		padding-top: 5px !important;
		padding-bottom: 5px !important;
		font-size: 10px;
	}

	.tabla_3 td{
		padding-top: 8px !important;
		padding-bottom: 8px !important;
		font-size: 10px;
	}

</style>

<br>
@php
	$licencia = \App\Licencia::find(session('id_licencia'));
@endphp


<div style="text-align: right;"><b style="font-size: 14px;">PERIODO LECTIVO {{ $plan_trabajo->periodo_academico->periodo }}</b></div>
<table class="tabla_1" border="1" cellpadding="0" cellspacing="0">
	<tr style="background-color: #c7e6a4">
		<td style="width: 19% !important"><b>1. DOCENTE</b> </td>
		<td colspan="3"><p>{{ $plan_trabajo->tercero->getNameFull() }}</p></td>
	</tr>
	<tr>
		<td style="width: 19% !important"><b>2. CATEGORIA</b> </td>
		<td colspan="3">{{ strtoupper($plan_trabajo->tercero->categoria) }}</td>
	</tr>
	<tr>
		<td style="width: 19% !important"><b>3. VINCULACIÓN</b> </td>
		<td colspan="3">{{ strtoupper($plan_trabajo->tercero->vinculacion) }}</td>
	</tr>
	<tr>
		<td style="width: 19% !important"><b>4. DEDICACIÓN</b> </td>
		<td colspan="3">{{ strtoupper($plan_trabajo->tercero->servicio) }}</td>
	</tr>
	<tr>
		<td style="width: 19% !important"><b>5. SEDE</b> </td>
		<td colspan="3">{{ strtoupper($licencia->sede) }}</td>
	</tr>
	<tr>
		<td style="width: 19% !important"><b>6. FACULTAD</b> </td>
		<td colspan="3">{{ strtoupper($licencia->programa->facultad->nombre) }}</td>
	</tr>
	<tr>
		<td style="width: 19% !important"><b>7. PROGRAMA</b> </td>
		<td colspan="3">{{ strtoupper($licencia->programa->nombre) }}</td>
	</tr>
	<tr>
		<td style="width: 19% !important"><b>8. DEPARTAMENTO</b> </td>
		<td colspan="3">{{ strtoupper($licencia->nombre) }}</td>
	</tr>
	<tr>
		<td colspan="4" style="padding-bottom: 4px !important; padding-top: 4px !important;"><b>9. ASIGNATURAS</b></td>
	</tr>
</table>
<table border="1" class="tabla_4" cellpadding="0" cellspacing="0">
		<tr>
			<td rowspan="2"><center><b>CODIGO</b></center></td>
			<td rowspan="2"><center><b>NOMBRE ASIGNATURA</b></center></td>
			<td colspan="2"><center><b>I.H.S</b></center></td>
		</tr>
		<tr>
			<td><center><b>T</b></center></td>
			<td><center><b>P</b></center></td>
		</tr>
	<tbody>	
		@foreach ($plan_trabajo->tercero->grupos_por_periodo_academico($plan_trabajo->id_periodo_academico) as $grupo)
			
		<tr>
			<td><center>{{ $grupo->asignatura->codigo }}</center></td>
			<td><center>{{ $grupo->asignatura->nombre }} (Grupo {{ $grupo->codigo }})</center></td>
			<td><center>{{ $grupo->asignatura->horas_teoricas }}</center></td>
			<td><center>{{ $grupo->asignatura->horas_practicas }}</center></td>
		</tr>

		@endforeach

	</tbody>	
</table>
<br>
<div style="text-align: center;"><b style="font-size: 14px;">CUADROS EXPLICATIVOS DE LAS ACTIVIDADES DOCENTES</b></div>

<table border="1" class="tabla_3" cellpadding="0" cellspacing="0">
		<tr  style="background-color: #c7e6a4">
			<td colspan="3" style="padding-left: 3px !important;"><center><b>1. ORIENTACIÓN Y EVALUACIÓN DE LOS TRABAJOS DE GRADO</b></center></td>
			<td colspan="2"><center><b>Aprobado por:</b></center></td>
			<td colspan="2"><center><b>Fecha de:</b></center></td>
			<td colspan="1"><center><b>Horas por semana</b></center></td>
		</tr>
		<tr>
			<td colspan="3" style="padding-top: 3px!important; padding-bottom: 5px !important;"><center><b>TITULO DE CADA TRABAJO DE GRADO</b></center></td>
			<td><center><b>Acta</center></b></td>
			<td><center><b>Fecha</center></b></td>
			<td><center><b>Iniciación</center></b></td>
			<td><center><b>Terminación</center></b></td>
			<td></td>
		</tr>
	 <tbody>	
		@php
			$cont = 0;
		@endphp
		@foreach ($plan_trabajo->actividades as $actividad)
			@if ($actividad->id_dominio_tipo == 18)
			@php
				if($actividad->fecha_aprobada) $actividad->fecha_aprobada = date('d/m/Y', strtotime($actividad->fecha_aprobada));
				if($actividad->fecha_iniciacion) $actividad->fecha_iniciacion = date('d/m/Y', strtotime($actividad->fecha_iniciacion));
				if($actividad->fecha_terminacion) $actividad->fecha_terminacion = date('d/m/Y', strtotime($actividad->fecha_terminacion));
			@endphp
				<tr>
					<td colspan="3"><center>{{ $actividad->nombre }}</center></td>
					<td><center>{{ $actividad->acta_aprobada }}</center></td>
					<td><center>{{ $actividad->fecha_aprobada }}</center></td>
					<td><center>{{ $actividad->fecha_iniciacion }}</center></td>
					<td><center>{{ $actividad->fecha_terminacion }}</center></td>
					<td><center>{{ $actividad->horas_por_semana }}</center></td>
				</tr>
				@php
					$cont += $actividad->horas_por_semana;
				@endphp
			@endif
		@endforeach
		<tr>
		<td colspan="7"><center>TOTAL HORAS</center></td>
		<td colspan="1"><center>{{ $cont }}</center></td>
		</tr>
	</tbody>	
</table>

<br>

<table border="1" class="tabla_3" cellpadding="0" cellspacing="0">
		<tr  style="background-color: #c7e6a4">
			<td colspan="3"  style="padding-left: 3px !important;"><b>2. INVESTIGACIÓN APROBADA</b></td>
			<td colspan="2"><center><b>Aprobado por:</b></center></td>
			<td colspan="2"><center><b>Fecha de:</b></center></td>
			<td colspan="1"><center><b>Horas por semana</b></center></td>
		</tr>
		<tr>
			<td colspan="3" style="padding-top: 5px!important; padding-bottom: 5px !important;"><center><b>TITULO DE CADA TRABAJO DE INVESTIGACIÓN</center></b></td>
			<td><center><b>Acta</center></b></td>
			<td><center><b>Fecha</center></b></td>
			<td><center><b>Iniciación</center></b></td>
			<td><center><b>Terminación</center></b></td>
			<td></td>
		</tr>
	<tbody>	
		@php
			$cont = 0;
		@endphp
		@foreach ($plan_trabajo->actividades as $actividad)
			@if ($actividad->id_dominio_tipo == 19)
			@php
				if($actividad->fecha_aprobada) $actividad->fecha_aprobada = date('d/m/Y', strtotime($actividad->fecha_aprobada));
				if($actividad->fecha_iniciacion) $actividad->fecha_iniciacion = date('d/m/Y', strtotime($actividad->fecha_iniciacion));
				if($actividad->fecha_terminacion) $actividad->fecha_terminacion = date('d/m/Y', strtotime($actividad->fecha_terminacion));
			@endphp
				<tr>
					<td colspan="3"><center>{{ $actividad->nombre }}</center></td>
					<td><center>{{ $actividad->acta_aprobada }}</center></td>
					<td><center>{{ $actividad->fecha_aprobada }}</center></td>
					<td><center>{{ $actividad->fecha_iniciacion }}</center></td>
					<td><center>{{ $actividad->fecha_terminacion }}</center></td>
					<td><center>{{ $actividad->horas_por_semana }}</center></td>
				</tr>
				@php
					$cont += $actividad->horas_por_semana;
				@endphp
			@endif
		@endforeach
		<tr>
		<td colspan="7"><center>TOTAL HORAS</center></td>
		<td colspan="1"><center>{{ $cont }}</center></td>
		</tr>
	</tbody>	
</table>
 
<br>
 <table border="1" class="tabla_3" cellpadding="0" cellspacing="0">
		<tr  style="background-color: #c7e6a4">
			<td colspan="2" style="padding-left: 3px !important;"><b>3. PROYECCIÓN SOCIAL</b></td>
			<td colspan="2" style="padding-left: 3px !important;"><b>Autorizada por:</b></td>
			<td colspan="1"><center><b>Horas por semana</b></center></td>
		</tr>
		<tr>
			<td style="padding-top: 5px!important; padding-bottom: 5px !important;"><center><b>ACTIVIDADES</center></b></td>
			<td><center><b>DESCRIPCIÓN</center></b></td>
			<td><center><b>INSTITUCIÓN</center></b></td>
			<td><center><b>FECHA</center></b></td>
			<td></td>
		</tr>
	<tbody>	
		@php
			$cont = 0;
		@endphp
		@foreach ($plan_trabajo->actividades as $actividad)
			@if ($actividad->id_dominio_tipo == 20)
			@php
				if($actividad->fecha_aprobada) $actividad->fecha_aprobada = date('d/m/Y', strtotime($actividad->fecha_aprobada));
				if($actividad->fecha_iniciacion) $actividad->fecha_iniciacion = date('d/m/Y', strtotime($actividad->fecha_iniciacion));
				if($actividad->fecha_terminacion) $actividad->fecha_terminacion = date('d/m/Y', strtotime($actividad->fecha_terminacion));
			@endphp
				<tr>
					<td><center>{{ $actividad->nombre }}</center></td>
					<td><center>{{ $actividad->descripcion }}</center></td>
					<td><center>{{ $actividad->institucion }}</center></td>
					<td><center>{{ $actividad->fecha_iniciacion }}</center></td>
					<td><center>{{ $actividad->horas_por_semana }}</center></td>
				</tr>
				@php
					$cont += $actividad->horas_por_semana;
				@endphp
			@endif
		@endforeach
		<tr>
		<td colspan="4"><center>TOTAL HORAS</center></td>
		<td colspan="1"><center>{{ $cont }}</center></td>
		</tr>
	</tbody>	
</table>

<br>
 <table border="1" class="tabla_3" cellpadding="0" cellspacing="0">
		<tr  style="background-color: #c7e6a4">
			<td colspan="2" style="padding-left: 3px !important;"><b>4. COOPERACIÓN  INTERINSTITUCIONAL </b></td>
			<td colspan="2" style="padding-left: 3px !important;"><b>Autorizada por:</b></td>
			<td colspan="1"><center><b>Horas por semana</b></center></td>
		</tr>
		<tr>
			<td style="padding-top: 5px!important; padding-bottom: 5px !important;"><center><b>ACTIVIDADES</center></b></td>
			<td><center><b>DESCRIPCIÓN</center></b></td>
			<td><center><b>INSTITUCIÓN</center></b></td>
			<td><center><b>FECHA</center></b></td>
			<td></td>
		</tr>
	<tbody>	
		@php
			$cont = 0;
		@endphp
		@foreach ($plan_trabajo->actividades as $actividad)
			@if ($actividad->id_dominio_tipo == 21)
			@php
				if($actividad->fecha_aprobada) $actividad->fecha_aprobada = date('d/m/Y', strtotime($actividad->fecha_aprobada));
				if($actividad->fecha_iniciacion) $actividad->fecha_iniciacion = date('d/m/Y', strtotime($actividad->fecha_iniciacion));
				if($actividad->fecha_terminacion) $actividad->fecha_terminacion = date('d/m/Y', strtotime($actividad->fecha_terminacion));
			@endphp
				<tr>
					<td><center>{{ $actividad->nombre }}</center></td>
					<td><center>{{ $actividad->descripcion }}</center></td>
					<td><center>{{ $actividad->institucion }}</center></td>
					<td><center>{{ $actividad->fecha_iniciacion }}</center></td>
					<td><center>{{ $actividad->horas_por_semana }}</center></td>
				</tr>
				@php
					$cont += $actividad->horas_por_semana;
				@endphp
			@endif
		@endforeach
		<tr>
		<td colspan="4"><center>TOTAL HORAS</center></td>
		<td colspan="1"><center>{{ $cont }}</center></td>
		</tr>
	</tbody>	
</table>

<br>
<div class="page-break"></div>

		<center>
			<table border="1" cellpadding="0" cellspacing="0" width="100%">
				 <tr>
				  <td rowspan="3"><center><img width="50px" height="50px" src="Imagenes/iconoupc.png"></center></td>
				  <td rowspan="2" colspan="4" style="padding-top: 8px; padding-bottom: 8px;"><center><b>UNIVERSIDAD POPULAR DEL CESAR</b></center></td>
				  <td rowspan="1" style="font-size: 11px; padding-left: 5px;">CODIGO: 201-300-PLTRA{{ $plan_trabajo->tercero->id_licencia }}-FOR{{ $plan_trabajo->id_plan_trabajo }}</td>
				 </tr>
				 <tr>
				  <td rowspan="1" style="font-size: 11px; padding-left: 5px;">VERSIÓN: 2</td> 
				 </tr>
				 <tr>
				  <td rowspan="1" colspan="4" style="font-size: 14px">
				  <center >
				  	<div style="margin-top: 10px">
				  PLAN DE TRABAJO
				  	</div>
				  </center></td>
				  <td rowspan="1" style="font-size: 11px; padding-left: 5px;" >Pagina </td>
				 </tr>
			</table>
		</center>
<br>
 <table border="1" class="tabla_3" cellpadding="0" cellspacing="0">
		<tr  style="background-color: #c7e6a4">
			<td colspan="2" style="padding-left: 3px !important;"><b>5. CRECIMIENTO PERSONAL Y DESARROLLO </b></td>
			<td colspan="2" style="padding-left: 3px !important;"><b>Autorizada por:</b></td>
			<td colspan="1"><center><b>Horas por semana</b></center></td>
		</tr>
		<tr>
			<td style="padding-top: 5px!important; padding-bottom: 5px !important;"><center><b>ACTIVIDADES</center></b></td>
			<td><center><b>DESCRIPCIÓN</center></b></td>
			<td><center><b>INSTITUCIÓN</center></b></td>
			<td><center><b>FECHA</center></b></td>
			<td></td>
		</tr>
	<tbody>	
		@php
			$cont = 0;
		@endphp
		@foreach ($plan_trabajo->actividades as $actividad)
			@if ($actividad->id_dominio_tipo == 22)
			@php
				if($actividad->fecha_aprobada) $actividad->fecha_aprobada = date('d/m/Y', strtotime($actividad->fecha_aprobada));
				if($actividad->fecha_iniciacion) $actividad->fecha_iniciacion = date('d/m/Y', strtotime($actividad->fecha_iniciacion));
				if($actividad->fecha_terminacion) $actividad->fecha_terminacion = date('d/m/Y', strtotime($actividad->fecha_terminacion));
			@endphp
				<tr>
					<td><center>{{ $actividad->nombre }}</center></td>
					<td><center>{{ $actividad->descripcion }}</center></td>
					<td><center>{{ $actividad->institucion }}</center></td>
					<td><center>{{ $actividad->fecha_iniciacion }}</center></td>
					<td><center>{{ $actividad->horas_por_semana }}</center></td>
				</tr>
				@php
					$cont += $actividad->horas_por_semana;
				@endphp
			@endif
		@endforeach
		<tr>
		<td colspan="4"><center>TOTAL HORAS</center></td>
		<td colspan="1"><center>{{ $cont }}</center></td>
		</tr>
	</tbody>	
</table>

<br>

<table border="1" class="tabla_3" cellpadding="0" cellspacing="0">
		<tr  style="background-color: #c7e6a4">
			<td colspan="2" style="padding-left: 3px !important;"><b>6. ACTIVIDADES ADMINISTRATIVAS</b></td>
			<td colspan="2" style="padding-left: 3px !important;"><b>Autorizada por:</b></td>
			<td colspan="1"><center><b>Horas por semana</b></center></td>
		</tr>
		<tr>
			<td style="padding-top: 5px!important; padding-bottom: 5px !important;"><center><b>ACTIVIDADES</center></b></td>
			<td><center><b>DESCRIPCIÓN</center></b></td>
			<td><center><b>INSTITUCIÓN</center></b></td>
			<td><center><b>FECHA</center></b></td>
			<td></td>
		</tr>
	<tbody>	
		@php
			$cont = 0;
		@endphp
		@foreach ($plan_trabajo->actividades as $actividad)
			@if ($actividad->id_dominio_tipo == 23)
			@php
				if($actividad->fecha_aprobada) $actividad->fecha_aprobada = date('d/m/Y', strtotime($actividad->fecha_aprobada));
				if($actividad->fecha_iniciacion) $actividad->fecha_iniciacion = date('d/m/Y', strtotime($actividad->fecha_iniciacion));
				if($actividad->fecha_terminacion) $actividad->fecha_terminacion = date('d/m/Y', strtotime($actividad->fecha_terminacion));
			@endphp
				<tr>
					<td><center>{{ $actividad->nombre }}</center></td>
					<td><center>{{ $actividad->descripcion }}</center></td>
					<td><center>{{ $actividad->institucion }}</center></td>
					<td><center>{{ $actividad->fecha_iniciacion }}</center></td>
					<td><center>{{ $actividad->horas_por_semana }}</center></td>
				</tr>
				@php
					$cont += $actividad->horas_por_semana;
				@endphp
			@endif
		@endforeach
		<tr>
		<td colspan="4"><center>TOTAL HORAS</center></td>
		<td colspan="1"><center>{{ $cont }}</center></td>
		</tr>
	</tbody>	
</table>
<br>

<table border="1" class="tabla_3" cellpadding="0" cellspacing="0">
		<tr  style="background-color: #c7e6a4">
			<td colspan="2" style="padding-left: 3px !important;"><b>7. OTRAS ACTIVIDADES</b></td>
			<td colspan="2" style="padding-left: 3px !important;"><b>Autorizada por:</b></td>
			<td colspan="1"><center><b>Horas por semana</b></center></td>
		</tr>
		<tr>
			<td style="padding-top: 5px!important; padding-bottom: 5px !important;"><center><b>ACTIVIDADES</center></b></td>
			<td><center><b>DESCRIPCIÓN</center></b></td>
			<td><center><b>INSTITUCIÓN</center></b></td>
			<td><center><b>FECHA</center></b></td>
			<td></td>
		</tr>
	<tbody>	
		@php
			$cont = 0;
		@endphp
		@foreach ($plan_trabajo->actividades as $actividad)
			@if ($actividad->id_dominio_tipo == 24)
			@php
				if($actividad->fecha_aprobada) $actividad->fecha_aprobada = date('d/m/Y', strtotime($actividad->fecha_aprobada));
				if($actividad->fecha_iniciacion) $actividad->fecha_iniciacion = date('d/m/Y', strtotime($actividad->fecha_iniciacion));
				if($actividad->fecha_terminacion) $actividad->fecha_terminacion = date('d/m/Y', strtotime($actividad->fecha_terminacion));
			@endphp
				<tr>
					<td><center>{{ $actividad->nombre }}</center></td>
					<td><center>{{ $actividad->descripcion }}</center></td>
					<td><center>{{ $actividad->institucion }}</center></td>
					<td><center>{{ $actividad->fecha_iniciacion }}</center></td>
					<td><center>{{ $actividad->horas_por_semana }}</center></td>
				</tr>
				@php
					$cont += $actividad->horas_por_semana;
				@endphp
			@endif
		@endforeach
		<tr>
		<td colspan="4"><center>TOTAL HORAS</center></td>
		<td colspan="1"><center>{{ $cont }}</center></td>
		</tr>
	</tbody>	
</table>
<br>
<table border="1" class="tabla_2" cellpadding="0" cellspacing="0">
	<tr>
		<td colspan="3"><b>10. TOTAL DE ASIGNATURAS A CARGO</b></td>
		<td colspan="1"><center><b>{{ $plan_trabajo->total_asignaturas }}</b></center></td>
	</tr>
	<tr>
		<td colspan="3"><b>11. TOTAL DE GRUPOS A CARGO</b></td>
		<td colspan="1" style="width: 20px !important"><center><b>{{ $plan_trabajo->total_grupos }}</b></center></td>
	</tr>
	<tr>
		<td colspan="3"><b>12. TOTAL DE ESTUDIANTES EN LOS GRUPOS A CARGO </b></td>
		<td colspan="1"><center><b>{{ $plan_trabajo->total_estudiantes }}</b></center></td>
	</tr>
	<tr>
		<td colspan="3"><b>13. TOTAL DE HORAS DE DOCENCIA DIRECTA ( TEÓRICA + PRÁCTICA )</b></td>
		<td colspan="1"><center><b>{{ $plan_trabajo->horas_docencia_directa }}</b></center></td>
	</tr>
	<tr>
		<td colspan="3"><b>14. HORAS DE ATENCIÓN A ESTUDIANTES (TUTORIAS)</b></td>
		<td colspan="1"><center><b>{{ $plan_trabajo->horas_atencion_estudiantes }}</b></center></td>
	</tr>
	<tr>
		<td colspan="3"><b>15. HORAS DE PREPARACIÓN Y EVALUACIÓN DE LAS ASIGNATURAS</b></td>
		<td colspan="1"><center><b>{{ $plan_trabajo->horas_preparacion_evaluacion }}</b></center></td>
	</tr>
	<tr>
		<td colspan="3"><b>16. TOTAL DE HORAS DEDICADAS A LAS ACTIVIDADES DOCENTES</b></td>
		<td colspan="1"><center><b>{{ $plan_trabajo->horas_dedicadas_actividades }}</b></center></td>
	</tr>
</table>

<br>
<div style="text-align: center;"><b style="font-size: 14px;">ACTIVIDADES DOCENTES COMPLEMENTARIAS </b></div>
<table border="1" class="tabla_2" cellpadding="0" cellspacing="0">
	<tr>
		<td colspan="3"><b>17. HORAS DE ORIENTACIÓN Y EVALUACIÓN DE LOS TRABAJOS DE GRADO (CUADRO 1) </b></td>
		<td colspan="1" style="width: 20px !important"><center><b>{{ $plan_trabajo->horas_orientacion_proyectos }}</b></center></td>
	</tr>
	<tr>
		<td colspan="3"><b>18. HORAS DEDICADAS A LA INVESTIGACIÓN APROBADA (CUADRO 2)</b></td>
		<td colspan="1"><center><b>{{ $plan_trabajo->horas_investigacion }}</b></center></td>
	</tr>
	<tr>
		<td colspan="3"><b>19. HORAS DEDICADAS A LA PROYECCIÓN SOCIAL REGISTRADA (CUADRO 3)</b></td>
		<td colspan="1"><center><b>{{ $plan_trabajo->horas_proyeccion_social }}</b></center></td>
	</tr>
	<tr>
		<td colspan="3"><b>20. HORAS DEDICADAS A LA COOPERACIÓN INTERINSTITUCIONAL (CUADRO 4)</b></td>
		<td colspan="1"><center><b>{{ $plan_trabajo->horas_cooperacion }}</b></center></td>
	</tr>
	<tr>
		<td colspan="3"><b>21. HORAS DEDICADAS PARA CRECIMIENTO PERSONAL Y PROFESIONAL (CUADRO 5)</b></td>
		<td colspan="1"><center><b>{{ $plan_trabajo->horas_crecimiento_personal }}</b></center></td>
	</tr>
	<tr>
		<td colspan="3"><b>22. HORAS DEDICADAS A LAS ACTIVIDADES ADMINISTRATIVAS (CUADRO 6)</b></td>
		<td colspan="1"><center><b>{{ $plan_trabajo->horas_actividades_administrativas }}</b></center></td>
	</tr>
	<tr>
		<td colspan="3"><b>23. HORAS PARA OTRAS ACTIVIDADES (CUADRO 7)</b></td>
		<td colspan="1"><center><b>{{ $plan_trabajo->horas_otras_actividades }}</b></center></td>
	</tr>
	<tr>
		<td colspan="3"><b>24. TOTAL HORAS DEDICADAS A LAS ACTIVIDADES DOCENTES  COMPLEMENTARIAS</b></td>
		<td colspan="1"><center><b>{{ $plan_trabajo->horas_actividades_complementarias }}</b></center></td>
	</tr>
	<tr>
		<td colspan="3"><b>TOTAL DE HORAS POR SEMANA DEL PLAN DE TRABAJO</b></td>
		<td colspan="1"><center><b>{{ $plan_trabajo->total_horas_semana }}</b></center></td>
	</tr>
</table>



<div class="page-break"></div>

		<center>
			<table border="1" cellpadding="0" cellspacing="0" width="100%">
				 <tr>
				  <td rowspan="3"><center><img width="50px" height="50px" src="Imagenes/iconoupc.png"></center></td>
				  <td rowspan="2" colspan="4" style="padding-top: 8px; padding-bottom: 8px;"><center><b>UNIVERSIDAD POPULAR DEL CESAR</b></center></td>
				  <td rowspan="1" style="font-size: 11px; padding-left: 5px;">CODIGO: 201-300-PLTRA{{ $plan_trabajo->tercero->id_licencia }}-FOR{{ $plan_trabajo->id_plan_trabajo }}</td>
				 </tr>
				 <tr>
				  <td rowspan="1" style="font-size: 11px; padding-left: 5px;">VERSIÓN: 2</td> 
				 </tr>
				 <tr>
				  <td rowspan="1" colspan="4" style="font-size: 14px">
				  <center >
				  	<div style="margin-top: 10px">
				  PLAN DE TRABAJO
				  	</div>
				  </center></td>
				  <td rowspan="1" style="font-size: 11px; padding-left: 5px;" >Pagina </td>
				 </tr>
			</table>
		</center>
<br>

<br>

<div style="text-align: center;"><b style="font-size: 14px;">HORARIO DE ACTIVIDADES</b></div>
<style type="text/css">
	.td_big td{
		padding: 5px !important;
	}
</style>
</script>
<table border="1" class="tabla_4 td_big" cellpadding="0" cellspacing="0" >
		<tr style="background-color: #c7e6a4">
      <td style="color: black !important;"><center><b>HORAS</b></center></td>
      <td><center><b>LUNES</b></center></td>
      <td><center><b>MARTES</b></center></td>
      <td><center><b>MIERCOLES</b></center></td>
      <td><center><b>JUEVES</b></center></td>
      <td><center><b>VIERNES</b></center></td>
      <td><center><b>SABADO</b></center></td>
    </tr>
    <tr>
      <td ><center><b>6 - 7</b></center></td>
      <td><center>{{ $horario->obtener_evento('Lunes', '6-7') }}</center></td>
      <td><center>{{ $horario->obtener_evento('Martes', '6-7') }}</center></td>
      <td><center>{{ $horario->obtener_evento('Miercoles', '6-7') }}</center></td>
      <td><center>{{ $horario->obtener_evento('Jueves', '6-7') }}</center></td>
      <td><center>{{ $horario->obtener_evento('Viernes', '6-7') }}</center></td>
      <td><center>{{ $horario->obtener_evento('Sabado', '6-7') }}</center></td>
    </tr>
    <tr>
      <td><center><b>7 - 8</b></center></td>
      <td><center>{{ $horario->obtener_evento('Lunes', '7-8') }}</center></td>
      <td><center>{{ $horario->obtener_evento('Martes', '7-8') }}</center></td>
      <td><center>{{ $horario->obtener_evento('Miercoles', '7-8') }}</center></td>
      <td><center>{{ $horario->obtener_evento('Jueves', '7-8') }}</center></td>
      <td><center>{{ $horario->obtener_evento('Viernes', '7-8') }}</center></td>
      <td><center>{{ $horario->obtener_evento('Sabado', '7-8') }}</center></td>
    7-8</tr>
    <tr>
      <td><center><b>8 - 9</b></center></td>
      <td><center>{{ $horario->obtener_evento('Lunes', '8-9') }}</center></td>
      <td><center>{{ $horario->obtener_evento('Martes', '8-9') }}</center></td>
      <td><center>{{ $horario->obtener_evento('Miercoles', '8-9') }}</center></td>
      <td><center>{{ $horario->obtener_evento('Jueves', '8-9') }}</center></td>
      <td><center>{{ $horario->obtener_evento('Viernes', '8-9') }}</center></td>
      <td><center>{{ $horario->obtener_evento('Sabado', '8-9') }}</center></td>
	</tr>
    <tr>
      <td><center><b>9 - 10</b></center></td>
      <td><center>{{ $horario->obtener_evento('Lunes', '9-10') }}</center></td>
      <td><center>{{ $horario->obtener_evento('Martes', '9-10') }}</center></td>
      <td><center>{{ $horario->obtener_evento('Miercoles', '9-10') }}</center></td>
      <td><center>{{ $horario->obtener_evento('Jueves', '9-10') }}</center></td>
      <td><center>{{ $horario->obtener_evento('Viernes', '9-10') }}</center></td>
      <td><center>{{ $horario->obtener_evento('Sabado', '9-10') }}</center></td>
    </tr>
    <tr>
      <td><center><b>10 - 11</b></center></td>
      <td><center>{{ $horario->obtener_evento('Lunes', '10-11') }}</center></td>
      <td><center>{{ $horario->obtener_evento('Martes', '10-11') }}</center></td>
      <td><center>{{ $horario->obtener_evento('Miercoles', '10-11') }}</center></td>
      <td><center>{{ $horario->obtener_evento('Jueves', '10-11') }}</center></td>
      <td><center>{{ $horario->obtener_evento('Viernes', '10-11') }}</center></td>
      <td><center>{{ $horario->obtener_evento('Sabado', '10-11') }}</center></td>
    </tr>
    <tr>
      <td><center><b>11 - 12</b></center></td>
      <td><center>{{ $horario->obtener_evento('Lunes', '11-12') }}</center></td>
      <td><center>{{ $horario->obtener_evento('Martes', '11-12') }}</center></td>
      <td><center>{{ $horario->obtener_evento('Miercoles', '11-12') }}</center></td>
      <td><center>{{ $horario->obtener_evento('Jueves', '11-12') }}</center></td>
      <td><center>{{ $horario->obtener_evento('Viernes', '11-12') }}</center></td>
      <td><center>{{ $horario->obtener_evento('Sabado', '11-12') }}</center></td>
    </tr>
    <tr>
      <td><center><b>12 - 13</b></center></td>
      <td><center>{{ $horario->obtener_evento('Lunes', '12-13') }}</center></td>
      <td><center>{{ $horario->obtener_evento('Martes', '12-13') }}</center></td>
      <td><center>{{ $horario->obtener_evento('Miercoles', '12-13') }}</center></td>
      <td><center>{{ $horario->obtener_evento('Jueves', '12-13') }}</center></td>
      <td><center>{{ $horario->obtener_evento('Viernes', '12-13') }}</center></td>
      <td><center>{{ $horario->obtener_evento('Sabado', '12-13') }}</center></td>
    </tr>
    <tr>
      <td><center><b>13 - 14</b></center></td>
      <td><center>{{ $horario->obtener_evento('Lunes', '13-14') }}</center></td>
      <td><center>{{ $horario->obtener_evento('Martes', '13-14') }}</center></td>
      <td><center>{{ $horario->obtener_evento('Miercoles', '13-14') }}</center></td>
      <td><center>{{ $horario->obtener_evento('Jueves', '13-14') }}</center></td>
      <td><center>{{ $horario->obtener_evento('Viernes', '13-14') }}</center></td>
      <td><center>{{ $horario->obtener_evento('Sabado', '13-14') }}</center></td>
    </tr>
    <tr>
      <td><center><b>14 - 15</b></center></td>
	  <td><center>{{ $horario->obtener_evento('Lunes', '14-15') }}</center></td>
      <td><center>{{ $horario->obtener_evento('Martes', '14-15') }}</center></td>
      <td><center>{{ $horario->obtener_evento('Miercoles', '14-15') }}</center></td>
      <td><center>{{ $horario->obtener_evento('Jueves', '14-15') }}</center></td>
      <td><center>{{ $horario->obtener_evento('Viernes', '14-15') }}</center></td>
      <td><center>{{ $horario->obtener_evento('Sabado', '14-15') }}</center></td>
    </tr>
    <tr>
      <td><center><b>15 - 16</b></center></td>
      <td><center>{{ $horario->obtener_evento('Lunes', '15-16') }}</center></td>
      <td><center>{{ $horario->obtener_evento('Martes', '15-16') }}</center></td>
      <td><center>{{ $horario->obtener_evento('Miercoles', '15-16') }}</center></td>
      <td><center>{{ $horario->obtener_evento('Jueves', '15-16') }}</center></td>
      <td><center>{{ $horario->obtener_evento('Viernes', '15-16') }}</center></td>
      <td><center>{{ $horario->obtener_evento('Sabado', '15-16') }}</center></td>
    </tr>
    <tr>
      <td><center><b>16 - 17</b></center></td>
      <td><center>{{ $horario->obtener_evento('Lunes', '16-17') }}</center></td>
      <td><center>{{ $horario->obtener_evento('Martes', '16-17') }}</center></td>
      <td><center>{{ $horario->obtener_evento('Miercoles', '16-17') }}</center></td>
      <td><center>{{ $horario->obtener_evento('Jueves', '16-17') }}</center></td>
      <td><center>{{ $horario->obtener_evento('Viernes', '16-17') }}</center></td>
      <td><center>{{ $horario->obtener_evento('Sabado', '16-17') }}</center></td>
    </tr>
    <tr>
      <td><center><b>17- 18</b></center></td>
      <td><center>{{ $horario->obtener_evento('Lunes', '17-18') }}</center></td>
      <td><center>{{ $horario->obtener_evento('Martes', '17-18') }}</center></td>
      <td><center>{{ $horario->obtener_evento('Miercoles', '17-18') }}</center></td>
      <td><center>{{ $horario->obtener_evento('Jueves', '17-18') }}</center></td>
      <td><center>{{ $horario->obtener_evento('Viernes', '17-18') }}</center></td>
      <td><center>{{ $horario->obtener_evento('Sabado', '17-18') }}</center></td>
    </tr>
    <tr>
      <td><center><b>18 - 19</b></center></td>
      <td><center>{{ $horario->obtener_evento('Lunes', '18-19') }}</center></td>
      <td><center>{{ $horario->obtener_evento('Martes', '18-19') }}</center></td>
      <td><center>{{ $horario->obtener_evento('Miercoles', '18-19') }}</center></td>
      <td><center>{{ $horario->obtener_evento('Jueves', '18-19') }}</center></td>
      <td><center>{{ $horario->obtener_evento('Viernes', '18-19') }}</center></td>
      <td><center>{{ $horario->obtener_evento('Sabado', '18-19') }}</center></td>
    </tr>
    <tr>
      <td><center><b>19 - 20</b></center></td>
      <td><center>{{ $horario->obtener_evento('Lunes', '19-20') }}</center></td>
      <td><center>{{ $horario->obtener_evento('Martes', '19-20') }}</center></td>
      <td><center>{{ $horario->obtener_evento('Miercoles', '19-20') }}</center></td>
      <td><center>{{ $horario->obtener_evento('Jueves', '19-20') }}</center></td>
      <td><center>{{ $horario->obtener_evento('Viernes', '19-20') }}</center></td>
      <td><center>{{ $horario->obtener_evento('Sabado', '19-20') }}</center></td>
    </tr>
    <tr>
      <td><center><b>20 - 21</b></center></td>
      <td><center>{{ $horario->obtener_evento('Lunes', '20-21') }}</center></td>
      <td><center>{{ $horario->obtener_evento('Martes', '20-21') }}</center></td>
      <td><center>{{ $horario->obtener_evento('Miercoles', '20-21') }}</center></td>
      <td><center>{{ $horario->obtener_evento('Jueves', '20-21') }}</center></td>
      <td><center>{{ $horario->obtener_evento('Viernes', '20-21') }}</center></td>
      <td><center>{{ $horario->obtener_evento('Sabado', '20-21') }}</center></td>
    </tr>
    <tr>
      <td><center><b>21 - 22</b></center></td>
      <td id="td_Lunes_21-22" onclick="ModalNuevoEvento('Lunes', '21-22')"><center></center></td>
      <td id="td_Martes_21-22" onclick="ModalNuevoEvento('Martes', '21-22')"><center></center></td>
      <td id="td_Miercoles_21-22" onclick="ModalNuevoEvento('Miercoles', '21-22')"><center></center></td>
      <td id="td_Jueves_21-22" onclick="ModalNuevoEvento('Jueves', '21-22')"><center></center></td>
      <td id="td_Viernes_21-22" onclick="ModalNuevoEvento('Viernes', '21-22')"><center></center></td>
      <td id="td_Sabado_21-22" onclick="ModalNuevoEvento('Sabado', '21-22')"><center></center></td>
    </tr> 	
</table>



<br><br>
<div style="border: 1px solid #000000; padding: 10px;">
	<table class="tabla_4">
	<tr>
		<td><b>OBSERVACIONES:</b></td>
		<td colspan="5" style="border-bottom: 1px solid #000000;">{{ $plan_trabajo->observaciones }}</td>
	</tr>
	<tr>
		<td colspan="6">&nbsp;</td>
	</tr>
	<tr>
		<td><b>FIRMA DEL PROFESOR:</b></td>
		<td colspan="3" style="border-bottom: 1px solid #000000;"></td>
		<td><b>FECHA:</b></td>
		<td colspan="1">{{ date('d/m/Y', strtotime($plan_trabajo->fecha)) }}</td>
	</tr>
	<tr>
		<td colspan="6">&nbsp;</td>
	</tr>
	<tr>
		<td colspan="6">&nbsp;</td>
	</tr>
	<tr>
		<td colspan="2" style="border-top: 1px solid #000000; width: 50% !important"><center> DIRECTOR DE DEPARTAMENTO </center></td>
		<td colspan="1"><center> &nbsp; </center></td>
		<td colspan="3" style="border-top: 1px solid #000000; width: 50% !important"><center>   APROBADO POR ACTA  Nº </center></td>
	</tr>
</table>
</div>



</body>
</html>