@extends('layouts.main_docente')
@php
    $usuario = \App\Usuario::find(session('id_usuario'));
@endphp    
@section('header_content')
    <div class="row page-titles">
        <div class="col-md-12 col-12 align-self-center">
            <h3 class="text-themecolor m-b-0 m-t-0">Tabla</h3>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Actividades</a></li>
                <li class="breadcrumb-item active">Mis actividades</li>
            </ol>
        </div>
    </div>
    <style type="text/css">

        input[type="radio"] {
          display: none;
        }

        .start {
          color: grey;
          font-size: 26px;
        }

        .start-active {
          font-size: 26px;
          color: orange;
        }

        .clasificacion {
          direction: rtl;
          unicode-bidi: bidi-override;
          margin-bottom: 0px;
        }
    </style>
@endsection
@section('content')
<style type="text/css">
    .icon-rounded{
        background-color: #789A2F;
        color: #ffffff;
        text-align: center;
        padding: 15px;
        border-radius: 150px;
    }
</style>
<div class="row">
    <div class="col-sm-4">
        <div class="card">
            <div class="card-block">
                <div class="row">
                    @php
                        $clases_pendientes = $usuario->tercero->clases_pendientes(5);
                    @endphp
                    <div class="col-sm-12"><h4><b>Proximas clases</b></h4></div>
                    <div class="table-responsive mt-2">
                        <table class="table stylish-table v-middle no-wrap">
                            <tbody>
                                @if (count($clases_pendientes) == 0)
                                    <tr><td><center><b><i>No tienes clases pendientes</i></b></center></td></tr>
                                @endif
                                @foreach ($clases_pendientes as $clase)
                                    <tr onclick="location.href = '{{ route('clases/view', $clase->id_clase) }}'">
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="icon-rounded btn_tintilante">
                                                    <center><i data-feather="airplay" aria-hidden="true"></i></center>
                                                </div>
                                                <div class="ml-1">
                                                    <a href="javascript:void(0)" class="link fs-3 fw-normal d-block mb-1">{{ $clase->grupo->asignatura->nombre }}</a>
                                                    <small>Grupo {{ $clase->grupo->codigo }}</small><br>
                                                    <span class="badge mt-1 bg-light-warning text-warning fw-normal">
                                                        <b>
                                                        {{ date('d/m/Y', strtotime($clase->fecha_inicio)) }} de {{ date('H:i', strtotime($clase->fecha_inicio)) }} hasta {{ date('H:i', strtotime($clase->fecha_fin)) }}
                                                        </b>
                                                    </span>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex pull-right">
                                                <a href="{{ route('clases/view', $clase->id_clase) }}"><i data-feather="eye" aria-hidden="true"></i></a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="text-center">
                            <a class="btn btn-primary text-white" href="{{ route('clases/mis_clases_pendientes') }}"><b>Ver todas</b></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="card">
            <div class="card-block">
                <div class="row">
                    @php
                        $formatos_pendientes = $usuario->tercero->formatos_pendientes(5);
                        $color_plan_trabajo = "success";
                        $color_plan_desarrollo = "warning";
                        $color_seguimiento_asignatura = "info";
                        $color_actividades_complementarias = "danger";
                    @endphp
                    <div class="col-sm-12"><h4><b>Formatos pendientes</b></h4></div>
                    <div class="table-responsive mt-2">
                        <table class="table stylish-table mb-0 no-wrap v-middle">
                            <tbody>
                                @foreach ($formatos_pendientes as $formato)
                                    @php
                                        if ($formato->tipo == "plan_trabajo") $color = $color_plan_trabajo;
                                        if ($formato->tipo == "plan_desarrollo") $color = $color_plan_desarrollo;
                                        if ($formato->tipo == "seguimiento_asignatura") $color = $color_seguimiento_asignatura;
                                        if ($formato->tipo == "actividades_complementarias") $color = $color_actividades_complementarias;

                                        $letra = "D";
                                        if ($formato->tipo == "plan_trabajo") $letra = "PT";
                                        if ($formato->tipo == "plan_desarrollo") $letra = "PD";
                                        if ($formato->tipo == "seguimiento_asignatura") $letra = "SA";
                                        if ($formato->tipo == "actividades_complementarias") $letra = "AC";
                                    @endphp
                                    <tr style="cursor: pointer;" onclick="location.href = '{{ $formato->ruta }}'">
                                        <td style="width:50px;"><span class="round rounded-circle text-white d-inline-block text-white bg-{{ $color }}">{{ $letra }}</span></td>
                                        <td>
                                            <h6 class="font-weight-medium mb-0 nowrap">{{ $formato->titulo }}</h6>
                                            <small class="text-muted no-wrap">
                                                @php
                                                    echo $formato->subtitulo
                                                @endphp
                                            </small>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="card">
            <div class="card-block">
                <div class="row">
                    <div class="col-sm-12"><h4><b>Promedio calificacion de clases</b></h4></div>
                    <div class="col-sm-12">
                        <div class="row">
                            <div class="col-lg-12 col-xl-12 col-md-12">
                                <center>
                                    @php
                                        $calificacion = $usuario->tercero->get_calificacion_general();
                                    @endphp
                                    <span class="mt-5 display-3">{{ $calificacion }}</span><br>
                                    <b>Puntos</b>
                                    <p class="clasificacion">
                                        <input id="radio1" type="radio" name="estrellas" value="10">
                                        <label class="start {{$calificacion >= 95 ? "start-active" : ""}}" for="radio1">★</label>
                                        <input id="radio2" type="radio" name="estrellas" value="9">
                                        <label class="start {{$calificacion >= 85 ? "start-active" : ""}}" for="radio2">★</label>
                                        <input id="radio3" type="radio" name="estrellas" value="8">
                                        <label class="start {{$calificacion >= 75 ? "start-active" : ""}}" for="radio3">★</label>
                                        <input id="radio4" type="radio" name="estrellas" value="7">
                                        <label class="start {{$calificacion >= 65 ? "start-active" : ""}}" for="radio4">★</label>
                                        <input id="radio5" type="radio" name="estrellas" value="6">
                                        <label class="start {{$calificacion >= 55 ? "start-active" : ""}}" for="radio5">★</label>
                                        <input id="radio6" type="radio" name="estrellas" value="5">
                                        <label class="start {{$calificacion >= 45 ? "start-active" : ""}}" for="radio6">★</label>
                                        <input id="radio7" type="radio" name="estrellas" value="4">
                                        <label class="start {{$calificacion >= 35 ? "start-active" : ""}}" for="radio7">★</label>
                                        <input class="start" id="radio8" type="radio" name="estrellas" value="3">
                                        <label class="start {{$calificacion >= 25 ? "start-active" : ""}}" for="radio8">★</label>
                                        <input id="radio9" type="radio" name="estrellas" value="2">
                                        <label class="start {{$calificacion >= 15 ? "start-active" : ""}}" for="radio9">★</label>
                                        <input id="radio10" type="radio" name="estrellas" value="1">
                                        <label class="start {{$calificacion >= 5 ? "start-active" : ""}}" for="radio10">★</label>
                                    </p>
                                </center>  
                            </div>
                            <!-- Column -->
                            <div class="col-lg-12 col-xl-12 col-md-12 border-start pl-0">
                                <ul class="product-review list-inline p-4" style="display: grid;">
                                    <li class="py-3">
                                        <div class="d-flex align-items-center">
                                            <span class="text-muted display-5"><i class="mdi mdi-emoticon-cool"></i></span>
                                            <div class="dl ms-2 ml-2">
                                                <h3 class="card-title">Calificaciones positivas</h3>
                                                <h6 class="card-subtitle">{{ $usuario->tercero->total_calificaciones("positiva") }} calificaciones</h6>
                                            </div>
                                        </div>
                                        <div class="progress">
                                            <div class="progress-bar bg-success" role="progressbar" 
                                            style="width: {{ $usuario->tercero->porcentaje_calificaciones("positiva") }}%; height:6px;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </li>
                                    <li class="py-3">
                                        <div class="d-flex align-items-center">
                                            <span class="text-muted display-5"><i class="mdi mdi-emoticon-sad"></i></span>
                                            <div class="dl ms-2 ml-2">
                                                <h3 class="card-title text-nowrap">Calificaciones negativas</h3>
                                                <h6 class="card-subtitle">{{ $usuario->tercero->total_calificaciones("negativa") }} calificaciones</h6>
                                            </div>
                                        </div>
                                        <div class="progress">
                                            <div class="progress-bar bg-danger" role="progressbar" 
                                            style="width: {{ $usuario->tercero->porcentaje_calificaciones("negativa") }}%; height:6px;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </li>
                                    <li class="py-3">
                                        <div class="d-flex align-items-center">
                                            <span class="text-muted display-5"><i class="mdi mdi-emoticon-neutral"></i></span>
                                            <div class="dl ms-2 ml-2">
                                                <h3 class="card-title">Calificaciones neutrales</h3>
                                                <h6 class="card-subtitle">{{ $usuario->tercero->total_calificaciones("neutral") }} calificaciones</h6>
                                            </div>
                                        </div>
                                        <div class="progress">
                                            <div class="progress-bar bg-warning" role="progressbar" 
                                            style="width: {{ $usuario->tercero->porcentaje_calificaciones("neutral") }}%; height:6px;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </li>
                                </ul></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style type="text/css">
    .modal_info{
        border-radius: 20px !important;
        background: #fff !important;
    }
    .modal_info h3{
        color: #000 !important;
    }
</style>
<div class="modal fade" id="modal_plazos" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" >
        <div class="modal-content modal_info">
            <div class="modal-body">
                <center>
                    <h3><b>Tienes <strong>NUEVOS</strong> plazos extra aprobados</b></h3>
                    <img height="400" width="100%" src="{{ asset('/imagenes/plazos.gif') }}">
                    <button onclick="location.href = '{{ route('notificacion/mis_notificaciones') }}'" type="button" class="btn_tintilante" style="width: 50%; cursor: pointer;"><b>Revisar plazos</b></button>
                </center>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<script>
	$(document).ready(()=>{
		@php
                $plazos_extra = \App\PlazoDocente::where('id_tercero', session('id_tercero_usuario'))
                                                 ->where('estado', 1)
                                                 ->first();
        @endphp

        @if($plazos_extra)
            $("#modal_plazos").modal('show')
        @endif
	})
</script>
@endsection