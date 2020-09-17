<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PlanAsignaturaUnidad extends Model
{
    protected $table = 'plan_asignatura_unidad';
    protected $primaryKey = 'id_plan_asignatura_unidad';

    public function ejes_tematicos()
    {
    	return $this->hasMany(PlanAsignaturaEjeTematico::class, 'id_plan_asignatura_unidad');
    }
}
