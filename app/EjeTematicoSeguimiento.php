<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EjeTematicoSeguimiento extends Model
{
    protected $table = 'eje_tematico_seguimiento';
    protected $primaryKey = 'id_eje_tematico_seguimiento';

    public function eje_tematico()
	{
	    return $this->belongsTo(EjeTematico::class, 'id_eje_tematico');
	}
	
}
