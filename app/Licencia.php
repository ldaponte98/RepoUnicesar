<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Licencia extends Model
{
     protected $table = 'licencia';
    protected $primaryKey = 'id_licencia';
    public function programa()
	{
	    return $this->belongsTo(Programa::class, 'id_programa');
	}
}
