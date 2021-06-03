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

    public function calificaciones()
    {
        return $this->hasMany(ClaseCalificacion::class, 'id_clase');
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

    public function get_calificacion_final()
    {
        $calificacion_final = 0;
        foreach ($this->calificaciones as $calificacion) {
            $calificacion_estudiante = 0;
            foreach ($calificacion->detalles as $detalle) {
                $calificacion_estudiante += ($detalle->valor / count($calificacion->detalles));
            }
            $calificacion_final += $calificacion_estudiante / count($this->calificaciones);
        }
        return round($calificacion_final);
    }

    public function cantidad_asistentes_calificaciones()
    {   $total = 0;
        foreach ($this->asistencias as $asistencia) {
            if (ClaseCalificacion::where('id_clase', $this->id_clase)
                                 ->where('id_tercero', $asistencia->id_tercero)
                                 ->first()) {
                $total++;
            }
        }
        return $total;
    }

    public function total_calificaciones($tipo = null) //positiva, neutral, negativa
    {   
        $total = 0;
        foreach ($this->calificaciones as $calificacion) {
            foreach ($calificacion->detalles as $detalle) {
                if (($tipo == "positiva" and  $detalle->valor >= 80)) $total++;
                if (($tipo == "neutral" and  $detalle->valor >= 60 and $detalle->valor < 80)) $total++;
                if (($tipo == "negativa" and  $detalle->valor < 60)) $total++;
                if ($tipo == null) $total;
            }
        }
        return $total;
    }

    public function porcentaje_calificaciones($tipo = null) //positiva, neutral, negativa
    {   
        $total = 0;
        $total_todas = 0;
        foreach ($this->calificaciones as $calificacion) {
            foreach ($calificacion->detalles as $detalle) {
                if (($tipo == "positiva" and  $detalle->valor >= 80)) $total++;
                if (($tipo == "neutral" and  $detalle->valor >= 60 and $detalle->valor < 80)) $total++;
                if (($tipo == "negativa" and  $detalle->valor < 60)) $total++;
                if ($tipo == null) $total;
                $total_todas++;
            }
        }
        return $total_todas > 0 ? ($total / $total_todas) * 100 : 0;
    }
}
