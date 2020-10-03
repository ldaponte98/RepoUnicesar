<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PlanDesarrolloAsignaturaUnidad extends Model
{
    protected $table = 'plan_desarrollo_asignatura_unidad';
    protected $primaryKey = 'id_plan_desarrollo_asignatura_unidad';

    public function unidad()
    {
    	return $this->belongsTo(UnidadAsignatura::class, 'id_unidad_asignatura');
    }

    public function ejes()
    {
    	return $this->hasMany(PlanDesarrolloAsignaturaEjeTematico::class, 'id_plan_desarrollo_asignatura_unidad');
    }
}
