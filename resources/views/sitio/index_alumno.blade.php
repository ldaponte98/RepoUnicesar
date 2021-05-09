@extends('layouts.main_alumno')
@php
   $usuario = \App\Usuario::find(session('id_usuario'));
@endphp
@section('content')
<style type="text/css">
    .modal_info{
        border-radius: 20px !important;
        background: #fff !important;
    }
    .modal_info h3{
        color: #000 !important;
    }
    
    @media(max-width: 767px){
        .img-panel{
            height: 300px !important;
            width : 100% !important;
        }
    }
</style>

<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-block">
                <center>
                    <h3><b>Bienvenido <strong>{{ $usuario->tercero->nombre }}</strong></b></h3>
                        <p>Aqui podras evaluar las clases asistidas y seguir el orden del plan de desarrollo de cada una de las asignaturas que tienes asignada.</p>
                    <img class="img-panel" src="{{ asset('Imagenes/peoples.gif') }}">
                </center>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modal_bienvenida" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" >
            <div class="modal-content modal_info">
                <div class="modal-body">
                    <center>
                        <h3><b>Bienvenido <strong>{{ $usuario->tercero->nombre }}</strong></b></h3>
                        <p>Aqui podras evaluar las clases asistidas y seguir el orden del plan de desarrollo de cada una de las asignaturas que tienes asignada.</p>
                        <img class="img-panel"  src="{{ asset('/imagenes/plazos.gif') }}">
                    </center>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
</div>

<script>
	$(document).ready(()=>{
        @if(session('bienvenida'))
            $("#modal_bienvenida").modal('show')
        @endif
	})
</script>
@endsection