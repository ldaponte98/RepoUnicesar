<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HorarioDetalle extends Model
{
    protected $table = 'horario_detalle';
    protected $primaryKey = 'id_horario_detalle';
    protected $fillable = [
    	'id_horario',
    	'id_dominio_tipo_evento',
    	'dia_semana',
    	'hora',
    	'evento'
    ];
    public function horario()
	{
	  return $this->belongsTo(Horario::class, 'id_horario');
	}

	public function tipo_evento()
	{
	    return $this->belongsTo(Dominio::class, 'id_dominio_tipo_evento');
	}

}
