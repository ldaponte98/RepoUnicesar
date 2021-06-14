@extends('layouts.main')
@php
    $usuario = \App\Usuario::find(session('id_usuario'));
@endphp
@section('header_content')
    <div class="row page-titles">
        <div class="col-md-6 col-8 align-self-center">
            <h3 class="text-tdemecolor m-b-0 m-t-0">Tabla</h3>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Reportes</a></li>
                <li class="breadcrumb-item active">Informe de rendimiento general de asignaturas</li>
            </ol>
        </div>
    </div>
    <style type="text/css">
        .echart-graph{
            widtd: 850px; 
            height: 500px;
        }
        @media (max-widtd: 600px) {
            .echart-graph{
                widtd: 350px; 
                height: 400px;
            }
        }
        .table-bordered td{
            color: #000000;
        }
        .table-striped{
            font-size: 12px;
        }
        .td-fill{
            background-color: #F2F7F8;
        }
        .td-not-fill{
            background-color: #ffffff;
        }

        .states-order{
            width:100%;
            height:auto;
            padding: 5px 10px;
            display: block;
            align-items: left;
        }
        .point{
            width: 100%;
            display: flex;
            justify-content: flex-start;
        }

        .point i{
            margin-right: 5px;
        }

        .point h5{
            font-size: 14px;
        }

        .yellow{ color:#F5E331 !important; }
        .blue{ color:#009EFB !important; }
        .green{ color:#99BC4A !important; }
        .violet{ color:#AC80FF !important; }

        .td-asig{
            padding-top: 18px !important;
        }

        .estados{
            align-items: center;
            display: inline-flex;
        }
        
    </style>
@endsection
@section('content')
<form metdod="POST">
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
                            <h3><b>Informe de rendimiento general de asignaturas</b></h3>
                            <i>Informe realizado con seguimientos de asignatura realizados hasta la fecha pertenecientes al periodo academico.</i><br><br>
                            <div class="states-order">
                                <div class="point yellow">
                                    <a href="#span_1" class="yellow"><i class="fa fa-circle"></i></a>
                                    <h5>Mayor porcentaje de aprobación</h5>
                                </div>
                                <div class="point blue">
                                    <a href="#span_2" class="blue"><i class="fa fa-circle"></i></a>
                                    <h5>Menor porcentaje de aprobación</h5>
                                </div>
                                <div class="point green">
                                    <a href="#span_3" class="green"><i class="fa fa-circle"></i></a>
                                    <h5>Mayor promedio de notas</h5>
                                </div>
                                <div class="point violet">
                                    <a href="#span_4" class="violet"><i class="fa fa-circle"></i></a>
                                    <h5>Menor promedio de notas</h5>
                                </div>
                            </div>
                        </center>
                        <div style="text-align: right;">
                            <a target="_blank" style="color: white;" onclick="exportar_excel()"  class="btn pull-rigth hidden-sm-down btn-primary">Exportar</a>
                        </div>
                        
                        <div class="table-responsive">
                            <table id="table-report" class="table table-striped table-bordered">
                                <tdead>
                                    <tr>
                                        <td class="td-asig" colspan="1" rowspan="2">
                                            <center><br><b>Asignatura</b></center>
                                        </td>
                                        <td colspan="2" scope="col"><center><b>1er Corte</b></center></td>
                                        <td colspan="2" scope="col"><center><b>2do Corte</b></center></td>
                                        <td colspan="2" scope="col"><center><b>3er Corte</b></center></td>
                                        <td colspan="2" scope="col"><center><b>Informe</b></center></td>
                                    </tr>
                                    <tr>
                                        <td scope="col"><center>% Aprobación</center></td>
                                        <td scope="col"><center>Promedio</center></td>

                                        <td scope="col"><center>% Aprobación</center></td>
                                        <td scope="col"><center>Promedio</center></td>

                                        <td scope="col"><center>% Aprobación</center></td>
                                        <td scope="col"><center>Promedio</center></td>

                                        <td scope="col" class="td-fill"><center><b>% Aprobación</b></center></td>
                                        <td scope="col" class="td-fill"><center><b>Promedio</b></center></td>
                                    </tr>
                              </tdead>
                              <tbody>
                                @foreach ($reporte as $item)
                                <tr>
                                    <td scope="col" class="td-not-fill">
                                        <center>{{ $item->nombre }} - {{ $item->codigo }}</center>
                                        <center>
                                            <div class="estados">
                                                @if ($item->id_asignatura == $estadisticas->id_asignatura_max_aprobacion)
                                                    <div id="span_1" class="point yellow">
                                                        <i class="fa fa-circle animation-point"></i>
                                                    </div>
                                                @endif

                                                @if ($item->id_asignatura == $estadisticas->id_asignatura_min_aprobacion)
                                                    <div id="span_2" class="point blue">
                                                        <i class="fa fa-circle animation-point"></i>
                                                    </div>
                                                @endif

                                                @if ($item->id_asignatura == $estadisticas->id_asignatura_max_aprobacion)
                                                    <div id="span_3" class="point green">
                                                        <i class="fa fa-circle animation-point"></i>
                                                    </div>
                                                @endif

                                                @if ($item->id_asignatura == $estadisticas->id_asignatura_min_notas)
                                                    <div id="span_4" class="point violet">
                                                        <i class="fa fa-circle animation-point"></i>
                                                    </div>
                                                @endif
                                            </div>
                                        </center>
                                        
                                    </td>
                                    <td scope="col" class="td-not-fill">
                                        <center>{{ $item->corte_1['porc_aprobacion'] }}%</center>
                                    </td>
                                    <td scope="col" class="td-not-fill">
                                        <center>{{ $item->corte_1['promedio_notas'] }}</center>
                                    </td>
                                    <td scope="col" class="td-not-fill">
                                        <center>{{ $item->corte_2['porc_aprobacion'] }}%</center>
                                    </td>
                                    <td scope="col" class="td-not-fill">
                                        <center>{{ $item->corte_2['promedio_notas'] }}</center>
                                    </td>
                                    <td scope="col" class="td-not-fill">
                                        <center>{{ $item->corte_3['porc_aprobacion'] }}%</center>
                                    </td>
                                    <td scope="col" class="td-not-fill">
                                        <center>{{ $item->corte_3['promedio_notas'] }}</center>
                                    </td>
                                    <td scope="col" class="td-fill">
                                        <center><b>{{ $item->porc_aprobacion_final }}%</b></center>
                                    </td>
                                    <td scope="col" class="td-fill">
                                        <center><b>{{ $item->promedio_notas_final }}</b></center>
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
    });

    function exportar_excel() {
        tableToExcel('table-report', 'Reporte general de rendimiento ({{ date('Y-m-d') }})')
    }
</script>
@endsection

