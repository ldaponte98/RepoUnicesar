@extends('layouts.main_docente')
@section('header_content')
    <div class="row page-titles">
        <div class="col-md-6 col-8 align-self-center">
            <h3 class="text-themecolor m-b-0 m-t-0">Tabla</h3>
            <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Clases</a></li>
            <li class="hidden-sm-down breadcrumb-item active"> Información de la clase </li>
        </div>
        <div class="col-md-6 col-4 align-self-center">
        </div>
    </div>
@endsection
@section('content')
<div class="row">
    <div class="col-sm-4">
        <div class="card">
            <div class="card-block">
                <form class="form-horizontal form-material">
                    <div class="form-group mb-3">
                        <label class="col-md-12">
                          <b>Periodo Academico: </b>{{ $clase->grupo->periodo_academico->periodo }}
                        </label>
                    </div>
                    <div class="form-group mb-3">
                        <label class="col-md-12">
                          <b>Asignatura: </b>{{ $clase->grupo->asignatura->nombre }} ({{ $clase->grupo->asignatura->codigo }})</label>
                    </div>
                    <div class="form-group mb-3">
                        <label class="col-md-12"><b>Grupo: </b>{{ $clase->grupo->codigo }}</label>
                    </div> 
                    <div class="form-group mb-3">
                        <label class="col-md-12"><b>Fecha: </b>{{ date('Y-m-d', strtotime($clase->fecha_inicio)) }}</label>
                    </div>    
                    <div class="form-group mb-3">
                        <label class="col-md-12"><b>Hora inicio: </b>{{ date('H:i', strtotime($clase->fecha_inicio)) }}</label>
                    </div>   
                    <div class="form-group mb-3">
                        <label class="col-md-12"><b>Hora fin: </b>{{ date('H:i', strtotime($clase->fecha_fin)) }}</label>
                    </div>     
                    <div class="form-group mb-3">
                        <label class="col-md-12"><b>Tema(s): </b>{{ $clase->tema }}</label>
                    </div>    
                    <div class="form-group mb-3">
                        <label class="col-md-12"><b>Observaciones o nota: </b>{{ $clase->nota }}</label>
                    </div>
                </form>
                <br>
                <div class="row">
                  <div class="col-sm-6"><center><a href="{{ route('clases/gestion') }}?clase={{ $clase->id_clase }}" class="btn btn-primary w-100"> Editar </a></center></div>
                  <div class="col-sm-6"><center><a href="{{ route('clases/gestionar_asistencia', $clase->id_clase) }}" class="btn btn-info w-100"> Asistencia </a></center></div>
                </div>
            </div>
        </div>
    </div>
    <!-- Column -->

    <div class="col-sm-8">
        <div class="card">
            <div class="card-block">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                      <a class="nav-link tab_header active" 
                         id="asistencias-tab" 
                         data-toggle="tab" 
                         href="#asistencias" 
                         role="tab" 
                         aria-controls="asistencias"
                         aria-selected="true"><b>Toma de Asistencia</b></a>


                    </li>
                    <li class="nav-item">
                      <a class="nav-link tab_header" 
                         id="calificaciones-tab" 
                         data-toggle="tab" 
                         href="#calificaciones" 
                         role="tab"
                         aria-controls="calificaciones"
                         aria-selected="false"><b>Calificaciones</b></a>
                    </li>
                </ul>


                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" 
                         id="asistencias" 
                         role="tabpanel" 
                         aria-labelledby="asistencias-tab">
                         {{ view('clase.tab_asistencias', compact('clase')) }}            
                    </div>

                    <div class="tab-pane fade" 
                         id="calificaciones" 
                         role="tabpanel" 
                         aria-labelledby="calificaciones-tab">
                         {{ view('clase.tab_calificaciones', compact('clase')) }}              
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>              
@endsection