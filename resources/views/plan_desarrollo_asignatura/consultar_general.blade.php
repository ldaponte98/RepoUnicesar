@extends('layouts.main')
@php
    $usuario = \App\Usuario::find(session('id_usuario'));
@endphp    
<style type="text/css">
    .search{
    line-height: inherit;
    height: 31px;
    background-color: #f2f7f8;
    border-left-color: transparent;
    border-right-color: transparent;
    border-top-color: transparent;
    border-bottom-color: #ddd;
    }
    .search:focus{
       border-bottom-color: black; 
       transition: 2.5s;
    }

    #segundofil{
        display: none;
    }
    #bodytable tr:hover{
        background-color: #DAF7A6;
        color: black;
       
    }
</style>
@section('header_content')

<script src="http://malsup.github.io/jquery.blockUI.js"></script>
<div class="row page-titles">
    <div class="col-md-6 col-8 align-self-center">
        <h3 class="text-themecolor m-b-0 m-t-0">Tabla</h3>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Tablero</a></li>
            <li class="breadcrumb-item active">Plan de desarrollo a la asignatura</li>
        </ol>
    </div>
    <div class="col-md-2 col-8 align-self-center">
    </div><div class="col-md-2 col-8 align-self-center">
    </div>
    <div class="col-md-2 col-8" style="text-align: right;">
      <br> <br>   
    <a target="_blank" id="btnlistar" style="color: white;" onclick="exportar_excel()"  class="btn pull-rigth hidden-sm-down btn-success">Excel tabla actual</a>
    </div>
</div>
@endsection
@section('content')
{{ Form::open(array('id' => 'form_fltros')) }}
<div class="row"> 
    <div class="col-sm-4">
        <div class="form-group">
            @php
                $docentes = \App\Tercero::all()->where('id_dominio_tipo_ter', 3)->where('id_licencia', session('id_licencia'));
            @endphp
            <label style="color: black;"><b>Docente</b></label>
            <select class="form-control-line form-control" id="id_tercero" name="id_tercero">
                <option value="" selected>Todos</option>
                @foreach ($docentes as $d)
                    <option value="{{ $d->id_tercero }}">{{ $d->getNameFull() }} ({{ $d->cedula }})</option>
                @endforeach
              
              
            </select>
            <script type="text/javascript">
                $(document).ready(function() {
                    $("#id_tercero").select2({
                        width : '100%'
                    })
                });
            </script>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group">
            @php
                $asignaturas = \App\Asignatura::all()->where('id_licencia', session('id_licencia'));
            @endphp
            <label style="color: black;"><b>Asignatura</b></label>
            <select class="form-control-line form-control" id="id_asignatura" name="id_asignatura">
                <option value="" selected>Todas</option>
                @foreach ($asignaturas as $d)
                    <option value="{{ $d->id_asignatura }}">{{ $d->nombre }} ({{ $d->codigo }})</option>
                @endforeach
              
              
            </select>
            <script type="text/javascript">
                $(document).ready(function() {
                    $("#id_asignatura").select2({
                        width : '100%'
                    })
                });
            </script>
        </div>
    </div>
    <div class="col-sm-2">
        <div class="form-group">
            <label style="color: black;"><b>Periodo academico</b></label>
            <select id="periodo_academico" name="periodo_academico" class="form-control form-control-line"  >
                <option value="">Todos</option>
                @php
                    $cont = 0;
                @endphp
                @foreach ($periodos_academicos as $periodo)
                    <option value="{{ $periodo->id_periodo_academico }}">{{ $periodo->periodo }}</option>                
                @endforeach
            </select>
        </div>
    </div> 
    <div class="col-sm-2">
        <div class="form-group">
          <label style="color: black;"><b>Estado</b></label>
            <select id="estado" name="estado" class="form-control form-control-line"  >
                <option value="">Todos</option>
                <option value="Recibido">Recibidos (Leidos)</option>
                <option value="Enviado">Enviados (No leidos)</option>
                <option value="Pendiente">Pendientes</option>
            </select>
        </div>
    </div> 
                           
