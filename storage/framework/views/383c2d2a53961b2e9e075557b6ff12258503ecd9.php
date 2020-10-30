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

<?php $__env->startSection('menu'); ?>
    <div class="fab-container">
        <div class="fab fab-icon-holder">
            <i class="fa fa-bars"></i>
        </div>
        <ul class="fab-options">
            <li onclick="location.href='<?php echo e(route('docente/horario', $docente->id_tercero)); ?>'">
                <span class="fab-label">Horario</span>
                <div class="fab-icon-holder">
                    <i class="ti-calendar"></i>
                </div>
            </li>
            <li onclick="location.href='/docente/view_formato/<?php echo e(config('global.plan_trabajo')); ?>/<?php echo e($docente->id_tercero); ?>'">
                <span class="fab-label">Planes de trabajo</span>
                <div class="fab-icon-holder">
                    <i class="ti-file"></i>
                </div>
            </li>
            <li onclick="location.href='/docente/view_formato/<?php echo e(config('global.desarrollo_asignatura')); ?>/<?php echo e($docente->id_tercero); ?>'">
                <span class="fab-label">Planes de desarrollo asignatura</span>
                <div class="fab-icon-holder">
                    <i class="ti-cup"></i>
                </div>
            </li>
            <li onclick="location.href='/docente/view_formato/<?php echo e(config('global.actividades_complementarias')); ?>/<?php echo e($docente->id_tercero); ?>'">
                <span class="fab-label">Actividades complementarias</span>
                <div class="fab-icon-holder">
                    <i class="ti-layers-alt"></i>
                </div>
            </li>
            <li onclick="location.href='/docente/view_formato/<?php echo e(config('global.seguimiento_asignatura')); ?>/<?php echo e($docente->id_tercero); ?>'">
                <span class="fab-label">Seguimientos de asignatura</span>
                <div class="fab-icon-holder">
                    <i class="ti-truck"></i>
                </div>
            </li>
        </ul>
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
                                 <a> <img id="fotico" target="Ver imagen" src="<?php echo e(asset($imagen)); ?>" class="img-circle" width="180" height="180" /></a> 
                                    
                                    
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
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label><b>Identificacion</b></label>
                                                <input disabled="" type="text" value="<?php echo e($docente->cedula); ?>"  class="form-control form-control-line " data-validate="">
                                            </div>
                                        </div>

                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label ><b>Nombres</b></label>
                                                <input disabled="" id="nom" type="text"  value="<?php echo e($docente->nombre); ?>"  class="form-control form-control-line ">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label><b>Apellidos</b></label>    
                                                <input disabled="" id="ape" type="text"  value="<?php echo e($docente->apellido); ?>" class="form-control form-control-line ">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label ><b>Email</b></label>    
                                                <input disabled="" id="ema"  value="<?php echo e($docente->email); ?>" type="email" placeholder="@unicesar.edu.co" class="form-control form-control-line " >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                             <div class="form-group">
                                                <label><b>Tipo de servicio</b></label>
                                                <input disabled="" id="ema"  value="<?php echo e($docente->servicio); ?>" type="email" class="form-control form-control-line " >
                                            </div>  
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label><b>Tipo de vinculación</b></label>
                                                <input disabled="" id="ema"  value="<?php echo e($docente->vinculacion); ?>" type="email" class="form-control form-control-line " >
                                            </div> 
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
                                    
                                    <li class="nav-item ">
                                      <a class="nav-link tab_header active" id="asignaturas-tab" data-toggle="tab" href="#asignaturas_tab" role="tab" aria-controls="asignaturas_tab"
                                        aria-selected="false"><b>Asignaturas y grupos</b></a>
                                    </li>
                                    
                                  </ul>
                                  <div class="tab-content" id="myTabContent">
                                    <div class="tab-pane fade show active" id="asignaturas_tab" role="tabpanel" aria-labelledby="asignaturas-tab">
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