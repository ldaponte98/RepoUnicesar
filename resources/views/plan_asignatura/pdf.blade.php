<!DOCTYPE html>
<html>
<head>
	<title>Informe Plan Asignatura</title>
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
				  <td rowspan="1" style="font-size: 11px; padding-left: 5px;">CODIGO: 201-300-PRO05-FOR01</td>
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
		margin: 3px !important;
	}
  h3{
    font-weight: normal;
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
		padding-left: 5px !important;
		padding-top: 3px !important;
		padding-bottom: 3px !important;
		font-size: 13px;
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

	.title{
		background-color: #38A970; 
		padding-top:10px !important; 
		padding-bottom:10px !important;
		font-size: 16px !important;
	}

</style>

<br>
@php
	$licencia = \App\Licencia::find(session('id_licencia'));
@endphp

<style type="text/css">
    .font-small{
        font-size: 13px;
    }
    .tabla_info td{
      padding: 3px !important;
    }
    .tabla_info_2 th{
        background-color: #C2D69B;
        padding: 7px !important;
        font-size: 12px;
        font-weight: bold;
    }
    .tabla_info_2 td{
      padding: 10px !important;
      font-size: 12px;
    }
</style>


<table class="tabla_1" width="100%" cellspacing="0" cellpadding="0" border="1">
	 					<tr>
                          <td colspan="10" class="title">
                              <center><b>IDENTIFICACIÓN <a style="cursor: pointer;" data-toggle="popover" title="Información" data-content="Mencione las competencias genéricas que esta asignatura ayudará en la formación de los estudiantes, en concordancia con el PEI y el programa curricular. Estas competencias deben estar enfocadas al desarrollo del ser (axiológico, social, estético)."><i class="fa fa-info-circle"></i></a>
                                </b></center>
                          </td>
                      </tr>
                      <tr>
                        <td width="25%"><b>Programa académico </b></td>
                        <td colspan="9" width="75%">{{ $asignatura->licencia->nombre }}</td>
                      </tr>
                      <tr>
                        <td><b>Nombre de la asignatura </b></td>
                        <td colspan="9">{{ $asignatura->nombre }}</td>
                      </tr>
                      <tr>
                        <td><b>Código de la asignatura </b></td>
                        <td colspan="9">{{ $asignatura->codigo }}</td>
                      </tr>
                      <tr>
                        <td><b>Créditos académicos </b></td>
                        <td colspan="9">{{ $asignatura->num_creditos }}</td>
                      </tr>
                      <tr>
                        <td rowspan="2"><center><b>Horas de trabajo semestral del estudiante</b></center></td>
                        <td style="background-color: #EAF1DD;" colspan="5" ><center><b style="font-size: 12px;">Horas con acompañamiento docente</b></center></td>
                        <td style="background-color: #EAF1DD;" rowspan="2"><center><b>HTI</b></center></td>
                        <td rowspan="2"><center>{{ $asignatura->horas_totales_trabajo_independiente }}</center></td>
                        <td style="background-color: #EAF1DD;" rowspan="2"><center><b>HTT</b></center></td>
                        <td rowspan="2"><center>{{ $asignatura->horas_totales_semestre }}</center></td>
                      </tr>
                      <tr>
                        <td style="background-color: #EAF1DD;" ><center><b>HDD</b></center></td>
                        <td style="" ><center>{{ $asignatura->horas_teoricas }}</center></td>
                        <td style="background-color: #EAF1DD;" ><center><b>HTP</b></center></td>
                        <td colspan="2" ><center>{{ $asignatura->horas_practicas }}</center></td>
                      </tr>
                      <tr>
                        <td><b>Prerrequisitos </b></td>
                        <td colspan="9">{{ $asignatura->prerrequisitos }}</td>
                      </tr>
                      <tr>
                        <td><b>Correquisitos </b></td>
                        <td colspan="9">{{ $asignatura->correquisitos }}</td>
                      </tr>
                      <tr>
                        <td><b>Departamento oferente </b></td>
                        <td colspan="9">Departamento de {{ strtolower($asignatura->licencia->nombre) }}</td>
                      </tr>
                      <tr>
                        <td><b>Tipo de asignatura </b></td>
                        <td colspan="2" style="background-color: #EAF1DD;">Teórica</td> 
                        <td><center>@if($asignatura->tipo == 'teorica') <b>X</b> @endif</center></td>
                        <td colspan="2" style="background-color: #EAF1DD;">Teórico práctica:</td> 
                        <td><center>@if($asignatura->tipo == 'teorica_practica') <b>X</b> @endif</center></td>
                        <td style="background-color: #EAF1DD;">Práctica</td> 
                        <td colspan="2"><center>@if($asignatura->tipo == 'practica') <b>X</b> @endif</center></td>
                      </tr>
                      <tr>
                          <td rowspan="3"><b>Naturaleza de la asignatura</b></td>
                          <td colspan="2">Habilitable</td>
                          <td colspan="1">@if($asignatura->habilitable == 1) <center><b>X</b></center> @endif</td>
                          <td colspan="3">No habilitable</td>
                          <td colspan="3">@if($asignatura->habilitable == 0) <center><b>X</b></center> @endif</td>
                      </tr>
                      <tr>
                          <td colspan="2">Validable</td>
                          <td colspan="1">@if($asignatura->validable == 1) <center><b>X</b></center> @endif</td>
                          <td colspan="3">No validable</td>
                          <td colspan="3">@if($asignatura->validable == 0) <center><b>X</b></center> @endif</td>
                      </tr>
                      <tr>
                          <td colspan="2">Homologable</td>
                          <td colspan="1">@if($asignatura->homologable == 1) <center><b>X</b></center> @endif</td>
                          <td colspan="3">No homologable</td>
                          <td colspan="3">@if($asignatura->homologable == 0) <center><b>X</b></center> @endif</td>
                      </tr>
                      <tr>
                          <td colspan="10" class="title">
                              <center><b>DESCRIPCIÓN DE LA ASIGNATURA</b></center>
                          </td>
                      </tr>
                      <tr>
                          <td colspan="10">
                              @php
                                echo $plan_asignatura->descripcion_asignatura;
                              @endphp  
                          </td>
                      </tr>
                      <tr>
                          <td colspan="10" class="title">
                              <center><b>OBJETIVO GENERAL </b></center>
                          </td>
                      </tr>
                      <tr>
                          <td colspan="10">
                              @php
                                echo $plan_asignatura->objetivo_general;
                              @endphp
                          </td>
                      </tr>
                      <tr>
                          <td colspan="10" class="title">
                              <center><b>OBJETIVOS ESPECÍFICOS <a style="cursor: pointer;" data-toggle="popover" title="Información" data-content="Declarar los objetivos específicos en términos de logros que, al ser desarrollados gradualmente, den cumplimiento al objetivo general y deben impactar su alcance. Los objetivos deben ser aplicables, verificables, medibles y alcanzables."><i class="fa fa-info-circle"></i></a>
                                </b></center>
                          </td>
                      </tr>
                      <tr>
                          <td colspan="10">
                              @php
                                echo $plan_asignatura->objetivos_especificos;
                              @endphp
                          </td>
                      </tr>

                      <tr>
                          <td colspan="10" class="title">
                              <center><b>ESTRATEGIAS PEDAGÓGICAS Y METODÓLOGICAS <a style="cursor: pointer;" data-toggle="popover" title="Información" data-content="Escriba las estrategias pedagógicas, metodológicas y didácticas que empleará para lograr los resultados de aprendizaje propuestos. Las estrategias deben estar en coherencia con el modelo pedagógico Institucional “Cognitivo contextual de corte constructivista”."><i class="fa fa-info-circle"></i></a>
                                </b></center>
                          </td>
                      </tr>
                      <tr>
                         <td colspan="10">
                              @php
                                echo $plan_asignatura->estrategias_pedagogicas;
                              @endphp
                          </td>
                      </tr>

                      <tr>
                          <td colspan="10" class="title">
                              <center><b>COMPETENCIAS GENÉRICAS <a style="cursor: pointer;" data-toggle="popover" title="Información" data-content="Mencione las competencias genéricas que esta asignatura ayudará en la formación de los estudiantes, en concordancia con el PEI y el programa curricular. Estas competencias deben estar enfocadas al desarrollo del ser (axiológico, social, estético)."><i class="fa fa-info-circle"></i></a>
                                </b></center>
                          </td>
                      </tr>
                      <tr>
                          <td colspan="10">
                              @php
                                echo $plan_asignatura->competencias_genericas;
                              @endphp
                          </td>
                      </tr>

                      
                      <tr>
                          <td colspan="10" class="title">
                              <center><b>CONTENIDOS, COMPETENCIAS ESPECÍFICAS Y RESULTADOS DE APRENDIZAJE </b></center>
                          </td>
                      </tr>
                      <tr>
                          <td style="padding: 0px !important" colspan="10">
                        <table class="tabla_info_2" style="" width="100%" cellspacing="0" cellpadding="0" border="1">
                                 <thead>
                                     <tr>
                                         <th rowspan="2"><center>Unidad Tematica</center></th>
                                         <th rowspan="2"><center>Competencias especificas</center></th>
                                         <th rowspan="2"><center>Resultados de aprendizaje</center></th>
                                         <th colspan="2"><center>Horas presenciales</center></th>
                                         <th rowspan="2"><center>HTI</center></th>
                                         <th rowspan="2"><center>HTT</center></th>
                                     </tr>
                                     <tr>
                                         <th><center>HDD</center></th>
                                         <th><center>HTP</center></th>
                                     </tr>
                                 </thead>
                                  <tbody id="tabla_unidades">
                                  	@foreach($plan_asignatura->unidades() as $unidad)
                   						<tr>
                                  <td>{{ $unidad->nombre }}</td>
                                  <td>
                   					@foreach($unidad->ejes as $eje)
                      					<li style="margin-left: 5px;">{{ $eje->nombre }}</li>
                   					@endforeach
	                              </td>
                                  <td>{{ $unidad->resultados_aprendizaje }}</td>
                                  <td><center>{{ $unidad->horas_hdd }}</center></td>
                                  <td><center>{{ $unidad->horas_htp }}</center></td>
                                  <td><center>{{ $unidad->horas_hti }}</center></td>
                                  <td><center>{{ $unidad->horas_htt }}</center></td>
                                </tr>
                                @endforeach
                                  </tbody>
                              </table>
                          </td>
                      </tr>

                      <tr>
                          <td colspan="10" class="title">
                              <center><b>MECANISMOS DE EVALUACIÓN <a style="cursor: pointer;" data-toggle="popover" title="Información" data-content="Describir los mecanismos efectivos de seguimiento, evaluación y análisis de los resultados de aprendizaje, de tal manera que se articulen de forma planificada y coherente con el proceso formativo, las actividades académicas, el nivel de formación y el o las modalidades en las cuales se ofrecerá el programa. Estos mecanismos de evaluación deben estar en concordancia con la normatividad institucional, deben quedar claros los porcentajes y todo aquello que es sujeto de valoración."><i class="fa fa-info-circle"></i></a>
                                </b></center>
                          </td>
                      </tr>
                      <tr>
                          <td colspan="10">
                              @php
                                echo $plan_asignatura->mecanismos_evaluacion;
                              @endphp
                          </td>
                      </tr>

                       <tr>
                          <td colspan="10" class="title">
                              <center><b>REFERENCIAS BIBLIOGRÁFICAS <a style="cursor: pointer;" data-toggle="popover" title="Información" data-content="Escriba la bibliografía actualizada y necesaria para el desarrollo de la asignatura, disponibles en medio físico y en las bases de datos con la que cuenta la Institución. Observación: se recomienda el uso de las bases de datos por ser un recurso abierto con contenidos altamente significativos y actualizados."><i class="fa fa-info-circle"></i></a>
                                </b></center>
                          </td>
                      </tr>
                      <tr>
                          <td colspan="10">
                              @php
                                echo $plan_asignatura->referencias_bibliograficas;
                              @endphp
                          </td>
                      </tr>
                    </table> 


</body>
</html>