<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UnidadAsignaturaSeguimiento extends Model
{
    protected $table = 'unidad_asignatura_seguimiento';
    protected $primaryKey = 'id_unidad_asignatura_seguimiento';

    public function unidad_asignatura()
	{
	    return $this->belongsTo(UnidadAsignatura::class, 'id_unidad_asignatura');
	}
}
