<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reporte extends Model
{
    public static function TotalesFormato($id_periodo, $id_dominio_tipo_formato)
    {
    	$formatos = [];
    	$pendientes = 0;
    	$enviados = 0;
    	$recibidos = 0;
    	$plazos_extra = 0;
    	switch ($id_dominio_tipo_formato) {
    		case config('global.plan_trabajo'):
    			$formatos = PlanTrabajo::reporte($id_periodo);
    			break;
    		case config('global.desarrollo_asignatura'):
    			$formatos = PlanDesarrolloAsignatura::reporte($id_periodo);
    			break;
    		case config('global.seguimiento_asignatura'):
    			$formatos = SeguimientoAsignatura::reporte($id_periodo);
    			break;
    		case config('global.actividades_complementarias'):
    			$formatos = ActividadesComplementarias::reporte($id_periodo);
    			break;
    	}

    	$plazos_extra = count(PlazoDocente::reporte($id_dominio_tipo_formato, $id_periodo));
    	foreach ($formatos as $formato) {
    		$formato = (object) $formato;
    		if ($formato->estado == "Pendiente") $pendientes++;
    		if ($formato->estado == "Enviado") $enviados++;
    		if ($formato->estado == "Recibido") $recibidos++;
    	}

    	return (object) [
    		'pendientes' => $pendientes,
			'enviados' => $enviados,
			'recibidos' => $recibidos,
			'plazos_extra' => $plazos_extra,
			'formatos' => $formatos
    	];
    }

    public static function HorasActividadesPlanTrabajo($id_periodo, $id_docente = 0)
    {
        $planes_trabajo = PlanTrabajo::where('id_periodo_academico', $id_periodo);
        if ($id_docente != 0) $planes_trabajo->where('id_tercero', $id_docente);
        $planes_trabajo = $planes_trabajo->get();
        $reporte = (object)[
            'total_orientacion' => 0,
            'total_investigacion' => 0,
            'total_proyeccion' => 0,
            'total_cooperacion' => 0,
            'total_crecimiento' => 0,
            'total_actividades' => 0,
            'total_otras' => 0,
            'max_horas' => 0
        ];
        foreach ($planes_trabajo as $plan) {
            $reporte->total_orientacion += $plan->horas_orientacion_proyectos;
            $reporte->total_investigacion += $plan->horas_investigacion;
            $reporte->total_proyeccion += $plan->horas_proyeccion_social;
            $reporte->total_cooperacion += $plan->horas_cooperacion;
            $reporte->total_crecimiento += $plan->horas_crecimiento_personal;
            $reporte->total_actividades += $plan->horas_actividades_administrativas;
            $reporte->total_otras += $plan->horas_otras_actividades;
        }
        if ($reporte->total_orientacion > $reporte->max_horas) $reporte->max_horas = $reporte->total_orientacion;
        if ($reporte->total_investigacion > $reporte->max_horas) $reporte->max_horas = $reporte->total_investigacion;
        if ($reporte->total_proyeccion > $reporte->max_horas) $reporte->max_horas = $reporte->total_proyeccion;
        if ($reporte->total_cooperacion > $reporte->max_horas) $reporte->max_horas = $reporte->total_cooperacion;
        if ($reporte->total_crecimiento > $reporte->max_horas) $reporte->max_horas = $reporte->total_crecimiento;
        if ($reporte->total_actividades > $reporte->max_horas) $reporte->max_horas = $reporte->total_actividades;
        if ($reporte->total_otras > $reporte->max_horas) $reporte->max_horas = $reporte->total_otras;
        return $reporte;
    }
}
