<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notificaciones extends Model
{
    protected $table = 'notificaciones';
    protected $primaryKey = 'id_notificacion';//
    public function tipo()
	{
	    return $this->belongsTo(Dominio::class, 'id_dominio_tipo');
	}
}
