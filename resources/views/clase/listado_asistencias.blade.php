<br>
<div class="row">
    <div class="col-sm-6"></div>
    <div class="col-sm-6 text-rigth">
        <input type="text" placeholder="Consulte aqui" class="form-control" id="txt-filtro-asistencias">
    </div>
</div>
<div class="table-responsive">
    <table class="table" id="table-asistencias">
        <thead>
            <tr>
                <th><center><b><i data-feather="user" aria-hidden="true"></i></b></center></th>
                <th><center><b>Alumno</b></center></th>
                <th><center><b>Asistio</b></center></th>
                <th><center><b>Motivo de excusa</b></center></th>
                <th><center><b>Soporte</b></center></th>
            </tr>
        </thead>
        <style type="text/css"> 
        	.fil td{
        		color: black !important;
        	}
        </style>
        <tbody>
            @foreach ($clase->asistencias as $asistencia)
                <tr>
                    <td>
                        <center>
                            <img src="{{ $asistencia->tercero->get_imagen() }}" class="img-circle" width="35" height="35" />
                        </center>
                    </td>
                    <td>
                        <center>
                            {{ $asistencia->tercero->getNameFull() }} - {{ $asistencia->tercero->cedula }}
                        </center>
                    </td>
                    <td>
                        <center>
                            {{ $asistencia->asistio == 1 ? "SI" : "NO"  }}
                        </center>
                    </td>
                    <td>
                        <center>
                            {{ $asistencia->motivo_excusa ? $asistencia->motivo_excusa : "Ninguna"  }}
                        </center>
                    </td>
                    <td>
                        <center>
                            {{ $asistencia->get_soporte() }}
                        </center>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
<script> SetFilter("txt-filtro-asistencias", "table-asistencias") </script>