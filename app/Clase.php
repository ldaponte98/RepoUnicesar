<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Clase extends Model
{
    protected $table = 'clases';
    protected $primaryKey = 'id_clase';

    public function grupo()
    {
        return $this->belongsTo(Grupo::class, 'id_grupo');
    }

    public function alumnos()
    {   
        $terceros = TerceroGrupo::all()->where('id_grupo', $this->id_grupo);
        foreach ($terceros as $tercero) {
            $tercero->asistencia = ClaseAsistencia::where('id_clase', $this->id_clase)
                                                  ->where('id_tercero', $tercero->id_tercero)
                                                  ->first();
        }
        return $terceros;
    }

    public function detalles()
    {
    	return $this->hasMany(ClaseDetalle::class, 'id_clase');
    }

    public function asistencias()
    {
        return $this->hasMany(ClaseAsistencia::class, 'id_clase');
    }

    public function validar_asistencia($id_tercero)
    {
    	$asistencia = ClaseAsistencia::where('id_tercero', $id_tercero)
    								 ->where('id_clase', $this->id_clase)
    								 ->where('asistio', 1)
    								 ->first();
   		if($asistencia) return true;

   		return false;
    }

    public function validar_excusa($id_tercero)
    {
    	$excusa = ClaseAsistencia::where('id_tercero', $id_tercero)
    								 ->where('id_clase', $this->id_clase)
    								 ->where('excusa', 1)
    								 ->first();
   		if($excusa) return $excusa;

   		return false;
    }
}
