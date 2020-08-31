<br>
<div class="row">
    
        <div class="col-lg-7"><input id="input_unidad" style="display: none" class="form-control" type="text" name="" placeholder="Nombre de la unidad"></div>
        <div class="col-lg-2"><button id="btn_unidad" style="display: none" onclick="agregar_unidad()" class="btn btn-success">Agregar</button></div>
    <div class="col-lg-3"><button onclick="HabilitarOpcionAgregarUnidad()" class="btn btn-info pull-right">Nueva Unidad</button></div>
</div>
<br>
<div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th><center><b>Id</b></center></th>
                            <th><center><b>Unidad</b></center></th>
                            <th><center><b>Ejes tematicos</b></center></th>
                            <th><center><b>Opciones</b></center></th>
                    </thead>
                    <style type="text/css"> 
                    	.fil td{
                    		color: black !important;
                    	}
                    </style>
                    <tbody id="bodytableUnidades">

                    	<?php $__currentLoopData = $asignatura->unidades; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $unidad): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						           <tr>
                                    <td><center><?php echo e($unidad->id_unidad_asignatura); ?></center></td>
                                    <td><center><?php echo e($unidad->nombre); ?></center></td>
                                    <td><center><a onclick="buscar_ejes(<?php echo e($unidad->id_unidad_asignatura); ?>,'<?php echo e($unidad->nombre); ?>')" style="cursor: pointer;"><i class="fa fa-book"></i></a></center></td>
                                    <td>
                                        <center>
                                            <a title="Eliminar unidad" onclick="eliminarUnidad(<?php echo e($unidad->id_unidad_asignatura); ?>)" style="cursor: pointer;"><i class="fa fa-trash"></i></a>
                                        </center>
                                    </td>
		                            </tr> 
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>

             <div id="myModal" class="modal fade bd-example-modal-lg" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        
        <h4 class="modal-title" id="titulo_name_unidad"><b></b></h4>
      </div>
          <div class="modal-body">
            <div class="row">
    
        <div class="col-lg-7"><input id="input_eje" style="display: none" class="form-control" type="text" name="" placeholder="Nombre del eje tematico"></div>
        <div class="col-lg-2"><button id="btn_eje" style="display: none" onclick="agregar_eje()" class="btn btn-success">Agregar</button></div>
    <div class="col-lg-3"><button onclick="HabilitarOpcionAgregarEje()" class="btn btn-info pull-right">Nuevo eje tematico</button></div>
</div>
            <div class="form-group">                                     
                        <div class="card">
                                <center class="m-t-30">
                                  <table class="table">
                                    <thead>
                                        <tr>
                                            <th><center><b>Id</b></center></th>
                                            <th><center><b>Eje tematico</b></center></th>
                                            <th><center><b>Opciones</b></center></th>
                                        </tr>
                                    </thead>
                                    <style type="text/css"> 
                                        .fil td{
                                            color: black !important;
                                        }
                                    </style>
                                    <tbody id="bodytableEjes">

                                        
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

