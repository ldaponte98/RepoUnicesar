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
    <script src="http://malsup.github.io/jquery.blockUI.js"></script>

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
                            </div>
                        </div>  
                              <div class="col-sm-3">
                            <div class="form-group">
                                  <label style="color: black;"><b>Asignatura</b></label>
                                        <select id="asignatura" name="asignatura" class="form-control form-control-line"  >
                                                <option value="">Seleccione...</option>
                                                <?php $__currentLoopData = $asignaturas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $asignatura): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($asignatura->id_asignatura); ?>"><?php echo e($asignatura->nombre); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                            </div>
                        </div> 

                         <div class="col-sm-3">
                            <div class="form-group">
                                  <label style="color: black;"><b>Grupo</b></label>
                                   <select id="grupo" name="grupo" class="form-control form-control-line"  >
                                        <option value="">Seleccione...</option>
                                        
                                    </select>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                  <label style="color: black;"><b>Periodo academico</b></label>
                                           <select id="periodo_academico" name="periodo_academico" class="form-control form-control-line"  >
                                                <option value="">Seleccione...</option>
                                                <?php
                                                    $cont = 0;
                                                ?>
                                                <?php $__currentLoopData = $periodos_academicos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $periodo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php if($cont == 0): ?>
                                                    <option selected value="<?php echo e($periodo->id_periodo_academico); ?>"><?php echo e($periodo->periodo); ?></option>
                                                    <?php
                                                        $cont++;
                                                    ?>
                                                <?php else: ?>
                                                    <option value="<?php echo e($periodo->id_periodo_academico); ?>"><?php echo e($periodo->periodo); ?></option>
                                                <?php endif; ?>
                                                
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
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
                        $("#asignatura").on('change', function(){
                           cargargrupos()
                        })
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

                function cargargrupos() {
                    $("#grupo").html("<option value='0'>Cargando...</option>")
                    var id_asignatura = $("#asignatura").val()
                    var ruta = "../asignatura/buscar_grupos/"+id_asignatura
                    var grupos = "<option value='0'>Seleccione...</option>"
                    $.get(ruta, function(response) {
                        response.forEach(function(grupo){
                            grupos += '<option value="'+grupo.id_grupo+'">'+grupo.codigo+'</option>'
                        })
                        $("#grupo").html(grupos)
                    })
                }

                function consultar(){
                    var data = $("#form_fltros").serialize();
                    var url = "<?php echo e(route('seguimiento/getReporteInformeFinal')); ?>"
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
                                 if(seguimiento.retraso == 'En espera' || seguimiento.retraso == 'Tiene plazo-extra') acciones = ""
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
                    borrarColumna("tabla_seguimientos",9)
                    tableToExcel('tabla_seguimientos', 'Reporte_seguimiento')
                    $("#tabla_seguimientos").html(tabla_aux)
                }
                </script>

<script>
    $(document).ready(function(){
        consultar()
    })
</script>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.main_docente', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\RepoUnicesar\resources\views/seguimiento_asignatura/consultar_informe_final_desde_docente.blade.php ENDPATH**/ ?>