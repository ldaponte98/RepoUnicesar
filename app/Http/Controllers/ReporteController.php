<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Reporte;

class ReporteController extends Controller
{
    public function puntualidad_formatos(Request $request)
    {
    	$post = $request->all();
    	$reporte = null;
    	$id_periodo = null;
    	$id_dominio_tipo_formato = null;
    	if ($post) {
    		$post = (object) $post;
    		$id_periodo = $post->id_periodo_academico;
    		$id_dominio_tipo_formato = $post->id_dominio_tipo_formato;


    		$reporte = (object)[
    			'total_pendientes' => 0,
				'total_enviados' => 0,
				'total_recibidos' => 0,
				'total_plazos_extra' => 0,
    			'porc_pendientes' => 0,
    			'porc_enviados' => 0,
    			'porc_recibidos' => 0,
    			'porc_plazos_extra' => 0,
    		];

    		$totales = Reporte::TotalesFormato($id_periodo, $id_dominio_tipo_formato);
    		$reporte->total_pendientes = $totales->pendientes;
    		$reporte->total_enviados = $totales->enviados;
    		$reporte->total_recibidos = $totales->recibidos;
    		$reporte->total_plazos_extra = $totales->plazos_extra;
    		$reporte->formatos = $totales->formatos;

    		$total = $totales->pendientes + $totales->enviados + $totales->recibidos;
    		$reporte->porc_pendientes = $total > 0 ? round((($totales->pendientes / $total) * 100), 1) : 0; 
			$reporte->porc_enviados = $total > 0 ? round((($totales->enviados / $total) * 100), 1) : 0; 
			$reporte->porc_recibidos = $total > 0 ? round((($totales->recibidos / $total) * 100), 1) : 0; 
			$reporte->porc_plazos_extra = $total > 0 ? round((($totales->plazos_extra / $total) * 100), 1) : 0; 

    	}
    	return view('reportes.puntualidad_formatos', compact([
    		'reporte',  'id_periodo', 'id_dominio_tipo_formato'
    	]));
    }

    public function actividades_docente(Request $request)
    {
    	$post = $request->all();
    	$reporte = null;
    	$id_periodo = null;
    	$id_tercero = 0;
    	if ($post) {
    		$post = (object) $post;
    		$id_periodo = $post->id_periodo_academico;
    		$id_tercero = $post->id_tercero;
    		$reporte = Reporte::HorasActividadesPlanTrabajo($id_periodo, $id_tercero);
    	}
    	return view('reportes.actividades_docente', compact([
    		'reporte',  'id_periodo', 'id_tercero'
    	]));
    }
}
