<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\DB;

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
                    if ($plan['retraso'] == "Tiene plazo-extra") {
                    	$plazo = PlazoDocente::where('id_tercero', $this->id_tercero)
				                   ->where('id_periodo_academico', $periodo_academico->id_periodo_academico)
				                   ->where('id_dominio_tipo_formato', config('global.plan_trabajo'))
				                   ->where('estado', 1)
				                   ->first();
				        $plan['id_plazo'] = $plazo->id_plazo_docente;
                    }
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
                        $plan['fecha'] =$plan_desarrollo_asignatura->created_at;
                    }else{
                        //como no existe hay q sacarle el retraso
                        $fecha_actual = date('Y-m-d H:i:s'); 
                        $plan['id_plan_desarrollo_asignatura'] = null;
                        $plan['estado'] = 'Pendiente';
                        $plan['retraso'] = PlanDesarrolloAsignatura::retraso($this->id_tercero, $periodo_academico->id_periodo_academico, $asignatura->id_asignatura);
                        if ($plan['retraso'] == "Tiene plazo-extra") {
                        	$plazo = PlazoDocente::where('id_tercero', $this->id_tercero)
					                   ->where('id_periodo_academico', $periodo_academico->id_periodo_academico)
					                   ->where('id_asignatura', $asignatura->id_asignatura)
					                   ->where('id_dominio_tipo_formato', config('global.desarrollo_asignatura'))
					                   ->where('estado', 1)
					                   ->first();
					        $plan['id_plazo'] = $plazo->id_plazo_docente;
                        }
                        
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


	 public function actividades_complementarias($estado = null)
    {
        $condiciones = "";
        $condiciones .= " and t.id_licencia = ".session('id_licencia');
        $condiciones .= " and a.id_tercero = '".$this->id_tercero."'";
        if ($estado) $condiciones .= " and a.estado = '".$estado."'";
        $sql = "select a.id_actividad_complementaria,
        t.id_tercero,
        concat(t.nombre,' ',t.apellido) as docente,
        a.fecha,
        a.estado,
        a.corte,
        a.id_plan_trabajo,
        a.fecha,
        p.periodo as periodo_academico
        from actividades_complementarias a
        left join plan_trabajo pl using(id_plan_trabajo)
        left join periodo_academico p on pl.id_periodo_academico = p.id_periodo_academico
        left join terceros t  on t.id_tercero = a.id_tercero
        where a.id_actividad_complementaria is not null 
        $condiciones";
        $data = DB::select($sql);

        $actividades = [];
        foreach ($data as $value) {
           $actividad = $value;
           if($value->estado == 'Pendiente') {
             $actividad->retraso = ActividadesComplementarias::find($value->id_actividad_complementaria)->retraso();
             if ($actividad->retraso == "Tiene plazo-extra") {
            	$plazo = PlazoDocente::where('id_tercero', $this->id_tercero)
                                   ->where('id_formato', $actividad->id_actividad_complementaria)
                                   ->where('id_dominio_tipo_formato', config('global.actividades_complementarias'))
                                   ->where('estado', 1)
                                   ->first();
		        $actividad->id_plazo = $plazo->id_plazo_docente;
            }
           }
           //calculo el progreso que lleva de terminada las actividades complementarias segun el plan de trabajo
            $total_actividades_a_entregar = count(PlanTrabajo::find($value->id_plan_trabajo)->get_tipos_de_actividades_para_actividades_complementarias());
            $total_actividades_realizadas = count(ActividadesComplementarias::find($value->id_actividad_complementaria)->get_tipos_de_actividades_realizadas());
          
          if($total_actividades_a_entregar != 0){
            $actividad->progreso = ($total_actividades_realizadas / $total_actividades_a_entregar) * 100;
          }else{
            $actividad->progreso  = 100;
          }
            
           array_push($actividades, $actividad);
        }
        return $actividades;
    }

    public function menu_asignaturas()
    {
        $grupos = TerceroGrupo::where('id_tercero', $this->id_tercero)
                       ->where('estado','<>',0)
                       ->orderBy('id_tercero_grupo','desc')
                       ->get();
        $asignaturas = [];
        $asignaturas_ya_ingresadas = [];
        
        foreach ($grupos as $tercero_grupo) {
            
            $fecha_inicio_periodo = date('Y-m-d', strtotime($tercero_grupo->grupo->periodo_academico->fechaInicio));
            $fecha_fin_periodo = date('Y-m-d', strtotime($tercero_grupo->grupo->periodo_academico->fechaFin));
            $fecha_actual = date('Y-m-d');
            
            if($fecha_actual >= $fecha_inicio_periodo and $fecha_actual <= $fecha_fin_periodo){
                if($tercero_grupo->estado != 0){ // si es 0 significa que el docente le nego el acceso
                    $asignatura['id_asignatura'] = $tercero_grupo->grupo->id_asignatura;
                    $asignatura['nombre_asignatura'] = $tercero_grupo->grupo->asignatura->nombre;
                    $asignatura['codigo_asignatura'] = $tercero_grupo->grupo->asignatura->codigo;
                    $asignatura['grupos']  = [];
                    //recorremos todos los grupos para asignarlos a las asignaturas
                    foreach ($grupos as $tercero_grupo_aux) {
                        if($tercero_grupo_aux->grupo->id_asignatura == $asignatura['id_asignatura']){
                            $grupo['id_grupo'] = $tercero_grupo_aux->grupo->id_grupo;
                            $grupo['codigo'] = $tercero_grupo_aux->grupo->codigo;
                            $grupo['acceso'] = $tercero_grupo_aux->estado;
                            $grupo['id_periodo_academico'] = $tercero_grupo_aux->grupo->id_periodo_academico;

                            array_push($asignatura['grupos'], (object) $grupo);
                        }
                    }

                    //ahora agregamos la asignatura
                    if(!in_array($asignatura['id_asignatura'], $asignaturas_ya_ingresadas)){
                        $asignaturas_ya_ingresadas[] = $asignatura['id_asignatura'];
                        array_push($asignaturas, (object) $asignatura);
                    }
                }
            }
        }

        return $asignaturas;
    }
}
