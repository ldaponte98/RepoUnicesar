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
<form method="POST">
    @csrf
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
                            @if ($plan_desarrollo->id_plan_desarrollo_asignatura)
                                <div class="dropdown-menu animated slideInUp" style="position: absolute;
                                    top: auto;
                                    left: auto;
                                    right: 35;">
                                      <a class="dropdown-item" target="_blank" href="{{ route('plan_desarrollo_asignatura/imprimir', $plan_desarrollo->id_plan_desarrollo_asignatura) }}" style="cursor: pointer;"><i class="fa fa-balance-scale"></i> &nbsp;Plan de desarrollo asignatura</a> 
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
                        .info{
                            color: black
                        }
                        .s-select{
                            max-width: 200px;
                        }
                        .s-label-info{
                            margin-top: 10px;
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
                            .info{
                                text-align: center;
                            }
                            .s-select{
                                max-width: none;
                            }
                            .s-label-info{
                                margin-top: 0px;
                            }
                        }
                 	</style>
                 	<div class="title-h2"><h2><b>Calificacion de la clase</b></h2></div>
                    <div class="info">
                        <b>
                            <i>
                                En este apartado podras darle una calificación a la clase asistida segun los siguientes criterios: 
                            </i>
                        </b>
                    </div>
                </div>
            </div>
        </div>
    </div>
        @php
            $criterios = \App\Dominio::all()->where('id_padre', 34);
        @endphp
        @foreach ($criterios as $criterio)
        <div class="card grow" style="">
            <div class="row">
                <div class="col-sm-6">
                   <label class="s-label-info"><b>{{ $criterio->dominio }}</b></label>
                </div>
                <div class="col-sm-6 text-right">
                   <select class="form-control s-select" name="respuesta_{{ $criterio->id_dominio }}">
                       @for ($i = 0; $i <= 100 ; $i++)
                           <option value="{{ $i }}">{{ $i }}</option>
                       @endfor
                   </select>
                </div>
            </div>
        </div>
    @endforeach
    <center><button type="submit" style="width: 200px;" class="btn btn-primary">Calificar clase</button></center>
</form>
@endsection