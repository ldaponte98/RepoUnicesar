<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Horario extends Model
{
    protected $table = 'horario';
    protected $primaryKey = 'id_horario';
    protected $fillable = [
    	'id_tercero',
    	'id_periodo_academico'
    ];
    public function detalles()
	{
	  return $this->hasMany(HorarioDetalle::class, 'id_horario');
	}

    public function obtener_evento($dia, $hora)
    {
        foreach ($this->detalles as $detalle) {
            if($detalle->dia_semana == $dia and $detalle->hora ==$hora){
                echo "<label>".$detalle->tipo_evento->dominio." <br><b>".$detalle->evento."</b> <br> </label>";
            }
         }
    }

}
