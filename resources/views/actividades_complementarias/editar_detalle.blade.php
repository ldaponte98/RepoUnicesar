@extends((session("is_admin") == true ? 'layouts.main' : 'layouts.main_docente'))
@php
    $usuario = \App\Usuario::find(session('id_usuario'));
    $tercero = $usuario->tercero;
@endphp 
@section('header_content')
@php
$is_admin = session('is_admin');
$tiene_permiso_editar = $actividad_complementaria->tiene_permiso_de_editar();

if($is_admin==true){
  $tiene_permiso_editar = false;
}
@endphp
  <div class="row page-titles">
                    <div class="col-md-6 col-8 align-self-center">
                        <h3 class="text-themecolor m-b-0 m-t-0">Tabla</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('actividades_complementarias/consultar') }}">Actividades complementarias</a></li>
                            <li class="hidden-sm-down breadcrumb-item active">@if ($is_admin==true)
                          {{$actividad_complementaria->plan_trabajo->tercero->getNameFull()}}
                          @else
                          Editar informe
                        @endif</li>
                        </ol>
                    </div>         
    </div>

@endsection
@section('content')

<script type="text/javascript">
  var lista_detalles = []

  function agregar_detalles_existentes(id_actividad_plan_trabajo, descripcion, evidencia, link, fecha) {
    var detalle = {
      'id_actividad_plan_trabajo' : id_actividad_plan_trabajo, 
      'descripcion' : descripcion,
      'evidencia' : evidencia,
      'link' : link,
      'fecha' : fecha
    }
    lista_detalles.push(detalle)

  }
</script>


<div class="card">
  <div class="card-block">
      <h4 class="card-title"><b>{{ $tipo_de_actividad->dominio }}</b></h4>
      @if ($is_admin==false)
        <i>Agregue las acciones realizadas en cada una de las siguientes actividades registradas.</i>
      @else
      <i>Cada una de las actividades del docente tiene listadas las acciones realizadas en el periodo academico.</i>
      @endif
      <br><br>
@foreach ($actividad_complementaria->plan_trabajo->get_actividades_por_tipo($tipo_de_actividad->id_dominio) as $actividad_programada)
    
    <div class="card">
    <div class="card-header bg-info">
      <div class="row">
        <div class="col-sm-10">
        <h4 class="mb-0 text-white">{{ $actividad_programada->nombre }}</h4>
        </div>
        <div align="right" class="col-sm-2">
          <a target="_blank" style="color: white; cursor: pointer;" href="{{ route('actividades_complementarias/imprimir', [
            'id_actividad' => $actividad_complementaria->id_actividad_complementaria, 
            'id_actividad_plan_trabajo' => $actividad_programada->id_actividad_plan_trabajo
            ]) }}" title="Imprimir formato"><i class="fa fa-print"></i></a> &nbsp; &nbsp;
          @if ($tiene_permiso_editar == true)
            <a  style="color: white; cursor: pointer;" title="Agregar nuevo" onclick ="AbrirModalNewDetalle({{ $actividad_programada->id_actividad_plan_trabajo }},'{{ $actividad_programada->nombre }}')"><i class="fa fa-plus-circle"></i></a> &nbsp; &nbsp;
          @endif
        <a class="pull-right" onclick=" 
        var estado = $('#tabla_{{ $actividad_programada->id_actividad_plan_trabajo }}').css('display')
        if(estado == 'none') $('#tabla_{{ $actividad_programada->id_actividad_plan_trabajo }}').css('display','block')
        if(estado == 'block') $('#tabla_{{ $actividad_programada->id_actividad_plan_trabajo }}').css('display','none')
        " style="color: white; cursor: pointer; margin-top: 3px;"><i class="fa fa-caret-down"></i></a>
        </div>
      </div>
    </div>
    
    <div class="table-responsive" id="tabla_{{ $actividad_programada->id_actividad_plan_trabajo }}" style="display: none;">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th><center><b>Descripcion de las actividades</b></center></th>
                    <th><center><b>Evidencia (Anexar)</b></center></th>
                    <th><center><b>Fecha</b></center></th>
                    @if ($tiene_permiso_editar == true)
                     <th><center><b>Eliminar</b></center></th>
                    @endif  
                      
                </tr>
            </thead>
            <style type="text/css"> 
              .fil td{
                color: black !important;
              }
            </style>
            <tbody id="bodytable_{{ $actividad_programada->id_actividad_plan_trabajo }}">
                
              @foreach ($actividad_complementaria->detalles as $detalle)
                @if ($detalle->id_actividad_plan_trabajo == $actividad_programada->id_actividad_plan_trabajo)
                  <tr>
                  <td><center>{{ $detalle->descripcion }}</center></td>
                  <td><center>{{ $detalle->evidencia }} @if ($detalle->link_evidencia)
                    <a target="_blank" href="{{ $detalle->link_evidencia }} ">Anexo</a>
                  @endif</center></td>
                  <td><center>{{ $detalle->fecha_evidencia }} </center></td>
                  @if ($tiene_permiso_editar == true)
                     <td><center><a onclick="eliminarDetalle({{ $actividad_programada->id_actividad_plan_trabajo }} , '{{ $detalle->descripcion }}')" style="font-size: 25px; color: red; cursor: pointer;"><i class="fa fa-times"></i></a></center>
                                    </td>
                  @endif  
                 
                  </tr>

                  <script>
                    agregar_detalles_existentes({{ $actividad_programada->id_actividad_plan_trabajo }}, '{{ $detalle->descripcion }}', '{{ $detalle->evidencia }}', '{{ $detalle->link_evidencia }}', '{{ $detalle->fecha_evidencia }}')
                  </script>
                @endif
              @endforeach
             
            </tbody>
        </table>
    </div>

  </div>

