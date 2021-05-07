<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClaseCalificacion extends Model
{
	protected $table = 'clase_calificacion';
    protected $primaryKey = 'id_clase_calificacion';

    public function tercero()
    {
        return $this->belongsTo(Tercero::class, 'id_tercero');
    }

    public function clase()
    {
        return $this->belongsTo(Clase::class, 'id_clase');
    }

    public function detalles()
    {
        return $this->hasMany(ClaseCalificacionDetalle::class, 'id_clase_calificacion');
    }
}
