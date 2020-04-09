<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UnidadAsignatura extends Model
{
    protected $table = 'unidad_asignatura';
    protected $primaryKey = 'id_unidad_asignatura';

    public function ejes_tematicos()
	{
		return $this->hasMany(EjeTematico::class, 'id_unidad_asignatura');
	}

}