<script type="text/javascript" async src="https://tenor.com/embed.js"></script>
<script type="text/javascript">

    var id_unidad_escojida = ""
    function HabilitarOpcionAgregarUnidad(){
        $("#btn_unidad").fadeIn()
        $("#input_unidad").fadeIn()
    }
    function HabilitarOpcionAgregarEje(){
        $("#btn_eje").fadeIn()
        $("#input_eje").fadeIn()
    }

    function cargar_tabla_unidades() {
        $("#bodytableUnidades").html('<center><i>Actualizando...</i></center>')
        var url = '<?php echo e(route('asignatura/get_unidades', $asignatura->id_asignatura)); ?>'
        $.get(url, (response) => {
            $("#bodytableUnidades").html("")
            if(response){
                response.forEach((unidad)=>{
                    $("#bodytableUnidades").append("<tr>"+
                    "<td><center>"+unidad.id_unidad_asignatura+"</center></td>"+
                    "<td><center>"+unidad.nombre+"</center></td>"+
                    "<td><center><a onclick=\"buscar_ejes("+unidad.id_unidad_asignatura+",'"+unidad.nombre+"')\" style='cursor:pointer'><i class='fa fa-book'></i></a></center></td>"+
                    "<td>"+
                        "<center>"+
                            "<a title='Eliminar unidad' onclick=' eliminarUnidad("+unidad.id_unidad_asignatura+")' style='cursor:pointer'><i class='fa fa-trash'></i></a>"+
                        "</center>"+
                    "</td>"+
                    "</tr>")
                })
            }
        })
    }

    function cargar_tabla_ejes() {
        $("#bodytableEjes").html('<center><i>Cargando...</i></center>')
        var url = "../../seguimiento/getEjesTematicos/"+id_unidad_escojida
        $.get(url, (response) => {
            $("#bodytableEjes").html("")
            if(response){
                
                response.ejes_tematicos.forEach((eje)=>{
                    $("#bodytableEjes").append("<tr>"+
                    "<td><center>"+eje.id_eje_tematico+"</center></td>"+
                    "<td>"+eje.nombre+"</td>"+
                    "<td><center><a onclick=\"eliminarEje("+eje.id_eje_tematico+")\" style='cursor:pointer'><i class='fa fa-trash'></i></a></center></td>"+
                    
                    "</tr>")
                })
                
            }
        })
    }

    function eliminarUnidad(id_unidad) {
        var r = confirm("¿Seguro que desea eliminar esta unidad?");
        if (r == true) {
           var url = '../eliminar_unidad/'+id_unidad 
           $.blockUI({
                message: '<h1>Borrando Unidad</h1><i class="fa fa-spinner fa-spin fa-3x fa-fw">',
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
                if(response.error == false){
                   cargar_tabla_unidades()
                }else{
                    toastr.error(response.mensaje, 'Error', {timeOut: 10000})
                }
               
            })

           
        }
    }

    function agregar_unidad() {
        var url = '<?php echo e(route('asignatura/agregar_unidad')); ?>'
        var unidad = $("#input_unidad").val()
        var id_asignatura = '<?php echo e($asignatura->id_asignatura); ?>'   
        var token = document.getElementsByName("_token")[0].value
        var data = {
            'id_asignatura': id_asignatura,
            'unidad': unidad,
            '_token': token
        }
        $.blockUI({
            message: '<h1>Guardando Unidad</h1><i class="fa fa-spinner fa-spin fa-3x fa-fw">',
            css: {
                border: 'none',
                padding: '15px',
                backgroundColor: '#000',
                '-webkit-border-radius': '10px',
                '-moz-border-radius': '10px',
                opacity: .8,
                color: '#fff'
            }});
         $.post(url,data,function(result){
             $.unblockUI();
             if(result.error==false){
                cargar_tabla_unidades()
             }else{
                toastr.error(result.mensaje, 'Error', {timeOut: 3000})
             }
         })
    }

    function agregar_eje() {
        $("#bodytableEjes").html("<br><br><i>Registrando nuevo eje tematico...</i>")
        var url = '<?php echo e(route('asignatura/agregar_eje')); ?>'
        var eje = $("#input_eje").val()
        var token = document.getElementsByName("_token")[0].value
        var data = {
            'id_unidad': id_unidad_escojida,
            'eje': eje,
            '_token': token
        }
         $.post(url,data,function(result){
             if(result.error==false){
                cargar_tabla_ejes()
             }else{
                toastr.error(result.mensaje, 'Error', {timeOut: 3000})
             }
         })
    }

    function eliminarEje(id_eje) {
        var r = confirm("¿Seguro que desea eliminar este eje tematico?");
        if (r == true) {
             $("#bodytableEjes").html("<br><br><i>Borrando eje tematico...</i>")
           var url = '../eliminar_eje/'+id_eje
           $.get(url, (response) => {
                if(response.error == true){
                    toastr.error(response.mensaje, 'Error', {timeOut: 10000})
                }
                cargar_tabla_ejes()
               
            })

           
        }
    }

    function buscar_ejes(id_unidad, nombre_unidad) {
        $("#myModal").modal('show')
        $("#titulo_name_unidad").html("Ejes de <i>"+nombre_unidad+"</i>")
        id_unidad_escojida = id_unidad
        cargar_tabla_ejes(id_unidad)
        
    }
</script><?php /**PATH C:\xampp\htdocs\RepoUnicesar\resources\views/asignatura/listado_unidades.blade.php ENDPATH**/ ?>