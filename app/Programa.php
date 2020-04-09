<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Programa extends Model
{
    protected $table = 'programa';
    protected $primaryKey = 'id_programa';

    public function facultad()
	{
	    return $this->belongsTo(Facultad::class, 'id_facultad');
	}
}
