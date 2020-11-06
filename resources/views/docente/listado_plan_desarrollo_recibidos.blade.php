<br>
<div class="row">
    <div class="col-lg-12"><input type="search" class="form-control" id="txtfiltrorecibidos" placeholder="Consulta por cualquier campo"></div>
</div>
<br>
<div class="table-responsive">
                <table class="table">
                    <thead>
                         <tr>
                            <th><center>#</center></th>
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
                        @php
                            $cont = 1;
                        @endphp
                        @foreach ($docente->planes_desarrollo_asignatura('Recibido') as $plan_desarrollo)
                        @php 
                            $plan_desarrollo = (object) $plan_desarrollo;
                        @endphp
					        <tr>
                                <td><center>{{ $cont }}</center></td>
                                <td><center>{{ $plan_desarrollo->asignatura }}</center></td>
                                <td><center>{{ $plan_desarrollo->periodo }}</center></td>
                                <td><center>{{ date('d/m/Y', strtotime($plan_desarrollo->fecha)) }}</center></td>
                                <td><center>{{ date('H:i', strtotime($plan_desarrollo->fecha)) }}</center></td>
                                 <td><center>
                                   <a target="_blank" href="{{ route('plan_desarrollo_asignatura/imprimir', $plan_desarrollo->id_plan_desarrollo_asignatura) }}">Ver</a>
                                </center></td>     
	                        </tr> 
                        @php
                            $cont++;
                        @endphp
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
    