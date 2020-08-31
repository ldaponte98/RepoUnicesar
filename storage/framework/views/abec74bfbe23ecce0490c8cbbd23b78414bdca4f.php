<br>
<div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th><center><b>Id</b></center></th>
                            <th><center><b>Programa</b></center></th>
                            <th><center><b>Facultad</b></center></th>
                    </thead>
                    <style type="text/css"> 
                    	.fil td{
                    		color: black !important;
                    	}
                    </style>
                    <tbody id="bodytable">

                    	<?php $__currentLoopData = $asignatura->asignatura_programa; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $intersecto): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						           <tr>
                                    <td><center><?php echo e($intersecto->id_asignatura_programa); ?></center></td>
                                    <td><center><?php echo e($intersecto->programa->nombre); ?></center></td>
                                    <td><center><?php echo e($intersecto->programa->facultad->nombre); ?></center></td>
		                            </tr> 
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div><?php /**PATH C:\xampp\htdocs\RepoUnicesar\resources\views/asignatura/listado_programas_academicos.blade.php ENDPATH**/ ?>