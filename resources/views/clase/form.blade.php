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
                <li class="hidden-sm-down breadcrumb-item active"> Gestion de clases </li>
        </div>
        <div class="col-md-6 col-4 align-self-center">
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/clockpicker/0.0.7/jquery-clockpicker.min.js" integrity="sha512-x0qixPCOQbS3xAQw8BL9qjhAh185N7JSw39hzE/ff71BXg7P1fkynTqcLYMlNmwRDtgdoYgURIvos+NJ6g0rNg==" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/clockpicker/0.0.7/bootstrap-clockpicker.css" integrity="sha512-BB0bszal4NXOgRP9MYCyVA0NNK2k1Rhr+8klY17rj4OhwTmqdPUQibKUDeHesYtXl7Ma2+tqC6c7FzYuHhw94g==" crossorigin="anonymous" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/clockpicker/0.0.7/bootstrap-clockpicker.js" integrity="sha512-1QoWYDbO//G0JPa2VnQ3WrXtcgOGGCtdpt5y9riMW4NCCRBKQ4bs/XSKJAUSLIIcHmvUdKCXmQGxh37CQ8rtZQ==" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/clockpicker/0.0.7/bootstrap-clockpicker.min.css" integrity="sha512-MT4B7BDQpIoW1D7HNPZNMhCD2G6CDXia4tjCdgqQLyq2a9uQnLPLgMNbdPY7g6di3hHjAI8NGVqhstenYrzY1Q==" crossorigin="anonymous" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/clockpicker/0.0.7/bootstrap-clockpicker.min.js" integrity="sha512-x0qixPCOQbS3xAQw8BL9qjhAh185N7JSw39hzE/ff71BXg7P1fkynTqcLYMlNmwRDtgdoYgURIvos+NJ6g0rNg==" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/clockpicker/0.0.7/jquery-clockpicker.css" integrity="sha512-k3sfG0D5NC+/EroxANHxPp+kChaxufWyOToUFLo5fOpOPAFkLQbyqHSvsHOX9CLR9m5ZeZgEKs4h7GuDOrqmAg==" crossorigin="anonymous" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/clockpicker/0.0.7/jquery-clockpicker.js" integrity="sha512-1QoWYDbO//G0JPa2VnQ3WrXtcgOGGCtdpt5y9riMW4NCCRBKQ4bs/XSKJAUSLIIcHmvUdKCXmQGxh37CQ8rtZQ==" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/clockpicker/0.0.7/jquery-clockpicker.min.css" integrity="sha512-Dh9t60z8OKsbnVsKAY3RcL2otV6FZ8fbZjBrFENxFK5H088Cdf0UVQaPoZd/E0QIccxqRxaSakNlmONJfiDX3g==" crossorigin="anonymous" />
@endsection
@section('content')
<form id="form-clase" method="POST">
    @csrf
    @php
        $disabled = $clase->id_clase ? "disabled" : "";
    @endphp
<div class="row">
<div class="col-sm-12">
    <div class="card">
        <div class="card-block">
            <div class="row">
                <div class="col-sm-3">
                    <div class="form-group">
                        @php
                            $periodos_academicos = \App\PeriodoAcademico::orderBy('id_periodo_academico', 'desc')->get();
                        @endphp
                    <label style="color: black;"><b>* Periodo academico</b></label>
                    <select onchange="buscar_carga_academica(this.value)" class="form-control hasDatepicker form-control-line" id="id_periodo_academico" {{ $disabled }} name="id_periodo_academico" required>
                        @foreach ($periodos_academicos as $d)
                            <option @if($grupo->id_periodo_academico == $d->id_periodo_academico) selected @endif value="{{ $d->id_periodo_academico }}">{{ $d->periodo }}</option>
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
                <div class="col-sm-3">
                    <div class="form-group">
                        <label style="color: black;"><b>* Asignatura</b></label>
                        <select onchange="buscar_grupos(this.value)" {{ $disabled }} class="form-control hasDatepicker form-control-line" id="id_asignatura" name="id_asignatura" required>
                            @if ($grupo->id_asignatura)
                                <option value="{{ $grupo->id_asignatura }}" {{ $disabled }} selected>{{ $grupo->asignatura->nombre }}</option>
                            @else
                                <option value="" disabled selected>Consultar por nombre o codigo</option>
                            @endif
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
                <div class="col-sm-3">
                    <div class="form-group">
                        <label style="color: black;"><b>* Grupo</b></label>
                        <select onclick="buscar_estudiantes(this.value)" {{ $disabled }} class="form-control hasDatepicker form-control-line" id="id_grupo" name="id_grupo" required>
                            @if ($grupo->id_grupo)
                                <option value="{{ $grupo->id_grupo }}" {{ $disabled }} selected>{{ $grupo->codigo }}</option>
                            @else
                                <option value="" disabled selected>Consultar por nombre</option>
                            @endif
                        </select>
                        <script type="text/javascript">
                        $(document).ready(function() {
                            $("#id_grupo").select2({
                                width : '100%',
                            })
                        });
                        </script>
                    </div>
                </div>

                <div class="col-sm-3">
                    <div class="form-group">
                        <label style="color: black;"><b>* Fecha clase</b></label>
                        <input type="text" readonly class="form-control hasDatepicker form-control-line"  name="fecha" id="fecha_clase" required value="{{ date('Y-m-d', strtotime($clase->fecha_inicio)) }}">
                        <script type="text/javascript">
                        $(document).ready(function() {
                            $('#fecha_clase').datepicker({
                                format: "yyyy-mm-dd",
                                language: "es",
                                autoclose: true
                            });
                        });
                        </script>
                    </div>
                </div>

            </div>
            <div class="row">
                <div class="col-sm-3">
                    <div class="form-group">
                        <label style="color: black;"><b>* Hora inicio</b></label>
                        <div class="input-group clockpicker " data-autoclose="true">
                            <span class="input-group-addon">
                            <i data-feather="clock" style="font-size: 12px;" aria-hidden="true"></i>
                            </span>
                            <input  type="text" required name="hora_inicio" id="hora_inicio" autocomplete="off" class="form-control" value="{{ date('H:i', strtotime($clase->fecha_inicio)) }}"/>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label style="color: black;"><b>* Hora fin</b></label>
                        <div class="input-group clockpicker " data-autoclose="true">
                            <span class="input-group-addon">
                            <i data-feather="clock" style="font-size: 12px;" aria-hidden="true"></i>
                            </span>
                            <input type="text" name="hora_fin" id="hora_fin" autocomplete="off" class="form-control" value="{{ date('H:i', strtotime($clase->fecha_fin)) }}" />
                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                   <div class="form-group">
                        <label style="color: black;"><b>* Tema(s)</b></label>
                        <input class="form-control" list="list_temas" id="tema" name="tema" value="{{ $clase->tema }}" required>
                        <datalist id="list_temas"></datalist>
                    </div>
                </div>
                <div class="col-sm-3">
                   <div class="form-group">
                        <label style="color: black;"><b>Observaciones o nota</b></label>
                        <input class="form-control" type="text" name="nota" value="{{ $clase->nota }}" />
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4"></div>
                <div class="col-sm-4"><button type="submit" class="btn btn-primary w-100">Guardar cambios</button></div>
            </div>
        </div>
    </div>
