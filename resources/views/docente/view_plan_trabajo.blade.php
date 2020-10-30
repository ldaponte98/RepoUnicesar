@extends('layouts.main')
@php
    $usuario = \App\Usuario::find(session('id_usuario'));
@endphp    
<style type="text/css">
    .search{
    line-height: inherit;
    height: 31px;
    background-color: #f2f7f8;
    border-left-color: transparent;
    border-right-color: transparent;
    border-top-color: transparent;
    border-bottom-color: #ddd;
    }
    .search:focus{
       border-bottom-color: black; 
       transition: 2.5s;
    }

    #segundofil{
        display: none;
    }
    #bodytablemiseguimiento tr:hover{
        background-color: #DAF7A6;
        color: black;
       
    }
</style>
@section('header_content')

<div class="row page-titles">
    <div class="col-md-6 col-8 align-self-center">
        <h3 class="text-themecolor m-b-0 m-t-0">Tabla</h3>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Docente</a></li>
            <li class="breadcrumb-item active">Planes de trabajo</li>
        </ol>
    </div>
</div>
@endsection
@section('menu')
    <div class="fab-container">
        <div class="fab fab-icon-holder">
            <i class="fa fa-bars"></i>
        </div>
        <ul class="fab-options">
            <li onclick="history.back(1)">
                <span class="fab-label">Volver</span>
                <div class="fab-icon-holder">
                    <i class="ti-arrow-left"></i>
                </div>
            </li>
        </ul>
    </div>
@endsection
@section('content')
<style type="text/css">
    .select2-container--default .select2-selection--single{
        font-size: 1.2em;  
    }
    
    .tab_header{
        color: black;
    }
</style>

<style type="text/css">
 .nav-item .active{
    color: blue !important;
 }
</style>
@if (isset($docente))


 <div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-block">  
                        
                @php
                $imagen = 'assets/images/users/sin_foto.jpg';
                if ($docente->foto)$imagen = 'files/'.$docente->cedula.'/'.$docente->foto;
                @endphp
                <a> <img id="" target="Ver imagen" src="{{ asset($imagen) }}" class="img-circle" width="50" height="50" /> <b> {{ strtoupper($docente->getNameFull()) }}</b></a> 
                <br>
                <h3>Planes de trabajo</h3>
                <br>
                <div class="table-responsive">
                   <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                          <a class="nav-link tab_header active" id="seg_pendientes-tab" data-toggle="tab" href="#seg_pendientes" role="tab" aria-controls="seg_pendientes"
                            aria-selected="true"><b>Pendientes</b></a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link tab_header" id="seg_enviados-tab" data-toggle="tab" href="#seg_enviados" role="tab" aria-controls="seg_enviados"
                            aria-selected="false"><b>Enviados (No leidos)</b></a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link tab_header" id="seg_recibidos-tab" data-toggle="tab" href="#seg_recibidos" role="tab" aria-controls="seg_recibidos"
                            aria-selected="false"><b>Recibidos (Leidos)</b></a>
                        </li>
                      </ul>
                      <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="seg_pendientes" role="tabpanel" aria-labelledby="seg_pendientes-tab">
                        {{ view('docente.listado_plan_trabajo_pendientes',compact('docente')) }}     
                                          
                        </div>
                        <div class="tab-pane fade" id="seg_enviados" role="tabpanel" aria-labelledby="seg_enviados-tab">
                        {{ view('docente.listado_plan_trabajo_enviados',compact('docente')) }}     
                        </div>
                        <div class="tab-pane fade" id="seg_recibidos" role="tabpanel" aria-labelledby="seg_recibidos-tab">
                        {{ view('docente.listado_plan_trabajo_recibidos',compact('docente')) }}     
                        </div>
                        
                      </div>
                </div>
                            
            </div>
        </div>
    </div>                
</div>
@endif
@endsection

