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

	public function asignaturas_por_periodo_academico($periodo)
	{
		$asignaturas = [];
		foreach ($this->grupos as $grupo) {
			$grupo = (object) $grupo;
			if (in_array($grupo->asignatura, $asignaturas) == false) 
			  { 
			  	if ($grupo->id_periodo_academico == $periodo) {
			  		array_push($asignaturas, $grupo->asignatura);
			  	}
			  }
		}
		return $asignaturas;
	}

	public function grupos_por_periodo_academico($periodo)
	{
		$grupos = [];
		foreach ($this->grupos as $grupo) {
			$grupo = (object) $grupo;
		  	if ($grupo->id_periodo_academico == $periodo) {
		  		array_push($grupos, $grupo);
		  	}
		}
		return $grupos;
	}

	public function num_estudiantes_por_periodo_academico($periodo)
	{
		$total = 0;
		foreach ($this->grupos as $grupo) {
			$grupo = (object) $grupo;
			if ($grupo->id_periodo_academico == $periodo) {
		  		$total += $grupo->num_est_ini;
		  	}
		}
		return $total;
	}

	public function total_horas_docencia($periodo)
	{
		$asignaturas = $this->asignaturas_por_periodo_academico($periodo);
		$total = 0;
			foreach ($asignaturas as $asignatura) {
				$total += $asignatura->horas_teoricas + $asignatura->horas_practicas;
			}
		return $total;
	}
}
