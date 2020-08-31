<style type="text/css">
    div#iconedit{
        width: 40;
        height: 40;
        background-color: rgba(160, 191, 76, 1);
        position: absolute;
        right: 65;
        top: 200;

    }
    div#iconedit a{
        color : white;
        top: 12;
        position: relative;
    }

    div#iconedit:hover{
         background-color: rgba(160, 191, 76, 0.9);
    }
    .tab_header{
        color: black;
    }
</style>
<?php $__env->startSection('header_content'); ?>

	<div class="row page-titles">
                    <div class="col-md-6 col-8 align-self-center">
                        <h3 class="text-themecolor m-b-0 m-t-0">Tabla</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Docentes</a></li>
                            <li class="hidden-sm-down breadcrumb-item active">Ver docente</li>
                        </ol>
                    </div>
                    <div class="col-md-6 col-4 align-self-center">
                        <br>
                    
                 </div>
                    
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
 <div class="row">
                    <!-- Column -->
                    <div class="col-lg-4 col-xlg-3 col-md-5">
                        <div class="card">
                            <div class="card-block">

                                <center class="m-t-30">
                                    <div id="iconedit" class="img-circle" style="cursor: pointer;">

                                    <a href="<?php echo e(route('docente/update_image', $docente->id_tercero)); ?>" title="Editar Imagen" ><i class="icon-pencil"></i> <font class="font-medium"></font></a>
                                    </div>
                                    <?php
                                    $imagen = 'assets/images/users/sin_foto.jpg';
                                    if ($docente->foto)$imagen = 'files/'.$docente->cedula.'/'.$docente->foto;
                                    ?>
                                 <a> <img id="fotico" target="Ver imagen" src="<?php echo e(asset($imagen)); ?>" class="img-circle" width="200" height="200" /></a> 
                                    
                                    
                                    <h4 class="card-title m-t-10"><?php echo e($docente->tipo->dominio); ?></h4>
                                    <h6 class="card-subtitle"><a title="Ver sus asignaturas y grupos" href="javascript:void(0)" class="link"><i class="icon-people"></i> <font class="font-medium"></font></a></h6>
                                    
                                </center>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                    <!-- Column -->
                    <div class="col-lg-8 col-xlg-9 col-md-7">
                        <div class="card">
                            <div class="card-block">

                                <form class="form-horizontal form-material">
                                    <div class="form-group">
                                        <label class="col-md-12"><b>Identificacion</b></label>
                                        <div class="col-md-12">
                                            <input disabled="" type="text" value="<?php echo e($docente->cedula); ?>"  class="form-control form-control-line " data-validate="">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12"><b>Nombre Completo</b></label>
                                        <div class="col-md-12">
                                            <input disabled="" id="nom" type="text"  value="<?php echo e($docente->nombre); ?>"  class="form-control form-control-line ">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12"><b>Apellidos</b></label>
                                        <div class="col-md-12">
                                            <input disabled="" id="ape" type="text"  value="<?php echo e($docente->apellido); ?>" class="form-control form-control-line ">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label  class="col-md-12"><b>Email</b></label>
                                        <div class="col-md-12">
                                            <input disabled="" id="ema"  value="<?php echo e($docente->email); ?>" type="email" placeholder="@unicesar.edu.co" class="form-control form-control-line " >
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-12"><b>Tipo de vinculacion</b></label>
                                        <div class="col-md-12">
                                            <input disabled="" id="ema"  value="<?php echo e($docente->servicio); ?>" type="email" class="form-control form-control-line " >
                                        </div>
                                    </div>                                    
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <a style="color: white;" class="btn btn-success" href="<?php echo e(route('docente/horario', $docente->id_tercero)); ?>" target="_blank"><i class="fa fa-calendar"></i> Ver Horario</a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <?php if($docente->id_dominio_tipo_ter == 3): ?>
                    <div class="col-lg-12 col-xlg-12 col-md-12">
                        <div class="card">
                            <div class="card-block">
                              <div class="table-responsive">
                               <ul class="nav nav-tabs" id="myTab" role="tablist">
                                    <li class="nav-item">
                                      <a class="nav-link tab_header active" id="seg_pendientes-tab" data-toggle="tab" href="#seg_pendientes" role="tab" aria-controls="seg_pendientes"
                                        aria-selected="true"><b>Pendientes</b></a>
                                    </li>
                                    <li class="nav-item">
                                      <a class="nav-link tab_header" id="seg_enviados-tab" data-toggle="tab" href="#seg_enviados" role="tab" aria-controls="seg_enviados"
                                        aria-selected="false"><b>Enviados (No leidos)</b></a>
                                    </li>
                                    <li class="nav-item">
                                      <a class="nav-link tab_header" id="seg_recibidos-tab" data-toggle="tab" href="#seg_recibidos" role="tab" aria-controls="seg_recibidos"
                                        aria-selected="false"><b>Recibidos (Leidos)</b></a>
                                    </li>
                                    <li class="nav-item">
                                      <a class="nav-link tab_header" id="asignaturas-tab" data-toggle="tab" href="#asignaturas_tab" role="tab" aria-controls="asignaturas_tab"
                                        aria-selected="false"><b>Asignaturas y grupos</b></a>
                                    </li>
                                    
                                  </ul>
                                  <div class="tab-content" id="myTabContent">
                                    <div class="tab-pane fade show active" id="seg_pendientes" role="tabpanel" aria-labelledby="seg_pendientes-tab">
                                    <?php echo e(view('docente.listado_seguimientos_pendientes',compact('docente'))); ?>     
                                                      
                                    </div>
                                    <div class="tab-pane fade" id="seg_enviados" role="tabpanel" aria-labelledby="seg_enviados-tab">
                                    <?php echo e(view('docente.listado_seguimientos_enviados',compact('docente'))); ?>     
                                    </div>
                                    <div class="tab-pane fade" id="seg_recibidos" role="tabpanel" aria-labelledby="seg_recibidos-tab">
                                    <?php echo e(view('docente.listado_seguimientos_recibidos',compact('docente'))); ?>     
                                    </div>
                                    <div class="tab-pane fade" id="asignaturas_tab" role="tabpanel" aria-labelledby="asignaturas-tab">
                                    <?php echo e(view('docente.listado_asignaturas',compact('docente'))); ?>     
                                    </div>
                                    
                                  </div>
                                  </div>
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>
                    <!-- Column -->
                </div>




<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\RepoUnicesar\resources\views/docente/view.blade.php ENDPATH**/ ?>