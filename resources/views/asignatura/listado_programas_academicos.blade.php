<br>
<div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th><center><b>Id</b></center></th>
                            <th><center><b>Programa</b></center></th>
                            <th><center><b>Facultad</b></center></th>
                    </thead>
                    <style type="text/css"> 
                    	.fil td{
                    		color: black !important;
                    	}
                    </style>
                    <tbody id="bodytable">

                    	@foreach ($asignatura->asignatura_programa as $intersecto)
						           <tr>
                                    <td><center>{{ $intersecto->id_asignatura_programa }}</center></td>
                                    <td><center>{{ $intersecto->programa->nombre }}</center></td>
                                    <td><center>{{ $intersecto->programa->facultad->nombre }}</center></td>
		                            </tr> 
						@endforeach
                    </tbody>
                </table>
            </div>