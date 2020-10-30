<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PlazoDocente;
use App\Notificaciones;


class PlazoDocenteController extends Controller
{
    public function registrar(Request $request)
    {
    	$post = $request->all();
        if ($post) {
            $post = (object) $post;
        $plazo_docente = new PlazoDocente;
        $fecha_inicio = date('Y-m-d', strtotime(str_replace("/", "-",explode(' - ', $post->fechas_plazo)[0])));
        $fecha_fin = date('Y-m-d', strtotime(str_replace("/", "-",explode(' - ', $post->fechas_plazo)[1])));

        $plazo_docente->id_tercero = $post->id_tercero;
        if(isset($post->id_formato)) $plazo_docente->id_formato = $post->id_formato;
        if(isset($post->id_periodo_academico)) $plazo_docente->id_periodo_academico = $post->id_periodo_academico;
        if(isset($post->id_asignatura)) $plazo_docente->id_asignatura = $post->id_asignatura;
        $plazo_docente->id_dominio_tipo_formato = $post->id_dominio_tipo_formato;
        $plazo_docente->fecha_inicio = $fecha_inicio;
        $plazo_docente->fecha_fin = $fecha_fin. " 23:59:59";

        $mensaje_notificacion = "";


        if ($plazo_docente->save()) {

            switch ($post->id_dominio_tipo_formato) {
                case config('global.seguimiento_asignatura'):
                    $mensaje_notificacion = "Se ah generado un nuevo plazo-extra para el seguimiento con codigo ".$post->id_formato." con un nuevo lapso de tiempo desde ".$fecha_inicio." hasta".$fecha_fin;
                    break;

                case config('global.plan_trabajo'):
                    $mensaje_notificacion = "Se ah generado un nuevo plazo-extra para el plan de trabajo del ".$plazo_docente->periodo_academico->periodo." con un nuevo lapso de tiempo desde ".$fecha_inicio." hasta".$fecha_fin;
                    break;
                
                case config('global.desarrollo_asignatura'):
                    $mensaje_notificacion = "Se ah generado un nuevo plazo-extra para el plan de desarrollo de la asignatura ".$plazo_docente->asignatura->nombre." (".$plazo_docente->asignatura->codigo.")"." del ".$plazo_docente->periodo_academico->periodo." con un nuevo lapso de tiempo desde ".$fecha_inicio." hasta".$fecha_fin;
                    break;

                case config('global.actividades_complementarias'):
                    break;
                
                default:
                    $titulo = "Formato invalido";
                    $mensaje = "";
                    return view('sitio.error',compact(['titulo', 'mensaje']));
            }

            //AHORA SE CREA LA NOTIFICACION PARA EL TERCERO
            $notificacion = new Notificaciones;
            $notificacion->notificacion = $mensaje_notificacion;
            $notificacion->id_tercero_envia = session('id_tercero_usuario');
            $notificacion->id_tercero_recibe = $post->id_tercero;
            $notificacion->id_dominio_tipo = config('global.notificacion_extra_pazo');
            if(isset($post->id_formato)) $notificacion->id_formato = $post->id_formato;
            if(isset($post->id_periodo_academico)) $notificacion->id_periodo_academico = $post->id_periodo_academico;
            if(isset($post->id_asignatura)) $notificacion->id_asignatura = $post->id_asignatura;
            $notificacion->id_dominio_tipo_formato = $post->id_dominio_tipo_formato;
            $notificacion->save();
        	return response()->json([
        		'error' => false,
        		'mensaje' => 'Plazo registrado correctamente'
        	]);
        }

        return response()->json([
        		'error' => true,
        		'mensaje' => 'Ocurrio un error al registrar el plazo extra'
        ]);
        	
        }
    }
}
