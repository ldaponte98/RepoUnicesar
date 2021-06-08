
@extends('layouts.main_docente')
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
<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

<div class="row page-titles">
                    <div class="col-md-6 col-8 align-self-center">
                        <h3 class="text-themecolor m-b-0 m-t-0">Tabla</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Tablero</a></li>
                            <li class="breadcrumb-item active">Actividades complementarias</li>
                        </ol>
                       
                    </div>
                    <div class="col-md-2 col-8 align-self-center">
                    </div><div class="col-md-2 col-8 align-self-center">
                    </div>
                    <div class="col-md-2 col-8 align-self-center">
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
                                  <label style="color: black;"><b>Estado</b></label>
                                           <select id="estado" name="estado" class="form-control form-control-line"  >
                                                <option value="">Todos</option>
                                                <option value="Recibido">Recibidos (Leidos)</option>
                                                <option value="Enviado">Enviados (No leidos)</option>
                                                <option value="Pendiente">Pendientes</option>
                                            </select>
                            </div>
                        </div> 
                         <div class="col-sm-4">
                            <div class="form-group">
                                  <label style="color: black;"><b>Corte</b></label>
                                           <select id="cor" name="corte" class="form-control form-control-line"  >
                                                <option value="">Todos</option>
                                                <option value="1">Primer Corte</option>
                                                <option value="2">Segundo Corte</option>
                                                <option value="3">Tercer Corte</option>
                                            </select>
                            </div>
                        </div>  
                        <div class="col-sm-4">
                            <div class="form-group">
                                  <label style="color: black;"><b>Periodo academico</b></label>
                                           <select id="periodo_academico" name="periodo_academico" class="form-control form-control-line"  >
                                                <option value="">Todos</option>
                                                @foreach ($periodos_academicos as $periodo)
                                                <option value="{{ $periodo->id_periodo_academico }}">{{ $periodo->periodo }}</option>
                                                @endforeach
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
                                   <a style="color: white; width: 80%;" onclick="consultar()"  class="btn btn-info">Consultar</a>
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
                                <h4 class="card-title" id="titulo_tabla">Actividades complementarias </h4>
                                <div id="tablaarchivo" class="table-responsive">
                                    <table id="tabla" class="table">
                                        <thead>
                                            <tr>
                                                <td><b>#</b></td>
                                                <td><b>Periodo academico</b></td>
                                                <td><b>Corte</b></td>
                                                <td><b>Estado</b></td>
                                                <td><b>Progreso</b></td>
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


            <div class="modal fade" id="modalNotificacion" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Solicitud de extraplazo</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <!--Material textarea-->
                    <div class="md-form">
                      <label for="msg_notificacion">Mensaje de notificacion</label>
                      <textarea id="msg_notificacion" class="md-textarea form-control" rows="6"></textarea>
                    </div>

                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-primary" onclick="NotificarSolicitud()">Enviar</button>
                  </div>
                </div>
              </div>
            </div>
             {{ Form::open(array('route' => array('notificacion/crear'), 'method' => 'post', 'id'=>'_form')) }}
            {{ Form::close() }}
            @php
                $jefe_departamento = \App\Tercero::where('id_licencia', $usuario->tercero->id_licencia)->where('id_dominio_tipo_ter', 2)->first();
            @endphp

                <script>
                function consultar(){
                    var data = $("#form_fltros").serialize();
                    var url = "{{ route('actividades_complementarias/getReporte') }}"
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
                         $.unblockUI();
                        var tabla = ""
                        console.log(response)
                        response.forEach(function(actividad) {
                            var acciones = ""
                            
                           tabla += "<tr>"+
                                    "<td>"+actividad.id_actividad_complementaria+"</td>"+
                                    "<td><center>"+actividad.periodo_academico+"</center></td>"+
                                    "<td>"+actividad.corte+"</td>"+
                                    "<td>"+actividad.estado+"</td>"
                                    
                            $color_progreso = ""
                        if(actividad.progreso >= 0 && actividad.progreso <= 20) $color_progreso = "danger"
                        if(actividad.progreso > 20 && actividad.progreso <= 40) $color_progreso = "warning"
                        if(actividad.progreso > 40 && actividad.progreso <= 60) $color_progreso = "primary"
                        if(actividad.progreso > 60 && actividad.progreso <= 80) $color_progreso = "secundary"
                        if(actividad.progreso > 80 && actividad.progreso < 100) $color_progreso = "info"
                        if(actividad.progreso == 100) $color_progreso = "success"

                            tabla += "<td>"+
                                     "<span class='text-"+$color_progreso+"'>"+actividad.progreso+"%</span>"+
                                            "<div class='progress'>"+
                                                "<div class='progress-bar bg-"+$color_progreso+"' role='progressbar' style='width: "+actividad.progreso+"%; height: 6px;' aria-valuenow='25' aria-valuemin='0' aria-valuemax='100'></div>"+
                                            "</div></td>"
                            //AHORA EVALUO LOS ESTADOS PARA LAS ACCIONES QUE SE PODRAN HACER
                            if(actividad.estado =='Pendiente'){
                                tabla += "<td>"+actividad.retraso+"</td>"
                                if(actividad.retraso == "En espera"){

                                     acciones = "<td><center><a href='editar/"+actividad.id_actividad_complementaria+"' style='color: blue; cursor: pointer;  font-size: 14px;' >Realizar</a></center></td>"
                                }else if(actividad.retraso == "Tiene plazo-extra"){
                                    acciones = "<td><center><a href='editar/"+actividad.id_actividad_complementaria+"' style='color: blue; cursor: pointer;  font-size: 14px;' >Realizar</a></center></td>"
                                }else if(actividad.retraso == "No se han configurado fechas"){
                                     acciones = "<td><center></center></td>"
                                }else{
                                     acciones = "<td><center><a onclick=\"OpenModalNotificarSolicitud('"+actividad.id_actividad_complementaria+"')\" style='color: blue; cursor: pointer;  font-size: 11px;' >Solicitar extra-plazo</a></center></td>"
                                }
                               
                            }
                            if(actividad.estado=='Recibido'){
                                tabla += "<td>Sin retraso</td>"
                                acciones = "<td><center><a style='color: blue; cursor: pointer; font-size: 14px;'  href = 'editar/"+actividad.id_actividad_complementaria+"'>Ver</a></center></td>"
                            }
                            if(actividad.estado=='Enviado'){
                                tabla += "<td>Sin retraso</td>"
                                acciones = "<td><center><a style='color: blue; cursor: pointer;  font-size: 14px;'  href = 'editar/"+actividad.id_actividad_complementaria+"'>Ver o editar</a></center></td>"
                            }

                            tabla += acciones
                            //
                        })

                        $("#bodytable").html(tabla)
                        $("#titulo_tabla").html("Actividades complementarias ("+response.length+")")
                    }).fail((error)=>{
                         $.unblockUI();
                        toastr.error('Ha ocurrido un error al consultar las actividades complementarias.', 'Error', {timeOut: 3000})

                    })

                }

                function exportar_excel() {
                    var tabla_aux = $("#tabla").html()
                    borrarColumna("tabla",5)
                    borrarColumna("tabla",6)
                    tableToExcel('tabla', 'Listado_actividades_complementarias')
                    $("#tabla").html(tabla_aux)
                }
                var id_actividad_complementaria_escojida = ""
                 function OpenModalNotificarSolicitud(id_actividad_complementaria) {
                            var mensaje = "El docente "+'{{ $usuario->tercero->getNameFull() }}'+" solicita un plazo exta para la actividad complementaria "+id_actividad_complementaria;
                            id_actividad_complementaria_escojida = id_actividad_complementaria
                            $("#msg_notificacion").val(mensaje)
                            $('#modalNotificacion').modal('show')
                        }
                 function NotificarSolicitud() {
                            $('#modalNotificacion').modal('hide')
                            var mensaje = $("#msg_notificacion").val()

                            if (mensaje.lenght == 0) {
                                alert("Debe llenar el campo requerido")
                                return false
                            }
                            if (mensaje.lenght>500) {
                                alert("Tamaño maximo de caracteres : 500")
                                return false
                            }
                            var id_tercero_envia = '{{ $usuario->tercero->id_tercero }}'
                            var id_tercero_recibe = '{{ $jefe_departamento->id_tercero }}'
                            var id_dominio_tipo = 8 //Es retraso
                            var _token = document.getElementsByName('_token')[0].value;

                            var data = {
                                mensaje : mensaje,
                                id_tercero_envia : id_tercero_envia,
                                id_tercero_recibe : id_tercero_recibe,
                                id_dominio_tipo : id_dominio_tipo,
                                id_formato : id_actividad_complementaria_escojida,
                                id_dominio_tipo_formato : {{ config('global.actividades_complementarias') }},
                                _token : _token
                            };
                            $.post("{{ route('notificacion/crear') }}",data, function(response){
                               if (!response.error) toastr.success('Notificacion enviada exitosamente', 'Mensaje enviado', {timeOut: 3000}) 
                               if (response.error) toastr.error('Ocurrio un error al enviar la notificacion', 'Mensaje no enviado', {timeOut: 3000})
                            });
                        }



                </script>


            <!--FIN MODAL DE NOTICAR RETRASO------------------------------------------------------->


@endsection

