<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\Paginator;

class Tercero extends Model
{
    protected $table = 'terceros';
    protected $primaryKey = 'id_tercero';

    public function getNameFull()
    {
    	return $this->nombre.' '.$this->apellido;
    }

    public function tipo()
	{
	    return $this->belongsTo(Dominio::class, 'id_dominio_tipo_ter');
	}

	 public function usuario()
	{
	    return $this->belongsTo(Usuario::class, 'id_tercero');
	}

	public function seguimientos_asignatura()
	{
		return $this->hasMany(SeguimientoAsignatura::class, 'id_tercero');
	}

	public function grupos()
	{
		return $this->hasMany(Grupo::class, 'id_tercero');
	}

	public function asignaturas()
	{
		$asignaturas = [];
		foreach ($this->grupos as $grupo) {
			$grupo = (object) $grupo;
			if (in_array($grupo->asignatura, $asignaturas) == false) 
			  { 
			  	array_push($asignaturas, $grupo->asignatura);
			  }
		}
		return $asignaturas;
	}

	public function asignaturas_por_periodo_academico($periodo)
	{
		$asignaturas = [];
		foreach ($this->grupos as $grupo) {
			$grupo = (object) $grupo;
			if (in_array($grupo->asignatura, $asignaturas) == false) 
			  { 
			  	if ($grupo->id_periodo_academico == $periodo) {
			  		array_push($asignaturas, $grupo->asignatura);
			  	}
			  }
		}
		return $asignaturas;
	}

	public function grupos_por_periodo_academico($periodo)
	{
		$grupos = [];
		foreach ($this->grupos as $grupo) {
			$grupo = (object) $grupo;
		  	if ($grupo->id_periodo_academico == $periodo) {
		  		array_push($grupos, $grupo);
		  	}
		}
		return $grupos;
	}

	public function num_estudiantes_por_periodo_academico($periodo)
	{
		$total = 0;
		foreach ($this->grupos as $grupo) {
			$grupo = (object) $grupo;
			if ($grupo->id_periodo_academico == $periodo) {
		  		$total += $grupo->num_est_ini;
		  	}
		}
		return $total;
	}

	public function total_horas_docencia($periodo)
	{
		$asignaturas = $this->asignaturas_por_periodo_academico($periodo);
		$total = 0;
			foreach ($asignaturas as $asignatura) {
				$total += $asignatura->horas_teoricas + $asignatura->horas_practicas;
			}
		return $total;
	}

	public function total_horas_atencion_a_estudiantes($periodo)
	{
		$asignaturas = $this->asignaturas_por_periodo_academico($periodo);
		$total = 0;
			foreach ($asignaturas as $asignatura) {
				$total += $asignatura->horas_atencion_estudiantes;
			}
		return $total;
	}

	public function total_horas_preparacion_evaluacion($periodo)
	{
		$asignaturas = $this->asignaturas_por_periodo_academico($periodo);
		$total = 0;
			foreach ($asignaturas as $asignatura) {
				$total += $asignatura->horas_preparacion_evaluacion;
			}
		return $total;
	}


