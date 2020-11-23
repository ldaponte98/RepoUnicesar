
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
                             <div class="dropdown-menu animated slideInUp" style="position: absolute;
							    top: auto;
							    left: auto;
							    right: 35;">
	                              <a class="dropdown-item" target="_blank" href="{{ route('plan_desarrollo_asignatura/imprimir', $plan_desarrollo_asignatura->id_plan_desarrollo_asignatura) }}" style="cursor: pointer;"><i class="fa fa-balance-scale"></i> &nbsp;Plan de desarrollo asignatura</a> 
	                         </div>
	                         
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
                 			margin-bottom: 15px !important;
							transition: 0.5s ease;
							box-shadow: 5px 10px 18px #888888;
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
                 	</style>
                 	<h2><b>Clases</b></h2>
                 	@if(count($clases) > 0)
                 	@php 
                 		$cont = count($clases);
                 	@endphp
                 	@foreach($clases as $clase)
                 		<div class="card grow shadow" style="">
                 			<div class="row">
                 				<div class="col-sm-6">
                 					<strong><b>{{ $cont }}. </b><label class="mb-0">{{ $clase->tema }} </label></strong> @if(!$clase->validar_asistencia(session('id_tercero_usuario'))) 
                                    @if($clase->validar_excusa(session('id_tercero_usuario')))
                                        <span class="label label-rounded label-warning">Presente excusa</span> 
                                    @else
                                        <span class="label label-rounded label-danger">No asistí</span> 
                                    @endif
                                    @endif 
                 				</div>
                 				<div class="col-sm-6" style="text-align: right;">
                 					<a href="" title="Configuraciones de acceso"><i data-feather="settings" aria-hidden="true"></i></a>
                 				</div>
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