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
            margin-right: 8px;
        }

        .point h5{
            font-size: 14px;
        }

        .yellow{ color:#F5E331; }
        .blue{ color:#009EFB; }
        .green{ color:#99BC4A; }
        .violet{ color:#AC80FF; }

        .td-asig{
            padding-top: 18px !important;
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
                            <div class="states-order">
                                <div class="point yellow">
                                    <i class="fa fa-circle"></i>
                                    <h5>Mayor porcentaje de aprobación</h5>
                                </div>
                                <div class="point blue">
                                    <i class="fa fa-circle"></i>
                                    <h5>Menor porcentaje de aprobación</h5>
                                </div>
                                <div class="point green">
                                    <i class="fa fa-circle"></i>
                                    <h5>Mayor promedio de notas</h5>
                                </div>
                                <div class="point violet">
                                    <i class="fa fa-circle"></i>
                                    <h5>Menor promedio de notas</h5>
                                </div>
                            </div>
                        </center>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered">
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
                                <tr>
                                    <td scope="col" class="td-not-fill"><center></center></td>
                                    <td scope="col" class="td-not-fill"><center></center></td>
                                    <td scope="col" class="td-not-fill"><center></center></td>
                                    <td scope="col" class="td-not-fill"><center></center></td>
                                    <td scope="col" class="td-not-fill"><center></center></td>
                                    <td scope="col" class="td-not-fill"><center></center></td>
                                    <td scope="col" class="td-not-fill"><center></center></td>
                                    <td scope="col" class="td-fill"><center><b>0</b></center></td>
                                    <td scope="col" class="td-fill"><center><b>0</b></center></td>
                                </tr>
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
            //let data = JSON.parse('@php echo json_encode($reporte) @endphp')
            //console.log(data)
            //PintarGrafica(data)
        @endif
        
    });
</script>
@endsection

