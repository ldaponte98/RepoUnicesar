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
                <li class="breadcrumb-item active">Indice de deserción por asignatura</li>
            </ol>
        </div>
    </div>
    <style type="text/css">
        .echart-graph{
            width: 850px; 
            height: 500px;
        }
        @media (max-width: 600px) {
            .mobile-chart{
                max-width: 240px;
                overflow: scroll;
                display: inline-flex;
                align-items: center;
            }
        }
        .table-bordered th{
            color: #000000;
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
                                $asignaturas = \App\Asignatura::where('id_licencia', session('id_licencia'))
                                                        ->get();
                            @endphp
                            <label style="color: black;"><b>Asignatura</b></label>
                            <select required class="form-control hasDatepicker form-control-line" id="id_asignatura" name="id_asignatura">
                                <option value="" disabled selected>Consultar por nombre o codigo</option>
                                @foreach ($asignaturas as $asignatura)
                                    <option @if ($asignatura->id_asignatura == $id_asignatura)
                                        selected 
                                    @endif value="{{ $asignatura->id_asignatura }}">{{ $asignatura->nombre. " ($asignatura->codigo)" }}</option>
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
                        <center>
                            <h3><b>Indice de deserción por asignatura</b></h3>
                            <div class="mobile-chart">
                                <div id="chart" class="echart-graph"></div>
                            </div>
                        </center>
                    </div>
                </div>
                <br>
                <h3><b>Primer corte</b></h3>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>                               
                                    <tr>
                                        <th><b><center>Grupo</center></b></th>
                                        <th><b><center>Docente encargado</center></b></th>
                                        <th><b><center>Estudiantes iniciales</center></b></th>
                                        <th><b><center>Asistentes</center></b></th>
                                        <th><b><center>Desertados</center></b></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($reporte as $grupo)
                                    <tr>
                                        <td>{{ $grupo->grupo }}</td>
                                        <td>
                                            <a target="_blank" 
                                                href="{{ route('docente/view', $grupo->docente->id_tercero) }}">
                                                {{ $grupo->docente->getNameFull() }} ({{ $grupo->docente->cedula }})
                                            </a>
                                        </td>
                                        <td style="text-align: right;">
                                            {{ number_format($grupo->cortes[0]->total_inicial, 0, ".", ".") }}
                                        </td>
                                        <td style="text-align: right;">
                                            {{ number_format($grupo->cortes[0]->asistentes, 0, ".", ".") }}
                                        </td>
                                        <td style="text-align: right;">
                                            {{ number_format($grupo->cortes[0]->desertados, 0, ".", ".") }}
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <br>
                <h3><b>Segundo corte</b></h3>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>                               
                                    <tr>
                                        <th><b><center>Grupo</center></b></th>
                                        <th><b><center>Docente encargado</center></b></th>
                                        <th><b><center>Estudiantes iniciales</center></b></th>
                                        <th><b><center>Asistentes</center></b></th>
                                        <th><b><center>Desertados</center></b></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($reporte as $grupo)
                                    <tr>
                                        <td>{{ $grupo->grupo }}</td>
                                        <td>
                                            <a target="_blank" 
                                                href="{{ route('docente/view', $grupo->docente->id_tercero) }}">
                                                {{ $grupo->docente->getNameFull() }} ({{ $grupo->docente->cedula }})
                                            </a>
                                        </td>
                                        <td style="text-align: right;">
                                            {{ number_format($grupo->cortes[1]->total_inicial, 0, ".", ".") }}
                                        </td>
                                        <td style="text-align: right;">
                                            {{ number_format($grupo->cortes[1]->asistentes, 0, ".", ".") }}
                                        </td>
                                        <td style="text-align: right;">
                                            {{ number_format($grupo->cortes[1]->desertados, 0, ".", ".") }}
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <br>
                <h3><b>Tercer corte</b></h3>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>                               
                                    <tr>
                                        <th><b><center>Grupo</center></b></th>
                                        <th><b><center>Docente encargado</center></b></th>
                                        <th><b><center>Estudiantes iniciales</center></b></th>
                                        <th><b><center>Asistentes</center></b></th>
                                        <th><b><center>Desertados</center></b></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($reporte as $grupo)
                                    <tr>
                                        <td>{{ $grupo->grupo }}</td>
                                        <td>
                                            <a target="_blank" 
                                                href="{{ route('docente/view', $grupo->docente->id_tercero) }}">
                                                {{ $grupo->docente->getNameFull() }} ({{ $grupo->docente->cedula }})
                                            </a>
                                        </td>
                                        <td style="text-align: right;">
                                            {{ number_format($grupo->cortes[2]->total_inicial, 0, ".", ".") }}
                                        </td>
                                        <td style="text-align: right;">
                                            {{ number_format($grupo->cortes[2]->asistentes, 0, ".", ".") }}
                                        </td>
                                        <td style="text-align: right;">
                                            {{ number_format($grupo->cortes[2]->desertados, 0, ".", ".") }}
                                        </td>
                                    </tr>
                                    @endforeach
                                    
                                </tbody>
                            </table>
                        </div>
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
        $("#id_asignatura").select2({
            width : '100%',
        })
        @if ($reporte)
            let data = JSON.parse('@php echo json_encode($reporte) @endphp')
            console.log(data)
            PintarGrafica(data)
        @endif
        
    });
    @if ($reporte)
    function PintarGrafica(_data){
        var app = {};

        var chartDom = document.getElementById('chart');
        var myChart = echarts.init(chartDom);
        var option;

        var posList = [
            'left', 'right', 'top', 'bottom',
            'inside',
            'insideTop', 'insideLeft', 'insideRight', 'insideBottom',
            'insideTopLeft', 'insideTopRight', 'insideBottomLeft', 'insideBottomRight'
        ];

        app.configParameters = {
            rotate: {
                min: -90,
                max: 90
            },
            align: {
                options: {
                    left: 'left',
                    center: 'center',
                    right: 'right'
                }
            },
            verticalAlign: {
                options: {
                    top: 'top',
                    middle: 'middle',
                    bottom: 'bottom'
                }
            },
            position: {
                options: posList.reduce(function (map, pos) {
                    map[pos] = pos;
                    return map;
                }, {})
            },
            distance: {
                min: 0,
                max: 100
            }
        };

        app.config = {
            rotate: 90,
            align: 'left',
            verticalAlign: 'middle',
            position: 'insideBottom',
            distance: 15,
            onChange: function () {
                var labelOption = {
                    normal: {
                        rotate: app.config.rotate,
                        align: app.config.align,
                        verticalAlign: app.config.verticalAlign,
                        position: app.config.position,
                        distance: app.config.distance
                    }
                };
                myChart.setOption({
                    series: [{
                        label: labelOption
                    }, {
                        label: labelOption
                    }, {
                        label: labelOption
                    }, {
                        label: labelOption
                    }]
                });
            }
        };


        var labelOption = {
            show: true,
            position: app.config.position,
            distance: app.config.distance,
            align: app.config.align,
            verticalAlign: app.config.verticalAlign,
            rotate: app.config.rotate,
            formatter: '{c}  {name|{a}}',
            fontSize: 16,
            rich: {
                name: {
                }
            }
        };

        let data_grupos = _data.map((item) => { return item.grupo })
        let data_corte_1 = []
        let data_corte_2 = []
        let data_corte_3 = []
        let data_cortes = _data.forEach((grupo) => {
            data_corte_1.push(grupo.cortes[0].desertados)
            data_corte_2.push(grupo.cortes[1].desertados)
            data_corte_3.push(grupo.cortes[2].desertados)
        })
        option = {
            tooltip: {
                trigger: 'axis',
                axisPointer: {
                    type: 'shadow'
                }
            },
            legend: {
                data: ['Deserción 1er Corte', 'Deserción 2do Corte', 'Deserción 3er Corte']
            },
            toolbox: {
                show: true,
                orient: 'vertical',
                left: 'right',
                top: 'center',
                feature: {
                    /*mark: {show: true},
                    dataView: {show: true, readOnly: false},
                    magicType: {show: true, type: ['line', 'bar', 'stack', 'tiled']},
                    restore: {show: true},
                    saveAsImage: {show: true}*/
                }
            },
            xAxis: [
                {
                    type: 'category',
                    axisTick: {show: false},
                    data: data_grupos
                }
            ],
            yAxis: [
                {
                    type: 'value'
                }
            ],
            series: [
                {
                    name: 'Deserción 1er Corte',
                    type: 'bar',
                    barGap: 0,
                    label: labelOption,
                    emphasis: {
                        focus: 'series'
                    },
                    data: data_corte_1
                },
                {
                    name: 'Deserción 2do Corte',
                    type: 'bar',
                    label: labelOption,
                    emphasis: {
                        focus: 'series'
                    },
                    data: data_corte_2
                },
                {
                    name: 'Deserción 3er Corte',
                    type: 'bar',
                    label: labelOption,
                    emphasis: {
                        focus: 'series'
                    },
                    data: data_corte_3
                }
            ]
        };

        myChart.setOption(option);
        myChart.on('click', function (params) {
            //DetallesEstado(params.name)
        });
    }
    @endif
    
</script>
@endsection

