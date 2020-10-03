@extends('layouts.main_docente')
@section('header_content')
<style type="text/css">
    .font-small{
        font-size: 13px;
    }
    .tabla_info td{
      padding: 10px !important;
      font-size: 12px;
    }
    .tabla_info_2{
        margin-bottom: 5px;
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
	<div class="row page-titles">
    <div class="col-md-6 col-8 align-self-center">
        <h3 class="text-themecolor m-b-0 m-t-0">Plan desarrollo asignatura</h3>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a >Plan desarrollo asignatura</a></li>
            <li class="hidden-sm-down breadcrumb-item active">Vista principal</li>
        </ol>
    </div>
    <div class="col-md-6 col-4 align-self-center">
        <br>
    </div>
    </div>
@endsection
@section('content')
 <div class="row">
        <div class="col-lg-12 col-xlg-12 col-md-12">
            <div class="card">
                <div class="card-block">
                  <div class="row">
                      <div class="col-sm-9">
                          <h3><b>Plan desarrollo asignatura de {{ $asignatura->nombre }}</b></h3>
                      </div> 
                      <div class="col-sm-3" style="display: flex;">
                        <div class="btn-group">
                            <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-cog"></i>
                            </button>
                            <div class="dropdown-menu animated slideInUp" style="">
                                <a class="dropdown-item" onclick="$('#modal_cargar_existente').modal('show')" style="cursor: pointer;"><i class="fa fa-upload"></i> &nbsp;Cargar existente</a>
                                <a class="dropdown-item" onclick="exportar_google_site()" style="cursor: pointer;"><i class="fa fa-google-plus-official"></i> &nbsp;Exportar para Google Site</a>
                            </div>
                        </div>
                          @php
                              $periodos_academicos = \App\PeriodoAcademico::all();
                          @endphp
                          <select id="id_periodo_academico" class="custom-select" style="width: 100%" onchange="location.href = '/plan_desarrollo_asignatura/view/{{ $tercero->id_tercero }}/{{ $asignatura->id_asignatura }}/'+$('#id_periodo_academico').val()">
                              @foreach ($periodos_academicos as $d)
                              <option value="{{ $d->id_periodo_academico }}" @if($d->id_periodo_academico == $periodo_academico->id_periodo_academico) selected @endif > Periodo {{ $d->periodo }}</option>
                              @endforeach
                          </select>
                      </div>
                  </div><br>
                  @if(session('sugerencia_flash'))
                    <div class="alert alert-info">
                      <strong>Sugerencia de {{ session('nombre_docente_sugerencia') }}: </strong>{{ session('sugerencia_flash') }}
                    </div>
                  @endif
                <div class="row">
                  
                    <div class="col-sm-12">
                        <table class="tabla_info" width="100%" cellspacing="0" cellpadding="0" border="1">
                      <tr>
                        <td width="25%" style="background-color: #C7E6A4;"><b>APELLIDOS Y NOMBRES DEL DOCENTE</b></td>
                        <td colspan="9" width="75%">{{ $tercero->getNameFull() }}</td>
                      </tr>
                      <tr>
                        <td><b>CORREO ELECTRÓNICO </b></td>
                        <td colspan="9">{{ $tercero->email }}</td>
                      </tr>
                      <tr>
                        <td><b>PROGRAMAS USUARIOS </b></td>
                        <td colspan="9">{{ $asignatura->get_string_programas_dirigentes() }}</td>
                      </tr>
                      <tr>
                        <td><b>FACULTAD USUARIA</b></td>
                        <td colspan="9">{{ $asignatura->get_string_facultades_dirigentes() }}</td>
                      </tr>

                      <tr>
                        <td><b>ASIGNATURA:</b> {{ $asignatura->nombre }}</td>
                        <td><b>CODIGO: </b>{{ $asignatura->codigo }}</td>
                        <td><b>CREDITOS: </b>{{ $asignatura->num_creditos }}</td>
                        <td><b>TEORICO: @if($asignatura->tipo == 'teorica') X @endif</b></td>
                        <td><b>TEORICO-PRACTICO: @if($asignatura->tipo == 'teorica_practica') X @endif</b></td>
                        <td><b>HABILITABLE: @if($asignatura->habilitable == 1) X @endif</b></td>
                        <td><b>NO HABILITABLE: @if($asignatura->habilitable == 0) X @endif</b></td>
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
                        <td><b>PERIODO ACADEMICO: </b>{{ explode('-', $periodo_academico->periodo)[1] }}</td>
                        <td colspan="2"><b>FECHA DE INICIO: </b>{{ $fecha_inicio }}</td>
                        <td colspan="2"><b>TOTAL: </b>{{ $periodo_academico->total_semanas }} semanas</td>
                        <td colspan="2"><b>FECHA DE TERMINACION: </b>{{ $fecha_fin }}</td>
                      </tr>
                    </table> 
                    <table class="tabla_info" width="100%" cellspacing="0" cellpadding="0" border="1">
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
                        
                      </tbody>
                    </table>
                    <div>
                      <button class="btn btn-info pull-right" onclick="show_modal_detalle(false)"><i class="fa fa-plus"></i> Agregar semana</button>
                    </div>
                    </div>
                </div>
                <br>
                <center><button class="btn btn-info" onclick="guardar()"><i class="fa fa-save"></i>&nbsp;Guardar cambios</button>&nbsp;&nbsp;&nbsp;@if($plan_desarrollo_asignatura->id_plan_desarrollo_asignatura)<a target="_blank" href="{{ route('plan_asignatura/imprimir', $plan_desarrollo_asignatura->id_plan_desarrollo_asignatura) }}" class="btn btn-danger"><i class="fa fa-print"></i> Imprimir</a> @endif</center>
                </div>
            </div>
        </div>
</div>
<style type="text/css">
  .custom-control-label{
    font-size: 13px !important;
  }
</style>

<div class="modal fade" id="modal_detalle" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><b><div id="titulo_modal_detalle"></div></b></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <input type="hidden" id="dia_escojido">
          <input type="hidden" id="hora_escojida">
          <div class="form-group">
            <label for="recipient-name" class="col-form-label"><strong><b>Fecha de desarrollo</b></strong></label>
            <input class="form-control" type="text" id="fecha_desarrollo_semana">
          </div>
          <!--<div class="form-group">
            <label for="recipient-name" class="col-form-label"><b>Unidades</b></label><br>
            <select style="width: 100%" class="form-control" id="select_unidades" multiple="multiple">
              @foreach($plan_asignatura->unidades() as $unidad)
                <option value="{{ $unidad->id_unidad }}">{{ $unidad->nombre }}</option>
              @endforeach
            </select>
          </div>-->
          <div class="row">
            <div class="col-sm-6">
              <label class="col-form-label"><strong><b>Ejes tematicos</b></strong></label><hr>
              @foreach($plan_asignatura->unidades() as $unidad)
                <input onclick="mostrar_ejes()" type="checkbox" class="" id="unidad_{{ $unidad->id_unidad }}">
                <label class="custom-control-label" for="unidad_{{ $unidad->id_unidad }}">{{ $unidad->nombre }}</label>
                <br>
              @endforeach
            </div>
            <div class="col-sm-6">
              <label class="col-form-label"><strong><b>Temas D.directa</b></strong></label><hr>
              <div id="div_ejes">

              </div>
            </div>
          </div>
          
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" onclick="" class="btn btn-info">Guardar</button>
      </div>
    </div>
  </div>
</div>


@csrf
<script>
  var detalles = []
  var semana_actual = 0
  var fecha_inicio_semestre = '{{ date('d/m/Y', strtotime($periodo_academico->fechaInicio)) }}'
  var fecha_fin_semestre = '{{ date('d/m/Y', strtotime($periodo_academico->fechaFin)) }}'
  var ejes_escojidos_tmp = []
  var unidades = []

  $(document).ready(function(){
     inicializar_unidades()
      $('#fecha_desarrollo_semana').daterangepicker({
          autoApply: true,
          autoUpdateInput: true,
          minDate: fecha_inicio_semestre,
          maxDate: fecha_fin_semestre,
          locale: {
            format: 'DD/MM/YYYY',
            cancelLabel: 'Clear'
          }
    });
  })
  function show_modal_detalle(editar) {
    if(editar){

    }else{
      semana_actual = detalles.length + 1
      this.buscar_fecha_sugerida(semana_actual)
    }
    $("#titulo_modal_detalle").html("Desarrollo en semana "+semana_actual)
    $("#modal_detalle").modal('show')
  }

  function buscar_fecha_sugerida(semana) {
    let saltarse_domingo = 1
    let fecha = ""
    if(semana = 1){
      //es la primera semana
      saltarse_domingo = 0
      fecha = '{{ date('Y-m-d', strtotime($periodo_academico->fechaInicio)) }}'
    }else{
      //buscamos la ultima fecha fin de los detalles registrados
    }
    let _token = ""
    $("[name='_token']").each(function() { _token = this.value })
    let url = '{{ route('plan_desarrollo_asignatura/obtener_fecha_sugerida') }}'
    let data = {
      '_token' : _token,
      'fecha' : fecha,
      'saltarse_domingo' : saltarse_domingo
    }
    $.post(url, data, (response) => {
      $('#fecha_desarrollo_semana').data('daterangepicker').setStartDate(response.fecha_inicio);
      $('#fecha_desarrollo_semana').data('daterangepicker').setEndDate(response.fecha_fin);
    })
  }

  function mostrar_ejes() {
    $("#div_ejes").html("<center><i>Actualizando...</i></center>")
    let ejes = ""
    this.unidades.forEach((unidad) => {
      if($("#unidad_"+unidad.id_unidad).prop('checked')){
        ejes += '<b>'+unidad.numero+'. '+unidad.nombre+'</b><br>'
        unidad.ejes.forEach((eje) => {
          let checked = ""
          var busqueda = eje_esta_escojido(eje.id_eje)
          if(busqueda) checked = "checked"
          ejes += '<input '+checked+' onclick="escojer_eje('+eje.id_eje+')" type="checkbox" id="eje_'+eje.id_eje+'"> '+
                  ' <label class="custom-control-label" for="eje_'+eje.id_eje+'">'+eje.nombre+'</label>'+
                  '<br>'
        })
        ejes += '<br>'
      }
    })
    $("#div_ejes").html(ejes)
  }

  function escojer_eje(id_eje) {
    if($("#eje_"+id_eje).prop('checked')){
      //si esta chekeado significa que lo quiere guardar
      this.ejes_escojidos_tmp.push(id_eje)
    }else{
      //quiere eliminarlo de los escojidos
      let posicion = this.ejes_escojidos_tmp.indexOf(id_eje);
      this.ejes_escojidos_tmp.splice(posicion, 1)
    }
    console.log(this.ejes_escojidos_tmp)
  }

  function eje_esta_escojido(id_eje) {
    console.log("se averiguo si esta escojido el id_eje = "+id_eje)
    let posicion = this.ejes_escojidos_tmp.indexOf(parseInt(id_eje));
    console.log("la posicion encontrada fue "+posicion)
    if(posicion != -1) return true 
    return false;
  }

  function inicializar_unidades() {
    let unidad = {
      'id_unidad' : '',
      'nombre' : '',
      'numero' : '',
      'ejes' : []
    }
    let cont_unidades = 1
    @foreach($plan_asignatura->unidades() as $unidad)
        unidad.id_unidad = '{{ $unidad->id_unidad }}'
        unidad.nombre = '{{ $unidad->nombre }}'
        unidad.numero = cont_unidades
        @foreach($unidad->ejes as $eje)
            unidad.ejes.push({
              'id_eje' : '{{ $eje->id_eje_tematico }}',
              'nombre' : '{{ $eje->nombre }}'
            })
        @endforeach
        this.unidades.push(unidad)
        unidad = {
          'id_unidad' : '',
          'nombre' : '',
          'numero' : '',
          'ejes' : []
        }
        cont_unidades++
    @endforeach
    console.log(this.unidades)
  }
  
</script>

            
@endsection

