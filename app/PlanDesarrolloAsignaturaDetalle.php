<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PlanDesarrolloAsignaturaDetalle extends Model
{
    protected $table = 'plan_desarrollo_asignatura_detalle';
    protected $primaryKey = 'id_plan_desarrollo_asignatura_detalle';

    public function unidades()
    {
    	return $this->hasMany(PlanDesarrolloAsignaturaUnidad::class, 'id_plan_desarrollo_asignatura_detalle');
    }
}
