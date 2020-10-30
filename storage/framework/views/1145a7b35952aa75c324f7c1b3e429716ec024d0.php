<?php $__env->startSection('content'); ?>
<style type="text/css">
    .modal_info{
        border-radius: 20px !important;
        background: #fff !important;
    }
    .modal_info h3{
        color: #000 !important;
    }
</style>
<div class="modal fade" id="modal_plazos" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" >
            <div class="modal-content modal_info">
                <div class="modal-body">
                    <center>
                        <h3><b>Tienes <strong>NUEVOS</strong> plazos extra aprobados</b></h3>
                        <img height="400" width="100%" src="<?php echo e(asset('/imagenes/plazos.gif')); ?>">
                        <button onclick="location.href = '<?php echo e(route('notificacion/mis_notificaciones')); ?>'" type="button" class="btn_tintilante" style="width: 50%; cursor: pointer;"><b>Revisar plazos</b></button>
                    </center>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
</div>

<script>
	$(document).ready(()=>{
		 <?php
                $plazos_extra = \App\PlazoDocente::where('id_tercero', session('id_tercero_usuario'))
                                                 ->where('estado', 1)
                                                 ->first();
        ?>

        <?php if($plazos_extra): ?>
            $("#modal_plazos").modal('show')
        <?php endif; ?>
	})
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main_docente', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\RepoUnicesar\resources\views/sitio/index2.blade.php ENDPATH**/ ?>