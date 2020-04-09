
@extends('layouts.main')

@section('header_content')

	<div class="row page-titles">
                    <div class="col-md-6 col-8 align-self-center">
                        <h3 class="text-themecolor m-b-0 m-t-0">Tabla</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Fechas</a></li>
                            <li class="hidden-sm-down breadcrumb-item active">Fechas de entrega</li>
                        </ol>
                    </div>
                    <div class="col-md-6 col-4 align-self-center">
                        <br>
                        <input title="Consulta cualquier campo" id="txtfiltro" type="text" class="pull-right search" name="" placeholder="Consulta Aqui">
                 </div>          
    </div>
@endsection
@section('content')
@php
@endphp

@if (session('mensaje_update_fechas'))
  <script>
    toastr.success('{{ session('mensaje_update_fechas') }}', 'Fechas actualizadas', {timeOut: 5000})
  </script>
@endif
<div class="row">
<div class="col-sm-12">
    <div class="card">
        <div class="card-block">
            
                <div class="form-group">
                    {{ Form::open(array('route' => 'fechas/fechas_de_entrega',))}}
                                  <label style="color: black;"><b>Periodo Academico</b></label>
                                  <div class="row">
                                      <div class="col-sm-4">
                                        <select name="id_periodo_escojido" class="form-control form-control-line" >
                                                @php
                                                    $periodos = \App\PeriodoAcademico::all();
                                                @endphp
                                                @foreach ($periodos as $periodo)
                                                    @if ($periodo->id_periodo_academico == $periodo_academico->id_periodo_academico)
                                                        <option selected value="{{ $periodo->id_periodo_academico }}">{{ $periodo->periodo }}</option>
                                                    @else
                                                        <option value="{{ $periodo->id_periodo_academico }}">{{ $periodo->periodo }}</option>
                                                    @endif
                                                
                                                @endforeach
                                        </select>
                                      </div>
                                      <div class="col-sm-2">
                                        <button type="submit" style="color: white; height: 100%; font-size: 16px;"  class="btn btn-success">Consultar</button>
                                      </div>
                                      <div class="col-sm-6">
                                        <i class="pull-right" style="margin-top: 5px">Calendario academico: {{ date('d/m/Y', strtotime($periodo_academico->fechaInicio)) }} hasta {{ date('d/m/Y', strtotime($periodo_academico->fechaFin)) }}</i>
                                      </div>
                                  </div>
                    {{ Form::close() }}

                            </div>
            <div class="row">

                <div class="col-sm-4">
                        <div class="card-section card-section-1 border rounded">
                            <div class="card-header card-header-1 rounded">
                                <center><h2 class="card-header-title mb-3 text-white">Plan de Trabajo</h2></center>
                            </div>
                            <div class="card-body text-center mb-2" style="padding: 15px">
                                <br><br><br><br>
                                @if ($fechas_de_entrega_plan_trabajo != null)
                                    <b>Desde {{ date('d/m/Y', strtotime($fechas_de_entrega_plan_trabajo->fechainicial1))}} hasta {{ date('d/m/Y', strtotime($fechas_de_entrega_plan_trabajo->fechafinal1))}}</b>
                                @else
                                    <center><b>Fechas no definidas </b></center>
                                @endif 
                                <br>
                                <br>
                                <br>
                                 <hr>
                                 <center>
                                <span><a href="{{ route('fechas/editar_fechas_de_entrega',['periodo' => $periodo_academico->id_periodo_academico, 'formato' =>  config('global.plan_trabajo') ]) }}" title="Editar fechas"><i class="fa fa-pencil rounded-circle" aria-hidden="true"></i></a></span>

                                </center>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-4">
                        <div class="card-section card-section-1 border rounded">
                            <div class="card-header card-header-1 rounded">
                                <center><h2 class="card-header-title mb-3 text-white">Desarrollo Asignatura</h2></center>
                            </div>
                            <div class="card-body text-center mb-2" style="padding: 15px">
                                <br><br><br><br>
                                @if ($fechas_de_entrega_plan_desarrollo_asignatura != null)
                                    <b>Desde {{ date('d/m/Y', strtotime($fechas_de_entrega_plan_desarrollo_asignatura->fechainicial1))}} hasta {{ date('d/m/Y', strtotime($fechas_de_entrega_plan_desarrollo_asignatura->fechafinal1))}}</b>
                                @else
                                    <b>Fechas no definidas </b>
                                @endif 
                                <br>
                                <br>
                                <br>                                
                                 <hr>
                                 <center>
                                <span><a href="{{ route('fechas/editar_fechas_de_entrega',['periodo' => $periodo_academico->id_periodo_academico, 'formato' =>  config('global.desarrollo_asignatura') ]) }}" title="Editar fechas"><i class="fa fa-pencil rounded-circle" aria-hidden="true"></i></a></span>

                                </center>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-4">
                        <div class="card-section card-section-1 border rounded">
                            <div class="card-header card-header-1 rounded">
                                <center><h2 class="card-header-title mb-3 text-white">Seguimiento Asignatura</h2></center>
                            </div>
                            <div class="card-body mb-2" style="padding: 15px">
                                
                                @if ($fechas_de_entrega_seguimiento != null)
                                    <b>Primer corte: </b>
                                     <p id="txt_seguimiento_corte_1">
                                        @if ($fechas_de_entrega_seguimiento->fechainicial1 != null)
                                             {{ date('d/m/Y', strtotime($fechas_de_entrega_seguimiento->fechainicial1)) }} hasta {{ date('d/m/Y', strtotime($fechas_de_entrega_seguimiento->fechafinal1)) }}
                                        @else
                                        Sin definir
                                        @endif
                                        </p>
                                      <b>Segundo corte: </b>
                                     <p id="txt_seguimiento_corte_1">
                                        @if ($fechas_de_entrega_seguimiento->fechainicial2 != null)
                                             {{ date('d/m/Y', strtotime($fechas_de_entrega_seguimiento->fechainicial2)) }} hasta {{ date('d/m/Y', strtotime($fechas_de_entrega_seguimiento->fechafinal2)) }}
                                        @else
                                        Sin definir
                                        @endif</p>
                                      <b>Tercer corte: </b>
                                     <p id="txt_seguimiento_corte_1">
                                        @if ($fechas_de_entrega_seguimiento->fechainicial3 != null)
                                             {{ date('d/m/Y', strtotime($fechas_de_entrega_seguimiento->fechainicial3)) }} hasta {{ date('d/m/Y', strtotime($fechas_de_entrega_seguimiento->fechafinal3)) }}
                                        @else
                                        Sin definir
                                        @endif</p>
                                @else
                                <br><br><br><br>
                                    <center><b>Fechas no definidas </b></center>
                                    <br>
                                    <br>
                                @endif 
                                 
                                 <hr>
                                 <center>
                                <span><a href="{{ route('fechas/editar_fechas_de_entrega',['periodo' => $periodo_academico->id_periodo_academico, 'formato' =>  config('global.seguimiento_asignatura') ]) }}" title="Editar fechas"><i class="fa fa-pencil rounded-circle" aria-hidden="true"></i></a></span>

                                </center>
                            </div>
                        </div>
                    </div>
                        <br>
                    <div class="col-sm-4">
                        <div class="card-section card-section-1 border rounded">
                            <div class="card-header card-header-1 rounded">
                                <center><h2 class="card-header-title mb-3 text-white">Actividades Complementarias</h2></center>
                            </div>
                            <div class="card-body mb-2" style="padding: 15px">
                                 @if ($fechas_de_entrega_actividades_complementarias != null)
                                    <b>Primer corte: </b>
                                     <p id="txt_seguimiento_corte_1">
                                        @if ($fechas_de_entrega_actividades_complementarias->fechainicial1 != null)
                                             {{ date('d/m/Y', strtotime($fechas_de_entrega_actividades_complementarias->fechainicial1)) }} hasta {{ date('d/m/Y', strtotime($fechas_de_entrega_actividades_complementarias->fechafinal1)) }}
                                        @else
                                        Sin definir
                                        @endif
                                       </p>
                                      <b>Segundo corte: </b>
                                     <p id="txt_seguimiento_corte_1">{{ date('d/m/Y', strtotime($fechas_de_entrega_actividades_complementarias->fechainicial2)) }} hasta {{ date('d/m/Y', strtotime($fechas_de_entrega_actividades_complementarias->fechafinal2)) }}</p>
                                      <b>Tercer corte: </b>
                                     <p id="txt_seguimiento_corte_1">{{ date('d/m/Y', strtotime($fechas_de_entrega_actividades_complementarias->fechainicial3)) }} hasta {{ date('d/m/Y', strtotime($fechas_de_entrega_actividades_complementarias->fechafinal3)) }}</p>
                                @else
                                <br><br><br><br>
                                    <center><b>Fechas no definidas </b></center>
                                    <br>
                                    <br>
                                @endif                                 
                                 <hr>
                                 <center>
                                <span><a href="{{ route('fechas/editar_fechas_de_entrega',['periodo' => $periodo_academico->id_periodo_academico, 'formato' =>  config('global.actividades_complementarias') ]) }}" title="Editar fechas"><i class="fa fa-pencil rounded-circle" aria-hidden="true"></i></a></span>

                                </center>

                            </div>
                        </div>
                    </div>
                                           
            </div>
        </div>
    </div>
</div>
</div>

    
@endsection