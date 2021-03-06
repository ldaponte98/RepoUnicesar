<?php $__env->startSection('header_content'); ?>

	<div class="row page-titles">
                    <div class="col-md-6 col-8 align-self-center">
                        <h3 class="text-themecolor m-b-0 m-t-0">Tabla</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Fechas</a></li>
                            <li class="hidden-sm-down breadcrumb-item active">Editar fechas de entrega</li>
                        </ol>
                    </div>        
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<?php
?>


<?php if($errores != ""): ?>
  <script>
    toastr.error('<?php echo e($errores); ?>', 'Error', {timeOut: 3000})
  </script>
<?php endif; ?>
<div class="row">
  <div class="col-sm-12">
      <div class="card">
          <div class="card-block">
              
                  <div class="form-group">

                      
                          <form action="<?php echo e(route('fechas/editar_fechas_de_entrega',['periodo' => $periodo_academico->id_periodo_academico, 'formato' =>  $formato->id_dominio ])); ?>">
                            <?php echo csrf_field(); ?>
                          
                                    <label style="color: black;"><b>Fechas de <?php echo e($formato->dominio); ?> - Periodo Academico <?php echo e($periodo_academico->periodo); ?></b></label>
                                    <br><br>
                                    <div class="row">

                                      <div class="col-sm-4">
                                        <div class="form-group">
                                                <?php if($formato->id_dominio == config('global.plan_trabajo') or $formato->id_dominio == config('global.desarrollo_asignatura')): ?>
                                                <label>Lapso de entrega</label>
                                              <?php else: ?>
                                                <label>Primer Corte</label>
                                              <?php endif; ?>

                                              <?php if($fecha_de_entrega['fechainicial1']): ?>
                                              <input class="form-control hasDatepicker form-control-line" readonly="readonly" id="fechas1" type="text" name="fechas1" autocomplete="off" value="<?php echo e(date('d/m/Y', strtotime($fecha_de_entrega->fechainicial1))); ?> - <?php echo e(date('d/m/Y', strtotime($fecha_de_entrega->fechafinal1))); ?>" placeholder ="Sin definir">
                                              <?php else: ?>
                                                <input class="form-control hasDatepicker form-control-line" readonly="readonly" id="fechas1" type="text" name="fechas1" autocomplete="off" value="Sin definir" placeholder ="Sin definir">
                                              <?php endif; ?>
                                                                   
                                        </div>
                                      </div>

                                    <?php if($formato->id_dominio == config('global.seguimiento_asignatura') or $formato->id_dominio == config('global.actividades_complementarias')): ?>

                                      <div class="col-sm-4">
                                        <div class="form-group">
                                                <?php if($formato->id_dominio == config('global.plan_trabajo') or $formato->id_dominio == config('global.desarrollo_asignatura')): ?>
                                                <label>Lapso de entrega</label>
                                              <?php else: ?>
                                                <label>Segundo Corte</label>
                                              <?php endif; ?>
                                               <?php if($fecha_de_entrega['fechainicial2']): ?>
                                              <input class="form-control hasDatepicker form-control-line" readonly="readonly" id="fechas2" type="text" name="fechas2" autocomplete="off" value="<?php echo e(date('d/m/Y', strtotime($fecha_de_entrega->fechainicial2))); ?> - <?php echo e(date('d/m/Y', strtotime($fecha_de_entrega->fechafinal2))); ?>" placeholder ="Sin definir">
                                              <?php else: ?>
                                                <input class="form-control hasDatepicker form-control-line" readonly="readonly" id="fechas2" type="text" name="fechas2" autocomplete="off" value="Sin definir" placeholder ="Sin definir">
                                              <?php endif; ?>                     
                                        </div>
                                      </div>

                                      <div class="col-sm-4">
                                        <div class="form-group">
                                                <?php if($formato->id_dominio == config('global.plan_trabajo') or $formato->id_dominio == config('global.desarrollo_asignatura')): ?>
                                                <label>Lapso de entrega</label>
                                              <?php else: ?>
                                                <label>Tercer Corte</label>
                                              <?php endif; ?>

                                               <?php if($fecha_de_entrega['fechainicial3']): ?>
                                              <input class="form-control hasDatepicker form-control-line" readonly="readonly" id="fechas3" type="text" name="fechas3" autocomplete="off" value="<?php echo e(date('d/m/Y', strtotime($fecha_de_entrega->fechainicial3))); ?> - <?php echo e(date('d/m/Y', strtotime($fecha_de_entrega->fechafinal3))); ?>" placeholder ="Sin definir">
                                              <?php else: ?>
                                                <input class="form-control hasDatepicker form-control-line" readonly="readonly" id="fechas3" type="text" name="fechas3" autocomplete="off" value="Sin definir" placeholder ="Sin definir">
                                              <?php endif; ?>                      
                                        </div>
                                      </div>

                                    <?php endif; ?>


                                    </div>

                                    <div class="row">
                                      <div class="col-sm-4">
                                        <button class="btn btn-info">Actualizar</button>
                                      </div>
                                    </div>
                      </form>

                              </div>
              <div class="row">

                        
              </div>
          </div>
      </div>
  </div>
