<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Reporte;
use App\Asignatura;
use App\Grupo;
use App\SeguimientoAsignatura;

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

    public function aprobados_reprobados(Request $request)
    {
        $post = $request->all();
        $reporte = null;
        $id_asignatura = null;
        $id_periodo = null;
        if ($post) {
            $post = (object) $post;
            $id_asignatura = $post->id_asignatura;
            $id_periodo = $post->id_periodo_academico;

            $reporte = [];
            $asignatura = Asignatura::find($id_asignatura);
            if ($asignatura) {
                //BUSCAMOS LOS GRUPOS DE LA ASIGNATURA EN EL PERIODO ACADEMICO
                $carga_academica =  Grupo::where('id_periodo_academico', $id_periodo)
                                    ->where('id_asignatura', $id_asignatura)
                                    ->get();

                foreach ($carga_academica as $carga) {
                    //AHORA SUMAMOS POR GRUPO LOS APROBADOS Y REPROBADOS POR CORTE
                    $grupo['grupo'] = 'Grupo '.$carga->codigo;
                    $grupo['docente'] = $carga->tercero;
                    $grupo['cortes'] = [];
                    for ($corte = 1; $corte <= 3 ; $corte++) { 
                        
                        $info['corte'] = $corte;
                        
                        $seguimiento = SeguimientoAsignatura::where('id_grupo', $carga->id_grupo)
                                                         ->where('estado', '<>', 'Pendiente')
                                                         ->where('corte', $corte)
                                                         ->first();
                        $info["asistentes"] = $carga->num_est_ini;
                        $info["aprobados"] = 0;
                        $info["reprobados"] = 0;
                        $info["porc_aprobados"] = 0;
                        $info["porc_reprobados"] = 0;
                        $info['id_seguimiento'] = null;
                        if ($seguimiento) {
                            $info["asistentes"] = $seguimiento->num_estudiantes;
                            $info["aprobados"] = $seguimiento->aprobados;
                            $info["reprobados"] = $seguimiento->reprobados;
                            if ($seguimiento->num_estudiantes > 0) {
                                $info["porc_aprobados"] = ($info["aprobados"] / $info["asistentes"]) * 100;
                                $info["porc_reprobados"] = ($info["reprobados"] / $info["asistentes"]) * 100;
                                $info["porc_aprobados"] = round($info["porc_aprobados"]);
                                $info["porc_reprobados"] =round($info["porc_reprobados"]);
                            }
                            $info['id_seguimiento'] = $seguimiento->id_seguimiento;
                        }


                        $grupo['cortes'][] = (object) $info;
                    }
                    $reporte[] = (object) $grupo;
                }
            }else{
                $titulo = "Error"; $mensaje = "Asignatura invalida";
                return view('sitio.error',compact(['titulo', 'mensaje']));
            }
        }

        return view('reportes.aprobados_reprobados', compact([
            'reporte',  'id_asignatura', 'id_periodo'
        ]));
    }
}
