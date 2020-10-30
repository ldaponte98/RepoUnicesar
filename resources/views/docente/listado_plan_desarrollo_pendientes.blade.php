@php
    $usuario = \App\Usuario::find(session('id_usuario'));
@endphp
<br>
<input type="search" class="form-control" id="txtfiltropendientes" placeholder="Consulta por cualquier campo">
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
                    <tbody id="bodytable">
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
                                    @if ($plan_desarrollo->retraso != "Fechas sin definir" and $plan_desarrollo->retraso != "Tiene plazo-extra")
                                        <center>
                                            <a style="color: blue; cursor: pointer;" onclick="OpenModalExtraPlazo({{ $plan_desarrollo->id_periodo }}, {{ $plan_desarrollo->id_asignatura }})">Extra plazo</a>
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

            <div class="modal fade" id="modalNotificacion" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Notificar Retraso</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <!--Material textarea-->
                    <div class="md-form">
                      <label for="msg_notificacion">Mensaje de notificacion</label>
                      <textarea id="msg_notificacion" class="md-textarea form-control" rows="6"></textarea>
                    </div>

                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-primary" onclick="NotificarRetraso()">Enviar</button>
                  </div>
                </div>
              </div>
            </div>

            <div class="modal fade" id="modalExtraPlazo" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Plazo extra</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <!--Material textarea-->
                    <div class="md-form">
                      <input id="id_periodo_para_plazo" type="hidden" name="">
                      <input id="id_asignatura_para_plazo" type="hidden" name="">
                      <label >Lapso de fecha</label>
                      <input class="form-control hasDatepicker form-control-line" readonly="readonly" id="lapso_de_plazo_extra" type="text" autocomplete="off">
                    </div>

                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-primary" onclick="DarExtraPlazo()">Dar extra plazo</button>
                  </div>
                </div>
              </div>
            </div>

            {{ Form::open(array('route' => array('notificacion/crear'), 'method' => 'post', 'id'=>'_form')) }}
            {{ Form::close() }}

    <script>
        $(document).ready(function(){
            $('#lapso_de_plazo_extra').daterangepicker({
                      autoApply: true,
                      autoUpdateInput: true,
                      locale: {
                        format: 'DD/MM/YYYY',
                        cancelLabel: 'Clear'
                      }
            });
            $('#txtfiltropendientes').keyup(function () {
              var rex = new RegExp($(this).val(), 'i');
                $('#bodytable tr').hide();
                $('#bodytable tr').filter(function () {
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
            $("#msg_notificacion").val(mensaje)
            $('#modalNotificacion').modal('show')
        }

        function OpenModalExtraPlazo(id_periodo_academico, id_asignatura) {
            $("#id_periodo_para_plazo").val(id_periodo_academico)
            $("#id_asignatura_para_plazo").val(id_asignatura)
            $('#modalExtraPlazo').modal('show')
        }

        function NotificarRetraso() {
            $('#modalNotificacion').modal('hide')
            var mensaje = $("#msg_notificacion").val()

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
            $('#modalExtraPlazo').modal('hide')
            var data_form = $("#_form").serialize()
            var url = '{{ route('plazo_docente/registrar') }}'
            var id_periodo = $("#id_periodo_para_plazo").val();
            var id_asignatura = $("#id_asignatura_para_plazo").val();
            var fechas_plazo = $("#lapso_de_plazo_extra").val();
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

    