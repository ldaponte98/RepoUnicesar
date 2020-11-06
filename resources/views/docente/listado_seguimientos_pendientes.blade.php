@php
    $usuario = \App\Usuario::find(session('id_usuario'));
@endphp
<br>
<input type="search" class="form-control" id="seguimientotxtfiltropendientes" placeholder="Consulta por cualquier campo">
<br>
<div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th><center><b>Id</b></center></th>
                            <th><center><b>Asignatura</b></center></th>
                            <th><center><b>Grupo</b></center></th>
                            <th><center><b>Corte</b></center></th>
                            <th><center><b>Retraso</b></center></th>
                            <th><center><b>Periodo academico</b></center></th>
                        </tr>
                    </thead>
                    <style type="text/css"> 
                    	.fil td{
                    		color: black !important;
                    	}
                    </style>
                    <tbody id="seguimientobodytable">

                    	@foreach ($docente->seguimientos_asignatura as $seguimiento)
						        @if ($seguimiento->estado == 'Pendiente')
						           <tr>
		                    		<td><center>{{ $seguimiento->id_seguimiento }}</center></td>
		                            <td><center>{{ $seguimiento->asignatura->nombre }}</center></td>
		                            <td><center>{{ $seguimiento->grupo->codigo }}</center></td>
		                            <td><center>{{ $seguimiento->corte }}</center></td>
		                            <td><center>{{ $seguimiento->retraso() }}</center></td>    
		                            <td><center>
		                            	{{ $seguimiento->grupo->periodo_academico->periodo }}
		                            </center></td>
                                    

                                    <td>
                                        @if ($seguimiento->retraso() != "Fechas sin definir" and $seguimiento->retraso() != "En espera")
                                        <center>
                                            <a style="color: blue; cursor: pointer;" onclick="OpenModalNotificarRetrasoSeguimiento({{ $seguimiento->id_seguimiento }},'{{ $usuario->tercero->getNameFull() }}','{{ $seguimiento->retraso() }}','{{ $seguimiento->asignatura->nombre }}', '{{ $seguimiento->grupo->codigo }}',{{ $seguimiento->corte }}, '{{ $seguimiento->grupo->periodo_academico->periodo }}')">Notificar retraso</a>
                                        </center>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($seguimiento->retraso() != "Fechas sin definir" and $seguimiento->retraso() != "En espera")
                                        
                                        <center>
                                            @if($seguimiento->retraso() != "Tiene plazo-extra")
                                                <a style="color: blue; cursor: pointer;" onclick="OpenModalExtraPlazoSeguimiento({{ $seguimiento->id_seguimiento }})">Extra plazo</a>
                                            @else
                                                @php
                                                    $plazo_extra = \App\PlazoDocente::where('id_tercero', $seguimiento->id_tercero)
                                                                   ->where('id_formato', $seguimiento->id_seguimiento)
                                                                   ->where('id_dominio_tipo_formato', config('global.seguimiento_asignatura'))
                                                                   ->where('estado', 1)
                                                                   ->first();
                                                @endphp
                                                <a style="color: blue; cursor: pointer;" onclick="OpenModalVerExtraPlazoSeguimiento({{ $plazo_extra->id_plazo_docente }})">Ver extra plazo</a>
                                            @endif
                                        </center>
                                    @endif
                                    </td> 

		                            </tr> 
						        @endif
						@endforeach
                    </tbody>
                </table>
            </div>

            <div class="modal fade" id="seguimientomodalNotificacion" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="seguimientoexampleModalLongTitle">Notificar Retraso</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <!--Material textarea-->
                    <div class="md-form">
                      <label for="msg_notificacion">Mensaje de notificacion</label>
                      <textarea id="seguimientomsg_notificacion" class="md-textarea form-control" rows="6"></textarea>
                    </div>

                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-primary" onclick="NotificarRetrasoSeguimiento()">Enviar</button>
                  </div>
                </div>
              </div>
            </div>

            <div class="modal fade" id="seguimientomodalExtraPlazo" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="seguimientoexampleModalLongTitle">Plazo extra</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <!--Material textarea-->
                    <div class="md-form">
                      <input id="seguimientoid_seguimiento_para_plazo" type="hidden" name="">
                      <label >Lapso de fecha</label>
                      <input class="form-control hasDatepicker form-control-line" readonly="readonly" id="seguimientolapso_de_plazo_extra" type="text" autocomplete="off">
                    </div>

                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-primary" onclick="DarExtraPlazoSeguimiento()">Dar extra plazo</button>
                  </div>
                </div>
              </div>
            </div>

            <div class="modal fade" id="seguimientomodalVerExtraPlazo" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="seguimientoexampleModalLongTitle">Plazo extra</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <!--Material textarea-->
                    <div class="md-form">
                      <input id="seguimientoid_plazo_escojido" type="hidden" name="">
                      <label >Usuario que otorga</label>
                      <input class="form-control hasDatepicker form-control-line" readonly="readonly" id="seguimientoplazo_tercero_otorga" type="text" autocomplete="off">
                      <br><br><label >Lapso de fecha</label>
                      <input class="form-control hasDatepicker form-control-line" readonly="readonly" id="seguimientoplazo_fechas" type="text" autocomplete="off">
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-info" onclick="ActualizarPlazoExtraSeguimiento()">Actualizar</button>
                    <button type="button" class="btn btn-warning" onclick="CancelarPlazoExtraSeguimiento()">Cancelar plazo</button>
                  </div>
                </div>
              </div>
            </div>

            {{ Form::open(array('route' => array('notificacion/crear'), 'method' => 'post', 'id'=>'_form')) }}
            {{ Form::close() }}

    <script>
        $(document).ready(function(){
            $('#seguimientolapso_de_plazo_extra').daterangepicker({
                      autoApply: true,
                      autoUpdateInput: true,
                      locale: {
                        format: 'DD/MM/YYYY',
                        cancelLabel: 'Clear'
                      }
            });
            $('#seguimientoplazo_fechas').daterangepicker({
                      autoApply: true,
                      autoUpdateInput: true,
                      locale: {
                        format: 'DD/MM/YYYY',
                        cancelLabel: 'Clear'
                      }
            });
            $('#seguimientotxtfiltropendientes').keyup(function () {
              var rex = new RegExp($(this).val(), 'i');
                $('#seguimientobodytable tr').hide();
                $('#seguimientobodytable tr').filter(function () {
                    return rex.test($(this).text());
                }).show();
            })
        })
       
        var id_seguimiento_escojido = 0
        function OpenModalNotificarRetrasoSeguimiento(id_seguimiento,name_tercero_envia, retraso, asignatura, grupo,corte, periodo_academico) {
            var mensaje = "El administrador "+name_tercero_envia+" te notifica retraso de "+retraso+" en el seguimiento de asignatura con codigo "+id_seguimiento+ " con relacion a la asignatura "+asignatura+" para el grupo "+grupo+" perteneciente al "+corte+" corte del periodo academico "+periodo_academico+".";
            id_seguimiento_escojido = id_seguimiento
            $("#seguimientomsg_notificacion").val(mensaje)
            $('#seguimientomodalNotificacion').modal('show')
        }
        function OpenModalExtraPlazoSeguimiento(id_seguimiento) {
            $("#seguimientoid_seguimiento_para_plazo").val(id_seguimiento)
            $('#seguimientomodalExtraPlazo').modal('show')
        }

        function OpenModalVerExtraPlazoSeguimiento(id_plazo) {
            let url = '/plazo_docente/buscar/'+id_plazo
            $("#seguimientoid_plazo_escojido").val(id_plazo)
            $.get(url, (response)=>{
                if(response.error==false){
                    $("#seguimientoplazo_tercero_otorga").val(response.data.tercero_otorga)
                    $('#seguimientoplazo_fechas').data('daterangepicker').setStartDate(response.data.fecha_inicio)
                    $('#seguimientoplazo_fechas').data('daterangepicker').setEndDate(response.data.fecha_fin)
                    $('#seguimientomodalVerExtraPlazo').modal('show')
                }else{
                    toastr.error(response.message, 'Error', {timeOut: 3000})
                }
            }).fail((error)=>{
               toastr.error('Ocurrio un error al consultar la información del plazo extra', 'Error', {timeOut: 3000})
            })
           
        }

        function ActualizarPlazoExtraSeguimiento() {
            r = confirm("¿Seguro que desea modificar la fecha de este plazo extra?")
            if(r == true){
                let id_plazo = $("#seguimientoid_plazo_escojido").val()
                $('#seguimientomodalVerExtraPlazo').modal('hide')
                var data_form = $("#_form").serialize()
                var url = '{{ route('plazo_docente/actualizar') }}'
                var fechas_plazo = $("#seguimientoplazo_fechas").val();
                var token = data_form.split("&")[0].split("=")[1];
                var data = {
                    '_token' : token,
                    'id_plazo' : id_plazo,
                    'fechas_plazo' : fechas_plazo,
                }
                $.blockUI({
                            message: '<h1>Actualizando plazo </h1><i class="fa fa-spinner fa-spin fa-3x fa-fw">',
                            css: {
                                border: 'none',
                                padding: '15px',
                                backgroundColor: '#000',
                                '-webkit-border-radius': '10px',
                                '-moz-border-radius': '10px',
                                opacity: .8,
                                color: '#fff'
                            }});
                $.post(url, data, (response)=>{
                    $.unblockUI();
                    if(response.error==false){
                        toastr.success(response.mensaje, 'Proceso exitoso', {timeOut: 3000})
                        location.reload();
                    }else{
                    toastr.error(response.mensaje, 'Error', {timeOut: 3000})
                    }
                }).fail((error)=>{
                    toastr.error("Ocurrio un error en el servidor", 'Error', {timeOut: 3000})
                     $.unblockUI();
                });
            }
        }

        function CancelarPlazoExtraSeguimiento() {
            r = confirm("¿Seguro que desea cancelar este plazo extra?")
            if(r == true){
                $('#seguimientomodalVerExtraPlazo').modal('hide')
                let id_plazo = $("#seguimientoid_plazo_escojido").val()
                let url = '/plazo_docente/cancelar/'+id_plazo
                $.blockUI({
                    message: '<h1>Cancelando plazo </h1><i class="fa fa-spinner fa-spin fa-3x fa-fw">',
                    css: {
                        border: 'none',
                        padding: '15px',
                        backgroundColor: '#000',
                        '-webkit-border-radius': '10px',
                        '-moz-border-radius': '10px',
                        opacity: .8,
                        color: '#fff'
                    }});
                $.get(url, (response)=>{
                    $.unblockUI();
                    if(response.error==false){
                        toastr.success(response.mensaje, 'Proceso exitoso', {timeOut: 3000})
                        location.reload();
                    }else{
                        toastr.error(response.mensaje, 'Error', {timeOut: 3000})
                    }
                }).fail((error)=>{
                    $.unblockUI();
                   toastr.error('Ocurrio un error al cancelar del plazo extra', 'Error', {timeOut: 3000})
                })
            }
           
        }

        function NotificarRetrasoSeguimiento() {
            $('#seguimientomodalNotificacion').modal('hide')
            var mensaje = $("#seguimientomsg_notificacion").val()

            if (mensaje.lenght == 0) {
                alert("Debe llenar el campo requerido")
                return false
            }
            if (mensaje.lenght>500) {
                alert("Tamaño maximo de caracteres : 500")
                return false
            }
            var id_tercero_envia = '{{ $usuario->tercero->id_tercero }}'
            var id_tercero_recibe = '{{ $docente->id_tercero }}'
            var id_dominio_tipo = 9 //Es retraso
            var _token = document.getElementsByName('_token')[0].value;

            var data = {
                mensaje : mensaje,
                id_tercero_envia : id_tercero_envia,
                id_tercero_recibe : id_tercero_recibe,
                id_dominio_tipo : id_dominio_tipo,
                id_formato : id_seguimiento_escojido,
                id_dominio_tipo_formato : {{ config('global.seguimiento_asignatura') }},
                _token : _token
            };
            $.post("{{ route('notificacion/crear') }}",data, function(response){
               if (!response.error) toastr.success('Notificacion enviada exitosamente', 'Mensaje enviado', {timeOut: 3000}) 
               if (response.error) toastr.error('Ocurrio un error al enviar la notificacion', 'Mensaje no enviado', {timeOut: 3000})
            });
        }

        function DarExtraPlazoSeguimiento() {
            $('#seguimientomodalExtraPlazo').modal('hide')
            var data_form = $("#seguimiento_form").serialize()
            var url = '{{ route('plazo_docente/registrar') }}'
            var id_seguimiento = $("#seguimientoid_seguimiento_para_plazo").val();
            var fechas_plazo = $("#seguimientolapso_de_plazo_extra").val();
            var token = data_form.split("&")[0].split("=")[1];
            var data = {
                '_token' : token,
                'id_tercero' : {{ $docente->id_tercero }},
                'id_formato' : id_seguimiento,
                'id_dominio_tipo_formato' : {{ config('global.seguimiento_asignatura') }},
                'fechas_plazo' : fechas_plazo,
            }
            $.blockUI({
                        message: '<h1>Registrando plazo </h1><i class="fa fa-spinner fa-spin fa-3x fa-fw">',
                        css: {
                            border: 'none',
                            padding: '15px',
                            backgroundColor: '#000',
                            '-webkit-border-radius': '10px',
                            '-moz-border-radius': '10px',
                            opacity: .8,
                            color: '#fff'
                        }});
            $.post(url, data, (response)=>{
                $.unblockUI();
                if(response.error==false){
                    toastr.success(response.mensaje, 'Proceso exitoso', {timeOut: 3000})
                    location.reload();
                }else{
                toastr.error(response.mensaje, 'Error', {timeOut: 3000})
                }
            })
        }

    </script>

    