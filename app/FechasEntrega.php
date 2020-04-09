<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FechasEntrega extends Model
{
    protected $table = 'fechas_entrega';
    protected $primaryKey = 'id_fecha_entrega';

    public function periodo_academico()
	{
		return $this->belongsTo(PeriodoAcademico::class, 'id_periodo_academico');
	}

	public function tipo_formato()
	{
	    return $this->belongsTo(Dominio::class, 'id_dominio_tipo_formato');
	}
}
