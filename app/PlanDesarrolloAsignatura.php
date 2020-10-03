<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PlanDesarrolloAsignatura extends Model
{
    protected $table = 'plan_desarrollo_asignatura';
    protected $primaryKey = 'id_plan_desarrollo_asignatura';

    public function detalles()
    {
    	return $this->hasMany(PlanDesarrolloAsignaturaDetalle::class, 'id_plan_desarrollo_asignatura');
    }
}
