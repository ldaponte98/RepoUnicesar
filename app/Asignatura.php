<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Asignatura extends Model
{
    protected $table = 'asignatura';
    protected $primaryKey = 'id_asignatura';

    public function grupos()
	{
		return $this->hasMany(Grupo::class, 'id_asignatura');
	}

	public function asignatura_programa()
	{
		return $this->hasMany(AsignaturaPrograma::class, 'id_asignatura');
	}

	public function unidades()
	{
		return $this->hasMany(UnidadAsignatura::class, 'id_asignatura');
	}

	public function ejes_tematicos()
	{
		$ejes = [];
		$unidades = UnidadAsignatura::all()->where('id_asignatura', $this->id_asignatura);
		foreach ($unidades as $unidad) {
			foreach ($unidad->ejes_tematicos as $eje) {
				array_push($ejes, $eje);
			}
		}
		return $ejes;
	}

	
}
