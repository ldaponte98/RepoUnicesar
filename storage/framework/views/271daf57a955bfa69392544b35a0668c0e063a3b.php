<br>
<div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th><center><b>Id</b></center></th>
                            <th><center><b>Grupo</b></center></th>
                            <th><center><b>Docente Encargado</b></center></th>
                            <th><center><b>N° Estudiantes</b></center></th>
                            <th><center><b>Periodo academico</b></center></th>
                        </tr>
                    </thead>
                    <style type="text/css"> 
                    	.fil td{
                    		color: black !important;
                    	}
                    </style>
                    <tbody id="bodytable">

                    	<?php $__currentLoopData = $asignatura->grupos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $grupo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						           <tr>
                                    <td><center><?php echo e($grupo->id_grupo); ?></center></td>
                                    <td><center><?php echo e($grupo->codigo); ?></center></td>
                                    <td><center><?php echo e($grupo->tercero->getNameFull()); ?></center></td>
                                    <td><center><?php echo e($grupo->num_est_ini); ?></center></td>
                                    <td><center><?php echo e($grupo->periodo_academico->periodo); ?></center></td>
                                    
		                            </tr> 
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div><?php /**PATH C:\xampp\htdocs\RepoUnicesar\resources\views/asignatura/listado_grupos.blade.php ENDPATH**/ ?>