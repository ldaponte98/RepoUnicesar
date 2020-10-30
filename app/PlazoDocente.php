<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PlazoDocente extends Model
{
    protected $table = 'plazo_docente';
    protected $primaryKey = 'id_plazo_docente';

    public function tipo_formato()
	{
	    return $this->belongsTo(Dominio::class, 'id_dominio_tipo_formato');
	}

	public function tercero()
	{
	    return $this->belongsTo(Tercero::class, 'id_tercero');
	}

	public function asignatura()
	{
	    return $this->belongsTo(Asignatura::class, 'id_asignatura');
	}

	public function periodo_academico()
	{
		return $this->belongsTo(PeriodoAcademico::class, 'id_periodo_academico');
	}
}
