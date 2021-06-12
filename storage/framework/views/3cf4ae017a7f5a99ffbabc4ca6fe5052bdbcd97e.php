<?php
    $usuario = \App\Usuario::find(session('id_usuario'));
?>    
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
<?php $__env->startSection('header_content'); ?>
<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
<script src="https://malsup.github.io/jquery.blockUI.js"></script>

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/css/select2.min.css">
<div class="row page-titles">
                    <div class="col-md-6 col-8 align-self-center">
                        <h3 class="text-themecolor m-b-0 m-t-0">Tabla</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Tablero</a></li>
                            <li class="breadcrumb-item active">Seguimiento de asignatura</li>
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
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<?php echo e(Form::open(array('id' => 'form_fltros'))); ?>

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
                        <script type="text/javascript">
                            $(document).ready(function() {
                                $("#estado").select2({
                                    width : '100%',
                                })
                            });
                        </script>
                            </div>
                        </div>  
                        <div class="col-sm-3">
                            <div class="form-group">
                                  <label style="color: black;"><b>Periodo academico</b></label>
                                           <select onchange="buscar_carga_academica(this.value)" id="periodo_academico" name="periodo_academico" class="form-control form-control-line"  >
                                                <option value="">Todos</option>
                                                <?php $__currentLoopData = $periodos_academicos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $periodo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($periodo->id_periodo_academico); ?>"><?php echo e($periodo->periodo); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
                    
                        <div class="col-sm-3">
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
                              <div class="col-sm-6">
                            <div class="form-group">
                                  <label style="color: black;"><b>Fecha de envio</b></label>
                                  <input class="form-control hasDatepicker form-control-line" readonly="readonly" id="fecha" type="text" name="fecha" autocomplete="off" value="" placeholder ="Todos">

                                                
                            </div>
                        </div> 
                         <div class="col-sm-3">
                            <div class="form-group">
                                          <input type="hidden" name="docente" type="text" class="form-control form-control-line" value="<?php echo e($usuario->tercero->cedula); ?>" placeholder="" >
                            </div>
                        </div>  
                    
                 </div>

                </div>
