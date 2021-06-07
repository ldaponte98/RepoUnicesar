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
                <li class="breadcrumb-item active">Puntualidad en formatos</li>
            </ol>
        </div>
    </div>
    <style type="text/css">
        .echart-graph{
            width: 950px; 
            height:400px;
        }

        @media (max-width: 600px) {
            .echart-graph{
                width: 350px; 
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
                            <label style="color: black;"><b>Docencia directa</b></label>
                            <select required class="form-control hasDatepicker form-control-line" id="id_dominio_tipo_formato" name="id_dominio_tipo_formato">
                                <option value="" disabled selected>Consultar por nombre</option>
                                <option value="{{ config('global.plan_trabajo') }}"
                                    @if ($id_dominio_tipo_formato == config('global.plan_trabajo')) selected @endif>
                                    Plan de trabajo
                                </option>

                                <option value="{{ config('global.desarrollo_asignatura') }}"
                                    @if ($id_dominio_tipo_formato == config('global.desarrollo_asignatura')) selected @endif>
                                    Plan de desarrollo a la asignatura
                                </option>

                                <option value="{{ config('global.seguimiento_asignatura') }}"
                                    @if ($id_dominio_tipo_formato == config('global.seguimiento_asignatura')) selected @endif>
                                    Plan de seguimiento por corte
                                </option>

                                <option value="{{ config('global.actividades_complementarias') }}"
                                        @if ($id_dominio_tipo_formato == config('global.actividades_complementarias') ) selected @endif>
                                    Actividades complementarias
                                </option>
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
                        <div class="row">
                            <div class="col-md-6 col-lg-3 col-xlg-3">
                                <div class="card">
                                    <div class="box p-2 rounded bg-danger text-center">
                                        <h1 class="fw-light text-white">{{ $reporte->porc_pendientes }}%</h1>
                                        <h6 class="text-white">Pendientes</h6>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-3 col-xlg-3">
                                <div class="card">
                                    <div class="box p-2 rounded bg-success text-center">
                                        <h1 class="fw-light text-white">{{ $reporte->porc_enviados }}%</h1>
                                        <h6 class="text-white">Enviados</h6>
                                    </div>
                                </div>
                            </div>
                            <!-- Column -->
                            <div class="col-md-6 col-lg-3 col-xlg-3">
                                <div class="card">
                                    <div class="box p-2 rounded bg-warning text-center">
                                        <h1 class="fw-light text-white">{{ $reporte->porc_recibidos }}%</h1>
                                        <h6 class="text-white">Recibidos</h6>
                                    </div>
                                </div>
                            </div>
                            <!-- Column -->
                            <div class="col-md-6 col-lg-3 col-xlg-3">
                                <div class="card">
                                    <div class="box p-2 rounded bg-info text-center">
                                        <h1 class="fw-light text-white">{{ $reporte->porc_plazos_extra }}%</h1>
                                        <h6 class="text-white">Plazos extra</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <h3><b>Reporte de puntualidad en formatos</b></h3>
                        <center><div id="chart" class="echart-graph"></div></center>
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
        $("#id_dominio_tipo_formato").select2({
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
            let dataX = ["Pendientes", "Enviados", "Recibidos", "Plazos extra"]
            let dataValue = [
                {{ $reporte->total_pendientes }}, 
                {{ $reporte->total_enviados }}, 
                {{ $reporte->total_recibidos }}, 
                {{ $reporte->total_plazos_extra }}
            ]
            var option = {
                color: "#409EFF",
                title: {
                    text: ''
                },
                tooltip: {},
                legend: {
                    data:['Estados']
                },
                xAxis: {
                    data: dataX
                },
                yAxis: {},
                series: [{
                    name: 'Estados',
                    type: 'bar',
                    data: dataValue
                }]
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