</div>


<div>
  <script>
                $(document).ready(function() {
              
                    if($("#fechas1").val() != "Sin definir"){
                          $('#fechas1').daterangepicker({
                                      autoApply: true,
                                      autoUpdateInput: true,
                                      minDate : '<?php echo e(date('d/m/Y', strtotime($periodo_academico->fechaInicio))); ?>',
                                      maxDate : '<?php echo e(date('d/m/Y', strtotime($periodo_academico->fechaFin))); ?>',
                                      locale: {
                                        format: 'DD/MM/YYYY',
                                        cancelLabel: 'Clear'
                                      }
                          });
                    }else{
                      $('#fechas1').click(function(){
                            if($('#fechas1').val()=="Sin definir"){
                                    $('#fechas1').daterangepicker({
                                      autoApply: true,
                                      autoUpdateInput: true,
                                      minDate : '<?php echo e(date('d/m/Y', strtotime($periodo_academico->fechaInicio))); ?>',
                                      maxDate : '<?php echo e(date('d/m/Y', strtotime($periodo_academico->fechaFin))); ?>',
                                      endDate : '<?php echo e(date('d/m/Y', strtotime($periodo_academico->fechaInicio))); ?>',
                                      locale: {
                                        format: 'DD/MM/YYYY',
                                        cancelLabel: 'Clear'
                                      }
                                    });
                             }
                         });
                    }

                    if($("#fechas2").val() != "Sin definir"){
                          $('#fechas2').daterangepicker({
                                      autoApply: true,
                                      autoUpdateInput: true,
                                      minDate : '<?php echo e(date('d/m/Y', strtotime($periodo_academico->fechaInicio))); ?>',
                                      maxDate : '<?php echo e(date('d/m/Y', strtotime($periodo_academico->fechaFin))); ?>',
                                      locale: {
                                        format: 'DD/MM/YYYY',
                                        cancelLabel: 'Clear'
                                      }
                          });
                    }else{
                      $('#fechas2').click(function(){
                            if($('#fechas2').val()=="Sin definir"){
                                    $('#fechas2').daterangepicker({
                                      autoApply: true,
                                      autoUpdateInput: true,
                                      minDate : '<?php echo e(date('d/m/Y', strtotime($periodo_academico->fechaInicio))); ?>',
                                      maxDate : '<?php echo e(date('d/m/Y', strtotime($periodo_academico->fechaFin))); ?>',
                                      endDate : '<?php echo e(date('d/m/Y', strtotime($periodo_academico->fechaInicio))); ?>',
                                      locale: {
                                        format: 'DD/MM/YYYY',
                                        cancelLabel: 'Clear'
                                      }
                                    });
                             }
                         });
                    }

                    if($("#fechas3").val() != "Sin definir"){
                          $('#fechas3').daterangepicker({
                                      autoApply: true,
                                      autoUpdateInput: true,
                                      minDate : '<?php echo e(date('d/m/Y', strtotime($periodo_academico->fechaInicio))); ?>',
                                      maxDate : '<?php echo e(date('d/m/Y', strtotime($periodo_academico->fechaFin))); ?>',
                                      locale: {
                                        format: 'DD/MM/YYYY',
                                        cancelLabel: 'Clear'
                                      }
                          });
                    }else{
                      $('#fechas3').click(function(){
                            if($('#fechas3').val()=="Sin definir"){
                                    $('#fechas3').daterangepicker({
                                      autoApply: true,
                                      autoUpdateInput: true,
                                      minDate : '<?php echo e(date('d/m/Y', strtotime($periodo_academico->fechaInicio))); ?>',
                                      maxDate : '<?php echo e(date('d/m/Y', strtotime($periodo_academico->fechaFin))); ?>',
                                      endDate : '<?php echo e(date('d/m/Y', strtotime($periodo_academico->fechaInicio))); ?>',
                                      locale: {
                                        format: 'DD/MM/YYYY',
                                        cancelLabel: 'Clear'
                                      }
                                    });
                             }
                         });
                    }
                                    
          });

  </script>
</div>
    
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\RepoUnicesar\resources\views/fechas/editar_fechas_de_entrega.blade.php ENDPATH**/ ?>