<!DOCTYPE html>
<html>
<head>

	<title>Informe Plan Desarrollo Asignatura</title>
	<style>
		.page-break {
		    page-break-after: always;
		}
		*{
			font-family:'Helvetica','Verdana','Monaco',sans-serif;
		}
		
	</style>
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
</head>
<body>
	   <center>
			<table border="1" cellpadding="0" cellspacing="0" width="100%">
				 <tr>
				  <td rowspan="3"><center><img width="50px" height="50px" src="Imagenes/iconoupc.png"></center></td>
				  <td rowspan="2" colspan="4" style="padding-top: 8px; padding-bottom: 8px;"><center><b>UNIVERSIDAD POPULAR DEL CESAR</b></center></td>
				  <td rowspan="1" style="font-size: 11px; padding-left: 5px;">CODIGO: 201-300-PRO05-FOR02</td>
				 </tr>
				 <tr>
				  <td rowspan="1" style="font-size: 11px; padding-left: 5px;">VERSIÓN: 1</td> 
				 </tr>
				 <tr>
				  <td rowspan="1" colspan="4" style="font-size: 14px">
				  <center >
				  	<div style="margin-top: 10px">
				  PLAN DESARROLLO ASIGNATURA
				  	</div>
				  </center></td>
				  <td rowspan="1" style="font-size: 11px; padding-left: 5px;" >Pagina 1 de 1</td>
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
                        <td width="25%" style="background-color: #C7E6A4;"><b>APELLIDOS Y NOMBRES DEL DOCENTE</b></td>
                        <td colspan="7" width="75%">{{ $tercero->getNameFull() }}</td>
                      </tr>
                      <tr>
                        <td><b>CORREO ELECTRÓNICO </b></td>
                        <td colspan="7">{{ $tercero->email }}</td>
                      </tr>
                      <tr>
                        <td><b>PROGRAMAS USUARIOS </b></td>
                        <td colspan="7">{{ $asignatura->get_string_programas_dirigentes() }}</td>
                      </tr>
                      <tr>
                        <td><b>FACULTAD USUARIA</b></td>
                        <td colspan="7">{{ $asignatura->get_string_facultades_dirigentes() }}</td>
                      </tr>

                      <tr>
                        <td><b>ASIGNATURA:</b> {{ $asignatura->nombre }}</td>
                        <td><b>CODIGO: </b>{{ $asignatura->codigo }}</td>
                        <td><b>CREDITOS: </b>{{ $asignatura->num_creditos }}</td>
                        <td><b>TEORICO: @if($asignatura->tipo == 'teorica') X @endif</b></td>
                        <td><b>TEORICO-PRACTICO: @if($asignatura->tipo == 'teorica_practica') X @endif</b></td>
                        <td><b>HABILITABLE: @if($asignatura->habilitable == 1) X @endif</b></td>
                        <td colspan="2"><b>NO HABILITABLE: @if($asignatura->habilitable == 0) X @endif</b></td>
                      </tr>
                      @php
                        $meses = [
                          '01' => 'enero', 
                          '02' => 'febrero', 
                          '03' => 'marzo',
                          '04' => 'abril',
                          '05' => 'mayo',
                          '06' => 'junio',
                          '07' => 'julio',
                          '08' => 'agosto',
                          '09' => 'septiembre',
                          '10' => 'octubre',
                          '11' => 'noviembre',
                          '12' => 'diciembre'
                        ];
                        setlocale(LC_ALL,"es_ES");
                        $mes = $meses[date('m', strtotime($periodo_academico->fechaInicio))];
                        $fecha_inicio = date('d', strtotime($periodo_academico->fechaInicio)). " de ".$mes." del ".date('Y', strtotime($periodo_academico->fechaInicio));

                        $mes = $meses[date('m', strtotime($periodo_academico->fechaFin))];
                        $fecha_fin = date('d', strtotime($periodo_academico->fechaFin)). " de ".$mes." del ".date('Y', strtotime($periodo_academico->fechaFin));
                      @endphp
                      <tr>
                        <td><b>AÑO LECTIVO: </b>{{ explode('-', $periodo_academico->periodo)[0] }}</td>
                        <td colspan="2"><b>PERIODO ACADEMICO: </b>{{ explode('-', $periodo_academico->periodo)[1] }}</td>
                        <td colspan="2"><b>FECHA DE INICIO: </b>{{ $fecha_inicio }}</td>
                        <td ><b>TOTAL: </b>{{ $periodo_academico->total_semanas }} semanas</td>
                        <td colspan="2"><b>FECHA DE TERMINACION: </b>{{ $fecha_fin }}</td>
                      </tr>
                    </table> 
