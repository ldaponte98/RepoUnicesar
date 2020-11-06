<br>
<div class="row">
    <div class="col-lg-9"><input type="search" class="form-control" id="txtfiltroenviados" placeholder="Consulta por cualquier campo">
</div>
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

                    var r = confirm("¿Seguro que desea marcar los archivos seleccionados como leidos?");
                    if (r == true) {

                        var data = {
                            formatos : seguimientos,
                            tipo_formato : <?php echo e(config('global.seguimiento_asignatura')); ?>,
                            _token : document.getElementsByName('_token')[0].value
                        };
                         $.blockUI({
                            message: '<h1>Marcando y notificando a los docentes</h1><i class="fa fa-spinner fa-spin fa-3x fa-fw">',
                            css: {
                                border: 'none',
                                padding: '15px',
                                backgroundColor: '#000',
                                '-webkit-border-radius': '10px',
                                '-moz-border-radius': '10px',
                                opacity: .8,
                                color: '#fff'
                            }});

                        $.post("<?php echo e(route('tercero/marcarFormatosComoLeido')); ?>",data, function(response){
                            $.unblockUI();
                           if (!response.error) {toastr.success('Se marcaron como leidos exitosamente', 'Proceso exitoso', {timeOut: 3000}); location.reload();}
                           if (response.error) toastr.success('Ocurrio un error al realizar la operacion', 'Error', {timeOut: 3000})
                        }).fail((error)=>{
                            console.log(error)
                            $.unblockUI();
                            toastr.success('Ocurrio un error en el servidor', 'Error', {timeOut: 3000})
                        });
                    }
                }

                $(document).ready(function () {
                    $('#txtfiltroenviados').keyup(function () {
                          var rex = new RegExp($(this).val(), 'i');
                            $('#bodytable tr').hide();
                            $('#bodytable tr').filter(function () {
                                return rex.test($(this).text());
                            }).show();
                        })
                });
            </script>
    <?php /**PATH C:\xampp\htdocs\RepoUnicesar\resources\views/docente/listado_seguimientos_enviados.blade.php ENDPATH**/ ?>