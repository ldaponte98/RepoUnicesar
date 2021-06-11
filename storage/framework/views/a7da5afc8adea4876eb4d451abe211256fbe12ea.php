<?php $__env->startSection('header_content'); ?>
<div class="row page-titles">
    <div class="col-md-6 col-8 align-self-center">
        <h3 class="text-themecolor m-b-0 m-t-0">Tabla</h3>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Fechas</a></li>
            <li class="hidden-sm-down breadcrumb-item active">Fechas de entrega</li>
        </ol>
    </div>          
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<?php
  $is_admin = session('is_admin');
?>

<?php if(session('mensaje_update_fechas')): ?>
  <script>
    toastr.success('<?php echo e(session('mensaje_update_fechas')); ?>', 'Fechas actualizadas', {timeOut: 5000})
  </script>
<?php endif; ?>
<div class="row">
  <div class="col-sm-12">
    <div class="card">
      <div class="card-block">
        <div class="form-group">
          <?php echo e(Form::open(array('route' => 'fechas/fechas_de_entrega',))); ?>

          <label style="color: black;"><b>Periodo Academico</b></label>
            <div class="row">
                <div class="col-sm-4">
                  <?php
                    $periodos = \App\PeriodoAcademico::orderBy('id_periodo_academico', 'desc')->get();
                  ?>
                  <select name="id_periodo_escojido" class="form-control form-control-line" >
                      <?php $__currentLoopData = $periodos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $periodo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option <?php if($periodo->id_periodo_academico == $periodo_academico->id_periodo_academico): ?> selected <?php endif; ?> value="<?php echo e($periodo->id_periodo_academico); ?>"><?php echo e($periodo->periodo); ?></option>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </select>
                </div>
                <div class="col-sm-2">
                  <button type="submit" style="color: white; height: 100%; font-size: 16px;"  class="btn btn-primary">Consultar</button>
                </div>
                <div class="col-sm-6">
                  <i class="pull-right" style="margin-top: 5px">Calendario academico: <?php echo e(date('d/m/Y', strtotime($periodo_academico->fechaInicio))); ?> hasta <?php echo e(date('d/m/Y', strtotime($periodo_academico->fechaFin))); ?></i>
                </div>
            </div>
          <?php echo e(Form::close()); ?>

        </div>
      </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-sm-4">
    <div class="card-section card-section-1 border rounded">
      <div class="card-header card-header-1 rounded">
          <center><h2 class="card-header-title mb-3 text-white">Plan de Trabajo</h2></center>
      </div>
      <div class="card-body text-center mb-2" style="padding: 15px">
          <br><br><br><br>
          <?php if($fechas_de_entrega_plan_trabajo != null): ?>
              <b>Desde <?php echo e(date('d/m/Y', strtotime($fechas_de_entrega_plan_trabajo->fechainicial1))); ?> hasta <?php echo e(date('d/m/Y', strtotime($fechas_de_entrega_plan_trabajo->fechafinal1))); ?></b>
          <?php else: ?>
              <center><b>Fechas no asignadas </b></center>
          <?php endif; ?> 
          <br>
          <br>
          <br>
          <hr>
         <center>
          <?php if($is_admin == true): ?>
            <span>
              <a href="<?php echo e(route('fechas/editar_fechas_de_entrega',['periodo' => $periodo_academico->id_periodo_academico, 'formato' =>  config('global.plan_trabajo') ])); ?>" title="Editar fechas"><i class="fa fa-pencil rounded-circle" aria-hidden="true"></i></a>
            </span>
          <?php endif; ?>
        </center>
      </div>
    </div>
  </div>

  <div class="col-sm-4">
    <div class="card-section card-section-1 border rounded">
      <div class="card-header card-header-1 rounded">
        <center><h2 class="card-header-title mb-3 text-white">Desarrollo Asignatura</h2></center>
      </div>
      <div class="card-body text-center mb-2" style="padding: 15px">
        <br><br><br><br>
        <?php if($fechas_de_entrega_plan_desarrollo_asignatura != null): ?>
            <b>Desde <?php echo e(date('d/m/Y', strtotime($fechas_de_entrega_plan_desarrollo_asignatura->fechainicial1))); ?> hasta <?php echo e(date('d/m/Y', strtotime($fechas_de_entrega_plan_desarrollo_asignatura->fechafinal1))); ?></b>
        <?php else: ?>
            <b>Fechas no asignadas </b>
        <?php endif; ?> 
        <br><br><br><hr>
        <center>
          <?php if($is_admin == true): ?>
            <span>
              <a href="<?php echo e(route('fechas/editar_fechas_de_entrega',['periodo' => $periodo_academico->id_periodo_academico, 'formato' =>  config('global.desarrollo_asignatura') ])); ?>" title="Editar fechas"><i class="fa fa-pencil rounded-circle" aria-hidden="true"></i></a>
            </span>
          <?php endif; ?>
        </center>
      </div>
    </div>
  </div>

  <div class="col-sm-4">
    <div class="card-section card-section-1 border rounded">
      <div class="card-header card-header-1 rounded">
          <center><h2 class="card-header-title mb-3 text-white">Seguimiento Asignatura</h2></center>
      </div>
      <div class="card-body mb-2" style="padding: 15px">
        <?php if($fechas_de_entrega_seguimiento != null): ?>
          <b>Primer corte </b>
          <p id="txt_seguimiento_corte_1">
            <?php if($fechas_de_entrega_seguimiento->fechainicial1 != null): ?>
                 <?php echo e(date('d/m/Y', strtotime($fechas_de_entrega_seguimiento->fechainicial1))); ?> hasta <?php echo e(date('d/m/Y', strtotime($fechas_de_entrega_seguimiento->fechafinal1))); ?>

            <?php else: ?>
            Sin definir
            <?php endif; ?>
          </p>
          <b>Segundo corte </b>
          <p id="txt_seguimiento_corte_1">
            <?php if($fechas_de_entrega_seguimiento->fechainicial2 != null): ?>
                 <?php echo e(date('d/m/Y', strtotime($fechas_de_entrega_seguimiento->fechainicial2))); ?> hasta <?php echo e(date('d/m/Y', strtotime($fechas_de_entrega_seguimiento->fechafinal2))); ?>

            <?php else: ?>
            Sin definir
            <?php endif; ?>
          </p>
          <b>Tercer corte </b>
          <p id="txt_seguimiento_corte_1">
            <?php if($fechas_de_entrega_seguimiento->fechainicial3 != null): ?>
                 <?php echo e(date('d/m/Y', strtotime($fechas_de_entrega_seguimiento->fechainicial3))); ?> hasta <?php echo e(date('d/m/Y', strtotime($fechas_de_entrega_seguimiento->fechafinal3))); ?>

            <?php else: ?>
            Sin definir
            <?php endif; ?>
          </p>
        <?php else: ?>
          <br><br><br><br>
          <center><b>Fechas no asignadas </b></center>
          <br>
          <br>
        <?php endif; ?> 
        <hr>
        <center>
          <?php if($is_admin == true): ?>
            <span>
              <a href="<?php echo e(route('fechas/editar_fechas_de_entrega',['periodo' => $periodo_academico->id_periodo_academico, 'formato' =>  config('global.seguimiento_asignatura') ])); ?>" title="Editar fechas"><i class="fa fa-pencil rounded-circle" aria-hidden="true"></i></a>
            </span>
          <?php endif; ?>
        </center>
      </div>
    </div>
  </div>
