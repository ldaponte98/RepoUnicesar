
@extends('layouts.main_alumno')
@section('content')
<style type="text/css">
	.div-img-card{
		background-color: rgba(0,0,0,0.8);
		background: url('https://www.mapfrere.com/reaseguro/es/images/servicio-estudios-mapfre-1198x248_tcm636-523037.jpg'); 
		background-size: cover; 
		height: 130px;
		filter:brightness(0.4);
	}
	.card-img{
		border-top-left-radius: calc(0.25rem - 1px);
	    border-top-right-radius: calc(0.25rem - 1px);
	    border-bottom-right-radius: 0;
	    border-bottom-left-radius: 0;
	}
	/*estilo para mobile*/
     @media (max-width: 600px) {
     	.div-img-card{
     		background-size: cover; 
     		height: 130px;
        	animation: movimiento 10s infinite alternate !important;
     	}
     	@keyframes movimiento{
            from{
    	        background: url('https://www.mapfrere.com/reaseguro/es/images/servicio-estudios-mapfre-1198x248_tcm636-523037.jpg');
    	        background-size: cover; 
    			height: 130px;
    	        background-position: left center ;
	        }

	        to{
	          	background: url('https://www.mapfrere.com/reaseguro/es/images/servicio-estudios-mapfre-1198x248_tcm636-523037.jpg');
	        	background-size: cover; 
				height: 130px;
	        	background-position: right center;
	        } 
	    }

        .container-options{
            text-align: center !important;
            padding-top: 10px !important;
        }
     }

     .container-options{
        text-align: right;
        padding-top: 20px;
     }

     .label-rounded {
        font-size: 14px !important;
        border-radius: 60px;
        padding: 6px 20px 6px 20px;
    }
</style>
<div class="row">
	<div class="col-sm-12">
            <div class="card text-white">
                <div class="card-img div-img-card"></div>
                <div class="card-img-overlay text-white">
                    <div class="d-flex no-block align-items-center">
                        <h5 class="font-weight-medium text-white">{{ $tercero_grupo->grupo->asignatura->nombre }}</h5>
                        <div class="ml-auto">
                        	<a type="button" style="cursor: pointer;" class="btn-primary-outline" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span><i class="ti-menu"></i></span>
                            </a>
                            @if ($plan_desarrollo_asignatura->id_plan_desarrollo_asignatura)
                                <div class="dropdown-menu animated slideInUp" style="position: absolute;
                                    top: auto;
                                    left: auto;
                                    right: 35;">
                                      <a class="dropdown-item" target="_blank" href="{{ route('plan_desarrollo_asignatura/imprimir', $plan_desarrollo_asignatura->id_plan_desarrollo_asignatura) }}" style="cursor: pointer;"><i class="fa fa-balance-scale"></i> &nbsp;Plan de desarrollo asignatura</a> 
                                 </div>
                            @endif
                        </div>
                    </div>
                    <div class="d-inline-block">

                        <span class="display-6">Grupo {{ $tercero_grupo->grupo->codigo }}</span>
                    </div>
                </div>
                 <div class="card-body mb-2">
                 	<style>
                 		.grow{
                 			background-color: #fff;
                            color: black;
                            padding: 20px;
                            margin-bottom: 25px !important;
                            transition: 0.5s ease;
                            box-shadow: 5px 5px 10px #888888;
                            display: flex !important;
						}

						.grow:hover{
							-webkit-transform: scale(1.02);
							-ms-transform: scale(1.02);
							transform: scale(1.02);
							transition: 0.5s ease;
							box-shadow: 5px 10px 18px #888888;
						}
						.card-body {
						    height: 100%; 
						}



                        @media(max-width: 767px){
                            .grow{
                                text-align: center;
                            }
                            .ml-4{
                                margin-left: 0px !important;
                            }
                            .title-h2{
                                text-align: center;
                            }
                        }
                 	</style>
                 	<div class="title-h2"><h2><b>Clases</b></h2></div>
                 	@if(count($clases) > 0)
                 	@php 
                 		$cont = count($clases);
                 	@endphp
                 	@foreach($clases as $clase)
                    @php
                        $puede_calificar = true;
                    @endphp
                 		<div class="card grow shadow" style="">
                 			<div class="row">
                 				<div class="col-sm-6">
                 					<strong><b>#{{ $cont }} <label class="mb-0">{{ $clase->tema }} </label></b></strong> 
                                    <br>
                                    <small class="ml-4">{{ date('Y-m-d H:i', strtotime($clase->fecha_inicio)) }} - {{ date('H:i', strtotime($clase->fecha_fin)) }}</small> <br>
                                    @if(!$clase->validar_asistencia(session('id_tercero_usuario'))) 
                                        @if($clase->validar_excusa(session('id_tercero_usuario')))
                                            @php
                                                $asistencia = $clase->validar_excusa(session('id_tercero_usuario'));
                                            @endphp
                                            <span class="ml-4 mt-1 label label-rounded label-warning">
                                                <a class="text-white" href="{{ $asistencia->get_file_soporte() }}">Presente excusa</a>
                                            </span> 
                                        @else
                                        @php $puede_calificar = false; @endphp
                                            <span class="ml-4 mt-1 label label-rounded label-danger">No asistí</span> 
                                        @endif
                                    @else
                                        <span class="ml-4 mt-1 label label-rounded label-success">Asistí</span>
                                    @endif
                 				</div>
                                @if ($puede_calificar)
                                    <div class="col-sm-6 container-options">
                                        <a href="" title="Calificar clase">
                                            <i data-feather="star" aria-hidden="true"></i>
                                        </a>
                                    </div>
                                @endif
                 				
                 			</div>
                 			
                 		</div>
                 	@php 
                 		$cont -= 1;
                 	@endphp
                 	@endforeach
                    @else
                    	<center>
                    		<h3>No han iniciado las clases para este grupo.</h3>
                    		<img class="img-fluid" src="{{ asset('Imagenes/no_clases.gif') }}">
                    	</center>
                    @endif
                 </div>
            </div>
        </div>
</div>
@endsection