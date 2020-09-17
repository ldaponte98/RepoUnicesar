<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\PlanAsignatura;
use App\PlanAsignaturaDetalle;
use App\PlanAsignaturaUnidad;
use App\PlanAsignaturaEjeTematico;
use App\Asignatura;
use App\PeriodoAcademico;
use App\EjeTematico;
use App\UnidadAsignatura;

class PlanAsignaturaController extends Controller
{
    public function view($id_asignatura, $id_periodo_academico)
    {
    	$plan_asignatura = PlanAsignatura::where('id_asignatura',$id_asignatura)
						   ->where('id_periodo_academico', $id_periodo_academico)
						   ->first();
		$asignatura = Asignatura::find($id_asignatura);
		$periodo_academico = PeriodoAcademico::find($id_periodo_academico);
    	if(!$plan_asignatura){
    		$plan_asignatura = new PlanAsignatura;
    	}
    	return view('plan_asignatura.view', compact(['plan_asignatura','asignatura', 'periodo_academico']));
    }

    public function editar(Request $request)
    {   
        $post = $request->all();

        $error = true;
        $message = "";
        $errors = [];
        if($post){
            $post = (object) $post;
            $plan_asignatura = PlanAsignatura::find($post->id_plan_asignatura);
            if(!$plan_asignatura) $plan_asignatura = new PlanAsignatura;

            $plan_asignatura->descripcion_asignatura = $post->descripcion_asignatura;
            $plan_asignatura->objetivo_general = $post->objetivo_general;
            $plan_asignatura->id_asignatura = $post->id_asignatura;
            $plan_asignatura->id_periodo_academico = $post->id_periodo_academico;

            if($plan_asignatura->save()){
                if(isset($post->detalles)){
                   foreach ($post->detalles as $detalle) {
                        $detalle = (object) $detalle;
                        $detalle_plan_asignatura = PlanAsignaturaDetalle::find($detalle->id_detalle);
                        if(!$detalle_plan_asignatura) $detalle_plan_asignatura = new PlanAsignaturaDetalle;
                        $detalle_plan_asignatura->id_plan_asignatura = $plan_asignatura->id_plan_asignatura;
                        $detalle_plan_asignatura->nombre = $detalle->nombre;
                        $detalle_plan_asignatura->id_dominio_tipo = $detalle->tipo;
                        $detalle_plan_asignatura->save();
                    } 
                }
                

                //ahora se guardan o actualizan las unidades y ejes tematicos
                $result_delete = DB::statement('delete from plan_asignatura_eje_tematico where id_plan_asignatura = '.$plan_asignatura->id_plan_asignatura);
                $result_delete = DB::statement('delete from plan_asignatura_unidad where id_plan_asignatura = '.$plan_asignatura->id_plan_asignatura);
                if(isset($post->unidades)){
                    foreach ($post->unidades as $unidad) {
                        $unidad = (object) $unidad;
                        $unidad_asignatura = UnidadAsignatura::find($unidad->id_unidad);
                        if(!$unidad_asignatura) $unidad_asignatura = new UnidadAsignatura;
                        $unidad_asignatura->nombre = $unidad->nombre;
                        $unidad_asignatura->id_asignatura = $post->id_asignatura;
                        $unidad_asignatura->save();

                        $unidad_plan_asignatura = new PlanAsignaturaUnidad;
                        $unidad_plan_asignatura->id_plan_asignatura = $plan_asignatura->id_plan_asignatura;
                        $unidad_plan_asignatura->id_unidad = $unidad_asignatura->id_unidad_asignatura;
                        $unidad_plan_asignatura->resultados_aprendizaje = $unidad->resultado_aprendizaje;
                        $unidad_plan_asignatura->horas_hdd = $unidad->horas_hdd;
                        $unidad_plan_asignatura->horas_htp = $unidad->horas_htp;
                        $unidad_plan_asignatura->horas_hti = $unidad->horas_hti;
                        $unidad_plan_asignatura->horas_htt = $unidad->horas_htt;
                        $unidad_plan_asignatura->save();

                        //ahora recorremos las competencias de la unidad
                        
                        foreach ($unidad->competencias as $competencia) {
                            $competencia = (object) $competencia;
                            $eje_tematico = EjeTematico::find($competencia->id_competencia);
                            if(!$eje_tematico) $eje_tematico = new EjeTematico;
                            $eje_tematico->nombre = $competencia->nombre;
                            $eje_tematico->id_unidad_asignatura = $unidad_asignatura->id_unidad_asignatura;
                            $eje_tematico->save();

                            $eje_plan_asignatura = new PlanAsignaturaEjeTematico;
                            $eje_plan_asignatura->id_plan_asignatura = $plan_asignatura->id_plan_asignatura;
                            $eje_plan_asignatura->id_plan_asignatura_unidad = $unidad_plan_asignatura->id_plan_asignatura_unidad;
                            $eje_plan_asignatura->id_eje_tematico = $eje_tematico->id_eje_tematico;
                            $eje_plan_asignatura->save();
                        }
                    }
                }

                $error = false;
                $message = "Plan de asignatura actualizado exitosamente.";
            }else{
                $message = "No se pudo guardar la información del plan de asignatura.";
                $errors = $plan_asignatura->errors;
            }
        }

    	return response()->json([
            'error' => $error,
            'message' => $message,
            'errors' => $errors
        ]);
    }
}
