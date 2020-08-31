<?php
    $usuario = \App\Usuario::find(session('id_usuario'));
    $tercero = $usuario->tercero;
?> 


<?php $__env->startSection('header_content'); ?>
<?php
$is_admin = session('is_admin');
$tiene_permiso_editar = $actividad_complementaria->tiene_permiso_de_editar();

if($is_admin==true){
  $tiene_permiso_editar = false;
}
?>
	<div class="row page-titles">
      <div class="col-md-6 col-8 align-self-center">
                        <h3 class="text-themecolor m-b-0 m-t-0">Tabla</h3>
          <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="<?php echo e(route('actividades_complementarias/consultar')); ?>">Actividades complementarias</a></li>
              <li class="hidden-sm-down breadcrumb-item active"><?php if($is_admin==true): ?>
                <?php echo e($actividad_complementaria->plan_trabajo->tercero->getNameFull()); ?>

                <?php else: ?>
                Ver informe
              <?php endif; ?></li>
          </ol>
      </div>         
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<script>
  function cambiar_estado_actividad_complementaria() {
    var r = confirm("¿Seguro que desea enviar esta informacion al jefe de departamento?");
    if (r == true) {
      var url = '<?php echo e(route('actividades_complementarias/enviar_formato', $actividad_complementaria->id_actividad_complementaria)); ?>'
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

      $.get(url, (response) => {
        $.unblockUI();
        if(!response.error){
          toastr.success(response.mensaje, 'Operacion exitosa', {timeOut: 3000})
        }else{
          toastr.error('Ocurrio un error al enviar el formato', 'Error', {timeOut: 3000})
        }

      })
    }
  }
</script>


<div class="row">
    <div class="col-sm-12">
    
<?php echo e(Form::open(array(
    'id' => 'form-plan-trabajo',
    'class'=>'form-horizontal form-material',
    'files' => true))); ?>

<div class="card">
  <div class="card-block">
      <div class="row">
        <div class="col-sm-9">
        <h4 class="card-title">Actividades complementarias de <?php echo e($actividad_complementaria->corte); ?> corte (<?php echo e($actividad_complementaria->plan_trabajo->periodo_academico->periodo); ?>)</h4>
        </div>
        <div class="col-sm-3">
          <?php if($tiene_permiso_editar == true): ?>
            <a style="color: white; width: 80%;" onclick="cambiar_estado_actividad_complementaria()"  class="btn btn-info pull-right">Enviar cambios actuales</a>

          <?php endif; ?>
          
        </div>
      </div>
        <?php $__currentLoopData = $actividad_complementaria->plan_trabajo->get_tipos_de_actividades_para_actividades_complementarias(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tipo_actividad_programada): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
       
         <div class="comment-widgets">
            <div class="d-flex flex-row comment-row active">
              <div class="comment-text w-100">
                  <h5><b><?php echo e($tipo_actividad_programada->dominio); ?></b></h5>
                  <?php
                    $total_actividades_programadas = count($actividad_complementaria->plan_trabajo->get_actividades_para_actividades_complementarias_por_tipo($tipo_actividad_programada->id_dominio));
                    $total_actividades_realizadas = $actividad_complementaria->get_total_detalles_por_actividad($tipo_actividad_programada->id_dominio);
                  ?>
                  <p class="mb-1"><?php echo e($total_actividades_realizadas); ?> de <?php echo e($total_actividades_programadas); ?> actividades registradas.</p>
                  <div class="comment-footer">
                      <span class="text-muted float-right">Ultima actualizacion: <?php echo e($actividad_complementaria->get_ultima_fecha_actualizada($tipo_actividad_programada->id_dominio)); ?></span>
                      <?php if($total_actividades_programadas != $total_actividades_realizadas): ?>
                        <span class="label label-light-warning">
                          Pendiente
                        </span>
                      <?php else: ?>
                        <span class="label label-light-success">
                          Todas realizadas
                        </span>
                      <?php endif; ?>
                      <?php if($tiene_permiso_editar == true): ?>
                      <span class="action-icons">
                              <a href="<?php echo e(route('actividades_complementarias/editar_detalle',['id_actividad' =>  $actividad_complementaria->id_actividad_complementaria , 'id_tipo_actividad' => $tipo_actividad_programada->id_dominio])); ?>"><i class="ti-pencil-alt"></i></a>
                      </span>
                      <?php else: ?>
                      <span class="action-icons">
                              <a href="<?php echo e(route('actividades_complementarias/editar_detalle',['id_actividad' =>  $actividad_complementaria->id_actividad_complementaria , 'id_tipo_actividad' => $tipo_actividad_programada->id_dominio])); ?>" title="Ver informes"><i class="ti-eye"></i></a>
                      </span>
                      <?php endif; ?>
                  </div>
              </div>
            </div>

        </div>
       <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
       
    </div>
</div>

<?php echo e(Form::close()); ?>

    </div>
</div>


<script>
</script>
    
<?php $__env->stopSection(); ?>
<?php echo $__env->make((session("is_admin") == true ? 'layouts.main' : 'layouts.main_docente'), \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\RepoUnicesar\resources\views/actividades_complementarias/vista_general.blade.php ENDPATH**/ ?>