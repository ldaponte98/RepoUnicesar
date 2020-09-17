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
                              
    </div>
@endsection
@section('content')

@php

$is_admin = session('is_admin');

if($is_admin==true){
  $permiso_para_modificar = false;
}
@endphp
<script>
  $(document).ready(function() {
    agregar_evento_antiguos_horario()
  })
  var lista_actividades = []
  var horario = []
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
                      tabla += "<td>"+actividad.descripcion+"</td>"+
                              "<td>"+actividad.institucion+"</td>"
                    }
                    if(tipo == 18 || tipo == 19){
                      tabla +="<td>"+actividad.fecha_iniciacion+"</td>"+
                     "<td>"+actividad.fecha_terminacion+"</td>"+
                     "<td>"+actividad.horas_semanales+"</td>"
                    }else{
                      tabla +="<td>"+actividad.fecha_iniciacion+"</td>"+
                     "<td>"+actividad.horas_semanales+"</td>"
                    }
                   
          @if ($permiso_para_modificar)
                   tabla += "<td style = 'width : 100px !important;'><center><a onclick=\"eliminarActividad('"+actividad.nombre+"' , "+actividad.tipo+")\" style='font-size: 25px; color: red; cursor: pointer;''><i class='fa fa-times'></i></a>  &nbsp;  &nbsp; <a onclick=\"AbrirModalEditarActividad("+actividad.tipo+" ,'"+actividad.nombre+"')\" style='font-size: 25px; color: orange; cursor: pointer;''><i class='fa fa-edit'></i></a> </center></td>"
          @endif
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

    var total_horas_actividades_docente = $("#horas_dedicadas_actividades").val()
    
    $("#total_horas_semana").val(parseInt(total_horas_actividades_docente) + parseInt(total_horas_de_actividades))
  }
    function agregar_antiguas_actividades(tipo,nombre, descripcion,institucion, acta, fecha_aprobada, fecha_iniciacion, fecha_terminacion, horas_semanales, requiere_actividad_complementaria) {
      var actividad = {
        'tipo' : tipo,
        'nombre' : nombre,
        'descripcion' : descripcion,
        'institucion' : institucion,
        'acta' : acta,
        'fecha_aprobada' : fecha_aprobada,
        'fecha_iniciacion' : fecha_iniciacion,
        'fecha_terminacion' : fecha_terminacion,
        'horas_semanales' : horas_semanales,
        'requiere_actividad_complementaria' : requiere_actividad_complementaria
      }
      lista_actividades.push(actividad)
      actualizar_tablas(tipo)
    }

    function agregar_evento_antiguos_horario() {
    
    <?php 
      if($horario){
         foreach ($horario->detalles as $detalle) {
           ?> 
            var evento = {
                'dia' : '{{ $detalle->dia_semana }}',
                'hora' : '{{ $detalle->hora }}',
                'nombre' : '{{ $detalle->evento }}',
                'tipo_evento' : '{{ $detalle->tipo_evento->dominio }}',
                'id_tipo_evento' : '{{ $detalle->id_dominio_tipo_evento }}'
            }
            horario.push(evento)
           <?php
        } 
      }
    ?>
    actualizar_horario()
    }

    function solo_numero(valor) {
      var filtro = /^([0-9])*$/
      if (filtro.test(valor) && valor != "e" && valor != "E" ){
      return true
      }
      else{
      return false
      }
    }
   
