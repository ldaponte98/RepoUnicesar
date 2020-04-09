<br>
<div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th><center><b>Id</b></center></th>
                            <th><center><b>Grupo</b></center></th>
                            <th><center><b>Docente Encargado</b></center></th>
                            <th><center><b>N° Estudiantes</b></center></th>
                            <th><center><b>Periodo academico</b></center></th>
                        </tr>
                    </thead>
                    <style type="text/css"> 
                    	.fil td{
                    		color: black !important;
                    	}
                    </style>
                    <tbody id="bodytable">

                    	@foreach ($asignatura->grupos as $grupo)
						           <tr>
                                    <td><center>{{ $grupo->id_grupo }}</center></td>
                                    <td><center>{{ $grupo->codigo }}</center></td>
                                    <td><center>{{ $grupo->tercero->getNameFull()}}</center></td>
                                    <td><center>{{ $grupo->num_est_ini }}</center></td>
                                    <td><center>{{ $grupo->periodo_academico->periodo }}</center></td>
                                    
		                            </tr> 
						@endforeach
                    </tbody>
                </table>
            </div>