<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    protected $table = 'usuarios';

    public static $instancia;

    public static function getInstance()
    {
    	return self::$instancia;
    }
    public static function setInstance($model)
    {
    	self::$instancia = $model;
    }

	public function tercero()
	{
	    return $this->belongsTo(Tercero::class, 'id_tercero');
	}
}
