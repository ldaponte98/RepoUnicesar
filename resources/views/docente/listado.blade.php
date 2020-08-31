
@extends('layouts.main')

@section('header_content')

	<div class="row page-titles">
                    <div class="col-md-6 col-8 align-self-center">
                        <h3 class="text-themecolor m-b-0 m-t-0">Tabla</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Docentes</a></li>
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
            <h4 class="card-title">Docentes : Total ({{ count($docentes) }})</h4>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th><center><b><i class="fa fa-user"></i></b></center></th>
                            <th><b>Nombre</b></th>
                            <th><b>Cedula</b></th>
                            <th><b>Email</b></th>
                            <th><b>Tipo de vinculacion</b></th>
                        </tr>
                    </thead>
                    <style type="text/css"> 
                    	.fil td{
                    		color: black !important;
                    	}
                    </style>
                    <tbody id="bodytable">

                    	@foreach ($docentes as $docente)
                        
                    	  <tr class="fil" onclick="location.href = 'view/{{ $docente->id_tercero }}'">
                    		<td>
                    			<center>
                    			@php
                                	$imagen = 'assets/images/users/sin_foto.jpg';
                                	if ($docente->foto)$imagen = 'files/'.$docente->cedula.'/'.$docente->foto;
                                @endphp
                                <img src="{{ asset($imagen) }}" class="img-circle" width="35" height="35" />
                                </center>
                            </td>
                            <td>{{ $docente->nombre }} {{ $docente->apellido }}</td>
                            <td>{{ $docente->cedula }}</td>
                            <td>{{ $docente->email }}</td>
                            <td>{{ $docente->servicio }}</td>    
                            </tr>

                    	@endforeach
                    </tbody>
                </table>
                {{ $docentes->links() }}
            </div>
        </div>
    </div>
</div>
</div>

@endsection