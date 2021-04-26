<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClaseAsistencia extends Model
{
    protected $table = 'clase_asistencia';
    protected $primaryKey = 'id_clase_asistencia';

    public function tercero()
    {
        return $this->belongsTo(Tercero::class, 'id_tercero');
    }

    public function clase()
    {
        return $this->belongsTo(Clase::class, 'id_clase');
    }

    public function get_soporte()
    {	
    	$soporte = "Ninguno";
    	if ($this->asistio == 1 and $this->archivo_excusa != null and $this->archivo_excusa != "") {
    		$soporte = "<a href='".asset("files/asistencias/".$this->archivo_excusa)."'>
							<i data-feather='user' aria-hidden='true'></i>
						</a>";
    	}
    	return $soporte;
    }
}
