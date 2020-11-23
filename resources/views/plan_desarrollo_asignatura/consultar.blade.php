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
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Plan de desarrollo asignatura</a></li>
                            <li class="breadcrumb-item active">Busqueda de asignatura</li>
                        </ol>
                        
                    </div>
                    
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
<div class="row">
  <div class="col-sm-12">
      <div class="card">
          <div class="card-block">
            <div class="row">
                <div class="col-sm-4">
                    <div class="form-group">
                        @php
                            $docentes = \App\Tercero::all()
                                                    ->where('id_dominio_tipo_ter', 3)
                                                    ->where('id_licencia', session('id_licencia'));
                        @endphp
                    <label style="color: black;"><b>Docente</b></label>
                    <select onchange="buscar_carga_academica()" class="form-control hasDatepicker form-control-line" id="id_tercero" name="id_tercero">
                        <option value="" disabled selected>Consultar por nombre o cedula</option>
                        @foreach ($docentes as $d)
                            <option value="{{ $d->id_tercero }}">{{ $d->getNameFull() }}</option>
                        @endforeach
                    </select>
                    <script type="text/javascript">
                    $(document).ready(function() {
                        $("#id_tercero").select2({
                            width : '100%',
                        })
                        
                    });
                    </script>
                  </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        @php
                            $periodos_academicos = \App\PeriodoAcademico::orderBy('id_periodo_academico','desc')->get();
                        @endphp
                    <label style="color: black;"><b>Periodo academico</b></label>
                    <select onchange="buscar_carga_academica()" class="form-control hasDatepicker form-control-line" id="id_periodo_academico" name="id_periodo_academico">
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
            
            </div>
            <center>
                <button type="submit" onclick="if($('#id_asignatura').val() != null && $('#id_periodo_academico').val() != null){ location.href = '{{ config('global.url_base') }}/plan_desarrollo_asignatura/view/'+$('#id_tercero').val()+'/'+$('#id_asignatura').val()+'/'+$('#id_periodo_academico').val() }else{alert('Es necesario que escoja la asignatura y el periodo academico.')}" class="btn btn-info">Consultar</button>
            </center>
          </div>
      </div>
  </div>
</div>
<style type="text/css">
 .nav-item .active{
    color: blue !important;
 }
</style>

<script type="text/javascript">
    function buscar_carga_academica(){
        
        let id_periodo = $("#id_periodo_academico").val()
        let id_tercero = $("#id_tercero").val()
        if(id_tercero && id_periodo){
            let url = "{{ config('global.url_base') }}/docente/buscar_asignaturas/"+id_periodo+"/"+id_tercero
            $.get(url, (response) => {
                var asignaturas = "<option value='' disabled selected>Consultar por nombre o codigo</option>";
                response.asignaturas.forEach((asignatura) => {
                    asignaturas += "<option value = '"+asignatura.id_asignatura+"' >"+asignatura.nombre+"</option>"
                })
                $("#id_asignatura").html(asignaturas)
            })
        }
    }
</script>
@endsection

