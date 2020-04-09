<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AsignaturaPrograma extends Model
{
    protected $table = 'asignatura_programa';
    protected $primaryKey = 'id_asignatura_programa';

    public function asignatura()
	{
	    return $this->belongsTo(Asignatura::class, 'id_asignatura');
	}
	public function programa()
	{
	    return $this->belongsTo(Programa::class, 'id_programa');
	}
}
