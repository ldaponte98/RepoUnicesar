<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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

        
        if ($fecha_actual <= $fechas_de_entrega->fechafinal1 and $fecha_actual >= $fechas_de_entrega->fechaInicial1){
        	if($estado == "Recibido"){//aca no puede modificar porq	el jefe ya lo reviso
        		return false;
        	}
			return true;
		}else{
			if($id_plan_trabajo != null){
				 $plazo_extra = PlazoDocente::where('id_tercero', $id_tercero)
                                       ->where('id_formato', $id_plan_trabajo)
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
			}
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
}
