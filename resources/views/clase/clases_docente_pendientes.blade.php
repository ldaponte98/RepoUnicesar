@extends('layouts.main_docente')
@php
    $usuario = \App\Usuario::find(session('id_usuario'));
@endphp
@section('header_content')

    <div class="row page-titles">
        <div class="col-md-6 col-8 align-self-center">
            <h3 class="text-themecolor m-b-0 m-t-0">Tabla</h3>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Clases</a></li>
                <li class="hidden-sm-down breadcrumb-item active">@if(session('is_docente')) Mis clases pendientes @endif</li>
            </ol>
        </div>
        <div class="col-md-6 col-4 align-self-center">
        </div>
    </div>
@endsection
@section('content')

<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-block">
                <div class="row">
                    <div class="col-sm-8"></div>
                    <div class="col-sm-4 text-right">
                        <input type="text" class="form-control" id="txt-filter-clases-pendientes" placeholder="Consulta aqui">
                    </div>
                </div>
                <h4 class="card-title"><b>Clases pendientes</b></h4>
                <div class="table-responsive">
                    <table class="table" id="table-clases-pendientes">
                        <thead>
                            <tr>
                                <th><center><b>#</b></center></th>
                                <th><center><b>Periodo</center></b></th>
                                <th><center><b>Asignatura</center></b></th>
                                <th><center><b>Grupo</center></b></th>
                                <th><center><b>Clase</center></b></th>
                                <th><center><b>Fecha</center></b></th>
                                <th><center><b>Hora de inicio</center></b></th>
                                <th><center><b>Hora de fin</center></b></th>
                                <th><center><b>Nota</center></b></th>
                                <th><center><b>Opciones</center></b></th>
                            </tr>
                        </thead>
                        <style type="text/css"> 
                            .fil td{
                                color: black !important;
                            }
                        </style>
                        <tbody>
                            @php
                                $cont = 1;
                            @endphp
                            @foreach ($clases_pendientes as $clase)
                                <tr>
                                    <td><center>{{ $cont }}</center></td>
                                    <td><center>{{ $clase->grupo->periodo_academico->periodo }}</center></td>
                                    <td><center>
                                        {{ $clase->grupo->asignatura->nombre." - ".$clase->grupo->asignatura->codigo }}
                                    </center></td>
                                    <td><center>{{ $clase->grupo->codigo }}</center></td>
                                    <td><center>{{ $clase->tema }}</center></td>
                                    <td><center>{{ date('Y-m-d', strtotime($clase->fecha_inicio)) }}</center></td>
                                    <td><center>{{ date('H:i', strtotime($clase->fecha_inicio)) }}</center></td>
                                    <td><center>{{ date('H:i', strtotime($clase->fecha_fin)) }}</center></td>
                                    <td><center>{{ $clase->nota }}</center></td>
                                    <td><center>
                                        <a class="font-small" href="{{ route('clases/view', $clase->id_clase) }}">
                                            Detalles
                                        </a>
                                        &nbsp;&nbsp; 
                                        <a class="font-small" href="{{ route('clases/gestionar_asistencia', $clase->id_clase) }}">
                                        Asistencia
                                        </a>
                                    </center></td>
                                </tr>
                            @php
                                $cont++;
                            @endphp
                            @endforeach
                        </tbody>
                    </table>
                    <ul class="pagination" id="paginador"></ul>
                </div>
            </div>
        </div>
    </div>
</div>

@csrf
<script type="text/javascript">
    var tabla = null;
    $(document).ready(()=>{
        $('#table-clases-pendientes').pageMe({
            pagerSelector : '#paginador',
            showPrevNext : true,
            hidePageNumbers : false,
            perPage : 10
        });
        SetFilter("txt-filter-clases-pendientes", "table-clases-pendientes")
    })
</script>
@endsection