<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ActividadesPlanTrabajo extends Model
{
    protected $table = 'actividades_plan_trabajo';
    protected $primaryKey = 'id_actividad_plan_trabajo';
    protected $fillable = [
    	'id_plan_trabajo',
    	'nombre',
    	'descripcion',
    	'acta_aprobada',
    	'fecha_aprobada',
    	'fecha_iniciacion',
    	'fecha_terminacion',
    	'institucion',
    	'horas_por_semana',
    	'id_dominio_tipo'
    ];

    public function tipo()
	{
	    return $this->belongsTo(Dominio::class, 'id_dominio_tipo');
	}

	public function plan_trabajo()
	{
	    return $this->belongsTo(PlanTrabajo::class, 'id_plan_trabajo');
	}
}
