<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CodigoAcceso extends Model
{
    protected $table = 'codigo_acceso';
    protected $primaryKey = 'id_codigo_acceso';

    public function grupo()
	{
		return $this->belongsTo(Grupo::class, 'id_grupo');
	}

	public function plan_desarrollo_asignatura()
	{
		return $this->belongsTo(PlanDesarrolloAsignatura::class, 'id_plan_desarrollo_asignatura');
	}

	public static function validar($token)
	{
		$error = true;
		$message = "";
		$codigo_acceso = CodigoAcceso::where('token', $token)
                                 ->where('estado', 1)
                                 ->first();
        if($codigo_acceso){
            //ahora se valida si esta en fechas validas para el uso del token dependiendo de la fecha del periodo academico
            $periodo = $codigo_acceso->plan_desarrollo_asignatura->periodo_academico;
            $fecha_actual = date('Y-m-d');
            $fecha_fin_periodo = date('Y-m-d', strtotime($periodo->fechaFin));
            $fecha_inicio_periodo = date('Y-m-d', strtotime($periodo->fechainicio));
            if($fecha_actual <= $fecha_fin_periodo and $fecha_actual >= $fecha_inicio_periodo){
                 $error = false;   
            }else{
                $message = "Codigo de acceso expirado.";
            }
        }else{
            $message = "Codigo de acceso invalido.";
        }

        return (object)[
        	'error' => $error,
        	'message' => $message
        ];
	}
}
