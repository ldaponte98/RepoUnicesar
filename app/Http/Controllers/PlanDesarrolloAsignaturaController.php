<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PlanAsignatura;
use App\PlanDesarrolloAsignatura;
use App\PlanDesarrolloAsignaturaDetalle;
use App\PlanDesarrolloAsignaturaUnidad;
use App\PlanDesarrolloAsignaturaEjeTematico;
use App\Asignatura;
use App\PeriodoAcademico;
use App\EjeTematico;
use App\UnidadAsignatura;
use App\Tercero;

class PlanDesarrolloAsignaturaController extends Controller
{
     public function view($id_tercero, $id_asignatura, $id_periodo_academico)
    {
    	$plan_desarrollo_asignatura = PlanDesarrolloAsignatura::where('id_asignatura',$id_asignatura)
						   ->where('id_periodo_academico', $id_periodo_academico)
						   ->where('id_tercero', $id_tercero)
						   ->first();
		$asignatura = Asignatura::find($id_asignatura);
		$periodo_academico = PeriodoAcademico::find($id_periodo_academico);
        $plan_asignatura = PlanAsignatura::where('id_asignatura', $id_asignatura)
                                         ->where('id_periodo_academico',$id_periodo_academico)
                                         ->first();
		$tercero = Tercero::find($id_tercero);
    	if(!$plan_desarrollo_asignatura){
    		$plan_desarrollo_asignatura = new PlanDesarrolloAsignatura;
    	}
        if(session('is_admin') == true)
            return view('plan_desarrollo_asignatura.view_admin', compact(['plan_desarrollo_asignatura','tercero', 'asignatura', 'periodo_academico']));

    	return view('plan_desarrollo_asignatura.view', compact(['plan_desarrollo_asignatura','tercero', 'asignatura', 'periodo_academico', 'plan_asignatura']));
    }

    public function obtener_fecha_sugerida(Request $request)
    {
    	$post = $request->all();
    	$fecha_inicio = "";
    	$fecha_fin = "";
    	if($post){
            $post = (object) $post;
            $fecha_inicio = date('d/m/Y', strtotime($post->fecha));
            if($post->saltarse_domingo == 1){
                $fecha_inicio = date('d/m/Y', strtotime($post->fecha.' +2 days'));
            }
    		$fecha_fin = date('d/m/Y', strtotime($post->fecha.' +5 days'));
    	}
    	return response()->json([
    		'fecha_inicio' => $fecha_inicio,
    		'fecha_fin' => $fecha_fin
    	]);
    }
}
