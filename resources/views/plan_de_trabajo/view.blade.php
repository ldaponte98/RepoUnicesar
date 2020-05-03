
@extends((session("is_admin") == true ? 'layouts.main' : 'layouts.main_docente'))
@php
    $usuario = \App\Usuario::find(session('id_usuario'));
    $tercero = $usuario->tercero;
@endphp 
@section('header_content')

	<div class="row page-titles">
                    <div class="col-md-6 col-8 align-self-center">
                        <h3 class="text-themecolor m-b-0 m-t-0">Tabla</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Plan de trabajo</a></li>
                            <li class="hidden-sm-down breadcrumb-item active">Mis planes de trabajo</li>
                        </ol>
                    </div>
                    <div class="col-md-6 col-4 align-self-center">
                        <br>
                        <input title="Consulta cualquier campo" id="txtfiltro" type="text" class="pull-right search" name="" placeholder="Consulta Aqui">
                 </div>          
    </div>
@endsection
@section('content')


<script>
  var lista_actividades = []
    function actualizar_tablas(tipo){
    var tabla = ""
    var total_horas_de_tabla_actual = 0
    var total_horas_de_actividades = 0
      lista_actividades.forEach((actividad)=>{
        if(actividad.tipo == tipo){
          tabla += "<tr>"+
                   "<td>"+actividad.nombre+"</td>"
                    if(tipo == 18 || tipo == 19){
                      tabla +="<td>"+actividad.acta+"</td>"+
                              "<td>"+actividad.fecha_aprobada+"</td>"
                    }else{
                      tabla += "<td>"+actividad.descripcion+"</td>"
                    }
                   
                   tabla +="<td>"+actividad.fecha_iniciacion+"</td>"+
                   "<td>"+actividad.fecha_terminacion+"</td>"+
                   "<td>"+actividad.horas_semanales+"</td>"+
                   "<td><center><a onclick=\"eliminarActividad('"+actividad.nombre+"' , "+actividad.tipo+")\" style='font-size: 25px; color: red; cursor: pointer;''><i class='fa fa-times'></i></a></center></td>"
          total_horas_de_tabla_actual += parseInt(actividad.horas_semanales)
        }
        total_horas_de_actividades += parseInt(actividad.horas_semanales)
      })
    //aca se modifican las tablas segun el tipo de actividad
    if(tipo == 18) $("#bodytable_proyectos_grados").html(tabla)
    if(tipo == 19) $("#bodytable_investigaciones").html(tabla)
    if(tipo == 20) $("#bodytable_proyeccion_social").html(tabla)
    if(tipo == 21) $("#bodytable_cooperacion").html(tabla)
    if(tipo == 22) $("#bodytable_crecimiento").html(tabla)
    if(tipo == 23) $("#bodytable_actividades_administrativas").html(tabla)
    if(tipo == 24) $("#bodytable_otras_actividades").html(tabla)

    //aca se modifican los valores segun el tipo de actividad
    if(tipo == 18) $("#horas_orientacion_proyectos").val(total_horas_de_tabla_actual)
    if(tipo == 19) $("#horas_investigacion").val(total_horas_de_tabla_actual)
    if(tipo == 20) $("#horas_proyeccion_social").val(total_horas_de_tabla_actual)
    if(tipo == 21) $("#horas_cooperacion").val(total_horas_de_tabla_actual)
    if(tipo == 22) $("#horas_crecimiento_personal").val(total_horas_de_tabla_actual)
    if(tipo == 23) $("#horas_actividades_administrativas").val(total_horas_de_tabla_actual)
    if(tipo == 24) $("#horas_otras_actividades").val(total_horas_de_tabla_actual)
    $("#horas_actividades_complementarias").val(total_horas_de_actividades)
  }
    function agregar_antiguas_actividades(tipo,nombre, descripcion, acta, fecha_aprobada, fecha_iniciacion, fecha_terminacion, horas_semanales) {
      var actividad = {
        'tipo' : tipo,
        'nombre' : nombre,
        'descripcion' : descripcion,
        'acta' : acta,
        'fecha_aprobada' : fecha_aprobada,
        'fecha_iniciacion' : fecha_iniciacion,
        'fecha_terminacion' : fecha_terminacion,
        'horas_semanales' : horas_semanales
      }
      lista_actividades.push(actividad)
      actualizar_tablas(tipo)
    }
</script>


@php

$is_admin = session('is_admin');
@endphp

@if (session('mensaje_update_fechas'))
  <script>
    toastr.success('{{ session('mensaje_update_fechas') }}', 'Fechas actualizadas', {timeOut: 5000})
  </script>
