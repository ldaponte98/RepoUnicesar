<br>
<div class="row">
    <div class="col-lg-12"><input type="search" class="form-control" id="txtfiltrorecibidos" placeholder="Consulta por cualquier campo"></div>
</div>
<br>
<div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th><center><b>Id</b></center></th>
                            <th><center><b>Periodo academico</b></center></th>
                            <th><center><b>Corte</b></center></th>
                            <th><center><b>Fecha de envio</b></center></th>
                            <th><center><b>Hora de envio</b></center></th>
                            <th><center><b>Progreso</b></center></th>
                        </tr>
                    </thead>
                    <style type="text/css"> 
                        .fil td{
                            color: black !important;
                        }
                    </style>
                    <tbody id="bodytable">
                        @foreach ($docente->actividades_complementarias('Recibido') as $actividad)
                        @php 
                            $actividad = (object) $actividad;
                        @endphp
                            <tr>
                                <td><center>{{ $actividad->id_actividad_complementaria }}</center></td>
                                    <td><center>{{ $actividad->periodo_academico }}</center></td>
                                    <td><center>{{ $actividad->corte }}</center></td>
                                    <td><center>{{ date('d/m/Y', strtotime($actividad->fecha)) }}</center></td>
                                    <td><center>{{ date('H:i', strtotime($actividad->fecha)) }}</center></td>
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
                                 <td><center>
                                   <a target="_blank" href="{{ route('actividades_complementarias/editar', $actividad->id_actividad_complementaria) }}">Ver</a>
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
                    $('#txtfiltrorecibidos').keyup(function () {
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

               
            </script>
    