</script>



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

                  <style type="text/css">
                    .tabla_info td{
                      padding: 10px !important;
                    }

                    .input_info{
                      border-width:0; 
                      width: 100%;
                      text-align: center;
                      
                    }
                    .td_valor{
                      width: 50px !important;
                      text-align: center;
                    }

                  </style>
                  <div id="div_form_plan_trabajo" style="display: none">
                    <label style="color: black;"><b>Informacion General</b></label><br><br>

                    <input type="hidden" id="id_plan_trabajo" value="{{ $plan_trabajo->id_plan_trabajo }}">
                  <input type="hidden" id="id_periodo_academico" value="{{ $periodo_academico->id_periodo_academico }}">
                  <input type="hidden" id="id_tercero" value="{{ $tercero->id_tercero }}">
                    
                    <table class="tabla_info" width="100%" cellspacing="0" cellpadding="0" border="1">
                      <tr>
                        <td colspan="3"><label style="color: black;"><b>Total asignaturas a cargo</b></label></td>
                        <td colspan="1" class="td_valor"><input class="input_info" id="total_asignaturas" name="total_asignaturas" value="{{ count($tercero->asignaturas_por_periodo_academico($periodo_academico->id_periodo_academico)) }}" readonly>

                        </td>
                      </tr>

                      <tr>
                        <td colspan="3"><label style="color: black;"><b>Total grupos</b></label></td>
                        <td colspan="1" class="td_valor">
                         <input id="total_grupos" name="total_grupos" class="input_info" value="{{ count($tercero->grupos_por_periodo_academico($periodo_academico->id_periodo_academico)) }}" readonly></td>
                      </tr>
                      <tr>
                        <td colspan="3"><label style="color: black;"><b>Total estudiantes</b></label></td>
                        <td colspan="1" class="td_valor">
                         <input id="total_estudiantes" name="total_estudiantes" class="input_info" value="{{ $tercero->num_estudiantes_por_periodo_academico($periodo_academico->id_periodo_academico) }}" readonly></td>

                      </tr>

                      <tr>
                        <td colspan="3"><label style="color: black;"><b>Total horas de docencia directa</b></label></td>
                        <td colspan="1" class="td_valor">
                          <input id="horas_docencia_directa" name="horas_docencia_directa"  class="input_info" value="{{ $tercero->total_horas_docencia($periodo_academico->id_periodo_academico) }}" readonly></td>

                      </tr>
                      <tr>
                        <td colspan="3"><label style="color: black;"><b>Total horas de atencion a estudiantes</b></label></td>
                        <td colspan="1" class="td_valor">
                         <input id="horas_atencion_estudiantes" name="horas_atencion_estudiantes" class="input_info" value="{{ $tercero->total_horas_atencion_a_estudiantes($periodo_academico->id_periodo_academico) }}"></td>
                      </tr>
                      <tr>
                        <td colspan="3"><label style="color: black;"><b>Total horas de preparacion y evaluacion de las asignaturas</b></label></td>
                        <td colspan="1" class="td_valor">
                         <input id="horas_preparacion_evaluacion" name="horas_preparacion_evaluacion"  class="input_info" value="{{ $tercero->total_horas_preparacion_evaluacion($periodo_academico->id_periodo_academico) }}"></td>
                      </tr>

                      <tr>
                        <td colspan="3"><label style="color: black;"><b>Total horas dedicadas a las actividades docente</b></label></td>
                        <td colspan="1" class="td_valor"><b>
                          @php
                            $total_horas_actividades_docente = $tercero->total_horas_docencia($periodo_academico->id_periodo_academico) + 
                                                               $tercero->total_horas_atencion_a_estudiantes($periodo_academico->id_periodo_academico) + 
                                                               $tercero->total_horas_preparacion_evaluacion($periodo_academico->id_periodo_academico);
                          @endphp
                         <input id="horas_dedicadas_actividades" name="horas_dedicadas_actividades" style="font-weight:bold;"  class="input_info" value="{{ $total_horas_actividades_docente }}"></b></td>
                      </tr>

                      <tr>
                        <td colspan="3"><label style="color: black;"><b>Total horas de orientación y evaluación de los trabajos de grado</b></label></td>
                        <td colspan="1" class="td_valor">
                         <input id="horas_orientacion_proyectos" name="horas_orientacion_proyectos"  class="input_info" value="{{ $plan_trabajo->horas_orientacion_proyectos }}" readonly></td>
                      </tr>

                       <tr>
                        <td colspan="3"><label style="color: black;"><b>Total horas dedicadas a la investigación aprobada</b></label></td>
                        <td colspan="1" class="td_valor">
                           <input id="horas_investigacion" name="horas_investigacion"  class="input_info" value="{{ $plan_trabajo->horas_investigacion }}" readonly></td>
                      </tr>

                       <tr>
                        <td colspan="3"><label style="color: black;"><b>Total horas dedicadas a la proyeccion social registrada</b></label></td>
                        <td colspan="1" class="td_valor">
                           <input id="horas_proyeccion_social" name="horas_proyeccion_social"  class="input_info" value="{{ $plan_trabajo->horas_proyeccion_social }}" readonly></td>
                      </tr> 
                      <tr>
                        <td colspan="3"><label style="color: black;"><b>Total horas dedicadas a la cooperación interinstitucional</b></label></td>
                        <td colspan="1" class="td_valor">
                           <input id="horas_cooperacion" name="horas_cooperacion"  class="input_info" value="{{ $plan_trabajo->horas_cooperacion }}" readonly></td>
                      </tr>  
                      <tr>
                        <td colspan="3"><label style="color: black;"><b>Total horas dedicadas para el crecimiento personal y profesional</b></label></td>
                        <td colspan="1" class="td_valor">
                           <input id="horas_crecimiento_personal" name="horas_crecimiento_personal"  class="input_info" value="{{ $plan_trabajo->horas_crecimiento_personal }}" readonly></td>
                      </tr> 
                      <tr>
                        <td colspan="3"><label style="color: black;"><b>Total horas dedicadas a las actividades administrativas</b></label></td>
                        <td colspan="1" class="td_valor">
                           <input id="horas_actividades_administrativas" name="horas_actividades_administrativas"  class="input_info" value="{{ $plan_trabajo->horas_actividades_administrativas }}" readonly>
                         </td>
                      </tr> 
                       <tr>
                        <td colspan="3"><label style="color: black;"><b>Total horas para otras actividades</b></label></td>
                        <td colspan="1" class="td_valor">
                           <input id="horas_otras_actividades" name="horas_otras_actividades"  class="input_info" value="{{ $plan_trabajo->horas_otras_actividades }}" readonly>
                         </td>
                      </tr>
                      <tr>
                        <td colspan="3"><label style="color: black;"><b>Total horas dedicadas a las actividades docente complementarias</b></label></td>
                        <td colspan="1" class="td_valor">
                           <input id="horas_actividades_complementarias" name="horas_actividades_complementarias" style="font-weight: bold;"  class="input_info" value="{{ $plan_trabajo->horas_actividades_complementarias }}">
                         </td>
                      </tr> 
                      <tr style="background-color: #c7e6a4">
                        <td colspan="3"><label style="color: black;"><b>Total de horas por plan de trabajo</b></label></td>
                        <td colspan="1" class="td_valor">
                           <input id="total_horas_semana" name="total_horas_semana" style="font-weight: bold; background-color: transparent;" class="input_info" value="{{ $total_horas_actividades_docente + $plan_trabajo->horas_actividades_complementarias }}" readonly>
                         </td>
                      </tr>       
                    </table> 
                    
                    <br>
                    <div class="row">
                      <div class="col-sm-12">
                           <label for="observaciones"><b>Observaciones</b></label>
                           <input id="observaciones" name="observaciones" type="text"  class="form-control form-control-line" placeholder="Escriba aqui cualquier observacion con relacion a este plan de trabajo" value="{{ $plan_trabajo->observaciones }}">
                      </div>
                    </div>
                    <br><br>
                    <label style="color: black;"><b>Cuadros explicativos de las actividades docentes</b></label>
                    <br><br>
                    <div class="card">
                      <div class="card-header bg-info">
                        <div class="row">
                          <div class="col-sm-12">
                          <h4 class="mb-0 text-white">Orientación y evaluación de los trabajos de grado
                          <div class="pull-right">
                            @if ($permiso_para_modificar == true)
                              <a  style="color: white; cursor: pointer;" title="Agregar nuevo" onclick ="AbrirModalNewActividad(18, 'Orientación y evaluación de los trabajos de grado')"><i class="fa fa-plus-circle"></i></a> &nbsp; &nbsp;
                            @endif
                          <a onclick=" 
                          var estado = $('#tabla_proyectos_grado').css('display')
                          if(estado == 'none') $('#tabla_proyectos_grado').css('display','block')
                          if(estado == 'block') $('#tabla_proyectos_grado').css('display','none')
                          " style="color: white; cursor: pointer; "><i class="fa fa-caret-down"></i></a>
                          </div></h4>
                          
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
                                    agregar_antiguas_actividades({{ $actividad->id_dominio_tipo }},'{{ $actividad->nombre }}','{{ $actividad->descripcion }}','{{ $actividad->institucion }}','{{ $actividad->acta_aprobada }}','{{ $actividad->fecha_aprobada }}','{{ $actividad->fecha_iniciacion }}','{{ $actividad->fecha_terminacion }}',{{ $actividad->horas_por_semana }},'{{ $actividad->requiere_actividad_complementaria }}')
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
                          <div class="col-sm-12">
                          <h4 class="mb-0 text-white">Investigacion aprobada
                           <div class="pull-right">
                            @if ($permiso_para_modificar == true)
                          <a  style="color: white; cursor: pointer;" title="Agregar nuevo" onclick ="AbrirModalNewActividad(19,'Investigacion aprobada')"><i class="fa fa-plus-circle"></i></a> &nbsp; &nbsp;
                          @endif
                          <a  onclick=" 
                          var estado = $('#tabla_investigaciones_aprobadas').css('display')
                          if(estado == 'none') $('#tabla_investigaciones_aprobadas').css('display','block')
                          if(estado == 'block') $('#tabla_investigaciones_aprobadas').css('display','none')
                          " style="color: white; cursor: pointer;"><i class="fa fa-caret-down"></i></a>
                          </div></h4>
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
                                    agregar_antiguas_actividades({{ $actividad->id_dominio_tipo }},'{{ $actividad->nombre }}','{{ $actividad->descripcion }}','{{ $actividad->institucion }}','{{ $actividad->acta_aprobada }}','{{ $actividad->fecha_aprobada }}','{{ $actividad->fecha_iniciacion }}','{{ $actividad->fecha_terminacion }}',{{ $actividad->horas_por_semana }},'{{ $actividad->requiere_actividad_complementaria }}')
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
                          <div class="col-sm-12">
                          <h4 class="mb-0 text-white">Proyeccion social
                          <div class="pull-right">
                            @if ($permiso_para_modificar ==  true)
                              <a  style="color: white; cursor: pointer;" title="Agregar nuevo" onclick ="AbrirModalNewActividad(20, 'Proyeccion social')"><i class="fa fa-plus-circle"></i></a> &nbsp; &nbsp;
                            @endif
                          
                          <a class="" onclick=" 
                          var estado = $('#tabla_proyeccion_social').css('display')
                          if(estado == 'none') $('#tabla_proyeccion_social').css('display','block')
                          if(estado == 'block') $('#tabla_proyeccion_social').css('display','none')
                          " style="color: white; cursor: pointer;"><i class="fa fa-caret-down"></i></a>
                          </div></h4>
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
                                    agregar_antiguas_actividades({{ $actividad->id_dominio_tipo }},'{{ $actividad->nombre }}','{{ $actividad->descripcion }}','{{ $actividad->institucion }}','{{ $actividad->acta_aprobada }}','{{ $actividad->fecha_aprobada }}','{{ $actividad->fecha_iniciacion }}','{{ $actividad->fecha_terminacion }}',{{ $actividad->horas_por_semana }},'{{ $actividad->requiere_actividad_complementaria }}')
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
                          <div class="col-sm-12">
                          <h4 class="mb-0 text-white">Cooperación interinstitucional
                          <div class="pull-right">
                            @if ($permiso_para_modificar)
                              <a  style="color: white; cursor: pointer;" title="Agregar nuevo" onclick ="AbrirModalNewActividad(21,'Cooperación interinstitucional')"><i class="fa fa-plus-circle"></i></a> &nbsp; &nbsp;
                            @endif
                          
                          <a class="" onclick=" 
                          var estado = $('#tabla_cooperacion').css('display')
                          if(estado == 'none') $('#tabla_cooperacion').css('display','block')
                          if(estado == 'block') $('#tabla_cooperacion').css('display','none')
                          " style="color: white; cursor: pointer; "><i class="fa fa-caret-down"></i></a>
                          </div>
                        </h4>

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
                                    agregar_antiguas_actividades({{ $actividad->id_dominio_tipo }},'{{ $actividad->nombre }}','{{ $actividad->descripcion }}','{{ $actividad->institucion }}','{{ $actividad->acta_aprobada }}','{{ $actividad->fecha_aprobada }}','{{ $actividad->fecha_iniciacion }}','{{ $actividad->fecha_terminacion }}',{{ $actividad->horas_por_semana }},'{{ $actividad->requiere_actividad_complementaria }}')
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
                          <div class="col-sm-12">
                          <h4 class="mb-0 text-white">Crecimiento personal y desarrollo
                          <div class="pull-right">
                            @if ($permiso_para_modificar == true)
                               <a  style="color: white; cursor: pointer;" title="Agregar nuevo" onclick ="AbrirModalNewActividad(22,'Crecimiento personal y desarrollo')"><i class="fa fa-plus-circle"></i></a> &nbsp; &nbsp;
                            @endif
                         
                          <a class="" onclick=" 
                          var estado = $('#tabla_crecimiento').css('display')
                          if(estado == 'none') $('#tabla_crecimiento').css('display','block')
                          if(estado == 'block') $('#tabla_crecimiento').css('display','none')
                          " style="color: white; cursor: pointer;"><i class="fa fa-caret-down"></i></a>
                          </div>
                        </h4>
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
                                    agregar_antiguas_actividades({{ $actividad->id_dominio_tipo }},'{{ $actividad->nombre }}','{{ $actividad->descripcion }}','{{ $actividad->institucion }}','{{ $actividad->acta_aprobada }}','{{ $actividad->fecha_aprobada }}','{{ $actividad->fecha_iniciacion }}','{{ $actividad->fecha_terminacion }}',{{ $actividad->horas_por_semana }},'{{ $actividad->requiere_actividad_complementaria }}')
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
                          <div class="col-sm-12">
                          <h4 class="mb-0 text-white">Actividades administrativas
                          <div class="pull-right">
                            @if ($permiso_para_modificar == true)
                              {{-- expr --}}
                           
                          <a  style="color: white; cursor: pointer;" title="Agregar nuevo" onclick ="AbrirModalNewActividad(23, 'Actividades administrativas')"><i class="fa fa-plus-circle"></i></a> &nbsp; &nbsp;
                           @endif
                          <a class="" onclick=" 
                          var estado = $('#tabla_actividades_Administrativas').css('display')
                          if(estado == 'none') $('#tabla_actividades_Administrativas').css('display','block')
                          if(estado == 'block') $('#tabla_actividades_Administrativas').css('display','none')
                          " style="color: white; cursor: pointer; margin-top: 3px;"><i class="fa fa-caret-down"></i></a>
                          </div></h4>
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
                                    agregar_antiguas_actividades({{ $actividad->id_dominio_tipo }},'{{ $actividad->nombre }}','{{ $actividad->descripcion }}','{{ $actividad->institucion }}','{{ $actividad->acta_aprobada }}','{{ $actividad->fecha_aprobada }}','{{ $actividad->fecha_iniciacion }}','{{ $actividad->fecha_terminacion }}',{{ $actividad->horas_por_semana }},'{{ $actividad->requiere_actividad_complementaria }}')
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
                          <div class="col-sm-12">
                          <h4 class="mb-0 text-white">Otras actividades
                          <div class="pull-right">
                            @if ($permiso_para_modificar == true)
                              {{-- expr --}}
                            
                          <a  style="color: white; cursor: pointer;" title="Agregar nuevo" onclick ="AbrirModalNewActividad(24,'Otras actividades')"><i class="fa fa-plus-circle"></i></a> &nbsp; &nbsp;
                          @endif
                          <a class="" onclick=" 
                          var estado = $('#tabla_otras_actividades').css('display')
                          if(estado == 'none') $('#tabla_otras_actividades').css('display','block')
                          if(estado == 'block') $('#tabla_otras_actividades').css('display','none')
                          " style="color: white; cursor: pointer; margin-top: 3px;"><i class="fa fa-caret-down"></i></a>
                          </div>
                        </h4>
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
                                    agregar_antiguas_actividades({{ $actividad->id_dominio_tipo }},'{{ $actividad->nombre }}','{{ $actividad->descripcion }}','{{ $actividad->institucion }}','{{ $actividad->acta_aprobada }}','{{ $actividad->fecha_aprobada }}','{{ $actividad->fecha_iniciacion }}','{{ $actividad->fecha_terminacion }}',{{ $actividad->horas_por_semana }},'{{ $actividad->requiere_actividad_complementaria }}')
                                  </script>
                                  @endif
                                  @endforeach
                               
                              </tbody>
                          </table>
                      </div>
                    </div>
                    
                    <br><br>