@endif
<div class="row">
<div class="col-sm-12">
    <div class="card">
        <div class="card-block">
            
                <div class="form-group">
                    {{ Form::open()}}
                                  <label style="color: black;"><b>Periodo Academico</b></label>
                                  <div class="row">
                                      <div class="col-sm-4">
                                        <select name="id_periodo_escojido" class="form-control form-control-line" >
                                                @php
                                                    $periodos = \App\PeriodoAcademico::all();
                                                @endphp
                                                @foreach ($periodos as $periodo)
                                                    @if ($periodo->id_periodo_academico == $periodo_academico->id_periodo_academico)
                                                        <option selected value="{{ $periodo->id_periodo_academico }}">{{ $periodo->periodo }}</option>
                                                    @else
                                                        <option value="{{ $periodo->id_periodo_academico }}">{{ $periodo->periodo }}</option>
                                                    @endif
                                                
                                                @endforeach
                                        </select>
                                      </div>
                                      <div class="col-sm-2">
                                        <button type="submit" style="color: white; height: 100%; width: 100%;  font-size: 16px;"  class="btn btn-success">Consultar</button>
                                      </div>
                                      @if ($plan_trabajo->id_plan_trabajo != null)
                                      <div class="col-sm-2">
                                        <a target="_blank" href="{{ route('plan_trabajo/imprimir', $plan_trabajo->id_plan_trabajo) }}" style="color: white; width: 100%; height: 100%; font-size: 16px;"  class="btn btn-info">Imprimir</a>
                                      </div>
                                      <div class="col-sm-1"></div>
                                      <div class="col-sm-3">
                                        @if ($plan_trabajo->estado == "Enviado")
                                          <h3><b class="pull-right">Estado: <a style="color: #ffc107; cursor: pointer;" title="Este plan de trabajo se envio al administrador correctamente pero este aun no lo ah leido o revisado.">Enviado</a></b></h3>
                                        @endif
                                        @if ($plan_trabajo->estado == "Recibido")
                                          <h3><b class="pull-right">Estado: <a  style="color: #28a745; cursor: pointer;" title="El administraor ya ah visto tu formato de plan de trabajo." >Recibido</a></b></h3>
                                        @endif
                                        
                                      </div>
                                      
                                      @endif
                                  </div>
                    {{ Form::close() }}

                            </div>

{{ Form::open(array(
    'id' => 'form-plan-trabajo',
    'class'=>'form-horizontal form-material',
    'files' => true))
}}
<style type="text/css">
  label{
    color: black !important;
  }
