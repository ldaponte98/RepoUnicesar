@extends((session("is_admin") == true ? 'layouts.main' : 'layouts.main_docente'))@section('header_content')
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
    hr {
      margin-top: 0 !important;
      margin-bottom: 15px !important;
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
@php
  $puede_editar = $plan_desarrollo_asignatura->puede_editar();
@endphp
 <div class="row">
        <div class="col-lg-12 col-xlg-12 col-md-12">
            <div class="card">
                <div class="card-block">
                  <!--<div class="alert alert-info">
                    Formato en proceso de desarrollo
                  </div>-->
                  @if(session('is_docente') and !$puede_editar)
                    <div class="alert alert-warning" id="msg_alert">
                      <strong>No esta dentro de las fechas validas para modificar este formato.</strong>
                    </div>
                    <script type="text/javascript">
                      setTimeout(()=>{$("#msg_alert").fadeOut()},8000)
                    </script>
                  @endif  
                  @if($plan_desarrollo_asignatura->estado == "Enviado" and session('is_docente'))
                  <div class="alert alert-info">
                        Formato <strong>Enviado</strong>, ultima actualización {{ date('d-m-Y',strtotime($plan_desarrollo_asignatura->updated_at)) }} {{ date('H:i',strtotime($plan_desarrollo_asignatura->updated_at)) }}
                  </div>
                  @endif
                  @if($plan_desarrollo_asignatura->estado == "Recibido" and session('is_docente'))
                  <div class="alert alert-success">
                        Formato <strong>Recibido</strong> por jefe de departamento, ultima actualización {{ date('d-m-Y',strtotime($plan_desarrollo_asignatura->updated_at)) }} {{ date('H:i',strtotime($plan_desarrollo_asignatura->updated_at)) }}
                  </div>
                  @endif
                   @if($plan_desarrollo_asignatura->estado == "Pendiente" and session('is_docente'))
                  <div class="alert alert-warning">
                        Formato <strong>Pendiente</strong>, no se ha enviado ningun registro de este formato en este periodo academico. 
                  </div>
                  @endif
                  <div class="row">
                      <div class="col-sm-9">
                          <h3><b>Plan desarrollo asignatura de {{ $asignatura->nombre }}</b></h3>
                      </div> 
                      <div class="col-sm-3" style="display: flex;">
                        @if(session('is_docente') == true)
                        <div class="btn-group">
                            <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-cog"></i>
                            </button>
                            
                              <div class="dropdown-menu animated slideInUp" style="">
                                 @if($puede_editar) <a class="dropdown-item" onclick="$('#modal_cargar_existente').modal('show')" style="cursor: pointer;"><i class="fa fa-upload"></i> &nbsp;Cargar existente</a> @endif
                                  <a class="dropdown-item" onclick="exportar_google_site()" style="cursor: pointer;"><i class="fa fa-google-plus-official"></i> &nbsp;Exportar para Google Site</a>
                              </div>
                           
                        </div>
                         @endif
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
                        <table class="tabla_info table-responsive" width="100%" cellspacing="0" cellpadding="0" border="1">
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
                    <table class="tabla_info table-responsive" width="100%" cellspacing="0" cellpadding="0" border="1">
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
                      @if($puede_editar)
                        <button id="btn_agregar_semana" class="btn btn-info pull-right" onclick="show_modal_detalle(false)"><i class="fa fa-plus"></i> Agregar semana</button>
                      @endif

                    </div>
                   
                   </div>
                </div>
                <br>
                 

                <center>@if($puede_editar) <button class="btn btn-info" onclick="guardar()"><i class="fa fa-save"></i>&nbsp;Guardar cambios</button>&nbsp;&nbsp;&nbsp; @endif  @if($plan_desarrollo_asignatura->id_plan_desarrollo_asignatura)<a target="_blank" href="{{ route('plan_desarrollo_asignatura/imprimir', $plan_desarrollo_asignatura->id_plan_desarrollo_asignatura) }}" class="btn btn-danger"><i class="fa fa-print"></i> Imprimir</a> @endif</center>
                <br>
                
                
                </div>

                <div class="modal fade"  data-focus="false" id="modal_detalle" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
          <div class="row">
            <div class="col-sm-6">
              <div class="form-group">
                <label for="recipient-name" class="col-form-label"><strong><b>Fecha de desarrollo</b></strong></label>
                <input class="form-control" type="text" id="fecha_desarrollo_semana">
              </div>
            </div>
            <div class="col-sm-6" style="padding-top: 37px !important;">
              <input  onclick="escojer_semana_parciales()" type="checkbox" id="semana_parciales">
              <label class="col-form-label" for="semana_parciales"><strong><b>Es semana de parciales</b></strong></label>
            </div>
          </div>
          
          <!--<div class="form-group">
            <label for="recipient-name" class="col-form-label"><b>Unidades</b></label><br>
            <select style="width: 100%" class="form-control" id="select_unidades" multiple="multiple">
              @foreach($plan_asignatura->unidades() as $unidad)
                <option value="{{ $unidad->id_unidad }}">{{ $unidad->nombre }}</option>
              @endforeach
            </select>
          </div>-->
          
          <div class="row" id="div_unidades_ejes">
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
          <div class="form-group" id="div_semana_parciales" style="display: none;">
            <label for="recipient-name" class="col-form-label"><strong><b>Titulo o enunciado para semana</b></strong></label><br>
            <textarea id="titulo_semana_parciales"></textarea>
          </div>

          <div class="form-group">
            <label for="recipient-name" class="col-form-label"><strong><b>Temas de trabajo independiente</b></strong></label><br>
            <textarea id="temas_trabajo"></textarea>
          </div>

          <div class="form-group">
            <label for="recipient-name" class="col-form-label"><strong><b>Estrategias metodológicas o acciones pedagógicas</b></strong></label><br>
            <textarea id="estrategias_metodologicas"></textarea>
          </div>

          <div class="form-group">
            <label for="recipient-name" class="col-form-label"><strong><b>Competencias</b></strong></label><br>
            <textarea id="competencias"></textarea>
          </div>

          <div class="form-group">
            <label for="recipient-name" class="col-form-label"><strong><b>Evaluación académica</b></strong></label><br>
            <textarea id="evaluacion_academica"></textarea>
          </div>

          <div class="form-group">
            <label for="recipient-name" class="col-form-label"><strong><b>Bibliografía (capítulos, páginas)</b></strong></label><br>
            <textarea id="bibliografia"></textarea>
          </div>
          
          
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        @if($puede_editar)
          <button type="button" id="btn_eliminar_detalle" onclick="eliminar_detalle()" class="btn btn-danger">Eliminar</button>
          <button type="button" onclick="agregar_semana()" class="btn btn-info">Guardar</button>
        @endif

        
      
      </div>
    </div>
  </div>
</div>


            </div>
        </div>
</div>


<div class="modal fade" id="modal_cargar_existente" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title">Carga de plan de desarrollo asignatura existente</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                      <div class="form-group" >
                        <input type="hidden" id="tipo_detalle">
                        <label for="recipient-name" class="col-form-label">Escoje el periodo academico del plan de desarrollo asignatura que desea cargar.</label>
                          @php
                            $periodos_academicos = \App\PeriodoAcademico::all();
                          @endphp
                          <select id="id_periodo_academico_carga_existente" class="custom-select" style="width: 100%" >
                               <option value="">Seleccione...</option>
                                @foreach ($periodos_academicos as $d)
                                @if($d->id_periodo_academico != $periodo_academico->id_periodo_academico)  
                                <option value="{{ $d->id_periodo_academico }}"  > Periodo {{ $d->periodo }}</option>
                                @endif
                                @endforeach
                          </select>
                      </div>
                      
                  </div>
                  <div class="modal-footer">
                    <button type="button" onclick="if($('#id_periodo_academico_carga_existente').val()){ window.open('/plan_desarrollo_asignatura/view/{{ $tercero->id_tercero }}/{{ $asignatura->id_asignatura }}/'+$('#id_periodo_academico_carga_existente').val(), '_blank')} else{ alert('Es necesario que seleccione el periodo academico.')}" class="btn btn-warning">Vista previa</button>
                    <button type="button" onclick="cargar_plan_existente()" class="btn btn-info">Cargar</button>
                  </div>
                </div>
              </div>
        </div>
<style type="text/css">
  .custom-control-label{
    font-size: 13px !important;
  }
  b, strong {
    font-weight: bold !important;
  }

  .tr_tabla:hover{
    cursor: pointer;
    background-color: #daf7a675;
  }
</style>
@csrf
<script>
  var detalles = []
  var semana_actual = 0
  var fecha_inicio_semestre = '{{ date('d/m/Y', strtotime($periodo_academico->fechaInicio)) }}'
  var fecha_fin_semestre = '{{ date('d/m/Y', strtotime($periodo_academico->fechaFin." +30 days")) }}'
  var ejes_escojidos_tmp = []
  var unidades = []
  var editor_temas_trabajo = null;
  var editor_estrategias_metodologicas = null
  var editor_competencias = null
  var editor_evaluacion_academica = null
  var editor_bibliografia = null
  var editor_titulo_semana_parciales = null

  var posicion_detalle_editar = -1
              

  $(document).ready(function(){

     inicializar_unidades()
     inicializar_editores()
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
      cargar_informacion_plan_desarrollo()
  })

  function escojer_semana_parciales() {
    if($("#semana_parciales").prop("checked")){
      $("#div_unidades_ejes").fadeOut()
      $("#div_semana_parciales").fadeIn()
    }else{
      $("#div_unidades_ejes").fadeIn()
      $("#div_semana_parciales").fadeOut()
    }
  }
  function pintar_datos_editar() {
    limpiar_modal()

    var detalle = this.detalles[posicion_detalle_editar]
    this.semana_actual = detalle.semana
    if(detalle.puede_eliminar) $("#btn_eliminar_detalle").fadeIn()
    $("#titulo_modal_detalle").html("Modificacion en semana "+detalle.semana)
    $("#fecha_desarrollo_semana").data('daterangepicker').setStartDate(detalle.fecha_inicio);
    $("#fecha_desarrollo_semana").data('daterangepicker').setEndDate(detalle.fecha_fin);
    if(detalle.semana_parciales){
      $("#div_unidades_ejes").fadeOut()
      $("#div_semana_parciales").fadeIn()
      $("#semana_parciales").prop("checked", true)
      this.editor_titulo_semana_parciales.setData(detalle.titulo_semana_parciales)
    }else{
      $("#div_unidades_ejes").fadeIn()
      $("#div_semana_parciales").fadeOut()
      this.ejes_escojidos_tmp = []
      detalle.unidades_escojidas.forEach((unidad) => {
        $("#unidad_"+unidad.id_unidad).prop('checked', true)
          unidad.ejes.forEach((eje) => {
            this.ejes_escojidos_tmp.push(parseInt(eje.id_eje))
          })
      })
      mostrar_ejes()
    }
    this.editor_temas_trabajo.setData(detalle.temas_trabajo)
    this.editor_estrategias_metodologicas.setData(detalle.estrategias_metodologicas)
    this.editor_competencias.setData(detalle.competencias)
    this.editor_evaluacion_academica.setData(detalle.evaluacion_academica)
    this.editor_bibliografia.setData(detalle.bibliografia)
    this.editor_titulo_semana_parciales.setData(detalle.titulo_semana_parciales)
  }

  function show_modal_detalle(editar) {
    limpiar_modal()
    if(editar){
      this.pintar_datos_editar()
    }else{
      $("#btn_eliminar_detalle").fadeOut()
      posicion_detalle_editar = -1
      semana_actual = detalles.length + 1
      this.buscar_fecha_sugerida(semana_actual)
      $("#titulo_modal_detalle").html("Desarrollo en semana "+semana_actual)
    }
    
    $("#modal_detalle").modal('show')
  }

  function buscar_fecha_sugerida(semana) {
    let saltarse_domingo = 1
    let fecha = ""

    if(semana == 1){
      //es la primera semana
      saltarse_domingo = 0
      fecha = '{{ date('Y-m-d', strtotime($periodo_academico->fechaInicio)) }}'
    }else{
      //buscamos la ultima fecha fin de los detalles registrados
      fecha = this.buscar_ultima_fecha()
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

  function buscar_ultima_fecha() {
    let detalle = this.detalles[detalles.length - 1]
    let ultima_fecha = detalle.fecha_fin
    return ultima_fecha.split("/").reverse().join("-")
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
  }

  function eje_esta_escojido(id_eje) {
    let posicion = this.ejes_escojidos_tmp.indexOf(parseInt(id_eje));
    if(posicion != -1) return true 
    return false;
  }


  function agregar_semana() {
  //
    let semana_parciales = false
    if($("#semana_parciales").prop('checked')){
      semana_parciales = true
    }
    let unidades_escojidas = [];
    if(!semana_parciales){
      let validar_unidades_escojidas = obtener_unidades_ejes_escojidos()
      if(validar_unidades_escojidas.error) return false

      unidades_escojidas = validar_unidades_escojidas.result;
    }else{
      if(editor_titulo_semana_parciales.getData().replace(/&nbsp;/gi,' ').trim() == "") {alert("Debe suministrar el titulo o enunciado del parcial de la semana."); return false}
    }
    
    

    let detalle = {
      'id_detalle' : null,
      'puede_eliminar' : true,
      'semana' : semana_actual,
      'fecha_inicio' : $('#fecha_desarrollo_semana').val().split(' - ')[0],
      'fecha_fin' : $('#fecha_desarrollo_semana').val().split(' - ')[1],
      'unidades_escojidas' : unidades_escojidas,
      'temas_trabajo' : editor_temas_trabajo.getData().replace(/&nbsp;/gi,' '),
      'estrategias_metodologicas' : editor_estrategias_metodologicas.getData().replace(/&nbsp;/gi,' '),
      'competencias' : editor_competencias.getData().replace(/&nbsp;/gi,' '),
      'evaluacion_academica' : editor_evaluacion_academica.getData().replace(/&nbsp;/gi,' '),
      'bibliografia' : editor_bibliografia.getData().replace(/&nbsp;/gi,' '),
      'semana_parciales' : semana_parciales,
      'titulo_semana_parciales' : editor_titulo_semana_parciales.getData().replace(/&nbsp;/gi,' '),
    }

    if(posicion_detalle_editar == -1){
      this.detalles.push(detalle)
    }else{
      this.detalles.splice(posicion_detalle_editar, 1, detalle)
    }
    
    $("#modal_detalle").modal('hide')
    limpiar_modal()
    actualizar_tabla()
  }

  function eliminar_detalle() {
    let r = confirm("Seguro desea eliminar esta semana del plan de desarrollo?");
    if(r){
      let detalles_tmp = []
      this.detalles.forEach((detalle) => {
        detalles_tmp.push(detalle)
      })
      console.log(detalles_tmp)
      this.detalles.splice(posicion_detalle_editar, 1);
      //se actualizan las semanas
      let cont = 0
      console.log(detalles_tmp)
      detalles_tmp.forEach((detalle_tmp) => {
        if(cont < this.detalles.length){
          let detalle = this.detalles[cont]
          detalle.semana = detalle_tmp.semana
          detalle.fecha_inicio = detalle_tmp.fecha_inicio
          detalle.fecha_fin = detalle_tmp.fecha_fin
          this.detalles.splice(cont, 1, detalle)
          cont++ 
        }
      })
      $("#modal_detalle").modal('hide')
      limpiar_modal()
      actualizar_tabla()
    }
    
  }


  function actualizar_tabla() {
    let tabla = ""
    this.detalles.forEach((detalle) => {
      let texto_fecha = obtener_texto_fecha(detalle.fecha_inicio, detalle.fecha_fin)
      tabla += "<tr class='tr_tabla' onclick='modal_opciones("+this.detalles.indexOf(detalle)+")'>\n\
                    <td><center><b>"+detalle.semana+"</b><br>"+texto_fecha+"</center></td>"

      let ejes = "";
      if(detalle.semana_parciales){
        tabla += "<td><center><b>"+detalle.titulo_semana_parciales+"</b></center></td>"
      }else{
        tabla += "<td>"
        detalle.unidades_escojidas.forEach((unidad) => {
          tabla += "<center><b> Unidad No "+unidad.numero+"</b></center>\n\
                    <center>"+unidad.nombre+"</center><br><br>"
                    unidad.ejes.forEach((eje) => {
                      ejes += "<b>"+unidad.numero+"."+eje.numero+"</b> "+eje.nombre+"<br><br>"
                    })
        })
        tabla += "</td>"
      }

       tabla +=     "<td>"+ejes+"</td>\n\
                    <td>"+detalle.temas_trabajo+"</td>\n\
                    <td>"+detalle.estrategias_metodologicas+"</td>\n\
                    <td>"+detalle.competencias+"</td>\n\
                    <td>"+detalle.evaluacion_academica+"</td>\n\
                    <td>"+detalle.bibliografia+"</td>\n\
                </tr>"
    })
    $("#tabla_detalles").html(tabla)

    //miramos si ya registro el numero maximo de semanas
    let num_max_semanas = {{ $periodo_academico->total_semanas }};

    if(this.detalles.length == num_max_semanas){
      $("#btn_agregar_semana").fadeOut()
    }else{
      $("#btn_agregar_semana").fadeIn()
    }
  }

  function modal_opciones(posicion_detalle) {
    posicion_detalle_editar = posicion_detalle
    @if($puede_editar)
      this.show_modal_detalle(true)
    @endif
  }

  function obtener_texto_fecha(fecha_inicio, fecha_fin) {
    let dia_inicio = fecha_inicio.split("/")[0]
    let mes_inicio = fecha_inicio.split("/")[1]
    let año_inicio = fecha_inicio.split("/")[2]

    let dia_fin = fecha_fin.split("/")[0]
    let mes_fin = fecha_fin.split("/")[1]
    let año_fin = fecha_fin.split("/")[2]

    let meses = [
                  'enero', 
                  'febrero', 
                  'marzo',
                  'abril',
                  'mayo',
                  'junio',
                  'julio',
                  'agosto',
                  'septiembre',
                  'octubre',
                  'noviembre',
                  'diciembre'
                ]

    if(mes_inicio == mes_fin && año_inicio == año_fin){
      return "Del "+dia_inicio+" al "+dia_fin+" de "+meses[parseInt(mes_inicio) - 1]+" de "+año_inicio
    }

    if(mes_inicio != mes_fin && año_inicio == año_fin){
      return "Del "+dia_inicio+" de "+meses[parseInt(mes_inicio) - 1]+" al "+dia_fin+" de "+meses[parseInt(mes_fin) - 1]+" de "+año_inicio
    }

    if(mes_inicio != mes_fin && año_inicio != año_fin){
      return "Del "+dia_inicio+" de "+meses[parseInt(mes_inicio) - 1]+" de "+año_inicio+" al "+dia_fin+" de "+meses[parseInt(mes_fin) - 1]+" de "+año_fin
    }

    return "Fecha no valida";

  }

  function limpiar_modal() {
    
    this.unidades.forEach((unidad) => {
      $("#unidad_"+unidad.id_unidad).prop('checked', false)      
    })
    $("#div_ejes").html("")
    this.ejes_escojidos_tmp = []
    this.editor_temas_trabajo.setData("")
    this.editor_estrategias_metodologicas.setData("")
    this.editor_competencias.setData("")
    this.editor_evaluacion_academica.setData("")
    this.editor_bibliografia.setData("")
    this.editor_titulo_semana_parciales.setData("")

    $("#semana_parciales").prop("checked", false)
    $("#div_unidades_ejes").fadeIn()
    $("#div_semana_parciales").fadeOut()
    
  }

  function obtener_unidades_ejes_escojidos() {
    let unidades_escojidas = []
    let error = false

    this.unidades.forEach((unidad) => {
        let unidad_escojida = {
          'id_unidad' : unidad.id_unidad,
          'nombre' : unidad.nombre,
          'numero' : unidad.numero,
          'ejes' : []
        }
        if($("#unidad_"+unidad.id_unidad).prop('checked')){
          unidad.ejes.forEach((eje) => {
            if(this.eje_esta_escojido(eje.id_eje)) unidad_escojida.ejes.push(eje)
          })
          if(unidad_escojida.ejes.length == 0){
            error = true
            alert("Debe seleccionar los temas de docencia directa del eje tematico "+unidad.numero+". "+unidad.nombre);
            return false
          }
          unidades_escojidas.push(unidad_escojida)
        }
    }) 
    if(unidades_escojidas.length == 0 && error == false){
      error = true
      alert("Es necesario que escoja ejes tematicos para el desarrollo de la semana ");
    }
    return {
      'result' : unidades_escojidas,
      'error' : error
    }
  }

  function guardar() {
    if(this.detalles.length == 0){
      alert("Debe diligenciar por lo menos una semana para registrar el formato.")
      return false
    }

    let url = '{{ route("plan_desarrollo_asignatura/editar") }}'

    let _token = ""
    $("[name='_token']").each(function() { _token = this.value })
    let request = {
        '_token' : _token,
        'id_plan_desarrollo_asignatura' : '{{ $plan_desarrollo_asignatura->id_plan_desarrollo_asignatura}}',
        'id_asignatura' : '{{ $asignatura->id_asignatura }}',
        'id_periodo_academico' : '{{ $periodo_academico->id_periodo_academico }}',
        'detalles' : this.detalles
    }
    $.blockUI({
      message: '<h1>Guardando</h1><i class="fa fa-spinner fa-spin fa-3x fa-fw">',
      css: {
          border: 'none',
          padding: '15px',
          backgroundColor: '#000',
          '-webkit-border-radius': '10px',
          '-moz-border-radius': '10px',
          opacity: .8,
          color: '#ffffff'
      }});

    $.post(url, request, (response) => {
      $.unblockUI();
      if(response.error == false){
        toastr.success(response.message, 'Guardado correctamente', {timeOut: 5000})
        location.reload();
      }else{
        toastr.error(response.message, 'Error', {timeOut: 5000})
      }
    }).fail((error) => {
      $.unblockUI();
      console.log(error)
      toastr.error("Ocurrio un error en el servicio. Por favor comuniquese con el encargado", 'Error', {timeOut: 5000})
    })
  }



  //configuraciones

  function inicializar_unidades() {
    let unidad = {
      'id_unidad' : '',
      'nombre' : '',
      'numero' : '',
      'ejes' : []
    }
    let cont_unidades = 1
    let cont_ejes = 1
    @foreach($plan_asignatura->unidades() as $unidad)
        unidad.id_unidad = '{{ $unidad->id_unidad }}'
        unidad.nombre = '{{ $unidad->nombre }}'
        unidad.numero = cont_unidades
        cont_ejes = 1
        @foreach($unidad->ejes as $eje)

            unidad.ejes.push({
              'id_eje' : '{{ $eje->id_eje_tematico }}',
              'numero' : cont_ejes,
              'nombre' : '{{ $eje->nombre }}'
            })
            cont_ejes++
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
  }

  function inicializar_editores() {
    var config = {
      ckfinder: {
        uploadUrl: "{{ asset('ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files&responseType=json') }}",
      },
      toolbar: ["heading", "bold", "italic", "link", "numberedList", "bulletedList",  "blockQuote", "ckfinder", "imageTextAlternative",  "imageStyle:full", "imageStyle:side", "indent", "outdent", "selectAll", "undo", "redo", "insertTable", "tableColumn", "tableRow", "mergeTableCells"]
      ,
      heading: {
          options: [
              { model: 'paragraph', title: 'Fuente', class: 'ck-heading_paragraph' },
              { model: 'heading1', view: 'h1', title: 'Grande', class: 'ck-heading_heading1' },
              { model: 'heading2', view: 'h2', title: 'Mediano', class: 'ck-heading_heading2' },
              { model: 'heading3', view: 'h3', title: 'Pequeño', class: 'ck-heading_heading3' }
          ]
      },
    }


    ClassicEditor
    .create( document.querySelector( '#temas_trabajo' ), config ).then( editor => {
      this.editor_temas_trabajo = editor;
    } ).catch( err => {
      console.error( err.stack );
    } );

    ClassicEditor
    .create( document.querySelector( '#estrategias_metodologicas' ), config ).then( editor => {
      this.editor_estrategias_metodologicas = editor;
    } ).catch( err => {
      console.error( err.stack );
    } );

    ClassicEditor
    .create( document.querySelector( '#competencias' ), config ).then( editor => {
      this.editor_competencias = editor;
    } ).catch( err => {
      console.error( err.stack );
    } );

    ClassicEditor
    .create( document.querySelector( '#evaluacion_academica' ), config ).then( editor => {
      this.editor_evaluacion_academica = editor;
    } ).catch( err => {
      console.error( err.stack );
    } );

    ClassicEditor
    .create( document.querySelector( '#bibliografia' ), config ).then( editor => {
      this.editor_bibliografia = editor;
    } ).catch( err => {
      console.error( err.stack );
    } );

    ClassicEditor
    .create( document.querySelector( '#titulo_semana_parciales' ), config ).then( editor => {
      this.editor_titulo_semana_parciales = editor;
    } ).catch( err => {
      console.error( err.stack );
    } );
  }

  function obtener_eje(id_eje) {
    let eje_encontado = {
        'id_eje' : '',
        'numero' : -1,
        'nombre' : ''
    }
    this.unidades.forEach((unidad) => {
      unidad.ejes.forEach((eje) => {
        if(eje.id_eje == id_eje){
          eje_encontado = {
              'id_eje' : eje.id_eje,
              'numero' : eje.numero,
              'nombre' : eje.nombre
          }
        } 
      })
    })
     
    return eje_encontado
  }
  function obtener_unidad(id_unidad) {
    let uni= {
          'id_unidad' : '',
          'nombre' : '',
          'numero' : '',
          'ejes' : []
    }
     this.unidades.forEach((unidad) => {
      if(unidad.id_unidad == id_unidad) {
        uni= {
          'id_unidad' : unidad.id_unidad,
          'nombre' : unidad.nombre,
          'numero' : unidad.numero,
          'ejes' : []
        }
      }
     })
     return uni
  }

  function cargar_informacion_plan_desarrollo() {
    @php
      $cont_detalles = 1;
    @endphp
    let unidades_antiguas = []
    let unidad_antigua = null;
    let ejes_antiguos = []
    @foreach($plan_desarrollo_asignatura->detalles as $detalle)
      unidades_antiguas = []
      @foreach($detalle->unidades as $unidad_plan_desarrollo)
        ejes_antiguos = []
        @foreach($unidad_plan_desarrollo->ejes as $eje_plan_desarrollo)
          ejes_antiguos.push(obtener_eje('{{ $eje_plan_desarrollo->id_eje_tematico }}'))
        @endforeach
        unidad_antigua = obtener_unidad('{{ $unidad_plan_desarrollo->id_unidad_asignatura }}');
        unidad_antigua.ejes = ejes_antiguos
       unidades_antiguas.push(unidad_antigua)
       unidad_antigua = null; 
      @endforeach

      this.detalles.push({
        'id_detalle' : '{{ $detalle->id_plan_desarrollo_asignatura_detalle }}',
        'puede_eliminar' : {{ $detalle->puede_eliminar() }},
        'semana' : {{ $cont_detalles }},
        'fecha_inicio' : '{{ date('d/m/Y', strtotime($detalle->fecha_inicio)) }}',
        'fecha_fin' : '{{ date('d/m/Y', strtotime($detalle->fecha_fin)) }}',
        'unidades_escojidas' : unidades_antiguas,
        'temas_trabajo' : '@php echo $detalle->temas_trabajo_independiente; @endphp',
        'estrategias_metodologicas' : '@php echo $detalle->estrategias_metodologicas; @endphp',
        'competencias' : '@php echo $detalle->competencias; @endphp',
        'evaluacion_academica' : '@php echo $detalle->evaluacion_academica; @endphp',
        'bibliografia' : '@php echo $detalle->bibliografia; @endphp',
        'semana_parciales' : @php 
                              if($detalle->is_semana_parciales){
                                echo 'true';
                              } else{
                                echo 'false';
                              }
                            @endphp,
        'titulo_semana_parciales' : '@php echo $detalle->titulo_semana_parciales; @endphp',
      })
      this.semana_actual = {{ $cont_detalles }}
      @php
        $cont_detalles++;
      @endphp
    @endforeach

    actualizar_tabla()
  }


  function cargar_plan_existente() {
        let id_periodo_academico = $("#id_periodo_academico_carga_existente").val()
        if(!id_periodo_academico){
          alert("Es necesario que seleccione el periodo academico.")
          return false
        }

        confirmacion = confirm("¿Seguro que desea cargar la misma información de este plan de desarrollo asignatura con respecto al periodo academico seleccionado?");

        if(confirmacion){
          
          var url = '{{ route('plan_desarrollo_asignatura/cargar_plan_existente') }}'
          let _token = ""
          $("[name='_token']").each(function() { _token = this.value })
          let request = {
              '_token' : _token,
              'id_plan_desarrollo_asignatura' : '{{ $plan_desarrollo_asignatura->id_plan_desarrollo_asignatura }}',
              'id_asignatura' : '{{ $asignatura->id_asignatura }}',
              'id_periodo_academico_actual' : '{{ $periodo_academico->id_periodo_academico }}',
              'id_periodo_academico_carga' : id_periodo_academico,
          }
          $.blockUI({
          message: '<h1>Cargando plan desarrollo de asignatura</h1><i class="fa fa-spinner fa-spin fa-3x fa-fw">',
          css: {
              border: 'none',
              padding: '15px',
              backgroundColor: '#000',
              '-webkit-border-radius': '10px',
              '-moz-border-radius': '10px',
              opacity: .8,
          }});

          $.post(url, request, (response) => {
            $.unblockUI();
            if(response.error == false){
                  $("#modal_cargar_existente").modal("hide")
                  toastr.success(response.message, 'Cargado correctamente', {timeOut: 5000})
                  location.reload();
            }else{
                toastr.error(response.message, 'Error', {timeOut: 5000})
            }
          })
          .fail((error)=>{
              toastr.error("Ocurrio un error en el servicio. Por favor comuniquese con el encargado", 'Error', {timeOut: 5000})
              $.unblockUI();
          })
        }
      }

      function exportar_google_site(){
        let url = '@php
          if ($plan_desarrollo_asignatura->id_plan_desarrollo_asignatura)
            echo route('plan_desarrollo_asignatura/obtener_vista', $plan_desarrollo_asignatura->id_plan_desarrollo_asignatura);
          else
            echo "";
          @endphp'
          if(url.trim()==""){
              toastr.error('Este plan de desarrollo asignatura no se ha realizado para poder exportarlo', 'Error', {timeOut: 5000})
          }else{
            $.get(url, (response) => {
              copiar(response)
            }).fail((error) => {
              toastr.error('Ocurrio un error al exportar la pagina para google site', 'Error', {timeOut: 5000})
            })
          }
        
      }

      function copiar(value){
        var aux = document.createElement("input");
        aux.setAttribute("value", value);
        document.body.appendChild(aux);
        aux.select();
        document.execCommand("copy");
        document.body.removeChild(aux);
        toastr.options.newestOnTop = false;
        toastr.info('Plan de desarrollo asignatura copiado para Google Site.', 'Copiada', {timeOut: 5000})
      }
  
</script>

            
@endsection