<center><label style="color: black;"><b>Horario de actividades</b></label></center>

<br><br>
<i style="font-size: 12px">Presione en los espacion vacios del calendario para agregar nuevos eventos.</i>
<br>
<style type="text/css">
  .tablita{
    border-color: black;
  }
  .tablita td{
    cursor: pointer !important;
    border-color: black;
  }
  .tablita p{
   font-size: 12px;
   margin-bottom: 0px;
  }
  .tablita th{
   color: black !important;
  }
</style>
<div class="table-responsive">
<table class="table table-bordered no-wrap tablita" >
    <tr style="background-color: #c7e6a4">
      <td style="color: black !important;"><center><b>HORAS</b></center></td>
      <th><center><b>LUNES</b></center></th>
      <th><center><b>MARTES</b></center></th>
      <th><center><b>MIERCOLES</b></center></th>
      <th><center><b>JUEVES</b></center></th>
      <th><center><b>VIERNES</b></center></th>
      <th><center><b>SABADO</b></center></th>
    </tr>
    <tr>
      <th ><center><b>6 - 7</b></center></th>
      <td id="td_Lunes_6-7" onclick="ModalNuevoEvento('Lunes', '6-7')"><center></center></td>
      <td id="td_Martes_6-7" onclick="ModalNuevoEvento('Martes', '6-7')"><center></center></td>
      <td id="td_Miercoles_6-7" onclick="ModalNuevoEvento('Miercoles', '6-7')"><center></center></td>
      <td id="td_Jueves_6-7" onclick="ModalNuevoEvento('Jueves', '6-7')"><center></center></td>
      <td id="td_Viernes_6-7" onclick="ModalNuevoEvento('Viernes', '6-7')"><center></center></td>
      <td id="td_Sabado_6-7" onclick="ModalNuevoEvento('Sabado', '6-7')"><center></center></td>
    </tr>
    <tr>
      <th><center><b>7 - 8</b></center></th>
      <td id="td_Lunes_7-8" onclick="ModalNuevoEvento('Lunes', '7-8')"><center></center></td>
      <td id="td_Martes_7-8" onclick="ModalNuevoEvento('Martes', '7-8')"><center></center></td>
      <td id="td_Miercoles_7-8" onclick="ModalNuevoEvento('Miercoles', '7-8')"><center></center></td>
      <td id="td_Jueves_7-8" onclick="ModalNuevoEvento('Jueves', '7-8')"><center></center></td>
      <td id="td_Viernes_7-8" onclick="ModalNuevoEvento('Viernes', '7-8')"><center></center></td>
      <td id="td_Sabado_7-8" onclick="ModalNuevoEvento('Sabado', '7-8')"><center></center></td>
    </tr>
    <tr>
      <th><center><b>8 - 9</b></center></th>
      <td id="td_Lunes_8-9" onclick="ModalNuevoEvento('Lunes', '8-9')"><center></center></td>
      <td id="td_Martes_8-9" onclick="ModalNuevoEvento('Martes', '8-9')"><center></center></td>
      <td id="td_Miercoles_8-9" onclick="ModalNuevoEvento('Miercoles', '8-9')"><center></center></td>
      <td id="td_Jueves_8-9" onclick="ModalNuevoEvento('Jueves', '8-9')"><center></center></td>
      <td id="td_Viernes_8-9" onclick="ModalNuevoEvento('Viernes', '8-9')"><center></center></td>
      <td id="td_Sabado_8-9" onclick="ModalNuevoEvento('Sabado', '8-9')"><center></center></td>
    </tr>
    <tr>
      <th><center><b>9 - 10</b></center></th>
      <td id="td_Lunes_9-10" onclick="ModalNuevoEvento('Lunes', '9-10')"><center></center></td>
      <td id="td_Martes_9-10" onclick="ModalNuevoEvento('Martes', '9-10')"><center></center></td>
      <td id="td_Miercoles_9-10" onclick="ModalNuevoEvento('Miercoles', '9-10')"><center></center></td>
      <td id="td_Jueves_9-10" onclick="ModalNuevoEvento('Jueves', '9-10')"><center></center></td>
      <td id="td_Viernes_9-10" onclick="ModalNuevoEvento('Viernes', '9-10')"><center></center></td>
      <td id="td_Sabado_9-10" onclick="ModalNuevoEvento('Sabado', '9-10')"><center></center></td>
    </tr>
    <tr>
      <th><center><b>10 - 11</b></center></th>
      <td id="td_Lunes_10-11" onclick="ModalNuevoEvento('Lunes', '10-11')"><center></center></td>
      <td id="td_Martes_10-11" onclick="ModalNuevoEvento('Martes', '10-11')"><center></center></td>
      <td id="td_Miercoles_10-11" onclick="ModalNuevoEvento('Miercoles', '10-11')"><center></center></td>
      <td id="td_Jueves_10-11" onclick="ModalNuevoEvento('Jueves', '10-11')"><center></center></td>
      <td id="td_Viernes_10-11" onclick="ModalNuevoEvento('Viernes', '10-11')"><center></center></td>
      <td id="td_Sabado_10-11" onclick="ModalNuevoEvento('Sabado', '10-11')"><center></center></td>
    </tr>
    <tr>
      <th><center><b>11 - 12</b></center></th>
      <td id="td_Lunes_11-12" onclick="ModalNuevoEvento('Lunes', '11-12')"><center></center></td>
      <td id="td_Martes_11-12" onclick="ModalNuevoEvento('Martes', '11-12')"><center></center></td>
      <td id="td_Miercoles_11-12" onclick="ModalNuevoEvento('Miercoles', '11-12')"><center></center></td>
      <td id="td_Jueves_11-12" onclick="ModalNuevoEvento('Jueves', '11-12')"><center></center></td>
      <td id="td_Viernes_11-12" onclick="ModalNuevoEvento('Viernes', '11-12')"><center></center></td>
      <td id="td_Sabado_11-12" onclick="ModalNuevoEvento('Sabado', '11-12')"><center></center></td>
    </tr>
    <tr>
      <th><center><b>12 - 13</b></center></th>
      <td id="td_Lunes_12-13" onclick="ModalNuevoEvento('Lunes', '12-13')"><center></center></td>
      <td id="td_Martes_12-13" onclick="ModalNuevoEvento('Martes', '12-13')"><center></center></td>
      <td id="td_Miercoles_12-13" onclick="ModalNuevoEvento('Miercoles', '12-13')"><center></center></td>
      <td id="td_Jueves_12-13" onclick="ModalNuevoEvento('Jueves', '12-13')"><center></center></td>
      <td id="td_Viernes_12-13" onclick="ModalNuevoEvento('Viernes', '12-13')"><center></center></td>
      <td id="td_Sabado_12-13" onclick="ModalNuevoEvento('Sabado', '12-13')"><center></center></td>
    </tr>
    <tr>
      <th><center><b>13 - 14</b></center></th>
      <td id="td_Lunes_13-14" onclick="ModalNuevoEvento('Lunes', '13-14')"><center></center></td>
      <td id="td_Martes_13-14" onclick="ModalNuevoEvento('Martes', '13-14')"><center></center></td>
      <td id="td_Miercoles_13-14" onclick="ModalNuevoEvento('Miercoles', '13-14')"><center></center></td>
      <td id="td_Jueves_13-14" onclick="ModalNuevoEvento('Jueves', '13-14')"><center></center></td>
      <td id="td_Viernes_13-14" onclick="ModalNuevoEvento('Viernes', '13-14')"><center></center></td>
      <td id="td_Sabado_13-14" onclick="ModalNuevoEvento('Sabado', '13-14')"><center></center></td>
    </tr>
    <tr>
      <th><center><b>14 - 15</b></center></th>
      <td id="td_Lunes_14-15" onclick="ModalNuevoEvento('Lunes', '14-15')"><center></center></td>
      <td id="td_Martes_14-15" onclick="ModalNuevoEvento('Martes', '14-15')"><center></center></td>
      <td id="td_Miercoles_14-15" onclick="ModalNuevoEvento('Miercoles', '14-15')"><center></center></td>
      <td id="td_Jueves_14-15" onclick="ModalNuevoEvento('Jueves', '14-15')"><center></center></td>
      <td id="td_Viernes_14-15" onclick="ModalNuevoEvento('Viernes', '14-15')"><center></center></td>
      <td id="td_Sabado_14-15" onclick="ModalNuevoEvento('Sabado', '14-15')"><center></center></td>
    </tr>
    <tr>
      <th><center><b>15 - 16</b></center></th>
      <td id="td_Lunes_15-16" onclick="ModalNuevoEvento('Lunes', '15-16')"><center></center></td>
      <td id="td_Martes_15-16" onclick="ModalNuevoEvento('Martes', '15-16')"><center></center></td>
      <td id="td_Miercoles_15-16" onclick="ModalNuevoEvento('Miercoles', '15-16')"><center></center></td>
      <td id="td_Jueves_15-16" onclick="ModalNuevoEvento('Jueves', '15-16')"><center></center></td>
      <td id="td_Viernes_15-16" onclick="ModalNuevoEvento('Viernes', '15-16')"><center></center></td>
      <td id="td_Sabado_15-16" onclick="ModalNuevoEvento('Sabado', '15-16')"><center></center></td>
    </tr>
    <tr>
      <th><center><b>16 - 17</b></center></th>
      <td id="td_Lunes_16-17" onclick="ModalNuevoEvento('Lunes', '16-17')"><center></center></td>
      <td id="td_Martes_16-17" onclick="ModalNuevoEvento('Martes', '16-17')"><center></center></td>
      <td id="td_Miercoles_16-17" onclick="ModalNuevoEvento('Miercoles', '16-17')"><center></center></td>
      <td id="td_Jueves_16-17" onclick="ModalNuevoEvento('Jueves', '16-17')"><center></center></td>
      <td id="td_Viernes_16-17" onclick="ModalNuevoEvento('Viernes', '16-17')"><center></center></td>
      <td id="td_Sabado_16-17" onclick="ModalNuevoEvento('Sabado', '16-17')"><center></center></td>
    </tr>
    <tr>
      <th><center><b>17- 18</b></center></th>
      <td id="td_Lunes_17-18" onclick="ModalNuevoEvento('Lunes', '17-18')"><center></center></td>
      <td id="td_Martes_17-18" onclick="ModalNuevoEvento('Martes', '17-18')"><center></center></td>
      <td id="td_Miercoles_17-18" onclick="ModalNuevoEvento('Miercoles', '17-18')"><center></center></td>
      <td id="td_Jueves_17-18" onclick="ModalNuevoEvento('Jueves', '17-18')"><center></center></td>
      <td id="td_Viernes_17-18" onclick="ModalNuevoEvento('Viernes', '17-18')"><center></center></td>
      <td id="td_Sabado_17-18" onclick="ModalNuevoEvento('Sabado', '17-18')"><center></center></td>
    </tr>
    <tr>
      <th><center><b>18 - 19</b></center></th>
      <td id="td_Lunes_18-19" onclick="ModalNuevoEvento('Lunes', '18-19')"><center></center></td>
      <td id="td_Martes_18-19" onclick="ModalNuevoEvento('Martes', '18-19')"><center></center></td>
      <td id="td_Miercoles_18-19" onclick="ModalNuevoEvento('Miercoles', '18-19')"><center></center></td>
      <td id="td_Jueves_18-19" onclick="ModalNuevoEvento('Jueves', '18-19')"><center></center></td>
      <td id="td_Viernes_18-19" onclick="ModalNuevoEvento('Viernes', '18-19')"><center></center></td>
      <td id="td_Sabado_18-19" onclick="ModalNuevoEvento('Sabado', '18-19')"><center></center></td>
    </tr>
    <tr>
      <th><center><b>19 - 20</b></center></th>
      <td id="td_Lunes_19-20" onclick="ModalNuevoEvento('Lunes', '19-20')"><center></center></td>
      <td id="td_Martes_19-20" onclick="ModalNuevoEvento('Martes', '19-20')"><center></center></td>
      <td id="td_Miercoles_19-20" onclick="ModalNuevoEvento('Miercoles', '19-20')"><center></center></td>
      <td id="td_Jueves_19-20" onclick="ModalNuevoEvento('Jueves', '19-20')"><center></center></td>
      <td id="td_Viernes_19-20" onclick="ModalNuevoEvento('Viernes', '19-20')"><center></center></td>
      <td id="td_Sabado_19-20" onclick="ModalNuevoEvento('Sabado', '19-20')"><center></center></td>
    </tr>
    <tr>
      <th><center><b>20 - 21</b></center></th>
      <td id="td_Lunes_20-21" onclick="ModalNuevoEvento('Lunes', '20-21')"><center></center></td>
      <td id="td_Martes_20-21" onclick="ModalNuevoEvento('Martes', '20-21')"><center></center></td>
      <td id="td_Miercoles_20-21" onclick="ModalNuevoEvento('Miercoles', '20-21')"><center></center></td>
      <td id="td_Jueves_20-21" onclick="ModalNuevoEvento('Jueves', '20-21')"><center></center></td>
      <td id="td_Viernes_20-21" onclick="ModalNuevoEvento('Viernes', '20-21')"><center></center></td>
      <td id="td_Sabado_20-21" onclick="ModalNuevoEvento('Sabado', '20-21')"><center></center></td>
    </tr>
    <tr>
      <th><center><b>21 - 22</b></center></th>
      <td id="td_Lunes_21-22" onclick="ModalNuevoEvento('Lunes', '21-22')"><center></center></td>
      <td id="td_Martes_21-22" onclick="ModalNuevoEvento('Martes', '21-22')"><center></center></td>
      <td id="td_Miercoles_21-22" onclick="ModalNuevoEvento('Miercoles', '21-22')"><center></center></td>
      <td id="td_Jueves_21-22" onclick="ModalNuevoEvento('Jueves', '21-22')"><center></center></td>
      <td id="td_Viernes_21-22" onclick="ModalNuevoEvento('Viernes', '21-22')"><center></center></td>
      <td id="td_Sabado_21-22" onclick="ModalNuevoEvento('Sabado', '21-22')"><center></center></td>
    </tr> 