</style>
            <div class="row" >
              <div class="col-sm-12">
                <div class="form-group">
              @if (!$plan_trabajo->id_plan_trabajo)
              <div id="div_nuevo_plan_trabajo">
                 <b><i>No tiene un formato de plan de trabajo registrado en este periodo academico</i></b> <br><button type="button" class="btn btn-info" onclick="
                  $('#div_form_plan_trabajo').fadeIn() 
                  $('#div_nuevo_plan_trabajo').fadeOut()">Nuevo plan de trabajo</button>
              </div>
              @else
                <script>
                  $(document).ready(function() {
                    $('#div_form_plan_trabajo').fadeIn()
                  })
              </script>
              @endif

                  <div id="div_form_plan_trabajo" style="display: none">
                    <label style="color: black;"><b>Informacion General</b></label><br><br>
                    <div class="row">
                  <input type="hidden" id="id_plan_trabajo" value="{{ $plan_trabajo->id_plan_trabajo }}">
                  <input type="hidden" id="id_periodo_academico" value="{{ $periodo_academico->id_periodo_academico }}">
                  <input type="hidden" id="id_tercero" value="{{ $tercero->id_tercero }}">
                    <div class="col-sm-4">
                         <label for="total_asignaturas" style="color: black;">Total asignaturas </label>
                         <input id="total_asignaturas" name="total_asignaturas" type="number" class="form-control form-control-line " value="{{ count($tercero->asignaturas_por_periodo_academico($periodo_academico->id_periodo_academico)) }}" readonly>
                    </div>
                    <div class="col-sm-4">
                         <label for="total_asignaturas" style="color: black;">Total grupos </label>
                         <input id="total_grupos" name="total_grupos" type="number" class="form-control form-control-line " value="{{ count($tercero->grupos_por_periodo_academico($periodo_academico->id_periodo_academico)) }}" readonly>
                    </div>
                    <div class="col-sm-4">
                         <label for="total_estudiantes" style="color: black;">Total estudiantes </label>
                         <input id="total_estudiantes" name="total_estudiantes" type="number" class="form-control form-control-line " value="{{ $tercero->num_estudiantes_por_periodo_academico($periodo_academico->id_periodo_academico) }}" readonly>
                    </div>
                    </div>
                    <br>
                    <div class="row">
                      <div class="col-sm-4">
                           <label for="horas_docencia_directa">Total horas de docencia directa </label>
                           <br><br>
                           <input id="horas_docencia_directa" name="horas_docencia_directa" type="number" class="form-control form-control-line " value="{{ $tercero->total_horas_docencia($periodo_academico->id_periodo_academico) }}" readonly>
                      </div>

                      <div class="col-sm-4">
                           <label for="horas_atencion_estudiantes">Total horas de atencion a estudiantes </label><br><br>
                           <input id="horas_atencion_estudiantes" name="horas_atencion_estudiantes" type="number" class="form-control form-control-line " value="{{ $plan_trabajo->horas_atencion_estudiantes }}">
                      </div>

                      <div class="col-sm-4">
                           <label for="horas_preparacion_evaluacion">Total horas de preparacion y evaluacion de las asignaturas </label>
                           <input id="horas_preparacion_evaluacion" name="horas_preparacion_evaluacion" type="number" class="form-control form-control-line " value="{{ $plan_trabajo->horas_preparacion_evaluacion }}">
                      </div>
                    </div>
                    <br>
                    <div class="row">
                      <div class="col-sm-4">
                           <label for="horas_dedicadas_actividades">Total horas dedicadas a las <br> actividades  docente</label>
                           <input id="horas_dedicadas_actividades" name="horas_dedicadas_actividades" type="number" class="form-control form-control-line " value="{{ $plan_trabajo->horas_dedicadas_actividades }}">
                      </div>

                      <div class="col-sm-4">
                           <label for="horas_orientacion_proyectos">Total horas de orientación y evaluación de los trabajos de grado </label>
                           <input id="horas_orientacion_proyectos" name="horas_orientacion_proyectos" type="number" class="form-control form-control-line " value="{{ $plan_trabajo->horas_orientacion_proyectos }}" readonly>
                      </div>

                      <div class="col-sm-4">
                           <label for="horas_investigacion">Total horas dedicadas a la investigación aprobada </label>
                           <input id="horas_investigacion" name="horas_investigacion" type="number" class="form-control form-control-line " value="{{ $plan_trabajo->horas_investigacion }}" readonly>
                      </div>
                    </div>

                    <br>
                    <div class="row">
                      <div class="col-sm-4">
                           <label for="horas_proyeccion_social">Total horas dedicadas a la proyeccion social registrada</label>
                           <input id="horas_proyeccion_social" name="horas_proyeccion_social" type="number" class="form-control form-control-line " value="{{ $plan_trabajo->horas_proyeccion_social }}" readonly>
                      </div>
                      <div class="col-sm-4">
                           <label for="horas_cooperacion">Total horas dedicadas a la cooperación interinstitucional </label>
                           <input id="horas_cooperacion" name="horas_cooperacion" type="number" class="form-control form-control-line " value="{{ $plan_trabajo->horas_cooperacion }}" readonly>
                      </div>

                      <div class="col-sm-4">
                           <label for="horas_crecimiento_personal">Total horas dedicadas para el crecimiento personal y profesional </label>
                           <input id="horas_crecimiento_personal" name="horas_crecimiento_personal" type="number" class="form-control form-control-line " value="{{ $plan_trabajo->horas_crecimiento_personal }}" readonly>
                      </div>
                    </div>

                    <br>
                    <div class="row">
                      <div class="col-sm-4">
                           <label for="horas_actividades_administrativas">Total horas dedicadas a las actividades administrativas</label>
                           <input id="horas_actividades_administrativas" name="horas_actividades_administrativas" type="number" class="form-control form-control-line " value="{{ $plan_trabajo->horas_actividades_administrativas }}" readonly>
                      </div>
                      <div class="col-sm-4">
                           <label for="horas_otras_actividades">Total horas para otras actividades </label><br><br>
                           <input id="horas_otras_actividades" name="horas_otras_actividades" type="number" class="form-control form-control-line " value="{{ $plan_trabajo->horas_otras_actividades }}" readonly>
                      </div>

                      <div class="col-sm-4">
                           <label for="horas_actividades_complementarias">Total horas dedicadas a las actividades docente complementarias </label>
                           <input id="horas_actividades_complementarias" name="horas_actividades_complementarias" type="number" class="form-control form-control-line " value="{{ $plan_trabajo->horas_actividades_complementarias }}">
                      </div>
                    </div>

                    <br>
                    <div class="row">
                      <div class="col-sm-4">
                           <label for="total_horas_semana">Total de horas por plan de trabajo</label>
                           <input id="total_horas_semana" name="total_horas_semana" type="number" class="form-control form-control-line " value="{{ $plan_trabajo->total_horas_semana }}" readonly>
                      </div>
                      <div class="col-sm-8">
                           <label for="observaciones">Observaciones</label>
                           <input id="observaciones" name="observaciones" type="text" class="form-control form-control-line " value="{{ $plan_trabajo->observaciones }}">
                      </div>
                    </div>
                    <br><br>
                    <label style="color: black;"><b>Cuadros explicativos de las actividades docentes</b></label>
                    <br><br>
                    <div class="card">
                      <div class="card-header bg-info">
                        <div class="row">
                          <div class="col-sm-11">
                          <h4 class="mb-0 text-white">Orientación y evaluación de los trabajos de grado</h4>
                          </div>
                          <div class="col-sm-1">
                            @if ($permiso_para_modificar == true)
                              <a  style="color: white; cursor: pointer;" title="Agregar nuevo" onclick ="AbrirModalNewActividad(18, 'Orientación y evaluación de los trabajos de grado')"><i class="fa fa-plus-circle"></i></a> &nbsp; &nbsp;
                            @endif
                          <a class="pull-right" onclick=" 
                          var estado = $('#tabla_proyectos_grado').css('display')
                          if(estado == 'none') $('#tabla_proyectos_grado').css('display','block')
                          if(estado == 'block') $('#tabla_proyectos_grado').css('display','none')
                          " style="color: white; cursor: pointer; margin-top: 3px;"><i class="fa fa-caret-down"></i></a>
                          </div>
                        </div>
                      </div>
                      
                      <div class="table-responsive" id="tabla_proyectos_grado" style="display: none;">
                          <table class="table table-bordered">
                              <thead>
                                  <tr>
                                      <th><center><b>Titulo</b></center></th>
                                      <th><center><b>Acta de aprobacion</b></center></th>
                                      <th><center><b>Fecha de aprobacion</b></center></th>
                                      <th><center><b>fecha de iniciacion</b></center></th>  
                                      <th><center><b>fecha de terminacion</b></center></th>  
                                      <th><center><b>Horas por semana</b></center></th>  
                                  </tr>
                              </thead>
                              <style type="text/css"> 
                                .fil td{
                                  color: black !important;
                                }
                              </style>
                              <tbody id="bodytable_proyectos_grados">
                                  @foreach ($plan_trabajo->actividades as $actividad)
                                  @if ($actividad->id_dominio_tipo == 18)<!--p. grado-->
                                  <tr>
                                    <td>{{ $actividad->nombre }}</td>
                                    <td>{{ $actividad->acta_aprobada }}</td>
                                    <td>@php
                                      if ($actividad->fecha_aprobada) {
                                        echo  date('d-m-Y', strtotime($actividad->fecha_aprobada));
                                      }
                                    @endphp
                                    </td>
                                    <td>@php
                                      if ($actividad->fecha_iniciacion) {
                                        echo  date('d-m-Y', strtotime($actividad->fecha_iniciacion));
                                      }
                                    @endphp
                                    </td>
                                    <td>@php
                                      if ($actividad->fecha_terminacion) {
                                        echo  date('d-m-Y', strtotime($actividad->fecha_terminacion));
                                      }
                                    @endphp
                                    </td>
                                    <td><center>{{ $actividad->horas_por_semana }}</center></td>
                                    <td><center><a onclick="eliminarActividad('{{ $actividad->nombre }}' , {{ $actividad->id_dominio_tipo }})" style="font-size: 25px; color: red; cursor: pointer;"><i class="fa fa-times"></i></a></center>
                                    </td>
                                    </tr>
                                  <script>
                                    agregar_antiguas_actividades({{ $actividad->id_dominio_tipo }},'{{ $actividad->nombre }}','{{ $actividad->descripcion }}','{{ $actividad->acta_aprobada }}','{{ $actividad->fecha_aprobada }}','{{ $actividad->fecha_iniciacion }}','{{ $actividad->fecha_terminacion }}',{{ $actividad->horas_por_semana }})
                                  </script>
                                  @endif
                                  @endforeach
                               
                              </tbody>
                          </table>
                      </div>

                    </div>

                    <div class="card">
                      <div class="card-header bg-info">
                        <div class="row">
                          <div class="col-sm-11">
                          <h4 class="mb-0 text-white">Investigacion aprobada</h4>
                          </div>
                          <div class="col-sm-1">
                            @if ($permiso_para_modificar == true)
                          <a  style="color: white; cursor: pointer;" title="Agregar nuevo" onclick ="AbrirModalNewActividad(19,'Investigacion aprobada')"><i class="fa fa-plus-circle"></i></a> &nbsp; &nbsp;
                          @endif
                          <a class="pull-right" onclick=" 
                          var estado = $('#tabla_investigaciones_aprobadas').css('display')
                          if(estado == 'none') $('#tabla_investigaciones_aprobadas').css('display','block')
                          if(estado == 'block') $('#tabla_investigaciones_aprobadas').css('display','none')
                          " style="color: white; cursor: pointer; margin-top: 3px;"><i class="fa fa-caret-down"></i></a>
                          </div>
                        </div>
                      </div>

                      <div class="table-responsive" id="tabla_investigaciones_aprobadas" style="display: none;">
                          <table class="table table-bordered">
                              <thead>
                                  <tr>
                                      <th><center><b>Titulo</b></center></th>
                                      <th><center><b>Acta de aprobacion</b></center></th>
                                      <th><center><b>Fecha de aprobacion</b></center></th>
                                      <th><center><b>fecha de iniciacion</b></center></th>  
                                      <th><center><b>fecha de terminacion</b></center></th>  
                                      <th><center><b>Horas por semana</b></center></th>  
                                  </tr>
                              </thead>
                              <style type="text/css"> 
                                .fil td{
                                  color: black !important;
                                }
                              </style>
                              <tbody id="bodytable_investigaciones">
                                @foreach ($plan_trabajo->actividades as $actividad)
                                  @if ($actividad->id_dominio_tipo == 19)
                                  <tr>
                                    <td>{{ $actividad->nombre }}</td>
                                    <td>{{ $actividad->acta_aprobada }}</td>
                                    <td>@php
                                      if ($actividad->fecha_aprobada) {
                                        echo  date('d-m-Y', strtotime($actividad->fecha_aprobada));
                                      }
                                    @endphp
                                    </td>
                                    <td>@php
                                      if ($actividad->fecha_iniciacion) {
                                        echo  date('d-m-Y', strtotime($actividad->fecha_iniciacion));
                                      }
                                    @endphp
                                    </td>
                                    <td>@php
                                      if ($actividad->fecha_terminacion) {
                                        echo  date('d-m-Y', strtotime($actividad->fecha_terminacion));
                                      }
                                    @endphp
                                    </td>
                                    <td><center>{{ $actividad->horas_por_semana }}</center></td>
                                    <td><center><a onclick="eliminarActividad('{{ $actividad->nombre }}' , {{ $actividad->id_dominio_tipo }})" style="font-size: 25px; color: red; cursor: pointer;"><i class="fa fa-times"></i></a></center>
                                    </td>
                                    </tr>
                                    <script>
                                    agregar_antiguas_actividades({{ $actividad->id_dominio_tipo }},'{{ $actividad->nombre }}','{{ $actividad->descripcion }}','{{ $actividad->acta_aprobada }}','{{ $actividad->fecha_aprobada }}','{{ $actividad->fecha_iniciacion }}','{{ $actividad->fecha_terminacion }}',{{ $actividad->horas_por_semana }})
                                  </script>
                                  @endif
                                  @endforeach
                               
                              </tbody>
                          </table>
                      </div>

                    </div>


                     <div class="card">
                      <div class="card-header bg-info">
                        <div class="row">
                          <div class="col-sm-11">
                          <h4 class="mb-0 text-white">Proyeccion social</h4>
                          </div>
                          <div class="col-sm-1">
                            @if ($permiso_para_modificar ==  true)
                              <a  style="color: white; cursor: pointer;" title="Agregar nuevo" onclick ="AbrirModalNewActividad(20, 'Proyeccion social')"><i class="fa fa-plus-circle"></i></a> &nbsp; &nbsp;
                            @endif
                          
                          <a class="pull-right" onclick=" 
                          var estado = $('#tabla_proyeccion_social').css('display')
                          if(estado == 'none') $('#tabla_proyeccion_social').css('display','block')
                          if(estado == 'block') $('#tabla_proyeccion_social').css('display','none')
                          " style="color: white; cursor: pointer; margin-top: 3px;"><i class="fa fa-caret-down"></i></a>
                          </div>
                        </div>
                      </div>

                      <div class="table-responsive" id="tabla_proyeccion_social" style="display: none;">
                          <table class="table table-bordered">
                              <thead>
                                  <tr>
                                      <th><center><b>Actividad</b></center></th>
                                      <th><center><b>Descripcion</b></center></th>
                                      <th><center><b>Institucion</b></center></th>
                                      <th><center><b>Fecha</b></center></th>  
                                      <th><center><b>Horas por semana</b></center></th>  
                                  </tr>
                              </thead>
                              <style type="text/css"> 
                                .fil td{
                                  color: black !important;
                                }
                              </style>
                              <tbody id="bodytable_proyeccion_social">

                                @foreach ($plan_trabajo->actividades as $actividad)
                                  @if ($actividad->id_dominio_tipo == 20)
                                  <tr>
                                    <td>{{ $actividad->nombre }}</td>
                                    <td>{{ $actividad->descripcion }}</td>
                                    <td>@php
                                      if ($actividad->fecha_iniciacion) {
                                        echo  date('d-m-Y', strtotime($actividad->fecha_iniciacion));
                                      }
                                    @endphp
                                    </td>
                                    <td>@php
                                      if ($actividad->fecha_terminacion) {
                                        echo  date('d-m-Y', strtotime($actividad->fecha_terminacion));
                                      }
                                    @endphp
                                    </td>
                                    <td><center>{{ $actividad->horas_por_semana }}</center></td>
                                    <td><center><a onclick="eliminarActividad('{{ $actividad->nombre }}' , {{ $actividad->id_dominio_tipo }})" style="font-size: 25px; color: red; cursor: pointer;"><i class="fa fa-times"></i></a></center>
                                    </td>
                                    </tr>
                                    <script>
                                    agregar_antiguas_actividades({{ $actividad->id_dominio_tipo }},'{{ $actividad->nombre }}','{{ $actividad->descripcion }}','{{ $actividad->acta_aprobada }}','{{ $actividad->fecha_aprobada }}','{{ $actividad->fecha_iniciacion }}','{{ $actividad->fecha_terminacion }}',{{ $actividad->horas_por_semana }})
                                  </script>
                                  @endif
                                  @endforeach
                              </tbody>
                          </table>
                      </div>

                    </div>


                    <div class="card">
                      <div class="card-header bg-info">
                        <div class="row">
                          <div class="col-sm-11">
                          <h4 class="mb-0 text-white">Cooperación interinstitucional</h4>
                          </div>
                          <div class="col-sm-1">
                            @if ($permiso_para_modificar)
                              <a  style="color: white; cursor: pointer;" title="Agregar nuevo" onclick ="AbrirModalNewActividad(21,'Cooperación interinstitucional')"><i class="fa fa-plus-circle"></i></a> &nbsp; &nbsp;
                            @endif
                          
                          <a class="pull-right" onclick=" 
                          var estado = $('#tabla_cooperacion').css('display')
                          if(estado == 'none') $('#tabla_cooperacion').css('display','block')
                          if(estado == 'block') $('#tabla_cooperacion').css('display','none')
                          " style="color: white; cursor: pointer; margin-top: 3px;"><i class="fa fa-caret-down"></i></a>
                          </div>
                        </div>
                      </div>

                      <div class="table-responsive" id="tabla_cooperacion" style="display: none;">
                          <table class="table table-bordered">
                              <thead>
                                  <tr>
                                      <th><center><b>Actividad</b></center></th>
                                      <th><center><b>Descripcion</b></center></th>
                                      <th><center><b>Institucion</b></center></th>
                                      <th><center><b>Fecha</b></center></th>  
                                      <th><center><b>Horas por semana</b></center></th>  
                                  </tr>
                              </thead>
                              <style type="text/css"> 
                                .fil td{
                                  color: black !important;
                                }
                              </style>
                              <tbody id="bodytable_cooperacion">
                                @foreach ($plan_trabajo->actividades as $actividad)
                                  @if ($actividad->id_dominio_tipo == 21)
                                  <tr>
                                    <td>{{ $actividad->nombre }}</td>
                                    <td>{{ $actividad->descripcion }}</td>
                                    <td>@php
                                      if ($actividad->fecha_iniciacion) {
                                        echo  date('d-m-Y', strtotime($actividad->fecha_iniciacion));
                                      }
                                    @endphp
                                    </td>
                                    <td>@php
                                      if ($actividad->fecha_terminacion) {
                                        echo  date('d-m-Y', strtotime($actividad->fecha_terminacion));
                                      }
                                    @endphp
                                    </td>
                                    <td><center>{{ $actividad->horas_por_semana }}</center></td>
                                    <td><center><a onclick="eliminarActividad('{{ $actividad->nombre }}' , {{ $actividad->id_dominio_tipo }})" style="font-size: 25px; color: red; cursor: pointer;"><i class="fa fa-times"></i></a></center>
                                    </td>
                                    </tr>
                                    <script>
                                    agregar_antiguas_actividades({{ $actividad->id_dominio_tipo }},'{{ $actividad->nombre }}','{{ $actividad->descripcion }}','{{ $actividad->acta_aprobada }}','{{ $actividad->fecha_aprobada }}','{{ $actividad->fecha_iniciacion }}','{{ $actividad->fecha_terminacion }}',{{ $actividad->horas_por_semana }})
                                  </script>
                                  @endif
                                  @endforeach
                               
                              </tbody>
                          </table>
                      </div>

                    </div>

                    <div class="card">
                      <div class="card-header bg-info">
                        <div class="row">
                          <div class="col-sm-11">
                          <h4 class="mb-0 text-white">Crecimiento personal y desarrollo</h4>
                          </div>
                          <div class="col-sm-1">
                            @if ($permiso_para_modificar == true)
                               <a  style="color: white; cursor: pointer;" title="Agregar nuevo" onclick ="AbrirModalNewActividad(22,'Crecimiento personal y desarrollo')"><i class="fa fa-plus-circle"></i></a> &nbsp; &nbsp;
                            @endif
                         
                          <a class="pull-right" onclick=" 
                          var estado = $('#tabla_crecimiento').css('display')
                          if(estado == 'none') $('#tabla_crecimiento').css('display','block')
                          if(estado == 'block') $('#tabla_crecimiento').css('display','none')
                          " style="color: white; cursor: pointer; margin-top: 3px;"><i class="fa fa-caret-down"></i></a>
                          </div>
                        </div>
                      </div>

                      <div class="table-responsive" id="tabla_crecimiento" style="display: none;">
                          <table class="table table-bordered">
                              <thead>
                                  <tr>
                                      <th><center><b>Actividad</b></center></th>
                                      <th><center><b>Descripcion</b></center></th>
                                      <th><center><b>Institucion</b></center></th>
                                      <th><center><b>Fecha</b></center></th>  
                                      <th><center><b>Horas por semana</b></center></th>  
                                  </tr>
                              </thead>
                              <style type="text/css"> 
                                .fil td{
                                  color: black !important;
                                }
                              </style>
                              <tbody id="bodytable_crecimiento">
                                @foreach ($plan_trabajo->actividades as $actividad)
                                  @if ($actividad->id_dominio_tipo == 22)
                                  <tr>
                                    <td>{{ $actividad->nombre }}</td>
                                    <td>{{ $actividad->descripcion }}</td>
                                    <td>@php
                                      if ($actividad->fecha_iniciacion) {
                                        echo  date('d-m-Y', strtotime($actividad->fecha_iniciacion));
                                      }
                                    @endphp
                                    </td>
                                    <td>@php
                                      if ($actividad->fecha_terminacion) {
                                        echo  date('d-m-Y', strtotime($actividad->fecha_terminacion));
                                      }
                                    @endphp
                                    </td>
                                    <td><center>{{ $actividad->horas_por_semana }}</center></td>
                                    <td><center><a onclick="eliminarActividad('{{ $actividad->nombre }}' , {{ $actividad->id_dominio_tipo }})" style="font-size: 25px; color: red; cursor: pointer;"><i class="fa fa-times"></i></a></center>
                                    </td>
                                    </tr>
                                    <script>
                                    agregar_antiguas_actividades({{ $actividad->id_dominio_tipo }},'{{ $actividad->nombre }}','{{ $actividad->descripcion }}','{{ $actividad->acta_aprobada }}','{{ $actividad->fecha_aprobada }}','{{ $actividad->fecha_iniciacion }}','{{ $actividad->fecha_terminacion }}',{{ $actividad->horas_por_semana }})
                                  </script>
                                  @endif
                                  @endforeach
                               
                              </tbody>
                          </table>
                      </div>

                    </div>


                    <div class="card">
                      <div class="card-header bg-info">
                        <div class="row">
                          <div class="col-sm-11">
                          <h4 class="mb-0 text-white">Actividades administrativas</h4>
                          </div>
                          <div class="col-sm-1">
                            @if ($permiso_para_modificar == true)
                              {{-- expr --}}
                           
                          <a  style="color: white; cursor: pointer;" title="Agregar nuevo" onclick ="AbrirModalNewActividad(23, 'Actividades administrativas')"><i class="fa fa-plus-circle"></i></a> &nbsp; &nbsp;
                           @endif
                          <a class="pull-right" onclick=" 
                          var estado = $('#tabla_actividades_Administrativas').css('display')
                          if(estado == 'none') $('#tabla_actividades_Administrativas').css('display','block')
                          if(estado == 'block') $('#tabla_actividades_Administrativas').css('display','none')
                          " style="color: white; cursor: pointer; margin-top: 3px;"><i class="fa fa-caret-down"></i></a>
                          </div>
                        </div>
                      </div>

                      <div class="table-responsive" id="tabla_actividades_Administrativas" style="display: none;">
                          <table class="table table-bordered">
                              <thead>
                                  <tr>
                                      <th><center><b>Actividad</b></center></th>
                                      <th><center><b>Descripcion</b></center></th>
                                      <th><center><b>Institucion</b></center></th>
                                      <th><center><b>Fecha</b></center></th>  
                                      <th><center><b>Horas por semana</b></center></th>  
                                  </tr>
                              </thead>
                              <style type="text/css"> 
                                .fil td{
                                  color: black !important;
                                }
                              </style>
                              <tbody id="bodytable_actividades_administrativas">
                                  @foreach ($plan_trabajo->actividades as $actividad)
                                  @if ($actividad->id_dominio_tipo == 23)
                                  <tr>
                                    <td>{{ $actividad->nombre }}</td>
                                    <td>{{ $actividad->descripcion }}</td>
                                    <td>@php
                                      if ($actividad->fecha_iniciacion) {
                                        echo  date('d-m-Y', strtotime($actividad->fecha_iniciacion));
                                      }
                                    @endphp
                                    </td>
                                    <td>@php
                                      if ($actividad->fecha_terminacion) {
                                        echo  date('d-m-Y', strtotime($actividad->fecha_terminacion));
                                      }
                                    @endphp
                                    </td>
                                    <td><center>{{ $actividad->horas_por_semana }}</center></td>
                                    <td><center><a onclick="eliminarActividad('{{ $actividad->nombre }}' , {{ $actividad->id_dominio_tipo }})" style="font-size: 25px; color: red; cursor: pointer;"><i class="fa fa-times"></i></a></center>
                                    </td>
                                    </tr>
                                    <script>
                                    agregar_antiguas_actividades({{ $actividad->id_dominio_tipo }},'{{ $actividad->nombre }}','{{ $actividad->descripcion }}','{{ $actividad->acta_aprobada }}','{{ $actividad->fecha_aprobada }}','{{ $actividad->fecha_iniciacion }}','{{ $actividad->fecha_terminacion }}',{{ $actividad->horas_por_semana }})
                                  </script>
                                  @endif
                                  @endforeach
                               
                              </tbody>
                          </table>
                      </div>

                    </div>


                    <div class="card">
                       <div class="card-header bg-info">
                        <div class="row">
                          <div class="col-sm-11">
                          <h4 class="mb-0 text-white">Otras actividades</h4>
                          </div>
                          <div class="col-sm-1">
                            @if ($permiso_para_modificar == true)
                              {{-- expr --}}
                            
                          <a  style="color: white; cursor: pointer;" title="Agregar nuevo" onclick ="AbrirModalNewActividad(24,'Otras actividades')"><i class="fa fa-plus-circle"></i></a> &nbsp; &nbsp;
                          @endif
                          <a class="pull-right" onclick=" 
                          var estado = $('#tabla_otras_actividades').css('display')
                          if(estado == 'none') $('#tabla_otras_actividades').css('display','block')
                          if(estado == 'block') $('#tabla_otras_actividades').css('display','none')
                          " style="color: white; cursor: pointer; margin-top: 3px;"><i class="fa fa-caret-down"></i></a>
                          </div>
                        </div>
                      </div>

                      <div class="table-responsive" id="tabla_otras_actividades" style="display: none;">
                          <table class="table table-bordered">
                              <thead>
                                  <tr>
                                      <th><center><b>Actividad</b></center></th>
                                      <th><center><b>Descripcion</b></center></th>
                                      <th><center><b>Institucion</b></center></th>
                                      <th><center><b>Fecha</b></center></th>  
                                      <th><center><b>Horas por semana</b></center></th>  
                                  </tr>
                              </thead>
                              <style type="text/css"> 
                                .fil td{
                                  color: black !important;
                                }
                              </style>
                              <tbody id="bodytable_otras_actividades">
                                @foreach ($plan_trabajo->actividades as $actividad)
                                  @if ($actividad->id_dominio_tipo == 24)
                                  <tr>
                                    <td>{{ $actividad->nombre }}</td>
                                    <td>{{ $actividad->descripcion }}</td>
                                    <td>@php
                                      if ($actividad->fecha_iniciacion) {
                                        echo  date('d-m-Y', strtotime($actividad->fecha_iniciacion));
                                      }
                                    @endphp
                                    </td>
                                    <td>@php
                                      if ($actividad->fecha_terminacion) {
                                        echo  date('d-m-Y', strtotime($actividad->fecha_terminacion));
                                      }
                                    @endphp
                                    </td>
                                    <td><center>{{ $actividad->horas_por_semana }}</center></td>
                                    </td>
                                    <td><center><a style="font-size: 15px;"><i class="fa fa-times"></i></a></center>
                                    </td>
                                    <td><center><a onclick="eliminarActividad('{{ $actividad->nombre }}' , {{ $actividad->id_dominio_tipo }})" style="font-size: 25px; color: red; cursor: pointer;"><i class="fa fa-times"></i></a></center>
                                    </td>
                                    </tr>
                                    <script>
                                    agregar_antiguas_actividades({{ $actividad->id_dominio_tipo }},'{{ $actividad->nombre }}','{{ $actividad->descripcion }}','{{ $actividad->acta_aprobada }}','{{ $actividad->fecha_aprobada }}','{{ $actividad->fecha_iniciacion }}','{{ $actividad->fecha_terminacion }}',{{ $actividad->horas_por_semana }})
                                  </script>
                                  @endif
                                  @endforeach
                               
                              </tbody>
                          </table>
                      </div>
                    </div>

                    <br>
                    
                    <br>
                    @if ($permiso_para_modificar == true)
                      <center>
                      <button type="button" onclick="guardar()" class="btn btn-info">Guardar cambios</button>
                    </center>
                    @endif
                    

                  </div>
                </div>  
              </div>                           
            </div>