	public function planes_trabajo($estado = null)
	{
		$planes = [];
		$periodos_academicos = PeriodoAcademico::all();
		foreach ($periodos_academicos as $periodo_academico) {
			$tiene_carga_academica = Grupo::where('id_tercero', $this->id_tercero)
                                          ->where('id_periodo_academico',  $periodo_academico->id_periodo_academico)
                                          ->first();
            if ($tiene_carga_academica) {
                
                $plan['id_tercero'] = $this->id_tercero;
                $plan['docente'] = $this->nombre." ".$this->apellido;
                $plan['periodo'] = $periodo_academico->periodo;
                $plan['id_periodo'] = $periodo_academico->id_periodo_academico;

                $progreso = 0;

                //aca verifico si el docente tiene un plan en este periodo
                $plan_trabajo = PlanTrabajo::where('id_tercero', $this->id_tercero)->where('id_periodo_academico',  $periodo_academico->id_periodo_academico)->first();
                if($plan_trabajo){
                    $plan['id_plan_trabajo'] = $plan_trabajo->id_plan_trabajo;
                    $plan['estado'] = $plan_trabajo->estado;
                    $plan['fecha'] = $plan_trabajo->fecha;
                    
                }else{
                    //como no existe hay q sacarle el retraso
                    $plan['id_plan_trabajo'] = null;
                    $plan['estado'] = 'Pendiente';
                    $plan['retraso'] = PlanTrabajo::retraso($this->id_tercero, $periodo_academico->id_periodo_academico);
                }

                $plan_trabajo_progreso = PlanTrabajo::find($plan['id_plan_trabajo']);
                if($plan_trabajo_progreso){
                    $total_actividades_a_entregar = count($plan_trabajo_progreso->get_tipos_de_actividades());
                     $total_actividades_realizadas = 0;
                     $suma_progreso = 0;
                    foreach ($plan_trabajo_progreso->actividades_complementarias as $actividad) {
                       $total_actividades_realizadas = count($actividad->get_tipos_de_actividades_realizadas());

                       $suma_progreso += ($total_actividades_realizadas / $total_actividades_a_entregar) * 100;
                    }
                    $result = $suma_progreso / 3; //porque son 3 cortes
                    $plan['progreso'] = round($result, 2);
                }else{
                    $plan['progreso'] = 0;
                }
                

                if ($estado and $estado != ""){
                    if($estado == $plan['estado']) array_push($planes, $plan);
                }else{
                    array_push($planes, $plan);
                }
            }
		}

		return $planes;
	}

	public function planes_desarrollo_asignatura($estado = null)
	{
		$planes = [];
        $periodos_academicos = PeriodoAcademico::all();
        $asignaturas = Asignatura::all()->where('id_licencia', session('id_licencia'));

        foreach ($periodos_academicos as $periodo_academico) {
            foreach ($asignaturas as $asignatura) {
                $tiene_carga_academica = Grupo::where('id_tercero', $this->id_tercero)
                                              ->where('id_periodo_academico',  $periodo_academico->id_periodo_academico)
                                              ->where('id_asignatura',  $asignatura->id_asignatura)
                                              ->first();


                $plan['id_tercero'] = $this->id_tercero;
                $plan['id_periodo'] = $periodo_academico->id_periodo_academico;
                $plan['periodo'] = $periodo_academico->periodo;
                $plan['id_asignatura'] = $asignatura->id_asignatura;
                $plan['asignatura'] = $asignatura->nombre." (".$asignatura->codigo.")";

                if($tiene_carga_academica){
                    $plan['tiene_carga_academica'] = 1;
                    $plan_desarrollo_asignatura = PlanDesarrolloAsignatura::where('id_tercero', $this->id_tercero)
                                              ->where('id_periodo_academico',  $periodo_academico->id_periodo_academico)
                                              ->where('id_asignatura',  $asignatura->id_asignatura)
                                              ->first();

                    if($plan_desarrollo_asignatura){
                        $plan['id_plan_desarrollo_asignatura'] = $plan_desarrollo_asignatura->id_plan_desarrollo_asignatura;
                        $plan['estado'] = $plan_desarrollo_asignatura->estado;
                        $plan['fecha'] = date('d/m/Y H:i', strtotime($plan_desarrollo_asignatura->created_at));
                    }else{
                        //como no existe hay q sacarle el retraso
                        $fecha_actual = date('Y-m-d H:i:s'); 
                        $plan['id_plan_desarrollo_asignatura'] = null;
                        $plan['estado'] = 'Pendiente';
                        $plan['retraso'] = PlanDesarrolloAsignatura::retraso($this->id_tercero, $periodo_academico->id_periodo_academico, $asignatura->id_asignatura);
                        
                    }

                    if ($estado and $estado != ""){
                        if($estado == $plan['estado']) array_push($planes, $plan);
                    }else{
                        array_push($planes, $plan);
                    }
                }
            }
        }

        return $planes;
	}
}
