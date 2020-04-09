
@extends('layouts.main')

@section('header_content')

	<div class="row page-titles">
                    <div class="col-md-6 col-8 align-self-center">
                        <h3 class="text-themecolor m-b-0 m-t-0">Tabla</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Asignaturas</a></li>
                            <li class="hidden-sm-down breadcrumb-item active">Listado</li>
                        </ol>
                    </div>
                    <div class="col-md-6 col-4 align-self-center">
                        <br>
                        <input title="Consulta cualquier campo" id="txtfiltro" type="text" class="pull-right search" name="" placeholder="Consulta Aqui">
                 </div>
                    
    </div>
@endsection
@section('content')
<div class="row">
<div class="col-sm-12">
    <div class="card">
        <div class="card-block">
            <h4 class="card-title">Asignaturas : Total ({{ count($asignaturas) }})</h4>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th><center><b>Id</b></center></th>
                            <th><center><b>Codigo</b></center></th>
                            <th><center><b>Nombre</b></center></th>
                            <th><center><b>Credios</b></center></th>  
                        </tr>
                    </thead>
                    <style type="text/css"> 
                    	.fil td{
                    		color: black !important;
                    	}
                    </style>
                    <tbody id="bodytable">

                    	@foreach ($asignaturas as $asignatura)
                    	  <tr class="fil" onclick="location.href = 'view/{{ $asignatura->id_asignatura }}'">
                            <td>{{ $asignatura->id_asignatura }}</td>
                            <td>{{ $asignatura->codigo }}</td>
                            <td>{{ $asignatura->nombre }}</td>
                            <td><center>{{ $asignatura->num_creditos }}</center></td> 
                            </tr>

                    	@endforeach
                    </tbody>
                </table>
                {{ $asignaturas->links() }}
            </div>
        </div>
    </div>
</div>
</div>

@endsection