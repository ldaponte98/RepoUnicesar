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
                <li class="hidden-sm-down breadcrumb-item active">@if(session('is_docente')) Mis clases @endif</li>
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
                <div class="col-sm-4">
                    <div class="form-group">
                        @php
                            $periodos_academicos = \App\PeriodoAcademico::orderBy('id_periodo_academico', 'desc')->get();
                        @endphp
                    <label style="color: black;"><b>Periodo academico</b></label>
                    <select onchange="buscar_carga_academica(this.value)" class="form-control hasDatepicker form-control-line" id="id_periodo_academico" name="id_periodo_academico">
                        <option value="" disabled selected>Consultar por nombre</option>
                        @foreach ($periodos_academicos as $d)
                            <option value="{{ $d->id_periodo_academico }}">{{ $d->periodo }}</option>
                        @endforeach
                    </select>
                    <script type="text/javascript">
                        $(document).ready(function() {
                            $("#id_periodo_academico").select2({
                                width : '100%',
                            })
                        });
                    </script>
                  </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label style="color: black;"><b>Asignatura</b></label>
                        <select class="form-control hasDatepicker form-control-line" id="id_asignatura" name="id_asignatura">
                            <option value="" disabled selected>Consultar por nombre o codigo</option>
                        </select>
                        <script type="text/javascript">
                        $(document).ready(function() {
                            $("#id_asignatura").select2({
                                width : '100%',
                            })
                        });
                        </script>
                    </div>
                </div>
                <div class="col-sm-4">
                    <br>
                    <button type="submit" onclick="buscar_clases()" class="btn btn-info">Consultar</button>
                    <button type="submit" class="btn btn-success">Exportar Excel</button>
                </div>
            </div>
            <h4 class="card-title">Clases</h4>
            <div class="table-responsive">
                <table class="table" id="tabla">
                    <thead>
                        <tr>
                            <th><center><b>#</b></center></th>
                            <th><b>Clase</b></th>
                            <th><b>Fecha de creación</b></th>
                            <th><b>Hora de creación</b></th>
                            <th><b>Asistentes</b></th>
                            <th><b>Faltantes</b></th>
                            <th><b>Opciones</b></th>
                        </tr>
                    </thead>
                    <style type="text/css"> 
                        .fil td{
                            color: black !important;
                        }
                    </style>
                    <tbody id="bodytable">
                       
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
        $('#tabla').pageMe({pagerSelector:'#paginador',showPrevNext:true,hidePageNumbers:false,perPage:1});
    })
    function buscar_carga_academica(id_periodo){
        let url = "{{ config('global.url_base') }}/docente/buscar_asignaturas/"+id_periodo+"/{{ $usuario->id_tercero }}"
        $.get(url, (response) => {
            var asignaturas = "<option value='' disabled selected>Consultar por nombre o codigo</option>";
            response.asignaturas.forEach((asignatura) => {
                asignaturas += "<option value = '"+asignatura.id_asignatura+"' >"+asignatura.nombre+"</option>"
            })
            $("#id_asignatura").html(asignaturas)
        })
    }

    function buscar_clases() {
        let id_periodo_academico = $("#id_periodo_academico").val()
        let id_asignatura = $("#id_asignatura").val()
        let id_tercero = {{ $usuario->id_tercero }};
        if(!id_periodo_academico) { alert("Es necesario que suministre el periodo academico"); return false } 
        if(!id_asignatura) { alert("Es necesario que suministre la asignatura"); return false }
        
        let _token = ""
        $("[name='_token']").each(function() { _token = this.value })
        let url = '{{ route('clases/buscar_clases') }}'
        let request = {
            '_token' : _token,
            'id_periodo_academico' : id_periodo_academico,
            'id_asignatura' : id_asignatura,
            'id_tercero' : id_tercero,
        }
        $.blockUI({
            message: '<h1>Consultando clases</h1><i class="fa fa-spinner fa-spin fa-3x fa-fw">',
            css: {
                border: 'none',
                padding: '15px',
                backgroundColor: '#000',
                '-webkit-border-radius': '10px',
                '-moz-border-radius': '10px',
                opacity: .8,
                color: '#fff'
        }});
        $.post(url, request, (response) => {
            $.unblockUI();
            if(response.error == false){
                this.tabla = response.data
                this.actualizar_tabla()
            }else{ 
                toastr.error(response.mensaje, 'Error', {timeOut: 8000})
            }
        })
        .fail((error) => {
            $.unblockUI();
            toastr.error("Ha ocurrido en el servidor", 'Error', {timeOut: 8000})
        })

    }

    function actualizar_tabla() {
        let cont = 1
        let tabla_html = ""
        this.tabla.forEach((asistencia) => {
            tabla_html += '<tr>'+
                        '<td>'+cont+'</td>'+
                        '<td>'+asistencia.tema+'</td>'+
                        '<td>'+asistencia.fecha_creacion+'</td>'+
                        '<td>'+asistencia.hora_creacion+'</td>'+
                        '<td>'+asistencia.asistentes+'</td>'+
                        '<td>'+asistencia.inasistentes+'</td>'+
                        '<td>'+this.opciones_clase(asistencia.permiso_asistencia)+'</td>'+
                     '</tr>'
            cont++
        })
        $("#bodytable").html(tabla_html)
        $("#paginador").html("")
        $('#tabla').pageMe({pagerSelector:'#paginador',showPrevNext:true,hidePageNumbers:false,perPage:10});
    }

    function opciones_clase(permiso_asistencia) {
        let opciones = ""
        if(permiso_asistencia == 0){
            opciones += '<a class="font-small" href="#">Editar</a>&nbsp;&nbsp; <a class="font-small" href="#">Detalles</a>&nbsp;'
        }else{
            opciones += '<a class="font-small" href="#">Tomar asistencia</a>&nbsp;&nbsp; <a class="font-small" href="#">Detalles</a>&nbsp;'
        }
        return opciones
    }
</script>
@endsection