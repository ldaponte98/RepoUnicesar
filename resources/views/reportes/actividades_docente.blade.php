@extends('layouts.main')
@php
    $usuario = \App\Usuario::find(session('id_usuario'));
@endphp
@section('header_content')
    <div class="row page-titles">
        <div class="col-md-6 col-8 align-self-center">
            <h3 class="text-themecolor m-b-0 m-t-0">Tabla</h3>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Reportes</a></li>
                <li class="breadcrumb-item active">Actividades docente segun plan de trabajo</li>
            </ol>
        </div>
    </div>
    <style type="text/css">
        .echart-graph{
            width: 850px; 
            height: 500px;
        }

        @media (max-width: 600px) {
            .echart-graph{
                width: 260px; 
                height: 400px;
            }
        }
    </style>
@endsection
@section('content')
<form method="POST">
    @csrf
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
                            <select required class="form-control hasDatepicker form-control-line" id="id_periodo_academico" name="id_periodo_academico">
                                <option value="" disabled selected>Consultar por nombre</option>
                                @foreach ($periodos_academicos as $d)
                                    <option @if ($id_periodo == $d->id_periodo_academico) selected @endif
                                     value="{{ $d->id_periodo_academico }}">{{ $d->periodo }}</option>
                                @endforeach
                            </select>
                          </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            @php
                                $docentes = \App\Tercero::where('id_dominio_tipo_ter', 3)
                                                        ->where('id_licencia', session('id_licencia'))
                                                        ->get();
                            @endphp
                            <label style="color: black;"><b>Docente</b></label>
                            <select required class="form-control hasDatepicker form-control-line" id="id_tercero" name="id_tercero">
                                <option value="0">Todos</option>
                                @foreach ($docentes as $tercero)
                                    <option @if ($tercero->id_tercero == $id_tercero)
                                        selected 
                                    @endif value="{{ $tercero->id_tercero }}">{{ $tercero->getNameFull(). " ($tercero->cedula)" }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <br>
                        <button type="submit" class="btn btn-info mt-2">Consultar</button>
                    </div>
                </div>
              </div>
          </div>
      </div>
    </div>
</form>
@if ($reporte)
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-block">
                <div class="row">
                    <div class="col-sm-12">
                        <h3><b>Demográfico de actividades docente</b></h3>
                        <center><div id="chart" class="echart-graph"></div></center>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-sm-12">
                        <table class="table table-bordered">
                          <tbody>
                            <tr>
                              <td colspan="3">Horas dedicadas a la orientación y evaluación de los proyectos de grado</td>
                              <td colspan="1"><center><b>{{ $reporte->total_orientacion }}</b></center></td>
                            </tr>
                            <tr>
                              <td colspan="3">Horas dedicadas a la investigación aprobada</td>
                              <td colspan="1"><center><b>{{ $reporte->total_investigacion }}</b></center></td>
                            </tr>
                            <tr>
                              <td colspan="3">Horas dedicadas a la proyección social</td>
                              <td colspan="1"><center><b>{{ $reporte->total_proyeccion }}</b></center></td>
                            </tr>
                            <tr>
                              <td colspan="3">Horas dedicadas a la cooperación interinstitucional</td>
                              <td colspan="1"><center><b>{{ $reporte->total_cooperacion }}</b></center></td>
                            </tr>
                            <tr>
                              <td colspan="3">Horas dedicadas al crecimiento personal y desarrollo</td>
                              <td colspan="1"><center><b>{{ $reporte->total_crecimiento }}</b></center></td>
                            </tr>
                            <tr>
                              <td colspan="3">Horas dedicadas a las actividades administrativas</td>
                              <td colspan="1"><center><b>{{ $reporte->total_actividades }}</b></center></td>
                            </tr>
                            <tr>
                              <td colspan="3">Horas dedicadas a otras actividades</td>
                              <td colspan="1"><center><b>{{ $reporte->total_otras }}</b></center></td>
                            </tr>
                          </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endif


<script type="text/javascript">
    $(document).ready(function() {
        $("#id_periodo_academico").select2({
            width : '100%',
        })
        $("#id_tercero").select2({
            width : '100%',
        })
        @if ($reporte)
            PintarGrafica()
        @endif
        
    });
    @if ($reporte)
    function PintarGrafica(){
        // based on prepared DOM, initialize echarts instance
        var myChart = echarts.init(document.getElementById('chart'));

        // specify chart configuration item and data
        var option = {
            dataset: {
                source: [
                    ['porcentaje', 'Horas', 'Actividades'],
                    [{{ $reporte->total_orientacion }}, {{ $reporte->total_orientacion }}, 'O y E de los proyectos de grado'],
                    [{{ $reporte->total_investigacion }}, {{ $reporte->total_investigacion }}, 'Investigación aprobada'],
                    [{{ $reporte->total_proyeccion }}, {{ $reporte->total_proyeccion }}, 'Proyección social'],
                    [{{ $reporte->total_cooperacion }}, {{ $reporte->total_cooperacion }}, 'Cooperacion Interinstitucional'],
                    [{{ $reporte->total_crecimiento }}, {{ $reporte->total_crecimiento }}, 'Crecimiento personal y desarrollo'],
                    [{{ $reporte->total_actividades }}, {{ $reporte->total_actividades }}, 'Actividades administrativas'],
                    [{{ $reporte->total_otras }}, {{ $reporte->total_otras }}, 'Otras actividades']
                ]
            },
            grid: {containLabel: true},
            xAxis: {name: 'Horas'},
            yAxis: {type: 'category'},
            visualMap: {
                top: 0,
                orient: 'horizontal',
                left: 'center',
                min: 0,
                max: {{ $reporte->max_horas }},
                text: ['Mayor cantidad de horas', 'Menor cantidad de horas'],
                dimension: 0,
                inRange: {
                    color: ['#FD665F', '#FFCE34', '#65B581']
                }
            },
            series: [
                {
                    type: 'bar',
                    encode: {
                        x: 'Horas',
                        y: 'Actividades'
                    }
                }
            ]
        };
        // use configuration item and data specified to show chart
        myChart.setOption(option);

        myChart.on('click', function (params) {
            DetallesEstado(params.name)
        });
    }
    @endif
    
</script>
@endsection

