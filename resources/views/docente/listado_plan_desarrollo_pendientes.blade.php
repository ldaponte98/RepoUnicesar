@php
    $usuario = \App\Usuario::find(session('id_usuario'));
@endphp
<br>
<input type="search" class="form-control" id="desarrolloasignaturatxtfiltropendientes" placeholder="Consulta por cualquier campo">
<br>
<div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th><center><b>#</b></center></th>
                            <th><center><b>Asignatura</b></center></th>
                            <th><center><b>Periodo academico</b></center></th>
                            <th><center><b>Fecha de registro</b></center></th>
                            <th><center><b>Retraso</b></center></th>
                        </tr>
                    </thead>
                    <style type="text/css"> 
                    	.fil td{
                    		color: black !important;
                    	}
                    </style>
                    <tbody id="desarrolloasignaturabodytable">
                        @php 
                            $cont = 1; 
                        @endphp
                    	@foreach ($docente->planes_desarrollo_asignatura('Pendiente') as $plan_desarrollo)
                                @php 
                                    $plan_desarrollo = (object) $plan_desarrollo;
                                @endphp
						        <tr>
		                    		<td><center>{{ $cont }}</center></td>
                                    <td><center>{{ $plan_desarrollo->asignatura }}</center></td>
                                    <td><center>{{ $plan_desarrollo->periodo }}</center></td>
		                            <td><center>Sin enviar</center></td>
		                            <td><center>{{ $plan_desarrollo->retraso }}</center></td>
		                            <td>   
		                            @if($plan_desarrollo->retraso != "Fechas sin definir" and $plan_desarrollo->retraso != "En espera")
                                        <center>
                                            <a style="color: blue; cursor: pointer;" onclick="OpenModalNotificarRetraso({{ $plan_desarrollo->id_periodo }},'{{ $plan_desarrollo->periodo }}',{{ $plan_desarrollo->id_asignatura }},'{{ $plan_desarrollo->asignatura }}','{{ $plan_desarrollo->retraso }}')">Notificar retraso</a>
                                        </center>
                                    @endif
                                    </td>
                                    <td>
                                    @if ($plan_desarrollo->retraso != "Fechas sin definir" and $plan_desarrollo->retraso != "En espera")
                                        <center>
                                            @if($plan_desarrollo->retraso != "Tiene plazo-extra")
                                            <a style="color: blue; cursor: pointer;" onclick="OpenModalExtraPlazo({{ $plan_desarrollo->id_periodo }}, {{ $plan_desarrollo->id_asignatura }})">Extra plazo</a>
                                            @else
                                            <a style="color: blue; cursor: pointer;" onclick="OpenModalVerExtraPlazodesarrolloasignatura({{ $plan_desarrollo->id_plazo }})">Ver extra plazo</a>
                                            @endif
                                        </center>
                                    @endif
                                    </td>  
                                    
		                        </tr> 
                            @php 
                                $cont++; 
                            @endphp    
						@endforeach
                    </tbody>
                </table>
            </div>

            <div class="modal fade" id="desarrolloasignaturamodalNotificacion" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="desarrolloasignaturaexampleModalLongTitle">Notificar Retraso</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <!--Material textarea-->
                    <div class="md-form">
                      <label for="msg_notificacion">Mensaje de notificacion</label>
                      <textarea id="desarrolloasignaturamsg_notificacion" class="md-textarea form-control" rows="6"></textarea>
                    </div>

                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-primary" onclick="NotificarRetraso()">Enviar</button>
                  </div>
                </div>
              </div>
            </div>

            <div class="modal fade" id="desarrolloasignaturamodalExtraPlazo" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="desarrolloasignaturaexampleModalLongTitle">Plazo extra</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <!--Material textarea-->
                    <div class="md-form">
                      <input id="desarrolloasignaturaid_periodo_para_plazo" type="hidden" name="">
                      <input id="desarrolloasignaturaid_asignatura_para_plazo" type="hidden" name="">
                      <label >Lapso de fecha</label>
                      <input class="form-control hasDatepicker form-control-line" readonly="readonly" id="desarrolloasignaturalapso_de_plazo_extra" type="text" autocomplete="off">
                    </div>

                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-primary" onclick="DarExtraPlazo()">Dar extra plazo</button>
                  </div>
                </div>
              </div>
            </div>

            <div class="modal fade" id="desarrolloasignaturamodalVerExtraPlazo" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="desarrolloasignaturaexampleModalLongTitle">Plazo extra</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <!--Material textarea-->
                    <div class="md-form">
                      <input id="desarrolloasignaturaid_plazo_escojido" type="hidden" name="">
                      <label >Usuario que otorga</label>
                      <input class="form-control hasDatepicker form-control-line" readonly="readonly" id="desarrolloasignaturaplazo_tercero_otorga" type="text" autocomplete="off">
                      <br><br><label >Lapso de fecha</label>
                      <input class="form-control hasDatepicker form-control-line" readonly="readonly" id="desarrolloasignaturaplazo_fechas" type="text" autocomplete="off">
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-info" onclick="ActualizarPlazoExtradesarrolloasignatura()">Actualizar</button>
                    <button type="button" class="btn btn-warning" onclick="CancelarPlazoExtradesarrolloasignatura()">Cancelar plazo</button>
                  </div>
                </div>
              </div>
            </div>

            {{ Form::open(array('route' => array('notificacion/crear'), 'method' => 'post', 'id'=>'_form')) }}
            {{ Form::close() }}

    <script>
        $(document).ready(function(){
            $('#desarrolloasignaturalapso_de_plazo_extra').daterangepicker({
                      autoApply: true,
                      autoUpdateInput: true,
                      locale: {
                        format: 'DD/MM/YYYY',
                        cancelLabel: 'Clear'
                      }
            });
            $('#desarrolloasignaturaplazo_fechas').daterangepicker({
                      autoApply: true,
                      autoUpdateInput: true,
                      locale: {
                        format: 'DD/MM/YYYY',
                        cancelLabel: 'Clear'
                      }
            });
            $('#desarrolloasignaturatxtfiltropendientes').keyup(function () {
              var rex = new RegExp($(this).val(), 'i');
                $('#desarrolloasignaturabodytable tr').hide();
                $('#desarrolloasignaturabodytable tr').filter(function () {
                    return rex.test($(this).text());
                }).show();
            })
        })

        var id_periodo_escojido = 0
        var id_asignatura_escojida = 0
        var nombre_periodo_escojido = ""
        function OpenModalNotificarRetraso(id_periodo_academico,periodo_academico,id_asignatura, asignatura, retraso) {
            var mensaje = "El jefe de departamento te notifica que estas "+retraso+" en el plan de desarrollo de la asignatura "+asignatura+" del periodo academico "+periodo_academico+".";
            id_periodo_escojido = id_periodo_academico
            id_asignatura_escojida = id_asignatura
            nombre_periodo_escojido = periodo_academico
            $("#desarrolloasignaturamsg_notificacion").val(mensaje)
            $('#desarrolloasignaturamodalNotificacion').modal('show')
        }

        function OpenModalExtraPlazo(id_periodo_academico, id_asignatura) {
            $("#desarrolloasignaturaid_periodo_para_plazo").val(id_periodo_academico)
            $("#desarrolloasignaturaid_asignatura_para_plazo").val(id_asignatura)
            $('#desarrolloasignaturamodalExtraPlazo').modal('show')
        }

        function OpenModalVerExtraPlazodesarrolloasignatura(id_plazo) {
            let url = '/plazo_docente/buscar/'+id_plazo
            $("#desarrolloasignaturaid_plazo_escojido").val(id_plazo)
            $.get(url, (response)=>{
                if(response.error==false){
                    $("#desarrolloasignaturaplazo_tercero_otorga").val(response.data.tercero_otorga)
                    $('#desarrolloasignaturaplazo_fechas').data('daterangepicker').setStartDate(response.data.fecha_inicio)
                    $('#desarrolloasignaturaplazo_fechas').data('daterangepicker').setEndDate(response.data.fecha_fin)
                    $('#desarrolloasignaturamodalVerExtraPlazo').modal('show')
                }else{
                    toastr.error(response.message, 'Error', {timeOut: 3000})
                }
            }).fail((error)=>{
               toastr.error('Ocurrio un error al consultar la información del plazo extra', 'Error', {timeOut: 3000})
            })
           
        }

        function ActualizarPlazoExtradesarrolloasignatura() {
            r = confirm("¿Seguro que desea modificar la fecha de este plazo extra?")
            if(r == true){
                let id_plazo = $("#desarrolloasignaturaid_plazo_escojido").val()
                $('#desarrolloasignaturamodalVerExtraPlazo').modal('hide')
                var data_form = $("#_form").serialize()
                var url = '{{ route('plazo_docente/actualizar') }}'
                var fechas_plazo = $("#desarrolloasignaturaplazo_fechas").val();
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

        function CancelarPlazoExtradesarrolloasignatura() {
            r = confirm("¿Seguro que desea cancelar este plazo extra?")
            if(r == true){
                $('#desarrolloasignaturamodalVerExtraPlazo').modal('hide')
                let id_plazo = $("#desarrolloasignaturaid_plazo_escojido").val()
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

        function NotificarRetraso() {
            $('#desarrolloasignaturamodalNotificacion').modal('hide')
            var mensaje = $("#desarrolloasignaturamsg_notificacion").val()

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
                id_periodo_academico : id_periodo_escojido,
                id_asignatura : id_asignatura_escojida,
                periodo_academico : nombre_periodo_escojido,
                id_dominio_tipo_formato : {{ config('global.desarrollo_asignatura') }},
                _token : _token
            };
            $.blockUI({
                    message: '<h1>Notificando...</h1><i class="fa fa-spinner fa-spin fa-3x fa-fw">',
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
            });
        }

        function DarExtraPlazo() {
            $('#desarrolloasignaturamodalExtraPlazo').modal('hide')
            var data_form = $("#_form").serialize()
            var url = '{{ route('plazo_docente/registrar') }}'
            var id_periodo = $("#desarrolloasignaturaid_periodo_para_plazo").val();
            var id_asignatura = $("#desarrolloasignaturaid_asignatura_para_plazo").val();
            var fechas_plazo = $("#desarrolloasignaturalapso_de_plazo_extra").val();
            var token = data_form.split("&")[0].split("=")[1];
            var data = {
                '_token' : token,
                'id_tercero' : {{ $docente->id_tercero }},
                'id_periodo_academico' : id_periodo,
                'id_asignatura' : id_asignatura,
                'id_dominio_tipo_formato' : {{ config('global.desarrollo_asignatura') }},
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
                toastr.error("Ocurrio un error en el servidor", 'Error', {timeOut: 3000})
                 $.unblockUI();
            });
        }

    </script>

    