</table>
</div>


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
          <div class="form-group" id="div_institucion">
            <label for="message-text" class="col-form-label">Institución</label>
            <input type="text" class="form-control" id="modal_institucion" value="Universidad Popular del cesar">
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
            <input type="number" min="1" max="40" class="form-control" id="modal_horas_por_semana">
          </div>
           <div class="form-group">
              <input type="checkbox" checked class="form-check-input" id="check_requerido_actividad" style="margin-left: 0px !important">
              <label class="form-check-label" for="exampleCheck1">Requerido para actividades complementarias</label>
           </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" onclick="agregar_actividad()" class="btn btn-info">Agregar</button>
      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="modalNewEvento" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><div id="titulo_modal_evento"></div></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <input type="hidden" id="dia_escojido">
          <input type="hidden" id="hora_escojida">
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Tipo de actividad</label>
            <select class="form-control" id="select_tipos_actividades" onchange="cargar_actividades(this.value)">
              <option value="0">Seleccione...</option>
              <option value="18">Orientación y evaluación de los trabajos de grado</option>
              <option value="19">Investigacion aprobada</option>
              <option value="20">Proyeccion social</option>
              <option value="21">Cooperación interinstitucional</option>
              <option value="22">Crecimiento personal y desarrollo</option>
              <option value="23">Actividades administrativas</option>
              <option value="24">Otras actividades</option>
            </select>
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Actividad</label>
            <select class="form-control" id="select_actividades_para_evento">
              <option value="0">Seleccione...</option>
            </select>
          </div>
          <br>
          <div class="alert alert-danger" id="mensaje_evento" style="display: none"></div>
          
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" onclick="agregar_evento_horario()" class="btn btn-info">Agregar a horario</button>
      </div>
    </div>
  </div>
