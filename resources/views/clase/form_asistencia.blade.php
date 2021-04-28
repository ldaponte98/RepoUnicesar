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
        <li class="hidden-sm-down breadcrumb-item active"> Toma de Asistencia </li>
    </div>
</div>
@endsection
@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-block">
                <div class="row">
                    <div class="col-sm-12">
                        <h4><b>Clase #{{ $clase->id_clase }}</b></h4>
                        <label><b>
                            {{ $clase->grupo->asignatura->nombre }} ({{ $clase->grupo->asignatura->codigo }})</b> - Grupo {{ $clase->grupo->codigo }} </label><br>
                            <div class="d-flex">
                                <i data-feather="clock" class="mr-2" aria-hidden="true"></i> <label><b>Horario: </b>{{ date('d/m/Y', strtotime($clase->fecha_inicio)) }}  ({{ date('H:i', strtotime($clase->fecha_inicio)) }} - {{ date('H:i', strtotime($clase->fecha_fin)) }})</label>
                            </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    @foreach ($clase->alumnos() as $alumno)
    @php
        $asistio = "button-1"; $no_asistio = "button-2"; $tiene_excusa = false;
        if ($alumno->asistencia) {
            if ($alumno->asistencia->asistio == 1) {
                $asistio = "button-success";
            }else{
                if ($alumno->asistencia->excusa == 1) $tiene_excusa = true;
                $no_asistio = "button-danger";
            }
        }else{
            $no_asistio = "button-danger";
        }
    @endphp
    <div class="col-sm-6">
        <div class="_card" >
            <div class="container-img">
                <img src="{{ $alumno->tercero->get_imagen() }}">
            </div>
            <div class="content-event">
                <div class="name-event">
                    <h2>{{ $alumno->tercero->getNameFull() }}</h2>
                    <p>{{ $alumno->tercero->cedula }}</p>
                </div>
                <div class="options-buttons">
                    <button 
                            class="{{ $asistio }}" 
                            id="btn-asistio-{{ $alumno->id_tercero }}" 
                            onclick="Asistencia({{ $alumno->id_tercero }}, 1)"><i class="fa fa-check"></i> Asistio</button>

                    <button class="{{ $no_asistio }}" 
                            id="btn-no-asistio-{{ $alumno->id_tercero }}" 
                            onclick="Asistencia({{ $alumno->id_tercero }}, 0)">
                            <i class="fa fa-ban"></i> No Asistio</button>

                    <button @if ($asistio == "button-success") 
                            style="display: none;" 
                            @endif 
                            class="btn-info pull-right" 
                            id="btn-excusa-{{ $alumno->id_tercero }}" 
                            onclick="ModalExcusa({{ $alumno->id_tercero }})">
                            <i class="fa fa-heartbeat"></i> Excusa </button>
                </div>
            </div>
        </div>
    </div>
    @endforeach
    <div class="col-sm-12 text-center"><br>
        @php
            $fecha_actual = date('Y-m-d H:i:s');
            $fecha_actual_mas_15 = date('Y-m-d H:i:s', strtotime($clase->fecha_fin." +15 minutes"));
        @endphp
        @if ($fecha_actual >= $clase->fecha_inicio and $fecha_actual <= $fecha_actual_mas_15)
            <button class="btn btn-primary" onclick="GuardarAsistencia()">Guardar asistencia</button>
        @else
            <b><i>No se puede tomar la asitencia de esta clase debido a que no esta dentro del horario de la clase</i></b>
        @endif
    </div>
</div>

<div class="modal" id="modalExcusa" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Gestion de excusas</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label><b>*Motivo</b></label>
                            <input class="form-control" type="text" id="excusa-motivo">
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label><b>*Archivo de soporte</b> <small id="excusa-file-name"></small></label>
                            <input class="form-control" type="file" id="excusa-soporte">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary" onclick="GuardarExcusa()" id="btn-guardar-excusa">Guardar</button>
            </div>
        </div>
    </div>
</div>

<style type="text/css">
    @media (max-width: 600px) {
        .container-img img{
            width: 30% !important;
            border-radius: 50%;
            max-height: 90px !important;

        }
        ._card{
            display: block !important;
            padding-top: 20px !important;
            margin-bottom: 30px;
        }
        .container-img{
            padding: 0px 30px 0px 30px;
            width: 100% !important;
            display: flex  !important;
            justify-content: center !important;
            align-items: center !important;
            max-height: 90px !important;
        }

        .content-event {
            width: 100% !important;
            display: block;
            padding: 15px;
        }

        .options-buttons {
            justify-content: flex-start;
            text-align: center;
        }
        .name-event{
            text-align: center;
        }
        .name-event h2{
            margin-bottom: 0px;
        }
        .button-2{
            margin-right: 0px !important;
        }
    }

    .name-event h2{
        margin-bottom: 0px;
    }
    .name-event p{
        margin-bottom: 5px;
    }
    ._card{
        background: #fff;
        padding: 0px;
        display: flex;
        justify-content: center;
        align-items: center;
        flex: wrap;
    }
    .content-event{
        width: 80%;
        display: block;
        padding: 15px;
    }

    .options-buttons{
        justify-content: flex-start;
    }

    .options-buttons button{
        border-radius: 8px;
        padding: 8px 12px 8px 12px;
        font-size: 12px;
        font-weight: 600;
        margin-right: 15px; 
        cursor: pointer;
    }

    .options-buttons .button-1{
        border: 2px solid #97BB49;
        background: #fff;
        color: #97BB49;
    }

    .options-buttons .button-2{
        border: 2px solid #F62D51;
        background: #fff;
        color: #F62D51;
    }

    .button-success{
        border: 2px solid #97BB49;
        background-color: #97BB49;
        color: #fff;
    }

    .button-danger{
        border: 2px solid #F62D51;
        background-color: #F62D51;
        color:#fff;
    }

    .container-img{
        width: 20%;
    }
    .container-img img{
        width: 100%;
        height: auto;
        max-height: 170px;
    }

    ._card:hover{
        box-shadow: 0px 19px 20px 0px rgba(212,212,212,1);
        transform: scale(1.03);
        transition: all .4s;
    }