{{ Form::close() }}
        </div>
    </div>
</div>
</div>
<div class="modal fade" id="modalNewActividad" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><div id="titulo_modal"></div></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <div class="form-group" >
            <label for="recipient-name" class="col-form-label">Actividad o titulo</label>
            <input type="text" class="form-control" id="modal_nombre_actividad">
          </div>
          <div class="form-group" id="div_descripcion">
            <label for="message-text" class="col-form-label">Descripcion</label>
            <textarea class="form-control" id="modal_descripcion"></textarea>
          </div>
          <div class="form-group" id="div_acta">
            <label for="recipient-name" class="col-form-label">Acta de aprobacion</label>
            <input type="text" class="form-control" id="modal_acta_aprovacion">
          </div>
          <div class="form-group" id="div_fecha_aprobacion">
            <label for="recipient-name" class="col-form-label">Fecha de aprobacion</label>
            <input id="modal_fecha_aprobacion" type="text" class="form-control" readonly >
          </div>

          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Fecha de iniciacion</label>
            <input id="modal_fecha_iniciacion" type="text" class="form-control" readonly>
          </div>
          <div class="form-group" id="div_fecha_terminacion">
            <label for="recipient-name" class="col-form-label">Fecha de terminacion</label>
            <input id="modal_fecha_terminacion" type="text" class="form-control" readonly>
          </div>

          <div class="form-group" >
            <label for="recipient-name" min="0" class="col-form-label">Horas por semana</label>
            <input type="number" class="form-control" id="modal_horas_por_semana">
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <button type="button" onclick="agregar_actividad()" class="btn btn-info">Agregar</button>
      </div>
    </div>
  </div>
