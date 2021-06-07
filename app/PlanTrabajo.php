<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class PlanTrabajo extends Model
{
    protected $table = 'plan_trabajo';
    protected $primaryKey = 'id_plan_trabajo';

    protected $fillable = [
    	  'id_tercero',
    	  'id_periodo_academico',
	      'total_asignaturas',
	      'total_grupos',
	      'total_estudiantes',
	      'horas_docencia_directa',
	      'horas_atencion_estudiantes',
	      'horas_preparacion_evaluacion',
	      'horas_dedicadas_actividades',
	      'horas_orientacion_proyectos',
	      'horas_investigacion',
	      'horas_proyeccion_social',
	      'horas_cooperacion',
	      'horas_crecimiento_personal',
	      'horas_actividades_administrativas',
	      'horas_otras_actividades',
	      'horas_actividades_complementarias',
	      'observaciones',
	      'estado'
    ];


    public function tercero()
	{
	    return $this->belongsTo(Tercero::class, 'id_tercero');
	}

	public function periodo_academico()
	{
		return $this->belongsTo(PeriodoAcademico::class, 'id_periodo_academico');
	}

	public function actividades()
	{
		return $this->hasMany(ActividadesPlanTrabajo::class, 'id_plan_trabajo');
	}

	public function actividades_complementarias()
	{
		return $this->hasMany(ActividadesComplementarias::class, 'id_plan_trabajo');
	}

	public static function tiene_permiso_para_editar($id_tercero,$id_periodo_academico, $id_plan_trabajo = null, $estado = null)
	{
		$periodo = PeriodoAcademico::find($id_periodo_academico);
    	$fechas_de_entrega = FechasEntrega::where('id_periodo_academico',$periodo->id_periodo_academico)
                            ->where('id_dominio_tipo_formato',config('global.plan_trabajo'))
                            ->where('id_licencia',session('id_licencia'))
    						->first();
    	$fecha_actual = date('Y-m-d');
    	if($fechas_de_entrega){
        
        if ($fecha_actual <= $fechas_de_entrega->fechafinal1 and $fecha_actual >= $fechas_de_entrega->fechaInicial1){
        	if($estado == "Recibido"){//aca no puede modificar porq	el jefe ya lo reviso
        		return false;
        	}
			return true;
		}else{
				 $plazo_extra = PlazoDocente::where('id_tercero', $id_tercero)
			                   ->where('id_periodo_academico', $id_periodo_academico)
			                   ->where('id_dominio_tipo_formato', config('global.plan_trabajo'))
			                   ->where('estado', 1)
			                   ->first();

                if ($plazo_extra) {
	                $fecha_inicio_plazo = date('Y-m-d', strtotime($plazo_extra->fecha_inicio));
	                $fecha_fin_plazo = date('Y-m-d', strtotime($plazo_extra->fecha_fin));
	                if ($fecha_actual >= $fecha_inicio_plazo and $fecha_actual <= $fecha_fin_plazo) {
	                   return true;
	                }
	            }
			return false;
		}
	}else{
		return false;
	}
            
	}

	public function get_tipos_de_actividades()
	{
	 $actividades_plan_trabajo = ActividadesPlanTrabajo::all()->where('id_plan_trabajo', $this->id_plan_trabajo);
	  $tipos_de_actividades = [];
	  $tipos_de_actividades_ya_insertadas = [];
	  foreach ($actividades_plan_trabajo as $actividad_plan_trabajo) {
	  	if (!in_array($actividad_plan_trabajo->id_dominio_tipo, $tipos_de_actividades_ya_insertadas)) {
	  		$tipo = Dominio::find($actividad_plan_trabajo->id_dominio_tipo);
	  		array_push($tipos_de_actividades, $tipo);
	  		array_push($tipos_de_actividades_ya_insertadas, $tipo->id_dominio);
	  	}
	  }

	  return $tipos_de_actividades;
	}

	public function get_tipos_de_actividades_para_actividades_complementarias()
	{
	 $actividades_plan_trabajo = ActividadesPlanTrabajo::all()->where('id_plan_trabajo', $this->id_plan_trabajo);
	  $tipos_de_actividades = [];
	  $tipos_de_actividades_ya_insertadas = [];
	  foreach ($actividades_plan_trabajo as $actividad_plan_trabajo) {
	  	if($actividad_plan_trabajo->requiere_actividad_complementaria == 1){
		  	if (!in_array($actividad_plan_trabajo->id_dominio_tipo, $tipos_de_actividades_ya_insertadas)) {
		  		$tipo = Dominio::find($actividad_plan_trabajo->id_dominio_tipo);
		  		array_push($tipos_de_actividades, $tipo);
		  		array_push($tipos_de_actividades_ya_insertadas, $tipo->id_dominio);
		  	}
		}
	  }

	  return $tipos_de_actividades;
	}

	public function get_actividades_por_tipo($tipo_actividad)
	{
		$actividades = [];
		foreach ($this->actividades as $actividad) {
			if($actividad->id_dominio_tipo == $tipo_actividad) array_push($actividades, $actividad);
		}
	  return $actividades;
	}

	public function get_actividades_para_actividades_complementarias_por_tipo($tipo_actividad){
		$actividades = [];
		foreach ($this->actividades as $actividad) {
			if($actividad->id_dominio_tipo == $tipo_actividad and $actividad->requiere_actividad_complementaria == 1) array_push($actividades, $actividad);
		}
	  return $actividades;
	}

	public static function retraso($id_tercero, $id_periodo_academico)
	{
		$fecha_actual = date('Y-m-d H:i:s');
        $fechas_de_entrega = FechasEntrega::where('id_periodo_academico',$id_periodo_academico)
                ->where('id_dominio_tipo_formato',config('global.plan_trabajo'))
                ->first();

        $plazo_extra = PlazoDocente::where('id_tercero', $id_tercero)
                   ->where('id_periodo_academico', $id_periodo_academico)
                   ->where('id_dominio_tipo_formato', config('global.plan_trabajo'))
                   ->where('estado', 1)
                   ->first();
        if ($plazo_extra) {
        	return "Tiene plazo-extra";
            $fecha_inicio_plazo = date('Y-m-d H:i:s', strtotime($plazo_extra->fecha_inicio));
            $fecha_fin_plazo = date('Y-m-d H:i:s', strtotime($plazo_extra->fecha_fin));
            if ($fecha_actual >= $fecha_inicio_plazo and $fecha_actual <= $fecha_fin_plazo) {
               return "Tiene plazo-extra";
            }            
        }

        if($fechas_de_entrega){
            if ($fecha_actual <= $fechas_de_entrega->fechafinal1){
                return "En espera";
            }else{
                $fechacierre = date("Y-m-d H:i:s", strtotime($fechas_de_entrega->fechafinal1));
                $fecha_actual = date_create($fecha_actual);
                $fechacierre = date_create($fechacierre);
                $diferencia = date_diff($fecha_actual,$fechacierre);
                $dias = $diferencia->days;
                $horas = $diferencia->h;
                return "Retrasado $dias dias y $horas horas";
            }
        }else{
            return "Fechas sin definir";
        }
	}


	public static function reporte($periodo_academico = "", $id_tercero = "", $estado = ""){
		$condiciones1 = "";
        $condiciones2 = "";
        if ($periodo_academico and $periodo_academico != "") $condiciones1 .= " where id_periodo_academico = ".$periodo_academico;
        if ($id_tercero and $id_tercero != "") $condiciones2 .= " and id_tercero = ".$id_tercero;
        
        $docentes = Tercero::all()
                    ->where('id_licencia', session('id_licencia'));
        $planes = [];
        $sql = "select * from periodo_academico $condiciones1"; 
        $periodos_academicos = DB::select($sql);
        $sql2 = "select * from terceros where id_dominio_tipo_ter = 3 and id_licencia = ".session('id_licencia')." $condiciones2"; 
        $docentes = DB::select($sql2);

        foreach ($periodos_academicos as $periodo_academico) {
            foreach ($docentes as $docente) {
                //miramos si tiene carga academica 
                $tiene_carga_academica = Grupo::where('id_tercero', $docente->id_tercero)
                                                  ->where('id_periodo_academico',  $periodo_academico->id_periodo_academico)
                                                  ->first();
                if ($tiene_carga_academica) {
                    $plan['id_tercero'] = $docente->id_tercero;
                    $plan['docente'] = $docente->nombre." ".$docente->apellido;
                    $plan['periodo'] = $periodo_academico->periodo;

                    $progreso = 0;

                    //aca verifico si el docente tiene un plan en este periodo
                    $plan_trabajo = PlanTrabajo::where('id_tercero', $docente->id_tercero)->where('id_periodo_academico',  $periodo_academico->id_periodo_academico)->first();
                    if($plan_trabajo){
                        $plan['id_plan_trabajo'] = $plan_trabajo->id_plan_trabajo;
                        $plan['estado'] = $plan_trabajo->estado;
                        $plan['fecha'] = $plan_trabajo->fecha;
                        
                    }else{
                        //como no existe hay q sacarle el retraso
                        $plan['id_plan_trabajo'] = null;
                        $plan['estado'] = 'Pendiente';
                        $plan['retraso'] = PlanTrabajo::retraso($docente->id_tercero, $periodo_academico->id_periodo_academico);

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
                    } else{
                        array_push($planes, $plan);
                    }
                }
            }
        }
        
        return $planes;
	}
}