@endforeach

<br>
@if ($tiene_permiso_editar == true)
<center>
<button type="button" onclick="guardar()" class="btn btn-info">Guardar cambios</button>
</center>
@endif
    
  </div>
</div>       
<br>

<div class="modal fade" id="modalNewDetalle" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><div id="titulo_modal"></div></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

          <div class="form-group">
            <label for="message-text" class="col-form-label">Descripción de la accion realizada.</label>
            <textarea class="form-control" id="descripcion"  rows="4"></textarea>
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Evidencia</label>
            <input type="text" class="form-control" id="evidencia">
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Link de la evidencia</label>
            <input type="text" class="form-control" id="link_evidencia">
          </div>
           <div class="form-group">
            <label for="recipient-name" class="col-form-label">Fecha de la evidencia</label>                                   
            <input type="text" readonly="readonly" class="form-control hasDatepicker form-control-line" autocomplete="off" id="fecha_evidencia">
          </div>
          <script type="text/javascript">
            $(document).ready(function() {
              $('#fecha_evidencia').daterangepicker({
                autoApply: true,
                autoUpdateInput: true,
                locale: {
                  format: 'DD/MM/YYYY',
                  cancelLabel: 'Clear'
                }
              });
            })
            
          </script>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <button type="button" onclick="agregar_detalle()" class="btn btn-info">Agregar</button>
      </div>
    </div>
  </div>
</div>
      
  {{ Form::open(array('id' => 'form-actividades-complementarias')) }} {{ Form::close() }}
  <script type="text/javascript">
    var id_actividad_plan_trabajo_escojido = ""
    function AbrirModalNewDetalle(id_actividad_plan_trabajo, nombre_actividad) {
      $("#titulo_modal").html(nombre_actividad)
      id_actividad_plan_trabajo_escojido = id_actividad_plan_trabajo
      $("#modalNewDetalle").modal('show')
      console.log(lista_detalles)
    }

     function agregar_detalle() {
      var detalle = {
        'id_actividad_plan_trabajo' : id_actividad_plan_trabajo_escojido, 
        'descripcion' : $("#descripcion").val(),
        'evidencia' : $("#evidencia").val(),
        'link' : $("#link_evidencia").val(),
        'fecha' : $("#fecha_evidencia").val()
      }
      lista_detalles.push(detalle)
      actualizar_tabla(id_actividad_plan_trabajo_escojido)
  }

  function actualizar_tabla(id_actividad_plan_trabajo) {
    var tabla = ""
    lista_detalles.forEach((detalle)=>{
      if(detalle.id_actividad_plan_trabajo == id_actividad_plan_trabajo){
        tabla += "<tr>"+
                 "<td><center>"+detalle.descripcion+"</center></td>"+
                 "<td><center>"+detalle.evidencia
                 if(detalle.link != "") tabla += "<a href='"+detalle.link+"'> Anexo</a>"
        tabla += "</center></td>"+
                 "<td><center>"+detalle.fecha+"</center></td>"
        @if ($tiene_permiso_editar == true)
          tabla += "<td><center><a onclick=\"eliminarDetalle("+detalle.id_actividad_plan_trabajo+", '"+detalle.descripcion+"')\" style='font-size: 25px; color: red; cursor: pointer;'><i class='fa fa-times'></i></a></center>"+
                 "</td>"
        @endif 
          tabla +="</tr>"
      }
    })
    $("#bodytable_"+id_actividad_plan_trabajo).html(tabla)
  }
  function eliminarDetalle(id_actividad_plan_trabajo, descripcion) {
     lista_detalles.forEach((detalle)=>{
        if(detalle.id_actividad_plan_trabajo == id_actividad_plan_trabajo && detalle.descripcion == descripcion){
          var posicion = lista_detalles.indexOf(detalle);
          lista_detalles.splice(posicion,1);
        }
     })  
     actualizar_tabla(id_actividad_plan_trabajo)  
    }


  function guardar() {
    var url = '{{ route('actividades_complementarias/guardar_detalles') }}'
    var token = $("#form-actividades-complementarias").serialize().split("&")[0].split("=")[1];
    var data = {
      '_token' : token,
      'id_actividad_complementaria' : {{ $actividad_complementaria->id_actividad_complementaria }},
      'tipo_actividad' : {{ $tipo_de_actividad->id_dominio }},
      'detalles' : lista_detalles
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

    $.post(url, data, (response)=>{
      $.unblockUI();
      if (!response.error) {
        toastr.success(response.mensaje, 'Operacion exitosa', {timeOut: 3000})
        location.href = '{{ route('actividades_complementarias/editar', $actividad_complementaria->id_actividad_complementaria) }}'
      }
      if (response.error) toastr.error(response.mensaje, 'Error', {timeOut: 3000})
    }).fail((response)=>{
      toastr.error('Ocurrio un error en el servidor al registrar la solicitud', 'Error', {timeOut: 3000})
      $.unblockUI();
    })
  }
  </script>
  @endsection