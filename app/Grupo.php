<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Grupo extends Model
{
    protected $table = 'grupo';
    protected $primaryKey = 'id_grupo';

    public function periodo_academico()
	{
		return $this->belongsTo(PeriodoAcademico::class, 'id_periodo_academico');
	}

	public function asignatura()
	{
		return $this->belongsTo(Asignatura::class, 'id_asignatura');
	}

	public function tercero()
	{
		return $this->belongsTo(Tercero::class, 'id_tercero');
	}
}
