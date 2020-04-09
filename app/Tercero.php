<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\Paginator;

class Tercero extends Model
{
    protected $table = 'terceros';
    protected $primaryKey = 'id_tercero';

    public function getNameFull()
    {
    	return $this->nombre.' '.$this->apellido;
    }

    public function tipo()
	{
	    return $this->belongsTo(Dominio::class, 'id_dominio_tipo_ter');
	}


	public function seguimientos_asignatura()
	{
		return $this->hasMany(SeguimientoAsignatura::class, 'id_tercero');
	}

	public function grupos()
	{
		return $this->hasMany(Grupo::class, 'id_tercero');
	}

	public function asignaturas()
	{
		$asignaturas = [];
		foreach ($this->grupos as $grupo) {
			$grupo = (object) $grupo;
			if (in_array($grupo->asignatura, $asignaturas) == false) 
			  { 
			  	array_push($asignaturas, $grupo->asignatura);
			  }
		}
		return $asignaturas;
	}
}
