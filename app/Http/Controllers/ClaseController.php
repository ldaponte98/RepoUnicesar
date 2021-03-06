<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Clase;
use App\ClaseAsistencia;
use App\ClaseCalificacion;
use App\ClaseCalificacionDetalle;
use App\TerceroGrupo;
use App\PlanDesarrolloAsignatura;
use App\PeriodoAcademico;
use App\Asignatura;
use App\Grupo;
use App\Dominio;

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
            if (!$plan_desarrollo_asignatura) $plan_desarrollo_asignatura = new PlanDesarrolloAsignatura;
            
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

    public function clases_docente() { return view('clase.clases_docente'); }
     

    public function clases_pendientes()
    {
        $fecha_actual = date('Y-m-d H:i:s');
        $clases_pendientes = Clase::select('clases.*')
                ->join('grupo', 'grupo.id_grupo', '=', 'clases.id_grupo')
                ->where('fecha_inicio', '<=', $fecha_actual)
                ->where('fecha_fin', '>=', $fecha_actual)
                ->where('grupo.id_tercero', session('id_tercero_usuario'))
                ->get();        
        return view('clase.clases_docente_pendientes', compact('clases_pendientes'));
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
                ->where('grupo.id_tercero', session('id_tercero_usuario'))
                ->get();
            foreach ($clases as $query_clase) {
                $clase = Clase::find($query_clase['id_clase']);
                $clase->nom_grupo = $clase->grupo->codigo; 
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

    public function gestion(Request $request)
    {
        $post = $request->all();
        $errores = null;
        $periodo_academico = DB::table('periodo_academico')
                               ->orderBy('id_periodo_academico','desc')
                               ->first();
        $clase = new Clase;
        $grupo = new Grupo;
        $grupo->id_periodo_academico = $periodo_academico->id_periodo_academico;
        $clase->fecha_inicio = date('Y-m-d H:i');
        $clase->fecha_fin = date('Y-m-d H:i', strtotime($clase->fecha_inicio. "+ 120 minutes"));
        if ($post) {
            $post = (object) $post;
            if (isset($post->clase)) {
                $clase = Clase::find($post->clase);
                if ($clase == null) {
                    $titulo = "Acceso denegado";
                    $mensaje = "La clase no es valida.";
                    return view('sitio.error',compact(['titulo', 'mensaje']));
                }
                $grupo = $clase->grupo;
            }
        }
        if($request->except(['clase'])){
            $post = (object) $post;
            $grupo = $clase->id_clase ? $clase->grupo : Grupo::find($post->id_grupo);
            $clase->id_grupo = $grupo->id_grupo;
            $clase->fecha_inicio = date('Y-m-d H:i:s', strtotime($post->fecha." ".$post->hora_inicio));
            $clase->fecha_fin = date('Y-m-d H:i:s', strtotime($post->fecha." ".$post->hora_fin));
            $clase->tema = $post->tema;
            $clase->nota = $post->nota;
            if ($clase->fecha_fin > $clase->fecha_inicio) {
                if ($clase->save()) {
                   return redirect()->route('clases/view', $clase->id_clase);
                }else{
                    $errores = $clase->errors[0];
                }
            }else{
                $errores = "La hora de inicio de la clase no pude ser mayor ni igual a la hora fin";
            }
        }
        return view('clase.form', compact(['clase','grupo', 'errores']));
    }

    public function view($id_clase)
    {
        $clase = Clase::find($id_clase);
        if ($clase) return view('clase.view', compact('clase'));
        $titulo = "Acceso denegado";
        $mensaje = "La clase no es valida.";
        return view('sitio.error',compact(['titulo', 'mensaje']));
    }

    public function gestionar_asistencia($id_clase)
    {
        $clase = Clase::find($id_clase);
        $message = "";
        if ($clase) {
            if ($clase->grupo->id_tercero == session('id_tercero_usuario')) {
                return view('clase.form_asistencia', compact('clase'));
            }else{
                $message = "Esta clase no pertence al usuario";
            }
        }else{
            $message = "Clase invalida";
        }
        $titulo = "Acceso denegado";
        return view('sitio.error',compact(['titulo', 'mensaje']));
    }

    public function guardar_asistencia(Request $request)
    {
        $post = $request->all();
        $error = true;
        $message = "";
        if ($post) {
            $post = (object) $post;
            $post->asistencias = json_decode($post->asistencias);
            foreach ($post->asistencias as $alumno) {
                $alumno = (object) $alumno;
                $asistencia = ClaseAsistencia::find($alumno->id_clase_asistencia);
                if ($asistencia == null) $asistencia = new ClaseAsistencia;
                $asistencia->id_clase      = $post->id_clase;
                $asistencia->id_tercero    = $alumno->id_tercero;
                $asistencia->asistio       = $alumno->asistio;
                $asistencia->excusa        = $alumno->excusa;
                $asistencia->motivo_excusa = $alumno->motivo_excusa;
                $file_excusa = $request->file('file_excusa_'.$alumno->id_tercero);
                if ($file_excusa) {
                    $file_name = $file_excusa->getClientOriginalName();
                    $extension = explode(".", $file_name);
                    $extension = $extension[count($extension) - 1];
                    $soporte = $alumno->id_tercero."-".date("Y-m-d-H-i-s").".".$extension;
                    $ruta = '/files/asistencias';
                    Storage::makeDirectory($ruta, 0777);
                    Storage::disk('public')->put($ruta."/".$soporte,  \File::get($file_excusa));
                    $asistencia->archivo_excusa = $soporte;
                }
                $asistencia->save();
            }
            $error = false; $message = "Asistencia registrada exitosamente";
        }
        return response()->json([
            'error' => $error,
            'message' => $message,
            'post' => $post
        ]);
    }

    public function calificar($id_clase, Request $request)
    {   
        $mensaje = "";
        $clase = Clase::find($id_clase);
        if ($clase) {
            if (session('is_alumno')) {
                $id_alumno = session('id_tercero_usuario');
                if ($clase->validar_asistencia($id_alumno)) {
                    $calificacion = ClaseCalificacion::where('id_tercero', $id_alumno)
                                                     ->where('id_clase', $clase->id_clase)
                                                     ->first();
                    if (!$calificacion) $calificacion = new ClaseCalificacion;

                    $tercero_grupo = TerceroGrupo::where('id_tercero', session('id_tercero_usuario'))
                                     ->where('id_grupo', $clase->id_grupo)
                                     ->where('estado', 1)
                                     ->first();
        
                    $plan_desarrollo = PlanDesarrolloAsignatura::where('id_asignatura', $tercero_grupo->grupo->id_asignatura)
                                    ->where('id_periodo_academico', $tercero_grupo->grupo->id_periodo_academico)
                                    ->first();
                        if (!$plan_desarrollo) $plan_desarrollo = new PlanDesarrolloAsignatura;

                        $post = $request->all();
                        if ($post) {
                            $calificacion = ClaseCalificacion::where('id_clase', $id_clase)
                                                  ->where('id_tercero', $id_alumno)
                                                  ->first();
                            if (!$calificacion) {
                                $calificacion = new ClaseCalificacion;
                                $calificacion->id_clase = $id_clase;
                                $calificacion->id_tercero = $id_alumno;
                                $calificacion->save();
                            }
                            DB::table('clase_calificacion_detalle')
                                ->where('id_clase_calificacion', $calificacion->id_clase_calificacion)
                                ->delete();
                            $criterios = Dominio::all()->where('id_padre', 34);
                            foreach ($criterios as $criterio) {
                                if (isset($post["respuesta_" . $criterio->id_dominio])) {
                                    $detalle = new ClaseCalificacionDetalle;
                                    $detalle->id_clase_calificacion = $calificacion->id_clase_calificacion;
                                    $detalle->id_dominio_criterio = $criterio->id_dominio;
                                    $detalle->valor = $post["respuesta_" . $criterio->id_dominio];
                                    $detalle->save();
                                }
                            }
                            return redirect()->route('clases/panel', $clase->id_grupo);
                        }

                        return view('clase.form_calificacion', compact(['tercero_grupo', 'plan_desarrollo','calificacion']));
                }else{
                   $mensaje = "No tiene permisos para calificar esta clase debido a la inasistencia de la misma.";
                }
            }else{
                $mensaje = "No tiene permisos para calificar esta clase.";
            }
        }else{
            $mensaje = "La clase no es valida.";
        }
        $titulo = "Acceso denegado";
        return view('sitio.error',compact(['titulo', 'mensaje']));
    }
}
