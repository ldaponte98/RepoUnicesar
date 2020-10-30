<br>
<div class="row">
    <div class="col-lg-12"><input type="search" class="form-control" id="txtfiltrorecibidos" placeholder="Consulta por cualquier campo"></div>
</div>
<br>
<div class="table-responsive">
                <table class="table">
                    <thead>
                         <tr>
                            <th><center><b>ID</b></center></th>
                            <th><center><b>Periodo academico</b></center></th>
                            <th><center><b>Fecha de registro</b></center></th>
                            <th><center><b>Hora de registro</b></center></th>
                            <th><center><b>Progreso</b></center></th>
                        </tr>
                    </thead>
                    <style type="text/css"> 
                    	.fil td{
                    		color: black !important;
                    	}
                    </style>
                    <tbody id="bodytable">
                        @foreach ($docente->planes_trabajo('Recibido') as $plan_trabajo)
                        @php 
                            $plan_trabajo = (object) $plan_trabajo;
                        @endphp
					        <tr>
                                <td><center>{{ $plan_trabajo->id_plan_trabajo }}</center></td>
                                <td><center>{{ $plan_trabajo->periodo }}</center></td>
                                <td><center>{{ date('d/m/Y', strtotime($plan_trabajo->fecha)) }}</center></td>
                                <td><center>{{ date('H:i', strtotime($plan_trabajo->fecha)) }}</center></td>
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
                                 <td><center>
                                   <a target="_blank" href="{{ route('plan_trabajo/imprimir', $plan_trabajo->id_plan_trabajo) }}">Ver</a>
                                </center></td>     
	                        </tr> 
						@endforeach
                    </tbody>
                </table>
            </div>
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
            </script>
    