</div><br>
<div class="row">
  <div class="col-sm-4">
    <div class="card-section card-section-1 border rounded">
      <div class="card-header card-header-1 rounded">
        <center><h2 class="card-header-title mb-3 text-white">Actividades Complementarias</h2></center>
      </div>
      <div class="card-body mb-2" style="padding: 15px">
        <?php if($fechas_de_entrega_actividades_complementarias != null): ?>
          <b>Primer corte </b>
          <p id="txt_seguimiento_corte_1">
            <?php if($fechas_de_entrega_actividades_complementarias->fechainicial1 != null): ?>
                 <?php echo e(date('d/m/Y', strtotime($fechas_de_entrega_actividades_complementarias->fechainicial1))); ?> hasta <?php echo e(date('d/m/Y', strtotime($fechas_de_entrega_actividades_complementarias->fechafinal1))); ?>

            <?php else: ?>
              Sin definir
            <?php endif; ?>
          </p>
          <b>Segundo corte </b>
          <p id="txt_seguimiento_corte_1"><?php echo e(date('d/m/Y', strtotime($fechas_de_entrega_actividades_complementarias->fechainicial2))); ?> hasta <?php echo e(date('d/m/Y', strtotime($fechas_de_entrega_actividades_complementarias->fechafinal2))); ?></p>
          <b>Tercer corte </b>
          <p id="txt_seguimiento_corte_1"><?php echo e(date('d/m/Y', strtotime($fechas_de_entrega_actividades_complementarias->fechainicial3))); ?> hasta <?php echo e(date('d/m/Y', strtotime($fechas_de_entrega_actividades_complementarias->fechafinal3))); ?></p>
          <?php else: ?>
          <br><br><br><br>
          <center><b>Fechas no asignadas </b></center>
          <br><br>
        <?php endif; ?>                                 
        <hr>
        <center>
          <?php if($is_admin == true): ?>
            <span>
              <a href="<?php echo e(route('fechas/editar_fechas_de_entrega',['periodo' => $periodo_academico->id_periodo_academico, 'formato' =>  config('global.actividades_complementarias') ])); ?>" title="Editar fechas"><i class="fa fa-pencil rounded-circle" aria-hidden="true"></i></a>
            </span>
          <?php endif; ?>
        </center>
      </div>
    </div>
  </div>                  
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make((session("is_admin") == true ? 'layouts.main' : 'layouts.main_docente'), \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\RepoUnicesar\resources\views/fechas/fechas_de_entrega.blade.php ENDPATH**/ ?>