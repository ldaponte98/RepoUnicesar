<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PlanDesarrolloAsignaturaEjeTematico extends Model
{
    protected $table = 'plan_desarrollo_asignatura_eje_tematico';
    protected $primaryKey = 'id_plan_desarrollo_asignatura_eje_tematico';

    public function eje()
    {
    	return $this->belongsTo(EjeTematico::class, 'id_eje_tematico');
    }
}
