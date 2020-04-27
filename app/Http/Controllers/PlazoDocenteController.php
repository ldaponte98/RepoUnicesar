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
        $plazo_docente->id_formato = $post->id_formato;
        $plazo_docente->fecha_inicio = $fecha_inicio;
        $plazo_docente->fecha_fin = $fecha_fin. " 23:59:59";

        if ($plazo_docente->save()) {

            //AHORA SE CREA LA NOTIFICACION PARA EL TERCERO 

            $notificacion = new Notificaciones;
            $notificacion->notificacion = "Se ah generado un nuevo plazo-extra para el seguimiento con codigo ".$post->id_formato." con un nuevo lapso de tiempo durante el ".$fecha_inicio." hasta".$fecha_fin;
            $notificacion->id_tercero_envia = session('id_usuario_tercero');
            $notificacion->id_tercero_recibe = $post->id_tercero;
            $notificacion->id_dominio_tipo = config('global.notificacion_extra_pazo');
            $notificacion->id_formato = $post->id_formato;
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
