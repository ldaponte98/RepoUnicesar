<br>
<div class="row">
    <div class="col-lg-9"><input type="search" class="form-control" id="txtfiltroenviados" placeholder="Consulta por cualquier campo"></div>
    <div class="col-lg-3"><button onclick="MarcarLeidos()" class="btn btn-info pull-right">Marcar como leidos</button></div>
</div>
<br>
<div class="table-responsive">
                <table class="table">
                    <thead>
                         <tr>
                            <th><center><input type="checkbox" id="marcar_todos"/></center></th>
                            <th><center><b>Asignatura</b></center></th>
                            <th><center><b>Periodo academico</b></center></th>
                            <th><center><b>Fecha de registro</b></center></th>
                            <th><center><b>Hora de registro</b></center></th>
                        </tr>
                    </thead>
                    <style type="text/css"> 
                    	.fil td{
                    		color: black !important;
                    	}
                    </style>
                    <tbody id="bodytable">
                        @foreach ($docente->planes_desarrollo_asignatura('Enviado') as $plan_desarrollo)
                        @php 
                            $plan_desarrollo = (object) $plan_desarrollo;
                        @endphp
					        <tr>
                                <td><center><input type="checkbox" name="check_marcar" value="{{ $plan_desarrollo->id_plan_desarrollo_asignatura }}" /></center></td>
                                <td><center>{{ $plan_desarrollo->asignatura }}</center></td>
                                <td><center>{{ $plan_desarrollo->periodo }}</center></td>
                                <td><center>{{ date('d/m/Y', strtotime($plan_desarrollo->fecha)) }}</center></td>
                                <td><center>{{ date('H:i', strtotime($plan_desarrollo->fecha)) }}</center></td>
                                 <td><center>
                                   <a target="_blank" href="{{ route('plan_desarrollo_asignatura/imprimir', $plan_desarrollo->id_plan_desarrollo_asignatura) }}">Revisar</a>
                                </center></td>     
	                        </tr> 
						@endforeach
                    </tbody>
                </table>
            </div>
             {{ Form::open(array('route' => array('seguimiento/marcarComoLeido'), 'method' => 'post')) }}
            {{ Form::close() }}

            <script>
                $(document).ready(()=>{
                    $('#txtfiltroenviados').keyup(function () {
                      var rex = new RegExp($(this).val(), 'i');
                        $('#bodytable tr').hide();
                        $('#bodytable tr').filter(function () {
                            return rex.test($(this).text());
                        }).show();
                    })
                })
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
                    var planes = new Array()
                    var x = document.getElementsByName("check_marcar");
                    for (var i = 0; i < x.length; i++) {
                      if (x[i].type == "checkbox" && x[i].checked == true) {
                         planes.push(x[i].value);
                      }
                    }
                    if (planes.length == 0) {
                        alert("Por favor seleccione por lo menos un plan de desarrollo asignatura para marcar como leido")
                        return false
                    }

                    var r = confirm("¿Seguro que desea marcar los archivos seleccionados como leidos?");
                    if (r == true) {

                        var data = {
                            formatos : planes,
                            tipo_formato : {{ config('global.desarrollo_asignatura') }},
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

                        $.post("{{ route('tercero/marcarFormatosComoLeido') }}",data, function(response){
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
            </script>
    