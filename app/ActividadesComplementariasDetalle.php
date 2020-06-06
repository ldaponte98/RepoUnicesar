<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ActividadesComplementariasDetalle extends Model
{
    protected $table = 'actividades_complementarias_detalle';
    protected $primaryKey = 'id_actividad_complementaria_detalle';

    public function actividad_plan_trabajo()
	{
		return $this->belongsTo(ActividadesPlanTrabajo::class, 'id_actividad_plan_trabajo');
	}
}
