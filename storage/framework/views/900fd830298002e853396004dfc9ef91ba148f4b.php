<?php $__env->startSection('header_content'); ?>

	<div class="row page-titles">
                    <div class="col-md-6 col-8 align-self-center">
                        <h3 class="text-themecolor m-b-0 m-t-0">Tabla</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Docentes</a></li>
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
            <h4 class="card-title">Docentes : Total (<?php echo e(count($docentes)); ?>)</h4>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th><center><b><i class="fa fa-user"></i></b></center></th>
                            <th><b>Nombre</b></th>
                            <th><b>Cedula</b></th>
                            <th><b>Email</b></th>
                            <th><b>Tipo de vinculacion</b></th>
                        </tr>
                    </thead>
                    <style type="text/css"> 
                    	.fil td{
                    		color: black !important;
                    	}
                    </style>
                    <tbody id="bodytable">

                    	<?php $__currentLoopData = $docentes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $doc): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php
                            $docente = \App\Tercero::find($doc->id_tercero);
                        ?>
                    	  <tr class="fil" onclick="location.href = 'view/<?php echo e($docente->id_tercero); ?>'">
                    		<td>
                    			<center>
                                <img src="<?php echo e($docente->get_imagen()); ?>" class="img-circle" width="35" height="35" />
                                </center>
                            </td>
                            <td><?php echo e($docente->nombre); ?> <?php echo e($docente->apellido); ?></td>
                            <td><?php echo e($docente->cedula); ?></td>
                            <td><?php echo e($docente->email); ?></td>
                            <td><?php echo e($docente->servicio); ?></td>    
                            </tr>

                    	<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
                <?php echo e($docentes->links()); ?>

            </div>
        </div>
    </div>
</div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\RepoUnicesar\resources\views/docente/listado.blade.php ENDPATH**/ ?>