</div>

<script>
  $(document).ready(function(){
    $("#modal_fecha_aprobacion").datepicker({
        format: 'yyyy-mm-dd',
        language: 'es'
    });
    $("#modal_fecha_iniciacion").datepicker({
        format: 'yyyy-mm-dd'
    });
    $("#modal_fecha_terminacion").datepicker({
        format: 'yyyy-mm-dd'
    });
  })
  var tipo_actual = 0
  function AbrirModalNewActividad(tipo, titulo){
    tipo_actual = tipo
    $("#titulo_modal").html(titulo)
    $("#modalNewActividad").modal('show')
    if(tipo == 18 || tipo == 19){
      $("#div_descripcion").fadeOut()
      $("#div_acta").fadeIn()
      $("#div_fecha_aprobacion").fadeIn()
      $("#div_fecha_terminacion").fadeIn()
    }else{
      $("#div_descripcion").fadeIn()
      $("#div_acta").fadeOut()
      $("#div_fecha_aprobacion").fadeOut()
      $("#div_fecha_terminacion").fadeOut()
    }
  }

  function agregar_actividad() {
    var actividad = {
        'tipo' : tipo_actual,
        'nombre' : $('#modal_nombre_actividad').val(),
        'descripcion' : $('#modal_descripcion').val(),
        'acta' : $('#modal_acta_aprovacion').val(),
        'fecha_aprobada' : $('#modal_fecha_aprobacion').val(),
        'fecha_iniciacion' : $('#modal_fecha_iniciacion').val(),
        'fecha_terminacion' : $('#modal_fecha_terminacion').val(),
        'horas_semanales' : $('#modal_horas_por_semana').val()
      }
    lista_actividades.push(actividad)
    $("#modalNewActividad").modal('hide')
    actualizar_tablas(tipo_actual)
  }

  function eliminarActividad(nombre_actividad, tipo) {
     lista_actividades.forEach((actividad)=>{
        if(actividad.tipo == tipo && actividad.nombre == nombre_actividad){
          var posicion = lista_actividades.indexOf(actividad);
          lista_actividades.splice(posicion,1);
        }
     })  
     actualizar_tablas(tipo)  
  }





  function guardar(){
    var url = '{{ route('plan_trabajo/editar') }}'
    var token = $("#form-plan-trabajo").serialize().split("&")[0].split("=")[1];
     var _data = {
      '_token' : token,
      'id_plan_trabajo' : $("#id_plan_trabajo").val(),
      'id_tercero' : $("#id_tercero").val(),
      'id_periodo_academico' : $("#id_periodo_academico").val(),
      'total_asignaturas' : $("#total_asignaturas").val(),
      'total_grupos' : $("#total_grupos").val(),
      'total_estudiantes' : $("#total_estudiantes").val(),
      'horas_docencia_directa' : $("#horas_docencia_directa").val(),
      'horas_atencion_estudiantes' : $("#horas_atencion_estudiantes").val(),
      'horas_preparacion_evaluacion' : $("#horas_preparacion_evaluacion").val(),
      'horas_dedicadas_actividades' : $("#horas_dedicadas_actividades").val(),
      'horas_orientacion_proyectos' : $("#horas_orientacion_proyectos").val(),
      'horas_investigacion' : $("#horas_investigacion").val(),
      'horas_proyeccion_social' : $("#horas_proyeccion_social").val(),
      'horas_cooperacion' : $("#horas_cooperacion").val(),
      'horas_crecimiento_personal' : $("#horas_crecimiento_personal").val(),
      'horas_actividades_administrativas' : $("#horas_actividades_administrativas").val(),
      'horas_otras_actividades' : $("#horas_otras_actividades").val(),
      'horas_actividades_complementarias' : $("#horas_actividades_complementarias").val(),
      'observaciones' : $("#observaciones").val(),
      'actividades' : lista_actividades
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
        color: '#fff'
    }});

    $.ajax({
      type: "POST",
      url: url,
      data: _data,
      success: function(response) {
        $.unblockUI();
           if(response.error == false){
                    toastr.success('El plan de trabajo se ah registrado correctamente.', 'Guardado correctamente', {timeOut: 3000})
                   location.reload()
                }else{ 
                    console.log(response)
                    toastr.error(response.mensaje, 'Error', {timeOut: 5000})
                }
      },
      error: function() {
        toastr.error('Ah ocurrido un error al intentar registrar el plan de trabajo.', 'Error', {timeOut: 3000})
      }
  });
            


        }
</script>
    
@endsection