<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
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
            $plan_desarrollo_asignatura->id_periodo_academico = $periodo_academico->id_periodo_academico;
            $plan_desarrollo_asignatura->id_asignatura = $asignatura->id_asignatura;
    	}
        if(session('is_admin') == true){
            return view('plan_desarrollo_asignatura.view_admin', compact(['plan_desarrollo_asignatura','tercero', 'asignatura', 'periodo_academico']));
        }
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
            $fecha_fin = date('d/m/Y', strtotime($post->fecha.' +5 days'));
            if($post->saltarse_domingo == 1){
                $fecha_inicio = date('d/m/Y', strtotime($post->fecha.' +2 days'));
                $fecha_fin = date('d/m/Y', strtotime($post->fecha.' +7 days'));
            }
    		
    	}
    	return response()->json([
    		'fecha_inicio' => $fecha_inicio,
    		'fecha_fin' => $fecha_fin
    	]);
    }

    public function editar(Request $request)
    {
       $post = $request->all();
       $error = true;
       $message = "";
       $errors = [];
       if($post){
            $post = (object) $post;
            $plan_desarrollo = PlanDesarrolloAsignatura::find($post->id_plan_desarrollo_asignatura);
            if(!$plan_desarrollo){
                $plan_desarrollo = new PlanDesarrolloAsignatura;
                $plan_desarrollo->id_tercero = session('id_tercero_usuario');
                $plan_desarrollo->id_asignatura = $post->id_asignatura;
                $plan_desarrollo->id_periodo_academico = $post->id_periodo_academico;
                $plan_desarrollo->save();
            }

            $result_delete = DB::statement('delete from plan_desarrollo_asignatura_eje_tematico where id_plan_desarrollo_asignatura = '.$plan_desarrollo->id_plan_desarrollo_asignatura);
            $result_delete = DB::statement('delete from plan_desarrollo_asignatura_unidad where id_plan_desarrollo_asignatura = '.$plan_desarrollo->id_plan_desarrollo_asignatura);
            $result_delete = DB::statement('delete from plan_desarrollo_asignatura_detalle where id_plan_desarrollo_asignatura = '.$plan_desarrollo->id_plan_desarrollo_asignatura);
            
            //ahora recorremos los detalles
            $cont = 1;
            foreach ($post->detalles as $detalle) {
                $detalle = (object) $detalle;
                $plan_desarrollo_detalle = new PlanDesarrolloAsignaturaDetalle;
                $plan_desarrollo_detalle->id_plan_desarrollo_asignatura = $plan_desarrollo->id_plan_desarrollo_asignatura;
                $plan_desarrollo_detalle->semana = $detalle->semana;
                $fecha_inicio = explode("/", $detalle->fecha_inicio)[2]."-".explode("/", $detalle->fecha_inicio)[1]."-".explode("/", $detalle->fecha_inicio)[0];
                $fecha_fin = explode("/", $detalle->fecha_fin)[2]."-".explode("/", $detalle->fecha_fin)[1]."-".explode("/", $detalle->fecha_fin)[0];
                
                $plan_desarrollo_detalle->fecha_inicio = date('Y-m-d', strtotime($fecha_inicio));
                $plan_desarrollo_detalle->fecha_fin = date('Y-m-d', strtotime($fecha_fin));
                $plan_desarrollo_detalle->titulo_semana_parciales = $detalle->titulo_semana_parciales;
                $plan_desarrollo_detalle->temas_trabajo_independiente = $detalle->temas_trabajo;
                $plan_desarrollo_detalle->estrategias_metodologicas = $detalle->estrategias_metodologicas;
                $plan_desarrollo_detalle->competencias = $detalle->competencias;
                $plan_desarrollo_detalle->evaluacion_academica = $detalle->evaluacion_academica;
                $plan_desarrollo_detalle->bibliografia = $detalle->bibliografia;
                $plan_desarrollo_detalle->is_semana_parciales = false;
                if($detalle->semana_parciales != "false")  $plan_desarrollo_detalle->is_semana_parciales = true;
                
                if($plan_desarrollo_detalle->save()){
                    if($plan_desarrollo_detalle->is_semana_parciales == false){
                        foreach ($detalle->unidades_escojidas as $unidad_escojida) {
                            $unidad_escojida = (object) $unidad_escojida;
                            $unidad_plan_desarrollo = new PlanDesarrolloAsignaturaUnidad;
                            $unidad_plan_desarrollo->id_plan_desarrollo_asignatura = $plan_desarrollo_detalle->id_plan_desarrollo_asignatura;
                            $unidad_plan_desarrollo->id_plan_desarrollo_asignatura_detalle  = $plan_desarrollo_detalle->id_plan_desarrollo_asignatura_detalle;
                            $unidad_plan_desarrollo->id_unidad_asignatura = $unidad_escojida->id_unidad;
                            if($unidad_plan_desarrollo->save()){
                                foreach ($unidad_escojida->ejes as $eje_escojido) {
                                    $eje_escojido = (object) $eje_escojido;
                                    $eje_plan_desarrollo = new PlanDesarrolloAsignaturaEjeTematico;
                                    $eje_plan_desarrollo->id_plan_desarrollo_asignatura = $plan_desarrollo->id_plan_desarrollo_asignatura;
                                    $eje_plan_desarrollo->id_plan_desarrollo_asignatura_unidad  = $unidad_plan_desarrollo->id_plan_desarrollo_asignatura_unidad;
                                    $eje_plan_desarrollo->id_eje_tematico = $eje_escojido->id_eje;
                                    if(!$eje_plan_desarrollo->save()){
                                        $message = "Ocurrio un error al guardar el tema de docencia directa '".$eje_escojido->nombre."' de la semana $cont.";
                                        $errors = $eje_plan_desarrollo->errors;
                                    }
                                }
                            }else{
                                $message = "Ocurrio un error al guardar el eje tematico '".$unidad_escojida->nombre."' de la semana $cont.";
                                $errors = $unidad_plan_desarrollo->errors;
                            }
                        }
                    }
                }else{
                    $message = "Ocurrio un error al guardar la informacion de la semana $cont.";
                    $errors = $plan_desarrollo_detalle->errors;
                }

                $cont++;
            }

            //aca ya registro bien todos los detalles
            $error = false;
            $message = "Plan de desarrollo asignatura actualizado correctamente.";
       }else{
            $message = "Error en la informacion enviada.";
       }

       if(count($errors) > 0) $error = true;

       return response()->json([
            'error' => $error,
            'message' => $message,
            'errors' => $errors
       ]);
    }

    public function imprimir($id_plan_desarrollo_asignatura)
    {
        echo "<br><br><br><center><h1>Formato en proceso de desarrollo</h1></center>";
    }
}
