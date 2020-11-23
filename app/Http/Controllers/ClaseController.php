<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Clase;
use App\ClaseDetalle;
use App\TerceroGrupo;
use App\PlanDesarrolloAsignatura;
class ClaseController extends Controller
{
    public function panel($id_grupo)
    {
    	$tercero_grupo = TerceroGrupo::where('id_tercero', session('id_tercero_usuario'))
    								 ->where('id_grupo', $id_grupo)
    								 ->where('estado', 1)
    								 ->first();
        if($tercero_grupo){
        	$plan_desarrollo_asignatura = PlanDesarrolloAsignatura::where('id_asignatura', $tercero_grupo->grupo->id_asignatura)
        														  ->where('id_periodo_academico', $tercero_grupo->grupo->id_periodo_academico)
        														  ->first();
        	$clases = Clase::where('id_grupo', $id_grupo)
        					->where('estado', 1)
        					->orderBy('created_at', 'desc')
    						->get();
        	return view('clase.panel',compact(['tercero_grupo', 'plan_desarrollo_asignatura','clases']));
        }
        //si llega aqui el usuario no tiene acceso a la vista
        $titulo = "Acceso denegado";
        $mensaje = "Este usuario no tiene permisos suficientes para ingresar a la informacion de esta clase.";
        return view('sitio.error',compact(['titulo', 'mensaje']));
    }

    public function clases_docente()
    {
        return view('clase.clases_docente');
    }

    public function buscar_clases(Request $request)
    {
        $post = $request->all();
        $error = true;
        $message = "";
        $data = null;
        if($post){
            $post = (object) $post;
            $id_periodo_academico = $post->id_periodo_academico;
            $id_asignatura = $post->id_asignatura;
            $id_tercero = $post->id_tercero;

            $clases = Clase::select('clases.*')
                ->join('grupo', 'grupo.id_grupo', '=', 'clases.id_grupo')
                ->get();
            foreach ($clases as $query_clase) {
                $clase = Clase::find($query_clase['id_clase']);
                $clase->detalles =  $clase->detalles;
                $clase->fecha_creacion = date('d/m/Y', strtotime($clase->created_at));
                $clase->hora_creacion = date('H:i', strtotime($clase->created_at));
                $data[] = $clase;
                $clase->asistentes = 0;
                $clase->inasistentes = 0;
                foreach ($clase->asistencias as $asistencia) {
                    if($asistencia->asistio == 1) $clase->asistentes += 1;
                    if($asistencia->asistio == 0) $clase->inasistentes += 1;
                }
                $clase->asistencias = $clase->asistencias;
                $clase->permiso_asistencia = 1; //este es el permiso para ver si puede llamar a lista o no
                if(count($clase->asistencias) > 0) $clase->permiso_asistencia = 0;
            }
            $error = false;
        }

        return response()->json([
            'error' => $error,
            'message' => $message,
            'data' => $data
        ]);
    }
}
