<br>
<div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th><center><b>Id</b></center></th>
                            <th><center><b>Codigo</b></center></th>
                            <th><center><b>Asignatura</b></center></th>
                            <th><center><b>Creditos</b></center></th>
                            <th><center><b>Grupos</b></center></th>
                        </tr>
                    </thead>
                    <style type="text/css"> 
                    	.fil td{
                    		color: black !important;
                    	}
                    </style>
                    <tbody id="bodytable">

                    	<?php $__currentLoopData = $docente->asignaturas(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $asignatura): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						           <tr>
		                    		<td><center><?php echo e($asignatura->id_asignatura); ?></center></td>
                                    <td><center><?php echo e($asignatura->codigo); ?></center></td>
                                    <td><center><?php echo e($asignatura->nombre); ?></center></td>
		                            <td><center><?php echo e($asignatura->num_creditos); ?></center></td>
		                            <td><center><a style="cursor: pointer;" onclick="buscar_grupos(<?php echo e($asignatura->id_asignatura); ?>,'<?php echo e($asignatura->nombre); ?>')"><i class="fa fa-users"></i></a></center></td>   
		                            </tr> 
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>


    <div id="myModal" class="modal fade bd-example-modal-lg" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        
        <h4 class="modal-title" id="titulo_name_asignatura"><b></b></h4>
      </div>
          <div class="modal-body">
            <div class="form-group">                                     
                        <div class="card">
                                <center class="m-t-30">
                                  <table class="table">
                                    <thead>
                                        <tr>
                                            <th><center><b>Id</b></center></th>
                                            <th><center><b>Grupo</b></center></th>
                                            <th><center><b>N° estudiantes iniciales</b></center></th>
                                            <th><center><b>Periodo academico</b></center></th>
                                        </tr>
                                    </thead>
                                    <style type="text/css"> 
                                        .fil td{
                                            color: black !important;
                                        }
                                    </style>
                                    <tbody id="bodytableGrupos">

                                        
                                    </tbody>
                                </table>
                                </center>
                            </div>
                        
                   
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
       
      </div>
    </div>

  </div>
</div>
<?php echo e(csrf_field()); ?>



<script type="text/javascript">
    function buscar_grupos(id_asignatura, nombre_asignatura) {

        $("#titulo_name_asignatura").html("Grupos de "+nombre_asignatura)
        var id_tercero = "<?php echo e($docente->id_tercero); ?>"
        var url = "<?php echo e(route('grupo/buscar')); ?>"
        var token = document.getElementsByName("_token")[0].value
        var data = {
            'id_tercero': id_tercero,
            'id_asignatura': id_asignatura,
            '_token': token
        }
        $.post(url,data,function(result){ 
            if (result) {
                var tabla = ""
                if(Array.isArray(result)){
                    result.forEach(function(grupo) {
                        tabla += "<tr>"+
                        "<td><center>"+grupo.id_grupo+"</center></td>"+
                        "<td><center>Grupo "+grupo.codigo+"</center></td>"+
                        "<td><center>"+grupo.num_est_ini+"</center></td>"+
                        "<td><center>"+grupo.periodo+"</center></td>"+
                        "<tr>"
                    })
                }else{
                    console.log(result)
                    var grupo = result
                    tabla += "<tr>"+
                        "<td><center>"+result["id_grupo"]+"</center></td>"+
                        "<td><center>Grupo "+result.codigo+"</center></td>"+
                        "<td><center>"+result.num_est_ini+"</center></td>"+
                        "<td><center>"+result.periodo+"</center></td>"+
                        "<tr>"
                }
                $("#bodytableGrupos").html(tabla)
                $("#myModal").modal('show')
            }
        }).fail(function(result){
            console.log(result)
        })
    }
</script>
    <?php /**PATH C:\xampp\htdocs\RepoUnicesar\resources\views/docente/listado_asignaturas.blade.php ENDPATH**/ ?>