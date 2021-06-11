@extends('layouts.main')
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
        .icon-rounded{
            background-color: #789A2F;
            color: #ffffff;
            text-align: center;
            padding: 15px;
            border-radius: 150px;
        }
        .tr-master{
            cursor: pointer;
        }
        .tr-master:hover{
            background-color: #92b5446e;
        }
        .h-card{
            min-height: 400px;
        }
    </style>
@endsection
@section('content')
<div class="row">
    

    <div class="col-sm-12">
        <div class="card h-card">
            <div class="card-block">
                <div class="row">
                    @php
                        $docentes = \App\Tercero::all()
                                            ->where('estado', 1)
                                            ->where('id_dominio_tipo_ter', 3)
                                            ->where('id_licencia', session('id_licencia'));

                        
                        $color_plan_trabajo = "success";
                        $color_plan_desarrollo = "warning";
                        $color_seguimiento_asignatura = "info";
                        $color_actividades_complementarias = "danger";
                        $hay_docentes = false;
                    @endphp
                    <div class="col-sm-12"><h4><b>Formatos pendientes por revisar</b></h4></div>
                    <div class="table-responsive mt-2">
                        <table class="table stylish-table mb-0 no-wrap v-middle">
                            <tbody>
                                @foreach ($docentes as $docente)
                                    @php
                                        $formatos_pendientes = $docente->formatos_enviados(1);
                                    @endphp
                                    @if (count($formatos_pendientes) > 0)
                                        @php
                                            $hay_docentes = true;
                                        @endphp
                                        <tr class="tr-master" onclick="location.href = '{{ route('docente/view', $docente->id_tercero) }}'">
                                            <td colspan="2"><center>
                                            <img src="{{ asset($docente->get_imagen()) }}" 
                                                 class="img-circle" 
                                                 width="35" 
                                                 height="35" />
                                            <small><b> {{ $docente->getNameFull() }} </b>({{ $docente->cedula }})</small>
                                        </center></td></tr>
                                    @endif
                                    
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
                                        <tr style="cursor: pointer;" onclick="location.href = '{{ $formato->ruta_revision }}'">
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
                                @endforeach
                                @if (!$hay_docentes)
                                        <tr><td><center><b><i>No tienes formatos pendientes</i></b></center></td></tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</div>
@endsection