</div>


<script>
  var bandera_elimino = false
  var bandera_editar = false
  var id_tipo_evento_editar = -1
  function ModalNuevoEvento(dia, hora) {
     @if($permiso_para_modificar)
    if(bandera_elimino == false){
      if(validar_disponibilidad_calendario(dia,hora) == true){//aca se valida q solo haya un solo evento por dia y hora
        $("#titulo_modal_evento").html("Nuevo evento para el "+dia+ " de "+hora)
        $("#dia_escojido").val(dia)
        $("#hora_escojida").val(hora)
        $("#modalNewEvento").modal('show')
      }
    }else{
      bandera_elimino = false
    }
    @endif
  }

  function cargar_actividades(tipo) {
    var actividades = ""
    var posicion = 0 //esta es la posicion de la actividad en la lista de actividades
    lista_actividades.forEach((actividad)=>{
        if(actividad.tipo == tipo){
         actividades += "<option value = '"+posicion+"'>"+actividad.nombre+"</option>"
        }
        posicion++
     }) 
     $("#select_actividades_para_evento").html(actividades) 
  }

  function actualizar_horario() {
    horario.forEach((evento)=>{
      var td = "<center><p>"+evento.tipo_evento+" <br>"+"<strong>"+evento.nombre+"</strong> <br>";
      @if($permiso_para_modificar)
      if(evento.id_tipo_evento != '25'){//este 25 es una clase mas no una actividad eso no se edita
         td += "<a title ='Eliminar Evento' onclick=\"eliminarEventoCalendario('"+evento.dia+"','"+evento.hora+"')\" style='font-size: 15px; color: red; cursor: pointer;''><i class='fa fa-times'></i></a>  &nbsp;  &nbsp;"+
            "<a title ='Editar Evento' onclick=\"ModalEditarEventoCalendario('"+evento.dia+"','"+evento.hora+"')\" style='font-size: 15px; color: orange; cursor: pointer;''><i class='fa fa-edit'></i></a>"
      }
     @endif
      td += "</p><center>"
      $("#td_"+evento.dia+"_"+evento.hora).html(td)
    })
  }

  function agregar_evento_horario() {
    
    var dia = $("#dia_escojido").val()
    var hora = $("#hora_escojida").val()
    if($("#select_tipos_actividades").val() == 0){
      $("#mensaje_evento").html('Seleccione un tipo de actividad valido.')
      $("#mensaje_evento").fadeIn()
      setTimeout(function(){ $("#mensaje_evento").fadeOut() }, 3000);
      return false
    }
    if($("#select_actividades_para_evento").val() == null){
      $("#mensaje_evento").html('Seleccione una actividad valida.')
      $("#mensaje_evento").fadeIn()
      setTimeout(function(){ $("#mensaje_evento").fadeOut() }, 3000);
      return false
    }

    var posicion_escojida = $("#select_actividades_para_evento").val() 
    var actividad_escojida = lista_actividades[posicion_escojida]
    var combo = document.getElementById("select_tipos_actividades");
    var tipo_actividad = combo.options[combo.selectedIndex].text;
    var evento = {
        'dia' : dia,
        'hora' : hora,
        'nombre' : actividad_escojida.nombre,
        'tipo_evento' : tipo_actividad,
        'id_tipo_evento' : $("#select_tipos_actividades").val()
    }
      if(bandera_editar == false){
          if(cantidad_veces_evento(evento.nombre, evento.id_tipo_evento) < actividad_escojida.horas_semanales){
            $("#modalNewEvento").modal('hide')
            horario.push(evento)
            actualizar_horario()
          }else{
             //aca se valida que solo se peogramen en el calendario las horas registradas anteriormente
             $("#mensaje_evento").html('Ya no puede agendar esta actividad debido a que ya se agendaron todas las horas realizadas.')
             $("#mensaje_evento").fadeIn()
             setTimeout(function(){ $("#mensaje_evento").fadeOut() }, 5000);
          }
      }else{//aca va a editar el evento
        var puede_editar = true
        if(evento.id_tipo_evento == id_tipo_evento_editar){
          if((cantidad_veces_evento(evento.nombre, evento.id_tipo_evento) -1) >= actividad_escojida.horas_semanales) puede_editar = false
        }else{
          if(cantidad_veces_evento(evento.nombre, evento.id_tipo_evento) >= actividad_escojida.horas_semanales) puede_editar = false
        }
        if(puede_editar == true){
            $("#modalNewEvento").modal('hide')
            var cont = 0
            horario.forEach((_evento)=>{
              if(_evento.dia == dia && _evento.hora == hora) {
                horario.splice(cont, 1, evento)
                actualizar_horario()
              }
              cont++
            })
          }else{
             //aca se valida que solo se peogramen en el calendario las horas registradas anteriormente
             $("#mensaje_evento").html('Ya no puede agendar esta actividad debido a que ya se agendaron todas las horas realizadas.')
             $("#mensaje_evento").fadeIn()
             setTimeout(function(){ $("#mensaje_evento").fadeOut() }, 5000);
          }
      }
    }

    function cantidad_veces_evento(nombre_evento, tipo_evento) {
      var cont = 0
      horario.forEach((evento)=>{
        if(evento.nombre == nombre_evento && evento.id_tipo_evento == tipo_evento) cont++;
      })
      return cont
    }

    function validar_disponibilidad_calendario(dia, hora) {
      var resp = true
      horario.forEach((evento)=>{
        if(evento.dia == dia && evento.hora == hora) {
          resp = false
        }
      })
      return resp
    }

    function ModalEditarEventoCalendario(dia, hora) {
      $("#titulo_modal_evento").html("Edición de evento para el "+dia+ " de "+hora)
       $("#dia_escojido").val(dia)
       $("#hora_escojida").val(hora)
       horario.forEach((evento)=>{
        if(evento.dia == dia && evento.hora == hora) {
          $("#select_tipos_actividades").val(evento.id_tipo_evento)
          cargar_actividades(evento.id_tipo_evento)
          //ahora busco la actividad en la lista
          var nombre_actividad = evento.nombre
          lista_actividades.forEach((actividad)=>{
            if(actividad.tipo == evento.id_tipo_evento && actividad.nombre == nombre_actividad){
              var posicion = lista_actividades.indexOf(actividad);
              id_tipo_evento_editar = evento.id_tipo_evento
              $("#select_actividades_para_evento").val(posicion)
            }
         })
          $("#modalNewEvento").modal('show')
        }
      })
    }
    function eliminarEventoCalendario(dia, hora) {
      console.log("eliminar")
      var r = confirm("¿Seguro que desea eliminar este evento de su horario?");
      if (r == true) {
         horario.forEach((evento)=>{
          if(evento.dia == dia && evento.hora == hora) {
            var posicion = horario.indexOf(evento);
            horario.splice(posicion,1);
            $("#td_"+dia+"_"+hora).html("")
            //aca por alguna razon se abre el modal entonces siempre toca poner una bandera para cuando acaba de eliminar
            bandera_elimino = true
          }
        })
      }
    }

    