<table class="tabla_1" width="100%" cellspacing="0" cellpadding="0" border="1">
  <thead>
  <tr>
    <td width="10%" style="background-color: #C7E6A4;"><center><b>SEMANA</center></b></td>
    <td width="15%" style="background-color: #C7E6A4;"><center><b>EJES TEMÁTICOS</center></b></td>
    <td style="background-color: #C7E6A4;"><center><b>TEMAS DOCENCIA DIRECTA</center></b></td>
    <td style="background-color: #C7E6A4;"><center><b>TEMAS TRABAJO INDEPENDIENTE</center></b></td>
    <td style="background-color: #C7E6A4;"><center><b>ESTRATEGIAS METODOLÓGICAS O ACCIONES PEDAGÓGICAS</center></b></td>
    <td style="background-color: #C7E6A4;"><center><b>COMPETENCIAS</center></b></td>
    <td style="background-color: #C7E6A4;"><center><b>EVALUACIÓN ACADÉMICA</center></b></td>
    <td style="background-color: #C7E6A4;"><center><b>BIBLIOGRAFÍA (capítulos, páginas)</center></b></td>
  </tr>
  </thead>
  <tbody id="tabla_detalles">
    @php
      $cont_detalles = 1;
      $cont_unidades = 1;
      $cont_ejes = 1;
    @endphp
    @foreach($plan_desarrollo_asignatura->detalles as $detalle)
      <tr class='tr_tabla'>
          <td><center><b>{{ $detalle->semana }}</b><br>{{ $detalle->texto_fecha() }}</center></td>
          @if($detalle->is_semana_parciales)
          <td><center><b>
            @php 
                    echo $detalle->titulo_semana_parciales; 
            @endphp</b></center></td>
          @else
          <td>
          @php
            $ejes = "";
          @endphp
          @foreach($detalle->unidades as $unidad_desarrollo)
          <center><b> Unidad No {{ $detalle->numero_unidad($unidad_desarrollo->id_unidad_asignatura) }}</b></center>
          <center>@php echo $unidad_desarrollo->unidad->nombre; @endphp</center><br><br>

                   @foreach($unidad_desarrollo->ejes as $eje_desarrollo)
                     @php 
                        $ejes .= "<b>".$detalle->numero_unidad($unidad_desarrollo->id_unidad_asignatura).".".$detalle->numero_eje($eje_desarrollo->id_eje_tematico)."</b> ".$eje_desarrollo->eje->nombre."<br><br>";
                     @endphp
                    
                   @endforeach
          @endforeach
          </td>
          @endif
          <td>
            @php 
              echo $ejes; 
              $ejes = "";
            @endphp
          </td>
           <td> @php echo $detalle->temas_trabajo_independiente; @endphp </td>
           <td> @php echo $detalle->estrategias_metodologicas; @endphp </td>
           <td> @php echo $detalle->competencias; @endphp </td>
           <td> @php echo $detalle->evaluacion_academica; @endphp </td>
           <td> @php echo $detalle->bibliografia; @endphp </td>
          
    </tr>
    @endforeach
  </tbody>
</table>

</body>
</html>