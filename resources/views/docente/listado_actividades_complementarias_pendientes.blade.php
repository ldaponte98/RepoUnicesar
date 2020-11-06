@php
    $usuario = \App\Usuario::find(session('id_usuario'));
@endphp
<br>
<input type="search" class="form-control" id="actividadtxtfiltropendientes" placeholder="Consulta por cualquier campo">
<br>
<div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th><center><b>Id</b></center></th>
                            <th><center><b>Periodo academico</b></center></th>
                            <th><center><b>Corte</b></center></th>
                            <th><center><b>Fecha de envio</b></center></th>
                            <th><center><b>Retraso</b></center></th>
                            <th><center><b>Progreso</b></center></th>
                        </tr>
                    </thead>
                    <style type="text/css"> 
                    	.fil td{
                    		color: black !important;
                    	}
                    </style>
                    <tbody id="actividadbodytable">

                    	@foreach ($docente->actividades_complementarias('Pendiente') as $actividad)
                            @php
                                $actividad = (object) $actividad;
                            @endphp
						           <tr>
		                    		<td><center>{{ $actividad->id_actividad_complementaria }}</center></td>
		                            <td><center>{{ $actividad->periodo_academico }}</center></td>
		                            <td><center>{{ $actividad->corte }}</center></td>
		                            <td><center>{{ $actividad->fecha }}</center></td>
		                            <td><center>{{ $actividad->retraso }}</center></td>  
                                    <td><center>
                                    @php 
                                    $color = "";
                                    if($actividad->progreso >= 0 and $actividad->progreso <= 20) $color = "danger";
                                    if($actividad->progreso > 20 and $actividad->progreso <= 40) $color = "warning";
                                    if($actividad->progreso > 40 and $actividad->progreso <= 60) $color = "primary";
                                    if($actividad->progreso > 60 and $actividad->progreso <= 80) $color = "secundary";
                                    if($actividad->progreso > 80 and $actividad->progreso < 100) $color = "info";
                                    if($actividad->progreso == 100) $color = "success";
                                    @endphp 
                                    <span class='text-{{ $color }}'>{{ $actividad->progreso }}%</span>
                                    <div class='progress'>
                                        <div class='progress-bar bg-{{ $color }}' role='progressbar' style='width: {{ $actividad->progreso }}%; height: 6px;' aria-valuenow='25' aria-valuemin='0' aria-valuemax='100'></div>
                                    </div>
                                    
                                    

                                    </center></td>  
                                    

                                    <td>
                                        @if ($actividad->retraso != "Fechas sin definir" and $actividad->retraso != "En espera")
                                        <center>
                                            <a style="color: blue; cursor: pointer;" onclick="OpenModalNotificarRetrasoactividad({{ $actividad->id_actividad_complementaria }},'{{ $actividad->periodo_academico }}','{{ $actividad->corte }}','{{ $actividad->retraso }}')">Notificar retraso</a>
                                        </center>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($actividad->retraso != "Fechas sin definir" and $actividad->retraso != "En espera")
                                        
                                        <center>
                                            @if($actividad->retraso != "Tiene plazo-extra")
                                                <a style="color: blue; cursor: pointer;" onclick="OpenModalExtraPlazoactividad({{ $actividad->id_actividad_complementaria }})">Extra plazo</a>
                                            @else
                                                <a style="color: blue; cursor: pointer;" onclick="OpenModalVerExtraPlazoactividad({{ $actividad->id_plazo }})">Ver extra plazo</a>
                                            @endif
                                        </center>
                                    </td> 

		                            </tr> 
						        @endif
						@endforeach
                    </tbody>
                </table>
            </div>

            <div class="modal fade" id="actividadmodalNotificacion" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="actividadexampleModalLongTitle">Notificar Retraso</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <!--Material textarea-->
                    <div class="md-form">
                      <label for="msg_notificacion">Mensaje de notificacion</label>
                      <textarea id="actividadmsg_notificacion" class="md-textarea form-control" rows="6"></textarea>
                    </div>

                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-primary" onclick="NotificarRetrasoactividad()">Enviar</button>
                  </div>
                </div>
              </div>
            </div>

            <div class="modal fade" id="actividadmodalExtraPlazo" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="actividadexampleModalLongTitle">Plazo extra</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <!--Material textarea-->
                    <div class="md-form">
                      <input id="actividadid_actividad_para_plazo" type="hidden" name="">
                      <label >Lapso de fecha</label>
                      <input class="form-control hasDatepicker form-control-line" readonly="readonly" id="actividadlapso_de_plazo_extra" type="text" autocomplete="off">
                    </div>

                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-primary" onclick="DarExtraPlazoactividad()">Dar extra plazo</button>
                  </div>
                </div>
              </div>
            </div>

            <div class="modal fade" id="actividadmodalVerExtraPlazo" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="actividadexampleModalLongTitle">Plazo extra</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <!--Material textarea-->
                    <div class="md-form">
                      <input id="actividadid_plazo_escojido" type="hidden" name="">
                      <label >Usuario que otorga</label>
                      <input class="form-control hasDatepicker form-control-line" readonly="readonly" id="actividadplazo_tercero_otorga" type="text" autocomplete="off">
                      <br><br><label >Lapso de fecha</label>
                      <input class="form-control hasDatepicker form-control-line" readonly="readonly" id="actividadplazo_fechas" type="text" autocomplete="off">
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-info" onclick="ActualizarPlazoExtraactividad()">Actualizar</button>
                    <button type="button" class="btn btn-warning" onclick="CancelarPlazoExtraactividad()">Cancelar plazo</button>
                  </div>
                </div>
              </div>
            </div>

            {{ Form::open(array('route' => array('notificacion/crear'), 'method' => 'post', 'id'=>'_form')) }}
            {{ Form::close() }}

    <script>
        $(document).ready(function(){
            $('#actividadlapso_de_plazo_extra').daterangepicker({
                      autoApply: true,
                      autoUpdateInput: true,
                      locale: {
                        format: 'DD/MM/YYYY',
                        cancelLabel: 'Clear'
                      }
            });
            $('#actividadplazo_fechas').daterangepicker({
                      autoApply: true,
                      autoUpdateInput: true,
                      locale: {
                        format: 'DD/MM/YYYY',
                        cancelLabel: 'Clear'
                      }
            });
            $('#actividadtxtfiltropendientes').keyup(function () {
              var rex = new RegExp($(this).val(), 'i');
                $('#actividadbodytable tr').hide();
                $('#actividadbodytable tr').filter(function () {
                    return rex.test($(this).text());
                }).show();
            })
        })
       
        var id_actividad_escojida = 0
        function OpenModalNotificarRetrasoactividad(id_actividad,periodo_academico, corte, retraso) {
            var mensaje = "El jefe de departamento te notifica que estas "+retraso+" en la actividad complementaria del periodo academico "+periodo_academico+" con relacion al "+corte+" corte.";
            id_actividad_escojida = id_actividad
            $("#actividadmsg_notificacion").val(mensaje)
            $('#actividadmodalNotificacion').modal('show')
        }
        function OpenModalExtraPlazoactividad(id_actividad) {
            $("#actividadid_actividad_para_plazo").val(id_actividad)
            $('#actividadmodalExtraPlazo').modal('show')
        }

        function OpenModalVerExtraPlazoactividad(id_plazo) {
            let url = '/plazo_docente/buscar/'+id_plazo
            $("#actividadid_plazo_escojido").val(id_plazo)
            $.get(url, (response)=>{
                if(response.error==false){
                    $("#actividadplazo_tercero_otorga").val(response.data.tercero_otorga)
                    $('#actividadplazo_fechas').data('daterangepicker').setStartDate(response.data.fecha_inicio)
                    $('#actividadplazo_fechas').data('daterangepicker').setEndDate(response.data.fecha_fin)
                    $('#actividadmodalVerExtraPlazo').modal('show')
                }else{
                    toastr.error(response.message, 'Error', {timeOut: 3000})
                }
            }).fail((error)=>{
               toastr.error('Ocurrio un error al consultar la información del plazo extra', 'Error', {timeOut: 3000})
            })
           
        }

        function ActualizarPlazoExtraactividad() {
            r = confirm("¿Seguro que desea modificar la fecha de este plazo extra?")
            if(r == true){
                let id_plazo = $("#actividadid_plazo_escojido").val()
                $('#actividadmodalVerExtraPlazo').modal('hide')
                var data_form = $("#_form").serialize()
                var url = '{{ route('plazo_docente/actualizar') }}'
                var fechas_plazo = $("#actividadplazo_fechas").val();
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

        function CancelarPlazoExtraactividad() {
            r = confirm("¿Seguro que desea cancelar este plazo extra?")
            if(r == true){
                $('#actividadmodalVerExtraPlazo').modal('hide')
                let id_plazo = $("#actividadid_plazo_escojido").val()
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

        function NotificarRetrasoactividad() {
            $('#actividadmodalNotificacion').modal('hide')
            var mensaje = $("#actividadmsg_notificacion").val()

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
                id_formato : id_actividad_escojida,
                id_dominio_tipo_formato : {{ config('global.actividades_complementarias') }},
                _token : _token
            };
            $.blockUI({
            message: '<h1>Notificando retraso</h1><i class="fa fa-spinner fa-spin fa-3x fa-fw">',
            css: {
                border: 'none',
                padding: '15px',
                backgroundColor: '#000',
                '-webkit-border-radius': '10px',
                '-moz-border-radius': '10px',
                opacity: .8,
                color: '#fff'
            }});
            $.post("{{ route('notificacion/crear') }}",data, function(response){
               $.unblockUI();
               if (!response.error) toastr.success('Notificacion enviada exitosamente', 'Mensaje enviado', {timeOut: 3000}) 
               if (response.error) toastr.error('Ocurrio un error al enviar la notificacion', 'Mensaje no enviado', {timeOut: 3000})
            }).fail((error)=>{
                $.unblockUI();
                toastr.error('Ocurrio un error al cancelar del plazo extra', 'Error', {timeOut: 3000})
            })
        }

        function DarExtraPlazoactividad() {
            $('#actividadmodalExtraPlazo').modal('hide')
            var data_form = $("#_form").serialize()
            var url = '{{ route('plazo_docente/registrar') }}'
            var id_actividad = $("#actividadid_actividad_para_plazo").val();
            var fechas_plazo = $("#actividadlapso_de_plazo_extra").val();
            var token = data_form.split("&")[0].split("=")[1];
            var data = {
                '_token' : token,
                'id_tercero' : {{ $docente->id_tercero }},
                'id_formato' : id_actividad,
                'id_dominio_tipo_formato' : {{ config('global.actividades_complementarias') }},
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
            }).fail((error)=>{
                $.unblockUI();
                toastr.error('Ocurrio un error al registrar el plazo extra', 'Error', {timeOut: 3000})
            })
        }

    </script>

    