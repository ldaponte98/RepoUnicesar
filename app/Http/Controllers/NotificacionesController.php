<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Notificaciones;


class NotificacionesController extends Controller
{
    public function crear(Request $request)
    {
    	$post = $request->all();

        if ($post) {
        	$post = (object) $post;
        	$notificacion = new Notificaciones;
        	$notificacion->notificacion = "$post->mensaje";
        	$notificacion->id_tercero_envia = $post->id_tercero_envia;
        	$notificacion->id_tercero_recibe = $post->id_tercero_recibe;
        	$notificacion->id_dominio_tipo = $post->id_dominio_tipo;
        	if ($notificacion->save()) {
        		return response()->json(array(
		            'error' => false,
		        )); 
        	}
        }
        return response()->json(array(
            'error' => true,
        ));
    }
}
