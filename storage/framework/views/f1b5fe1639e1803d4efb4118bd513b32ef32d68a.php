<br>
<div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th><center><b>Id</b></center></th>
                            <th><center><b>Asignatura</b></center></th>
                            <th><center><b>Grupo</b></center></th>
                            <th><center><b>Corte</b></center></th>
                            <th><center><b>Fecha de envio</b></center></th>
                            <th><center><b>Fecha de revision</b></center></th>
                            <th><center><b>Periodo academico</b></center></th>
                        </tr>
                    </thead>
                    <style type="text/css"> 
                    	.fil td{
                    		color: black !important;
                    	}
                    </style>
                    <tbody id="bodytable">

                    	<?php $__currentLoopData = $docente->seguimientos_asignatura; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $seguimiento): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						        <?php if($seguimiento->estado == 'Recibido'): ?>
						           <tr>
		                    		<td><center><?php echo e($seguimiento->id_seguimiento); ?></center></td>
		                            <td><center><?php echo e($seguimiento->asignatura->nombre); ?></center></td>
		                            <td><center><?php echo e($seguimiento->grupo->codigo); ?></center></td>
		                            <td><center><?php echo e($seguimiento->corte); ?></center></td>
                                    <td><center><?php echo e($seguimiento->fecha); ?></center></td>    
                                    <td><center><?php echo e($seguimiento->updated_at); ?></center></td>    
		                            <td><center>
		                            	<?php echo e($seguimiento->grupo->periodo_academico->periodo); ?>

		                            </center></td>   
                                    <td><center>
                                        <a target="_blank" href="<?php echo e(route('seguimiento/view', $seguimiento->id_seguimiento)); ?>">Ver</a>
                                    </center></td> 
		                            </tr> 
						        <?php endif; ?>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
    <?php /**PATH C:\xampp\htdocs\RepoUnicesar\resources\views/docente/listado_seguimientos_recibidos.blade.php ENDPATH**/ ?>