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

                    	@foreach ($asignatura->unidades as $unidad)
						           <tr>
                                    <td><center>{{ $unidad->id_unidad_asignatura }}</center></td>
                                    <td><center>{{ $unidad->nombre }}</center></td>
                                    <td><center><a onclick="buscar_ejes({{ $unidad->id_unidad_asignatura }},'{{ $unidad->nombre }}')" style="cursor: pointer;"><i class="fa fa-book"></i></a></center></td>
                                    <td>
                                        <center>
                                            <a title="Eliminar unidad" onclick="eliminarUnidad({{ $unidad->id_unidad_asignatura }})" style="cursor: pointer;"><i class="fa fa-trash"></i></a>
                                        </center>
                                    </td>
		                            </tr> 
						@endforeach
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
        <div class="col-lg-2"><button id="btn_eje" style="display: none" onclick="agregar_unidad()" class="btn btn-success">Agregar</button></div>
    <div class="col-lg-3"><button onclick="HabilitarOpcionAgregarEje()" class="btn btn-info pull-right">Nuevo Eje</button></div>
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
{{ csrf_field() }}
<script type="text/javascript" async src="https://tenor.com/embed.js"></script>
<script type="text/javascript">
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
        var url = '{{ route('asignatura/get_unidades', $asignatura->id_asignatura) }}'
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
        var url = '{{ route('asignatura/agregar_unidad') }}'
        var unidad = $("#input_unidad").val()
        var id_asignatura = '{{ $asignatura->id_asignatura}}'   
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

    function buscar_ejes(id_unidad, nombre_unidad) {
        $("#myModal").modal('show')
        $("#titulo_name_unidad").html("Ejes de <i>"+nombre_unidad+"</i>")
        
    }
</script>