</div>
</div> 
</form>               

<script type="text/javascript">

    var tabla = null;
    $(document).ready(()=>{
        $('.clockpicker').clockpicker();
        this.buscar_carga_academica({{ $grupo->id_periodo_academico }})
        $('#tabla').pageMe({pagerSelector:'#paginador',showPrevNext:true,hidePageNumbers:false,perPage:1});
    })

    

    function buscar_carga_academica(id_periodo){
        let url = "{{ config('global.url_base') }}/docente/buscar_asignaturas/"+id_periodo+"/{{ $usuario->id_tercero }}"
        $.get(url, (response) => {
            var asignaturas = '<option value="" disabled selected>Consultar por nombre o codigo</option>';
            response.asignaturas.forEach((asignatura) => {
                let id_asignatura_antiguo = "{{ $grupo->id_asignatura }}"
                let selected = ""
                if(id_asignatura_antiguo == asignatura.id_asignatura) selected = "selected"
                asignaturas += "<option value = '"+asignatura.id_asignatura+"' "+selected+">"+asignatura.nombre+"</option>"
            })
            $("#id_asignatura").html(asignaturas)
            var grupos = "<option value='' disabled selected>Consultar por nombre</option>"
            $("#id_grupo").html(grupos)
            $("#list_temas").html("")
            @if ($grupo->id_asignatura)
                buscar_grupos({{ $grupo->id_asignatura }})
            @endif
        })
    }

    function buscar_grupos(id_asignatura) {
        let id_periodo = $("#id_periodo_academico").val()
        if(id_periodo == "" || id_periodo == null){ alert("Es necesario establecer el periodo academico para el filtrado."); return false }
        
        var ruta = "{{ config('global.url_base') }}/asignatura/buscar_grupos_docente/"+id_asignatura+"/{{ $usuario->id_tercero }}/"+id_periodo
        var grupos = '<option value="" disabled selected>Consultar por nombre</option>'
        $.get(ruta, function(response) {
            response.forEach(function(grupo){
                let id_grupo_antiguo = "{{ $grupo->id_grupo }}"
                let selected = ""
                if(id_grupo_antiguo == grupo.id_grupo) selected = "selected"
                grupos += '<option value="'+grupo.id_grupo+'" '+selected+'>'+grupo.codigo+'</option>'
            })
            $("#id_grupo").html(grupos)
            buscar_temas()
        })
    }

    function buscar_temas() {
        $("#list_temas").html("")
        let id_periodo_academico = $("#id_periodo_academico").val()
        let id_asignatura = $("#id_asignatura").val()
        
        $.blockUI({
            message: '<h1>Consultando temas</h1><i class="fa fa-spinner fa-spin fa-3x fa-fw">',
            css: {
                border: 'none',
                padding: '15px',
                backgroundColor: '#000',
                '-webkit-border-radius': '10px',
                '-moz-border-radius': '10px',
                opacity: .8,
                color: '#fff'
            }
        });
        let url = "{{ route('plan_desarrollo_asignatura/obtener_temas') }}"
        let _token = ""
        $("[name='_token']").each(function() { _token = this.value })
        let request = {
            '_token' : _token,
            'id_periodo_academico' : id_periodo_academico,
            'id_asignatura' : id_asignatura,
            'id_tercero' : {{ $usuario->id_tercero }}
        }
        
        $.post(url, request, (response) => {
            $.unblockUI();
            let temas = ""
            response.temas.forEach((tema) => {
                temas += "<option value='"+tema+"'>"
            })
            $("#list_temas").html(temas)
        })
        .fail((error)=>{
            $.unblockUI();
            toastr.error("Ha ocurrido en el servidor", 'Error', {timeOut: 8000})
            console.log(error)
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
</script>
@endsection