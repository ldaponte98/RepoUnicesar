<br>
<div class="row">
    <div class="col-lg-9"></div>
    <div class="col-lg-3"><button onclick="MarcarLeidos()" class="btn btn-info pull-right">Marcar como leidos</button></div>
</div>
<br>
<div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th><center><input type="checkbox" id="marcar_todos"/></center></th>
                            <th><center><b>Id</b></center></th>
                            <th><center><b>Asignatura</b></center></th>
                            <th><center><b>Grupo</b></center></th>
                            <th><center><b>Corte</b></center></th>
                            <th><center><b>Fecha de envio</b></center></th>
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
						        <?php if($seguimiento->estado == 'Enviado'): ?>
						           <tr>
                                    <td><center><input type="checkbox" name="check_marcar" value="<?php echo e($seguimiento->id_seguimiento); ?>" /></center></td>
                                    <td><center><?php echo e($seguimiento->id_seguimiento); ?></center></td>
		                            <td><center><?php echo e($seguimiento->asignatura->nombre); ?></center></td>
		                            <td><center><?php echo e($seguimiento->grupo->codigo); ?></center></td>
		                            <td><center><?php echo e($seguimiento->corte); ?></center></td>
		                            <td><center><?php echo e($seguimiento->fecha); ?></center></td>    
		                            <td><center>
		                            	<?php echo e($seguimiento->grupo->periodo_academico->periodo); ?>

		                            </center></td>
                                     <td><center>
                                       <a target="_blank" href="<?php echo e(route('seguimiento/view', $seguimiento->id_seguimiento)); ?>">Revisar</a>
                                    </center></td>     
		                            </tr> 
						        <?php endif; ?>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
             <?php echo e(Form::open(array('route' => array('seguimiento/marcarComoLeido'), 'method' => 'post'))); ?>

            <?php echo e(Form::close()); ?>


            <script>
                $("#marcar_todos").on("change", function() {
                    var estado_check = true
                    var check_marcar_todos = document.getElementById("marcar_todos");
                    if (check_marcar_todos.checked==false) estado_check = false
                    var x = document.getElementsByName("check_marcar");
                    for (var i = 0; i < x.length; i++) {
                      if (x[i].type == "checkbox") {
                        x[i].checked = estado_check;
                      }
                    }
                })

                function MarcarLeidos(){
                    var r = confirm("¿Seguro que desea marcar los archivos seleccionados como leidos?");
                    if (r == true) {
            
                        var seguimientos = new Array()
                        var x = document.getElementsByName("check_marcar");
                        for (var i = 0; i < x.length; i++) {
                          if (x[i].type == "checkbox" && x[i].checked == true) {
                             seguimientos.push(x[i].value);
                          }
                        }
                        if (seguimientos.length == 0) {
                            alert("Por favor seleccione por lo menos un seguimiento para marcar como leido")
                            return false
                        }
                        var data = {
                            seguimientos : seguimientos,
                            _token : document.getElementsByName('_token')[0].value
                        };
                        $.post("<?php echo e(route('seguimiento/marcarComoLeido')); ?>",data, function(response){
                           if (!response.error) {alert("¡Operacion exitosa!"); location.reload();}
                           if (response.error) alert("Ocurrio un error al realizar la operacion")
                        });


                        }
                }
            </script>
    <?php /**PATH C:\xampp\htdocs\RepoUnicesar\resources\views/docente/listado_seguimientos_enviados.blade.php ENDPATH**/ ?>