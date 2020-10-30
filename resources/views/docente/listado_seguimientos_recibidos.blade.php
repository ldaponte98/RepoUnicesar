<br>
<input type="search" class="form-control" id="txtfiltrorecibidos" placeholder="Consulta por cualquier campo">
<br>
<div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th><center><b>Id</b></center></th>
                            <th><center><b>Asignatura</b></center></th>
                            <th><center><b>Grupo</b></center></th>
                            <th><center><b>Corte</b></center></th>
                            <th><center><b>Fecha de envio</b></center></th>
                            <th><center><b>Fecha de revision</b></center></th>
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
						        @if ($seguimiento->estado == 'Recibido')
						           <tr>
		                    		<td><center>{{ $seguimiento->id_seguimiento }}</center></td>
		                            <td><center>{{ $seguimiento->asignatura->nombre }}</center></td>
		                            <td><center>{{ $seguimiento->grupo->codigo }}</center></td>
		                            <td><center>{{ $seguimiento->corte }}</center></td>
                                    <td><center>{{ $seguimiento->fecha }}</center></td>    
                                    <td><center>{{ $seguimiento->updated_at }}</center></td>    
		                            <td><center>
		                            	{{ $seguimiento->grupo->periodo_academico->periodo }}
		                            </center></td>   
                                    <td><center>
                                        <a target="_blank" href="{{ route('seguimiento/view', $seguimiento->id_seguimiento) }}">Ver</a>
                                    </center></td> 
		                            </tr> 
						        @endif
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
    