</script>


<!-- Estos scripts tienen que ver con la parte superior de las asignaciones de las actividades y los cuadros iniciales -->
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
  var va_a_editar = false
  var posicion_editar = -1
  function AbrirModalNewActividad(tipo, titulo){
    tipo_actual = tipo
    $("#titulo_modal").html(titulo)
    $("#modalNewActividad").modal('show')
    if(tipo == 18 || tipo == 19){
      $("#div_descripcion").fadeOut()
      $("#div_institucion").fadeOut()
      $("#div_acta").fadeIn()
      $("#div_fecha_aprobacion").fadeIn()
      $("#div_fecha_terminacion").fadeIn()
    }else{
      $("#div_descripcion").fadeIn()
      $("#div_institucion").fadeIn()
      $("#div_acta").fadeOut()
      $("#div_fecha_aprobacion").fadeOut()
      $("#div_fecha_terminacion").fadeOut()
    }

    if(tipo == 24){ //aca las otras actividades la mayoria no son obligatorias de actividades complementarias
      $("#check_requerido_actividad").prop("checked", false);
    }
  }

  function AbrirModalEditarActividad(tipo, nombre_actividad){
    va_a_editar = true
    tipo_actual = tipo
    $("#titulo_modal").html("Edicion de "+nombre_actividad)
    $("#modalNewActividad").modal('show')
    if(tipo == 18 || tipo == 19){
      $("#div_descripcion").fadeOut()
      $("#div_institucion").fadeOut()
      $("#div_acta").fadeIn()
      $("#div_fecha_aprobacion").fadeIn()
      $("#div_fecha_terminacion").fadeIn()
    }else{
      $("#div_descripcion").fadeIn()
      $("#div_institucion").fadeIn()
      $("#div_acta").fadeOut()
      $("#div_fecha_aprobacion").fadeOut()
      $("#div_fecha_terminacion").fadeOut()
    }

    lista_actividades.forEach((actividad)=>{
        if(actividad.tipo == tipo && actividad.nombre == nombre_actividad){
          posicion_editar = lista_actividades.indexOf(actividad);
          $('#modal_nombre_actividad').val(actividad.nombre)
          $('#modal_descripcion').val(actividad.descripcion)
          $('#modal_institucion').val(actividad.institucion)
          $('#modal_acta_aprovacion').val(actividad.acta)
          $('#modal_fecha_aprobacion').val(actividad.fecha_aprobada)
          $('#modal_fecha_iniciacion').val(actividad.fecha_iniciacion)
          $('#modal_fecha_terminacion').val(actividad.fecha_terminacion)
          $('#modal_horas_por_semana').val(actividad.horas_semanales)
          if(actividad.requiere_actividad_complementaria == 1) {
              $("#check_requerido_actividad").prop("checked", true); 
          }else{
              $("#check_requerido_actividad").prop("checked", false);
          }
        }
     })  
  }

  function agregar_actividad() {
    var requiere_actividad_complementaria = 0
    if($("#check_requerido_actividad").prop('checked')) {
        requiere_actividad_complementaria = 1
    }
    var horas_semanales = $('#modal_horas_por_semana').val()

    if(solo_numero(horas_semanales) == false || horas_semanales.length == 0){
      alert("El campo de horas semanales solo permite numeros.")
      return false
    } 
    var actividad = {
        'tipo' : tipo_actual,
        'nombre' : $('#modal_nombre_actividad').val(),
        'descripcion' : $('#modal_descripcion').val(),
        'institucion' : $('#modal_institucion').val(),
        'acta' : $('#modal_acta_aprovacion').val(),
        'fecha_aprobada' : $('#modal_fecha_aprobacion').val(),
        'fecha_iniciacion' : $('#modal_fecha_iniciacion').val(),
        'fecha_terminacion' : $('#modal_fecha_terminacion').val(),
        'horas_semanales' : $('#modal_horas_por_semana').val(),
        'requiere_actividad_complementaria' : requiere_actividad_complementaria
    }
    if(va_a_editar==true){
       va_a_editar = false
       var cont = 0;
       lista_actividades.forEach((actividad_lista)=>{
        if(cont==posicion_editar){
          posicion_editar = -1;
          //se validan antes de editar la actividad de que pueda agregar las horas solicitadas
          //en las horas no validas se colocan las horas antiguas para que saqeu la diferencia con las horas ahora solicitadas
          var validacion = validarHorasPermitidas(actividad_lista.horas_semanales,actividad.horas_semanales)
          if(validacion.error == true){
            alert(validacion.mensaje)
            return false
          }
          var nombre_antiguo_actividad = actividad_lista.nombre;
          lista_actividades.splice(cont, 1, actividad);

          //aca edita a la actividad entonces hay q editarla en el horario si tambien esta registrada
          //antes de elminar la actividad hay que borrar del calendario donde este registrada
          horario.forEach((evento)=>{
              if(evento.nombre == nombre_antiguo_actividad && evento.id_tipo_evento == tipo_actual){
                var posicion_evento = horario.indexOf(evento)
                evento.nombre = actividad.nombre;
                horario.splice(posicion_evento, 1, evento);
                actualizar_horario()
              }
          })
        }
        cont++
     })  
    }else{
      //se validan antes de ingresar la actividad de que pueda agregar las horas solicitadas
      //en las horas no validas se coloca 0 porque como es una nueva actividad se suman las horas solicitadas a las horas actuales
      var validacion = validarHorasPermitidas(0,actividad.horas_semanales)
      if(validacion.error == false){
        lista_actividades.push(actividad)
      }else{
        alert(validacion.mensaje)
        return false
      }
    }
    $("#modalNewActividad").modal('hide')
    actualizar_tablas(tipo_actual)
  }

  function validarHorasPermitidas(horas_no_validas, horas_solicitadas){
    $respuesta = true
    tipo_docente = '{{ $tercero->servicio }}'
    var respuesta = {
        'error' : false,
        'mensaje' : ''
    }
    var total_horas = $("#total_horas_semana").val()
    var total_horas_solicitadas = parseInt(total_horas) - parseInt(horas_no_validas) + parseInt(horas_solicitadas)
    switch (tipo_docente) {
      case 'Catedratico':
        if(total_horas_solicitadas > 18) respuesta.error = true; respuesta.mensaje = "Como docente catedratico ,las horas solicitadas para esta actividad exceden sus horas permitidas lo cual son hasta 18 horas maximo." 
        break;
      case 'Tiempo completo':
        if(total_horas_solicitadas > 40) respuesta.error = true; respuesta.mensaje = "Como docente de tiempo completo ,las horas solicitadas para esta actividad exceden sus horas permitidas lo cual son hasta 40 horas maximo." 
        break;
      case 'Medio tiempo':
        if(total_horas_solicitadas > 20) respuesta.error = true; respuesta.mensaje = "Como docente de medio tiempo ,las horas solicitadas para esta actividad exceden sus horas permitidas lo cual son hasta 20 horas maximo." 
        break;
      default:
        break;
    }
    return respuesta;

  }

  function eliminarActividad(nombre_actividad, tipo) {

    //antes de elminar la actividad hay que borrar del calendario donde este registrada
    horario.forEach((evento)=>{
        if(evento.nombre == nombre_actividad && evento.id_tipo_evento == tipo){
          console.log("entro a eliminar del horario")
          var posicion_en_horario = horario.indexOf(evento);
          horario.splice(posicion_en_horario,1);
          $("#td_"+evento.dia+"_"+evento.hora).html("")
          //aca por alguna razon se abre el modal entonces siempre toca poner una bandera para cuando acaba de eliminar
          bandera_elimino = true
        }
    })

    //ahora si se eliminan las actividades
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
      'actividades' : lista_actividades,
      'horario' : horario
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