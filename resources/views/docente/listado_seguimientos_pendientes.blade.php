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
                    <tbody id="bodytable">

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
                                        @if ($seguimiento->retraso() != "En espera")
                                        <center>
                                            <a style="color: blue; cursor: pointer;" onclick="OpenModalNotificarRetraso({{ $seguimiento->id_seguimiento }},'{{ $usuario->tercero->getNameFull() }}','{{ $seguimiento->retraso() }}','{{ $seguimiento->asignatura->nombre }}', '{{ $seguimiento->grupo->codigo }}',{{ $seguimiento->corte }}, '{{ $seguimiento->grupo->periodo_academico->periodo }}')">Notificar retraso</a>
                                        </center>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($seguimiento->retraso() != "Tiene plazo-extra" and $seguimiento->retraso() != "En espera")
                                        
                                        <center>

                                        <a style="color: blue; cursor: pointer;" onclick="OpenModalExtraPlazo({{ $seguimiento->id_seguimiento }})">Extra plazo</a>
                                    </center>
                                    @endif
                                    </td> 

		                            </tr> 
						        @endif
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
                      <input id="id_seguimiento_para_plazo" type="hidden" name="">
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
       
        var id_seguimiento_escojido = 0
        function OpenModalNotificarRetraso(id_seguimiento,name_tercero_envia, retraso, asignatura, grupo,corte, periodo_academico) {
            var mensaje = "El administrador "+name_tercero_envia+" te notifica retraso de "+retraso+" en el seguimiento de asignatura con codigo "+id_seguimiento+ " con relacion a la asignatura "+asignatura+" para el grupo "+grupo+" perteneciente al "+corte+" corte del periodo academico "+periodo_academico+".";
            id_seguimiento_escojido = id_seguimiento
            $("#msg_notificacion").val(mensaje)
            $('#modalNotificacion').modal('show')
        }
        function OpenModalExtraPlazo(id_seguimiento) {
            $("#id_seguimiento_para_plazo").val(id_seguimiento)
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
                id_formato : id_seguimiento_escojido,
                id_dominio_tipo_formato : {{ config('global.seguimiento_asignatura') }},
                _token : _token
            };
            $.post("{{ route('notificacion/crear') }}",data, function(response){
               if (!response.error) toastr.success('Notificacion enviada exitosamente', 'Mensaje enviado', {timeOut: 3000}) 
               if (response.error) toastr.error('Ocurrio un error al enviar la notificacion', 'Mensaje no enviado', {timeOut: 3000})
            });
        }

        function DarExtraPlazo() {
            $('#modalExtraPlazo').modal('hide')
            var data_form = $("#_form").serialize()
            var url = '{{ route('plazo_docente/registrar') }}'
            var id_seguimiento = $("#id_seguimiento_para_plazo").val();
            var fechas_plazo = $("#lapso_de_plazo_extra").val();
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

    