<?php echo e(Form::close()); ?>


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
                                <h4 class="card-title" id="titulo_tabla">Seguimientos de asignatura </h4>
                                <div id="tablaarchivo" class="table-responsive">
                                    <table id="tabla_seguimientos" class="table">
                                        <thead>
                                            <tr>
                                                <td><b>Id</b></td>
                                                <td><b>Asignatura</b></td>
                                                <td><b>Grupo</b></td>
                                                <td><b>Corte</b></td>
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
             <?php echo e(Form::open(array('route' => array('notificacion/crear'), 'method' => 'post', 'id'=>'_form'))); ?>

            <?php echo e(Form::close()); ?>

            <?php
                $jefe_departamento = \App\Tercero::where('id_licencia', $usuario->tercero->id_licencia)->where('id_dominio_tipo_ter', 2)->first();
            ?>

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

                    function buscar_carga_academica(id_periodo){
                        let url = "<?php echo e(config('global.url_base')); ?>/docente/buscar_asignaturas/"+id_periodo+"/<?php echo e($usuario->id_tercero); ?>"
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
                        
                        var ruta = "<?php echo e(config('global.url_base')); ?>/asignatura/buscar_grupos_docente/"+id_asignatura+"/<?php echo e($usuario->id_tercero); ?>/"+id_periodo
                        var grupos = "<option value=''>Todos</option>"
                        $.get(ruta, function(response) {
                            response.forEach(function(grupo){
                                grupos += '<option value="'+grupo.id_grupo+'">'+grupo.codigo+'</option>'
                            })
                            $("#grupo").html(grupos)
                        })
                    }

                   /*
                    $('#fecha_envio').datepicker({
                        format: "dd/mm/yyyy",
                        language: "es",
                        autoclose: true
                    });
                    $('#fecha_revision').datepicker({
                        format: "dd/mm/yyyy",
                        language: "es",
                        autoclose: true
                    });
                    */

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

                

                function consultar(){
                    var data = $("#form_fltros").serialize();
                    var url = "<?php echo e(route('seguimiento/getReporte')); ?>"
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
                                    "<td>"+seguimiento.grupo+"</td>"+
                                    "<td>"+seguimiento.corte+"</td>"
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
                                if(seguimiento.retraso == "En espera"){

                                     acciones = "<td><center><a href='editar/"+seguimiento.id_seguimiento+"' style='color: blue; cursor: pointer;  font-size: 14px;' >Realizar</a></center></td>"
                                }else if(seguimiento.retraso == "Tiene plazo-extra"){
                                    acciones = "<td><center><a href='editar/"+seguimiento.id_seguimiento+"' style='color: blue; cursor: pointer;  font-size: 14px;' >Realizar</a></center></td>"
                                }else{
                                     acciones = "<td><center><a onclick=\"OpenModalNotificarSolicitud('"+seguimiento.id_seguimiento+"')\" style='color: blue; cursor: pointer;  font-size: 11px;' >Solicitar extra-plazo</a></center></td>"
                                }
                               
                            }
                            if(seguimiento.estado=='Recibido'){
                                acciones = "<td><center><a style='color: blue; cursor: pointer; font-size: 14px;' target='_blank' href = 'view/"+seguimiento.id_seguimiento+"'>Ver</a></center></td>"
                            }
                            if(seguimiento.estado=='Enviado'){
                                acciones = "<td><center><a style='color: blue; cursor: pointer;  font-size: 14px;' target='_blank' href = 'view/"+seguimiento.id_seguimiento+"'>Ver</a></center></td>"
                                acciones += "<td><center><a style='color: blue; cursor: pointer; font-size: 14px;' href='editar/"+seguimiento.id_seguimiento+"' >Editar</a></center></td>"
                            }

                            tabla += acciones
                            $.unblockUI(); //
                        })
                        $.unblockUI();

                        $("#bodytablemiseguimiento").html(tabla)
                        $("#titulo_tabla").html("Seguimientos de asignatura ("+response.length+")")
                    })

                }

                function exportar_excel() {
                    var tabla_aux = $("#tabla_seguimientos").html()
                    borrarColumna("tabla_seguimientos",8)
                    tableToExcel('tabla_seguimientos', 'Reporte_seguimiento')
                    $("#tabla_seguimientos").html(tabla_aux)
                }

                 function OpenModalNotificarSolicitud(id_seguimiento) {
                            var mensaje = "El docente "+'<?php echo e($usuario->tercero->getNameFull()); ?>'+" solicita un plazo extra para el seguimiento de asignatura "+id_seguimiento;
                            id_seguimiento_escojido = id_seguimiento
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
                            var id_tercero_envia = '<?php echo e($usuario->tercero->id_tercero); ?>'
                            var id_tercero_recibe = '<?php echo e($jefe_departamento->id_tercero); ?>'
                            var id_dominio_tipo = 8 //Es retraso
                            var _token = document.getElementsByName('_token')[0].value;

                            var data = {
                                mensaje : mensaje,
                                id_tercero_envia : id_tercero_envia,
                                id_tercero_recibe : id_tercero_recibe,
                                id_dominio_tipo : id_dominio_tipo,
                                id_formato : id_seguimiento_escojido,
                                id_dominio_tipo_formato : <?php echo e(config('global.seguimiento_asignatura')); ?>,
                                _token : _token
                            };
                             $.blockUI({
                                message: '<h1>Solicitando...</h1><i class="fa fa-spinner fa-spin fa-3x fa-fw">',
                                css: {
                                    border: 'none',
                                    padding: '15px',
                                    backgroundColor: '#000',
                                    '-webkit-border-radius': '10px',
                                    '-moz-border-radius': '10px',
                                    opacity: .8,
                                    color: '#ffffff'
                                }});
                            $.post("<?php echo e(route('notificacion/crear')); ?>",data, function(response){
                                $.unblockUI();
                               if (!response.error) toastr.success('Notificacion enviada exitosamente', 'Mensaje enviado', {timeOut: 3000}) 
                               if (response.error) toastr.error('Ocurrio un error al enviar la notificacion', 'Mensaje no enviado', {timeOut: 3000})
                            });
                        }



                </script>


            <!--FIN MODAL DE NOTICAR RETRASO------------------------------------------------------->


<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.main_docente', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\RepoUnicesar\resources\views/seguimiento_asignatura/consultar_desde_docente.blade.php ENDPATH**/ ?>