
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
    #bodytablemiseguimiento tr:hover{
        background-color: #DAF7A6;
        color: black;
       
    }
</style>
@section('header_content')
<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
<script src="http://malsup.github.io/jquery.blockUI.js"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/css/select2.min.css">

<div class="row page-titles">
                    <div class="col-md-6 col-8 align-self-center">
                        <h3 class="text-themecolor m-b-0 m-t-0">Tabla</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Tablero</a></li>
                            <li class="breadcrumb-item active">Informe final seguimiento de asignatura</li>
                        </ol>
                        <a id="btnfil" style="color: white;" onclick="masfiltros()"  class="btn pull-left  btn-info">Mas filtros</a>
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

                        <div class="col-sm-3">
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
                        <div class="col-sm-3">
                            <div class="form-group">
                                  <label style="color: black;"><b>Periodo academico</b></label>
                                           <select onchange="buscar_carga_academica(this.value)" id="periodo_academico" name="periodo_academico" class="form-control form-control-line"  >
                                                <option value="">Todos</option>
                                                @php
                                                    $cont = 0;
                                                @endphp
                                                @foreach ($periodos_academicos as $periodo)
                                                @if ($cont == 0)
                                                    <option selected value="{{ $periodo->id_periodo_academico }}">{{ $periodo->periodo }}</option>
                                                    @php
                                                        $cont++;
                                                    @endphp
                                                @else
                                                    <option value="{{ $periodo->id_periodo_academico }}">{{ $periodo->periodo }}</option>
                                                @endif
                                                
                                                @endforeach
                                            </select>
                            <script type="text/javascript">
                                $(document).ready(function() {
                                    $("#periodo_academico").select2({
                                        width : '100%',
                                    })
                                });
                            </script>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                  <label style="color: black;"><b>Asignatura</b></label>
                                        <select onchange="buscar_grupos(this.value)" id="asignatura" name="asignatura" class="form-control form-control-line"  >
                                                <option value="">Todos</option>
                                               
                                        </select>
                                <script type="text/javascript">
                                    $(document).ready(function() {
                                        $("#asignatura").select2({
                                            width : '100%',
                                        })
                                    });
                                </script>
                            </div>
                        </div> 

                         <div class="col-sm-3">
                            <div class="form-group">
                                  <label style="color: black;"><b>Grupo</b></label>
                                           <select id="grupo" name="grupo" class="form-control form-control-line"  >
                                                <option value="">Todos</option>
                                            </select>
                                    <script type="text/javascript">
                                        $(document).ready(function() {
                                            $("#grupo").select2({
                                                width : '100%',
                                            })
                                        });
                                    </script>
                            </div>
                        </div>
                 </div>
                 <div id="segundofil">
                 <div class="row" > 
                              <div class="col-sm-12">
                            <div class="form-group">
                                  <label style="color: black;"><b>Fecha de envio</b></label>
                                  <input class="form-control hasDatepicker form-control-line" readonly="readonly" id="fecha" type="text" name="fecha" autocomplete="off" value="" placeholder ="Seleccione...">                            
                            </div>
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
                                <h4 class="card-title" id="titulo_tabla">Informes finales de seguimiento de asignatura </h4>
                                <div id="tablaarchivo" class="table-responsive">
                                    <table id="tabla_seguimientos" class="table">
                                        <thead>
                                            <tr>
                                                <td><b>Id</b></td>
                                                <td><b>Asignatura</b></td>
                                                <td><b>Grupo</b></td>
                                                <td><b>Fecha de envio</b></td>
                                                <td><b>Retraso</b></td>
                                                <td><b>Estado</b></td>
                                                <td><b>Periodo</b></td>
                                                <td><center><b>Acciones</b></center></td>
                                            </tr>
                                        </thead>
                                        <tbody id="bodytablemiseguimiento">
                                            
                                            
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <script>
                    $(document).ready(function() {
                         $('#fecha').click(function(){
                            if($('#fecha').val()==""){
                                    $('#fecha').daterangepicker({
                                      autoApply: true,
                                      autoUpdateInput: true,
                                      locale: {
                                        format: 'YYYY/MM/DD',
                                        cancelLabel: 'Clear'
                                      }
                                    });
                             }
                         });
                    })

                function masfiltros(){
                    if($("#btnfil").html()=="Mas filtros"){
                        $("#btnfil").html("Menos filtros");
                        document.getElementById("btnfil").className = "btn pull-left btn-success";
                        document.getElementById("btnlistar").className = "btn pull-left btn-info";
                        document.getElementById("segundofil").style.display='';
                        $("#segundofil").fadeIn();
                    }else{
                        $("#btnfil").html("Mas filtros")
                        document.getElementById("btnfil").className = "btn pull-left btn-info";
                         document.getElementById("btnlistar").className = "btn pull-left btn-success";
                        $("#segundofil").fadeOut();
                    }
                }

                function buscar_carga_academica(id_periodo){
                    let url = "{{ config('global.url_base') }}/docente/buscar_asignaturas/"+id_periodo+"/{{ $usuario->id_tercero }}"
                    $.get(url, (response) => {
                        var asignaturas = "<option value=''>Todos</option>";
                        response.asignaturas.forEach((asignatura) => {
                            asignaturas += "<option value = '"+asignatura.id_asignatura+"' >"+asignatura.nombre+"</option>"
                        })
                        $("#asignatura").html(asignaturas)
                        var grupos = "<option value=''>Todos</option>"
                        $("#grupo").html(grupos)
                    })
                }

                function buscar_grupos(id_asignatura) {
                    let id_periodo = $("#periodo_academico").val()
                    if(id_periodo == "" || id_periodo == null){ alert("Es necesario establecer el periodo academico para el filtrado."); return false }
                    
                    var ruta = "{{ config('global.url_base') }}/asignatura/buscar_grupos_docente/"+id_asignatura+"/{{ $usuario->id_tercero }}/"+id_periodo
                    var grupos = "<option value=''>Todos</option>"
                    $.get(ruta, function(response) {
                        response.forEach(function(grupo){
                            grupos += '<option value="'+grupo.id_grupo+'">'+grupo.codigo+'</option>'
                        })
                        $("#grupo").html(grupos)
                    })
                }

                function consultar(){
                    var data = $("#form_fltros").serialize();
                    var url = "{{ route('seguimiento/getReporteInformeFinal') }}"
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
                        response.forEach(function(seguimiento) {
                            var acciones = ""
                           tabla += "<tr>"+
                                    "<td>"+seguimiento.id_seguimiento+"</td>"+
                                    "<td>"+seguimiento.asignatura+"</td>"+
                                    "<td>"+seguimiento.grupo+"</td>"
                            if(seguimiento.estado=='Pendiente'){
                                tabla += "<td> Sin enviar </td>"+
                                         "<td>"+seguimiento.retraso+"</td>"

                            }else{
                                tabla += "<td>"+seguimiento.fecha+"</td>"+
                                         "<td>No tiene</td>"
                            }
                            tabla += "<td>"+seguimiento.estado+"</td>"+
                                     "<td>"+seguimiento.periodo_academico+"</td>"
                            //AHORA EVALUO LOS ESTADOS PARA LAS ACCIONES QUE SE PODRAN HACER
                            if(seguimiento.estado=='Pendiente'){

                                acciones = "<td><center><a style='color: blue; cursor: pointer;  font-size: 14px;'"+
                                 "onclick=\"OpenModalNotificarRetraso("+seguimiento.id_seguimiento+","+seguimiento.id_tercero+",\'"+seguimiento.docente+"\',\'"+seguimiento.retraso+"\',\'"+seguimiento.asignatura+"\',\'"+seguimiento.grupo+"\',"+seguimiento.corte+", \'"+seguimiento.periodo_academico+"\')\">Notificar retraso</a></center></td>"
                                 if(seguimiento.retraso == 'En espera' || seguimiento.retraso == 'Tiene plazo-extra') acciones = "<td></td>"
                            }
                            if(seguimiento.estado=='Recibido'){
                                acciones = "<td><center><a style='color: blue; cursor: pointer; font-size: 14px;' target='_blank' href = 'view_informe_final/"+seguimiento.id_seguimiento+"'>Ver</a></center></td>"
                            }
                            if(seguimiento.estado=='Enviado'){
                                acciones = "<td><center><a style='color: blue; cursor: pointer;  font-size: 14px;' target='_blank' href = 'view_informe_final/"+seguimiento.id_seguimiento+"'>Revisar</a></center></td>"
                            }

                            tabla += acciones
                            $.unblockUI(); //
                        })
                        $.unblockUI();

                        $("#bodytablemiseguimiento").html(tabla)
                        $("#titulo_tabla").html("Informe final seguimiento de asignatura ("+response.length+")")
                    })

                }

                function exportar_excel() {
                    var tabla_aux = $("#tabla_seguimientos").html()
                    borrarColumna("tabla_seguimientos",7)
                    tableToExcel('tabla_seguimientos', 'Reporte_seguimiento')
                    $("#tabla_seguimientos").html(tabla_aux)
                }
                </script>

<script>
    $(document).ready(function(){
        consultar()
    })
</script>
@endsection