</style>          
@csrf
<script type="text/javascript">
    var alumnos = []
    var id_tercero_escojido = null
    function Asistencia(id_tercero, asistio) {
        let alumno = this.alumnos.find(item => item.id_tercero == id_tercero)
        alumno.asistio = asistio
        this.ActualizarAlumno(alumno)
    }

    function ModalExcusa(id_tercero) {
        let alumno = this.alumnos.find(item => item.id_tercero == id_tercero)
        this.id_tercero_escojido = id_tercero
        $("#modalExcusa").modal('show')
        $("#excusa-motivo").val(alumno.motivo_excusa)
        $("#excusa-soporte").val(null)
        $("#excusa-file-name").html(alumno.archivo_excusa)
    }

    function GuardarExcusa() {
        let alumno = this.alumnos.find(item => item.id_tercero == this.id_tercero_escojido)
        let posicion = this.alumnos.indexOf(alumno)
        let file = $("#excusa-soporte")[0].files[0]
        let motivo = $("#excusa-motivo").val()
        if(motivo.trim() == ""){ alert("El motivo de la excusa es obligatorio"); return false }
        if(!file && alumno.file_soporte == null && alumno.archivo_excusa == ""){ 
            alert("El archivo de soporte de la excusa es obligatorio");
            return false; 
        }
        alumno.excusa = 1
        alumno.motivo_excusa = motivo
        if(file){
            alumno.file_soporte = file 
            alumno.archivo_excusa = file.name
        }
        this.ActualizarAlumno(alumno)
        $("#modalExcusa").modal('hide')
    }

    function ActualizarAlumno(alumno) {
        let posicion = this.alumnos.findIndex(item => item.id_tercero == alumno.id_tercero)
        this.alumnos.splice(posicion, 1, alumno)
        if(alumno.asistio == 1){
            $('#btn-asistio-'+alumno.id_tercero).addClass("button-success");
            $('#btn-asistio-'+alumno.id_tercero).removeClass("button-1");
            $('#btn-no-asistio-'+alumno.id_tercero).addClass("button-2");
            $('#btn-no-asistio-'+alumno.id_tercero).removeClass("button-danger");
            $('#btn-excusa-'+alumno.id_tercero).fadeOut();
        }else{
            $('#btn-asistio-'+alumno.id_tercero).addClass("button-1");
            $('#btn-asistio-'+alumno.id_tercero).removeClass("button-success");
            $('#btn-no-asistio-'+alumno.id_tercero).addClass("button-danger");
            $('#btn-no-asistio-'+alumno.id_tercero).removeClass("button-2");
            $('#btn-excusa-'+alumno.id_tercero).fadeIn();
        }
    }

    function GuardarAsistencia() {
        let request = new FormData();
        let _token = $('input[name=_token]')[0].value
        request.append('_token', _token);
        request.append('id_clase', {{ $clase->id_clase }});
        request.append('asistencias', JSON.stringify(this.alumnos));
        this.alumnos.forEach((item) =>{
            if(item.asistio == 0 && item.excusa == 1 && item.file_soporte != null){
                request.append('file_excusa_' + item.id_tercero, item.file_soporte);
            }
        })
        Loading(true, "Guardando asistencia")
        $.ajax({
            url: "{{ url('clases/guardar_asistencia') }}",
            type: 'POST',
            data: request,
            dataType : "json",
            processData: false,
            contentType: false
        })      
        .done(function(response) {
            Loading(false)
            if(response.error == false){
                toastr.success(response.message)
                location.reload()
            }else{
                toastr.error(response.message, "Error")
            }
        }).fail(function() {
            Loading(false)
            toastr.error("Ocurrio un error", "Error")
            console.log("error");
        });
    }

    function CargarAlumnos() {
        @foreach ($clase->alumnos() as $alumno)
            @php $asistencia = $alumno->asistencia; @endphp
            this.alumnos.push({
                'id_tercero' : {{ $alumno->id_tercero }},
                'id_clase_asistencia' : {{ $asistencia ? $asistencia->id_clase_asistencia : "null" }},
                'asistio' : {{ $asistencia ? $asistencia->asistio : 0 }},
                'excusa' : {{ $asistencia ? $asistencia->excusa : 0 }},
                'motivo_excusa' : "{{ $asistencia ? ($asistencia->motivo_excusa ? $asistencia->motivo_excusa : "null") : "null" }}",
                'archivo_excusa' : "{{ $asistencia ? ($asistencia->archivo_excusa ? $asistencia->archivo_excusa : "null") : "null" }}",
                'file_soporte' : null
            })
        @endforeach
    }

    $(document).ready(()=>{
        CargarAlumnos()
    })


</script>
@endsection