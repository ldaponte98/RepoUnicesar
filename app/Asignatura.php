<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Asignatura extends Model
{
    protected $table = 'asignatura';
    protected $primaryKey = 'id_asignatura';

    public function licencia()
    {
    	return $this->belongsTo(licencia::class, 'id_licencia');
    }
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

	public function programas_dirigentes()
	{
		$programas = [];
		foreach ($this->asignatura_programa as $asignatura_programa) {
			if(!in_array($asignatura_programa->programa, $programas))
				$programas[] = $asignatura_programa->programa;
		}
		return $programas;
	}

	public function facultades_dirigentes()
	{
		$facultades = [];
		foreach ($this->programas_dirigentes() as $programa) {
			if(!in_array($programa->facultad, $facultades))
				$facultades[] = $programa->facultad;
		}
		return $facultades;
	}

	public function get_string_programas_dirigentes()
	{
		$string_programas = "";
		$cont = 0;
		foreach ($this->programas_dirigentes() as $programa) {
			$string_programas .= $programa->nombre;
			$cont++;
			if($cont < count($this->programas_dirigentes())) $string_programas .= ", ";
		}
		return $string_programas;
	}

	public function get_string_facultades_dirigentes()
	{
		$string_facultades = "";
		$cont = 0;
		foreach ($this->facultades_dirigentes() as $facultad) {
			$string_facultades .= $facultad->nombre;
			$cont++;
			if($cont < count($this->facultades_dirigentes())) $string_facultades .= ", ";
		}
		return $string_facultades;
	}

	
}
