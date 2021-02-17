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
                <li class="hidden-sm-down breadcrumb-item active"> @if($escenario == "crear") Nueva Clase @else Actualización Clase @endif
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
                    <label style="color: black;"><b>Periodo academico</b></label>
                    <select onchange="buscar_carga_academica(this.value)" class="form-control hasDatepicker form-control-line" id="id_periodo_academico" name="id_periodo_academico">
                        @foreach ($periodos_academicos as $d)
                            <option @if($periodo_academico->id_periodo_academico == $d->id_periodo_academico) selected @endif value="{{ $d->id_periodo_academico }}">{{ $d->periodo }}</option>
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
                        <label style="color: black;"><b>Asignatura</b></label>
                        <select onchange="buscar_grupos(this.value)" class="form-control hasDatepicker form-control-line" id="id_asignatura" name="id_asignatura">
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
                <div class="col-sm-3">
                    <div class="form-group">
                        <label style="color: black;"><b>Grupo</b></label>
                        <select onclick="buscar_estudiantes(this.value)" class="form-control hasDatepicker form-control-line" id="id_grupo" name="id_grupo">
                            <option value="" disabled selected>Consultar por nombre</option>
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
                        <label style="color: black;"><b>Fecha clase</b></label>
                        <input type="text" readonly class="form-control hasDatepicker form-control-line" id="fecha_clase">
                        <script type="text/javascript">
                        $(document).ready(function() {
                            $('#fecha_clase').datepicker({
                                format: "dd/mm/yyyy",
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
                        <label style="color: black;"><b>Hora inicio</b></label>
                        <div class="input-group clockpicker " data-autoclose="true">
                            <span class="input-group-addon">
                            <i data-feather="clock" style="font-size: 12px;" aria-hidden="true"></i>
                            </span>
                            <input type="text" id="hora_inicio" autocomplete="off" class="form-control" value="" />
                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label style="color: black;"><b>Hora fin</b></label>
                        <div class="input-group clockpicker " data-autoclose="true">
                            <span class="input-group-addon">
                            <i data-feather="clock" style="font-size: 12px;" aria-hidden="true"></i>
                            </span>
                            <input type="text" id="hora_fin" autocomplete="off" class="form-control" value="" />
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                   <div class="form-group">
                        <label style="color: black;"><b>Tema</b></label>
                        <input class="form-control" list="list_temas" id="tema"/>
                        <datalist id="list_temas"></datalist>
                    </div>
                </div>
            </div>
                <br>
                <h4 class="card-title"><b>Asistencia</b></h4>
                <div class="w3-card-8 w3-dark-grey">

                <div class="w3-container w3-center">
                  <h3>Friend request</h3>
                  <img src="img_avatar3.png" alt="Avatar" style="width:80%">
                  <h5>John Doe</h5>

                  <button class="w3-btn w3-green">Accept</button>
                  <button class="w3-btn w3-red">Decline</button>
                </div>

                </div>
        </div>
    </div>
</div>
</div>

                
@csrf
<script type="text/javascript">
    var tabla = null;
    $(document).ready(()=>{
        this.buscar_carga_academica({{ $periodo_academico->id_periodo_academico }})
        $('#tabla').pageMe({pagerSelector:'#paginador',showPrevNext:true,hidePageNumbers:false,perPage:1});
        $('.clockpicker').clockpicker();
    })
    function buscar_carga_academica(id_periodo){
        let url = "{{ config('global.url_base') }}/docente/buscar_asignaturas/"+id_periodo+"/{{ $usuario->id_tercero }}"
        $.get(url, (response) => {
            var asignaturas = '<option value="" disabled selected>Consultar por nombre o codigo</option>';
            response.asignaturas.forEach((asignatura) => {
                asignaturas += "<option value = '"+asignatura.id_asignatura+"' >"+asignatura.nombre+"</option>"
            })
            $("#id_asignatura").html(asignaturas)
            var grupos = "<option value='' disabled selected>Consultar por nombre</option>"
            $("#id_grupo").html(grupos)
            $("#list_temas").html("")
        })
    }

    function buscar_grupos(id_asignatura) {
        let id_periodo = $("#id_periodo_academico").val()
        if(id_periodo == "" || id_periodo == null){ alert("Es necesario establecer el periodo academico para el filtrado."); return false }
        
        var ruta = "{{ config('global.url_base') }}/asignatura/buscar_grupos_docente/"+id_asignatura+"/{{ $usuario->id_tercero }}/"+id_periodo
        var grupos = '<option value="" disabled selected>Consultar por nombre</option>'
        $.get(ruta, function(response) {
            response.forEach(function(grupo){
                grupos += '<option value="'+grupo.id_grupo+'">'+grupo.codigo+'</option>'
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