@php
    $usuario = \App\Usuario::find(session('id_usuario'));
@endphp
<br>
<input type="search" class="form-control" id="plantrabajotxtfiltropendientes" placeholder="Consulta por cualquier campo">
<br>
<div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th><center><b>#plantrabajo</b></center></th>
                            <th><center><b>Periodo academico</b></center></th>
                            <th><center><b>Fecha de registro</b></center></th>
                            <th><center><b>Retraso</b></center></th>
                            <th><center><b>Progreso</b></center></th>
                        </tr>
                    </thead>
                    <style type="text/css"> 
                    	.fil td{
                    		color: black !important;
                    	}
                    </style>
                    <tbody id="plantrabajobodytable">
                        @php 
                            $cont = 1; 
                        @endphp
                    	@foreach ($docente->planes_trabajo('Pendiente') as $plan_trabajo)
                                @php 
                                    $plan_trabajo = (object) $plan_trabajo;
                                @endphp
						        <tr>
		                    		<td><center>{{ $cont }}</center></td>
		                            <td><center>{{ $plan_trabajo->periodo }}</center></td>
		                            <td><center>Sin enviar</center></td>
		                            <td><center>{{ $plan_trabajo->retraso }}</center></td>
		                            <td><center>
                                    @php 
                                    $color = "";
                                    if($plan_trabajo->progreso >= 0 and $plan_trabajo->progreso <= 20) $color = "danger";
                                    if($plan_trabajo->progreso > 20 and $plan_trabajo->progreso <= 40) $color = "warning";
                                    if($plan_trabajo->progreso > 40 and $plan_trabajo->progreso <= 60) $color = "primary";
                                    if($plan_trabajo->progreso > 60 and $plan_trabajo->progreso <= 80) $color = "secundary";
                                    if($plan_trabajo->progreso > 80 and $plan_trabajo->progreso < 100) $color = "info";
                                    if($plan_trabajo->progreso == 100) $color = "success";
                                    @endphp 
                                    <span class='text-{{ $color }}'>{{ $plan_trabajo->progreso }}%</span>
                                    <div class='progress'>
                                        <div class='progress-bar bg-{{ $color }}' role='progressbar' style='width: {{ $plan_trabajo->progreso }}%; height: 6px;' aria-valuenow='25' aria-valuemin='0' aria-valuemax='100'></div>
                                    </div>
                                    
                                    

                                    </center></td>    
		                            
                                    <td>
                                    @if($plan_trabajo->retraso != "Fechas sin definir" and $plan_trabajo->retraso != "En espera")    
                                    <center>
                                        <a style="color: blue; cursor: pointer;" onclick="OpenModalNotificarRetrasoPlanTrabajoPlanTrabajo({{ $plan_trabajo->id_periodo }},'{{ $plan_trabajo->periodo }}','{{ $plan_trabajo->retraso }}')">Notificar retraso</a>
                                    </center>
                                    @endif
                                    </td>
                                    <td>
                                    @if ($plan_trabajo->retraso != "Fechas sin definir" and $plan_trabajo->retraso != "En espera")
                                        <center>
                                            @if($plan_trabajo->retraso != "Tiene plazo-extra")
                                            <a style="color: blue; cursor: pointer;" onclick="OpenModalExtraPlazoPlanTrabajo({{ $plan_trabajo->id_periodo }})">Extra plazo</a>
                                            @else
                                            <a style="color: blue; cursor: pointer;" onclick="OpenModalVerExtraPlazoPlanTrabajo({{ $plan_trabajo->id_plazo }})">Ver extra plazo</a>
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

            <div class="modal fade" id="plantrabajomodalNotificacion" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="plantrabajoexampleModalLongTitle">Notificar Retraso</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <!--Material textarea-->
                    <div class="md-form">
                      <label for="msg_notificacion">Mensaje de notificacion</label>
                      <textarea id="plantrabajomsg_notificacion" class="md-textarea form-control" rows="6"></textarea>
                    </div>

                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-primary" onclick="NotificarRetrasoPlanTrabajo()">Enviar</button>
                  </div>
                </div>
              </div>
            </div>

            <div class="modal fade" id="plantrabajomodalExtraPlazo" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="plantrabajoexampleModalLongTitle">Plazo extra</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <!--Material textarea-->
                    <div class="md-form">
                      <input id="plantrabajoid_periodo_para_plazo" type="hidden" name="">
                      <label >Lapso de fecha</label>
                      <input class="form-control hasDatepicker form-control-line" readonly="readonly" id="plantrabajolapso_de_plazo_extra" type="text" autocomplete="off">
                    </div>

                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-primary" onclick="DarExtraPlazoPlanTrabajo()">Dar extra plazo</button>
                  </div>
                </div>
              </div>
            </div>

            <div class="modal fade" id="plantrabajomodalVerExtraPlazo" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="plantrabajoexampleModalLongTitle">Plazo extra</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <!--Material textarea-->
                    <div class="md-form">
                      <input id="plantrabajoid_plazo_escojido" type="hidden" name="">
                      <label >Usuario que otorga</label>
                      <input class="form-control hasDatepicker form-control-line" readonly="readonly" id="plantrabajoplazo_tercero_otorga" type="text" autocomplete="off">
                      <br><br><label >Lapso de fecha</label>
                      <input class="form-control hasDatepicker form-control-line" readonly="readonly" id="plantrabajoplazo_fechas" type="text" autocomplete="off">
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-info" onclick="ActualizarPlazoExtraPlanTrabajo()">Actualizar</button>
                    <button type="button" class="btn btn-warning" onclick="CancelarPlazoExtraPlanTrabajo()">Cancelar plazo</button>
                  </div>
                </div>
              </div>
            </div>

            {{ Form::open(array('route' => array('notificacion/crear'), 'method' => 'post', 'id'=>'_form')) }}
            {{ Form::close() }}

    <script>
        $(document).ready(function(){
            $('#plantrabajolapso_de_plazo_extra').daterangepicker({
                      autoApply: true,
                      autoUpdateInput: true,
                      locale: {
                        format: 'DD/MM/YYYY',
                        cancelLabel: 'Clear'
                      }
            });
            $('#plantrabajoplazo_fechas').daterangepicker({
                      autoApply: true,
                      autoUpdateInput: true,
                      locale: {
                        format: 'DD/MM/YYYY',
                        cancelLabel: 'Clear'
                      }
            });
            $('#plantrabajotxtfiltropendientes').keyup(function () {
              var rex = new RegExp($(this).val(), 'i');
                $('#plantrabajobodytable tr').hide();
                $('#plantrabajobodytable tr').filter(function () {
                    return rex.test($(this).text());
                }).show();
            })
        })

        var id_periodo_escojido = 0
        var nombre_periodo_escojido = ""
        function OpenModalNotificarRetrasoPlanTrabajoPlanTrabajo(id_periodo_academico,periodo_academico, retraso) {
            var mensaje = "El jefe de departamento te notifica que estas "+retraso+" en el plan de trabajo del periodo academico "+periodo_academico+".";
            id_periodo_escojido = id_periodo_academico
            nombre_periodo_escojido = periodo_academico
            $("#plantrabajomsg_notificacion").val(mensaje)
            $('#plantrabajomodalNotificacion').modal('show')
        }

        function OpenModalExtraPlazoPlanTrabajo(id_periodo_academico) {
            $("#plantrabajoid_periodo_para_plazo").val(id_periodo_academico)
            $('#plantrabajomodalExtraPlazo').modal('show')
        }

        function OpenModalVerExtraPlazoPlanTrabajo(id_plazo) {
            let url = '/plazo_docente/buscar/'+id_plazo
            $("#plantrabajoid_plazo_escojido").val(id_plazo)
            $.get(url, (response)=>{
                if(response.error==false){
                    $("#plantrabajoplazo_tercero_otorga").val(response.data.tercero_otorga)
                    $('#plantrabajoplazo_fechas').data('daterangepicker').setStartDate(response.data.fecha_inicio)
                    $('#plantrabajoplazo_fechas').data('daterangepicker').setEndDate(response.data.fecha_fin)
                    $('#plantrabajomodalVerExtraPlazo').modal('show')
                }else{
                    toastr.error(response.message, 'Error', {timeOut: 3000})
                }
            }).fail((error)=>{
               toastr.error('Ocurrio un error al consultar la información del plazo extra', 'Error', {timeOut: 3000})
            })
           
        }

        function ActualizarPlazoExtraPlanTrabajo() {
            r = confirm("¿Seguro que desea modificar la fecha de este plazo extra?")
            if(r == true){
                let id_plazo = $("#plantrabajoid_plazo_escojido").val()
                $('#plantrabajomodalVerExtraPlazo').modal('hide')
                var data_form = $("#_form").serialize()
                var url = '{{ route('plazo_docente/actualizar') }}'
                var fechas_plazo = $("#plantrabajoplazo_fechas").val();
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
                                backgroundColor: '#plantrabajo000',
                                '-webkit-border-radius': '10px',
                                '-moz-border-radius': '10px',
                                opacity: .8,
                                color: '#plantrabajofff'
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

        function CancelarPlazoExtraPlanTrabajo() {
            r = confirm("¿Seguro que desea cancelar este plazo extra?")
            if(r == true){
                $('#plantrabajomodalVerExtraPlazo').modal('hide')
                let id_plazo = $("#plantrabajoid_plazo_escojido").val()
                let url = '/plazo_docente/cancelar/'+id_plazo
                $.blockUI({
                    message: '<h1>Cancelando plazo </h1><i class="fa fa-spinner fa-spin fa-3x fa-fw">',
                    css: {
                        border: 'none',
                        padding: '15px',
                        backgroundColor: '#plantrabajo000',
                        '-webkit-border-radius': '10px',
                        '-moz-border-radius': '10px',
                        opacity: .8,
                        color: '#plantrabajofff'
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


        function NotificarRetrasoPlanTrabajo() {
            $('#plantrabajomodalNotificacion').modal('hide')
            var mensaje = $("#plantrabajomsg_notificacion").val()

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
                id_dominio_tipo_formato : {{ config('global.plan_trabajo') }},
                _token : _token
            };
            $.blockUI({
                        message: '<h1>Notificando...</h1><i class="fa fa-spinner fa-spin fa-3x fa-fw">',
                        css: {
                            border: 'none',
                            padding: '15px',
                            backgroundColor: '#plantrabajo000',
                            '-webkit-border-radius': '10px',
                            '-moz-border-radius': '10px',
                            opacity: .8,
                            color: '#plantrabajofff'
                        }});
            $.post("{{ route('notificacion/crear') }}",data, function(response){
                $.unblockUI();
               if (!response.error) toastr.success('Notificacion enviada exitosamente', 'Mensaje enviado', {timeOut: 3000}) 
               if (response.error) toastr.error('Ocurrio un error al enviar la notificacion', 'Mensaje no enviado', {timeOut: 3000})
            }).fail((error)=>{
                 $.unblockUI();
            });
        }

        function DarExtraPlazoPlanTrabajo() {
            $('#plantrabajomodalExtraPlazo').modal('hide')
            var data_form = $("#plantrabajo_form").serialize()
            var url = '{{ route('plazo_docente/registrar') }}'
            var id_periodo = $("#plantrabajoid_periodo_para_plazo").val();
            var fechas_plazo = $("#plantrabajolapso_de_plazo_extra").val();
            var token = data_form.split("&")[0].split("=")[1];
            var data = {
                '_token' : token,
                'id_tercero' : {{ $docente->id_tercero }},
                'id_periodo_academico' : id_periodo,
                'id_dominio_tipo_formato' : {{ config('global.plan_trabajo') }},
                'fechas_plazo' : fechas_plazo,
            }
            $.blockUI({
                        message: '<h1>Registrando plazo </h1><i class="fa fa-spinner fa-spin fa-3x fa-fw">',
                        css: {
                            border: 'none',
                            padding: '15px',
                            backgroundColor: '#plantrabajo000',
                            '-webkit-border-radius': '10px',
                            '-moz-border-radius': '10px',
                            opacity: .8,
                            color: '#plantrabajofff'
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

    