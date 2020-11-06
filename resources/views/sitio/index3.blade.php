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
</style>
<div class="modal fade" id="modal_bienvenida" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" >
            <div class="modal-content modal_info">
                <div class="modal-body">
                    <center>
                        <h3><b>Bienvenido <strong>{{ $usuario->tercero->nombre }}</strong></b></h3>
                        <p>Aqui podras evaluar las clases asistidas y seguir el orden del plan de desarrollo de cada una de las asignaturas que tienes asignada.</p>
                        <img height="400" width="100%" src="{{ asset('/imagenes/plazos.gif') }}">
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