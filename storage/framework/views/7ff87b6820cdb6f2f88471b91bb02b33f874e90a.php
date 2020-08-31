<?php $__env->startSection('header_content'); ?>

	<div class="row page-titles">
                    <div class="col-md-6 col-8 align-self-center">
                        <h3 class="text-themecolor m-b-0 m-t-0">Tabla</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Asignaturas</a></li>
                            <li class="hidden-sm-down breadcrumb-item active">Listado</li>
                        </ol>
                    </div>
                    <div class="col-md-6 col-4 align-self-center">
                        <br>
                        <input title="Consulta cualquier campo" id="txtfiltro" type="text" class="pull-right search" name="" placeholder="Consulta Aqui">
                 </div>
                    
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="row">
<div class="col-sm-12">
    <div class="card">
        <div class="card-block">
            <h4 class="card-title">Asignaturas : Total (<?php echo e(count($asignaturas)); ?>)</h4>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th><center><b>Id</b></center></th>
                            <th><center><b>Codigo</b></center></th>
                            <th><center><b>Nombre</b></center></th>
                            <th><center><b>Credios</b></center></th>  
                        </tr>
                    </thead>
                    <style type="text/css"> 
                    	.fil td{
                    		color: black !important;
                    	}
                    </style>
                    <tbody id="bodytable">

                    	<?php $__currentLoopData = $asignaturas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $asignatura): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    	  <tr class="fil" onclick="location.href = 'view/<?php echo e($asignatura->id_asignatura); ?>'">
                            <td><?php echo e($asignatura->id_asignatura); ?></td>
                            <td><?php echo e($asignatura->codigo); ?></td>
                            <td><?php echo e($asignatura->nombre); ?></td>
                            <td><center><?php echo e($asignatura->num_creditos); ?></center></td> 
                            </tr>

                    	<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
                <?php echo e($asignaturas->links()); ?>

            </div>
        </div>
    </div>
</div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\RepoUnicesar\resources\views/asignatura/listado.blade.php ENDPATH**/ ?>