</div>

                 
{{ Form::close() }}

                <div class="row" >
                    
                        <div class="col-sm-4">
                            
                        </div>  
                        <div class="col-sm-4">
                            <div class="form-group">
                                <center>
                                   <a style="color: white; width: 100%;" onclick="consultar()"  class="btn btn-info">Consultar</a>
                                </center>
                            </div>
                        </div>
                 </div>


                <!--TABLA-->

                <div class="row">
                    <!-- column -->
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-block">
                                <h4 class="card-title" id="titulo_tabla">Planes de desarrollo a la asignatura </h4>
                                <div id="tablaarchivo" class="table-responsive">
                                    <table id="tabla" class="table">
                                        <thead>
                                            <tr>
                                                <td><b>#</b></td>
                                                <td><b>Docente</b></td>
                                                <td><b>Asignatura</b></td>
                                                <td><b>Periodo academico</b></td>
                                                <td><b>Estado</b></td>
                                                <td><b>Fecha de registro</b></td>
                                                <td><b>Retraso</b></td>
                                                <td><center><b>Acciones</b></center></td>
                                                
                                            </tr>
                                        </thead>
                                        <tbody id="bodytable">
                                            
                                            
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                
                <script>

                    var tabla_excel = ""

                function consultar(){
                    var data = $("#form_fltros").serialize();
                    var url = "{{ route('plan_desarrollo_asignatura/getReporte') }}"
                    
                    $.blockUI({
                        message: '<h1>Buscando</h1><i class="fa fa-spinner fa-spin fa-3x fa-fw">',
                        css: {
                            border: 'none',
                            padding: '15px',
                            backgroundColor: '#000',
                            '-webkit-border-radius': '10px',
                            '-moz-border-radius': '10px',
                            opacity: .8,
                            color: '#fff'
                        }});
                    
                    $.post(url, data, function(response) { 
                        var tabla = ""
                        var cont = 1
                        response.forEach(function(plan_desarrollo) {
                            var acciones = ""
                           tabla += "<tr>"+
                                    "<td>"+cont+"</td>"+
                                    "<td>"+plan_desarrollo.docente+"</td>"+
                                    "<td>"+plan_desarrollo.asignatura+"</td>"+
                                    "<td>"+plan_desarrollo.periodo+"</td>"
                            if(plan_desarrollo.tiene_carga_academica == 0){
                                tabla +="<td colspan='4'> No hay carga academica registrada</td>"
                            }else{
                                tabla +="<td>"+plan_desarrollo.estado+"</td>"
                                if(plan_desarrollo.estado == 'Pendiente'){
                                    tabla += "<td> Sin enviar </td>"+
                                             "<td>"+plan_desarrollo.retraso+"</td>"

                                }else{
                                    tabla += "<td>"+plan_desarrollo.fecha+"</td>"+
                                             "<td>No tiene</td>"
                                }
                                //AHORA EVALUO LOS ESTADOS PARA LAS ACCIONES QUE SE PODRAN HACER
                                if(plan_desarrollo.estado=='Pendiente'){
                                    if(plan_desarrollo.retraso != "En espera" && plan_desarrollo.retraso != "Fechas sin definir"){
                                        acciones = "<td><center><a class='acciones' style='color: blue; cursor: pointer;  font-size: 14px;'"+
                                     "onclick=\"OpenModalNotificarRetraso("+plan_desarrollo.id_tercero+",\'"+plan_desarrollo.retraso+"\',\'"+plan_desarrollo.periodo+"\',\'"+plan_desarrollo.asignatura+"\')\">Notificar retraso</a></center></td>"
                                    }else{
                                        acciones = "<td></td>"
                                    }
                                }
                                if(plan_desarrollo.estado=='Recibido'){
                                    acciones = "<td><center><a class='acciones' style='color: blue; cursor: pointer; font-size: 14px;' target='_blank' href = 'imprimir/"+plan_desarrollo.id_plan_desarrollo_asignatura+"'>Ver</a></center></td>"
                                }
                                if(plan_desarrollo.estado=='Enviado'){
                                    acciones = "<td><center><a class='acciones' style='color: blue; cursor: pointer;  font-size: 14px;' target='_blank' href = 'imprimir/"+plan_desarrollo.id_plan_desarrollo_asignatura+"'>Revisar</a></center></td>"
                                }
                            }
                            cont++
                            tabla += acciones
                            $.unblockUI(); //
                        })
                        $.unblockUI();

                        $("#bodytable").html(tabla)
                        $("#titulo_tabla").html("Planes de desarrollo asignatura ("+response.length+")")
                    })

                }

                function exportar_excel() {
                    var tabla_aux = $("#tabla").html()
                    //borrarColumna("tabla",7)
                    
                    tableToExcel('tabla', 'Reporte_plan_de_desarrollo_asignatura')
                    $("#tabla").html(tabla_aux)
                }
                </script>


        <!--MODAL DE NOTICAR RETRASO------------------------------------------------------->


         <div class="modal fade" id="modalNotificacion" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Notificar Retraso</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <!--Material textarea-->
                    <input type="hidden" name="" id="periodo_academico_oculto">
                    <div class="md-form">
                      <label for="msg_notificacion">Mensaje de notificacion</label>
                      <textarea id="msg_notificacion" class="md-textarea form-control" rows="6"></textarea>
                    </div>

                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-primary" onclick="NotificarRetraso()">Enviar</button>
                  </div>
                </div>
              </div>
        </div>
            {{ Form::open(array('route' => array('notificacion/crear'), 'method' => 'post')) }}
            {{ Form::close() }}

            <script>


        function OpenModalNotificarRetraso(id_tercero,retraso, periodo_academico,asignatura) {
            var mensaje = "El administrador notifica que se encuenta "+retraso+" retrasado(a) en el plan de desarrollo de la asignatura "+asignatura+" del periodo academico "+periodo_academico+".";
            id_tercero_recibe = id_tercero
            $("#msg_notificacion").val(mensaje)
            $("#periodo_academico_oculto").val(periodo_academico)
            $('#modalNotificacion').modal('show')
        }

        function NotificarRetraso() {
            var mensaje = $("#msg_notificacion").val()
            $('#modalNotificacion').modal('hide')
            if (mensaje.lenght == 0) {
                alert("Debe llenar el campo requerido")
                return false
            }
            if (mensaje.lenght>500) {
                alert("Tamaño maximo de caracteres : 500")
                return false
            }
            var id_tercero_envia = '{{ $usuario->tercero->id_tercero }}'
            var id_dominio_tipo = 9 //Es retraso
            var _token = document.getElementsByName('_token')[0].value;

            var data = {
                mensaje : mensaje,
                id_tercero_envia : id_tercero_envia,
                id_tercero_recibe : id_tercero_recibe,
                id_dominio_tipo : id_dominio_tipo,
                periodo_academico : $("#periodo_academico_oculto").val(),
                id_dominio_tipo_formato : {{ config('global.desarrollo_asignatura') }},
                _token : _token
            };
            $.blockUI({
                        message: '<h1>Enviando mensaje...</h1><i class="fa fa-spinner fa-spin fa-3x fa-fw">',
                        css: {
                            border: 'none',
                            padding: '15px',
                            backgroundColor: '#000',
                            '-webkit-border-radius': '10px',
                            '-moz-border-radius': '10px',
                            opacity: .8,
                            color: '#fff'
                        }});
            $.post("{{ route('notificacion/crear') }}",data, function(response){
                $.unblockUI();
               if (!response.error) toastr.success('Notificacion enviada exitosamente', 'Mensaje enviado', {timeOut: 3000})
               if (response.error) toastr.error('Ocurrio un error al enviar la notificacion','Error', {timeOut: 3000})
            
            });
        }

    </script>

            <!--FIN MODAL DE NOTICAR RETRASO------------------------------------------------------->


@endsection

