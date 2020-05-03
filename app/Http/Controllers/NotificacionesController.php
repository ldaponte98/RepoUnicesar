<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;
use App\Notificaciones;
use App\SeguimientoAsignatura;


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
            $notificacion->id_formato = $post->id_dominio_tipo;
            $notificacion->id_dominio_tipo_formato = $post->id_dominio_tipo_formato;
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
    public function ver_notificacion($id_notificacion)
    {
        $notificacion = Notificaciones::find($id_notificacion);
        if ($notificacion) {
            $notificacion->estado = 1;
            $notificacion->save();
            if (session('is_docente')==true) {
                switch ($notificacion->id_dominio_tipo) {
                    case 6: //revision
                        if($notificacion->id_dominio_tipo_formato == config('global.seguimiento_asignatura')) {
                            return redirect()->route('seguimiento/view', ['id' => $notificacion->id_formato]);
                        }
                        if($notificacion->id_dominio_tipo_formato == config('global.plan_trabajo')) {
                            return redirect()->route('plan_trabajo/view');
                        }
                    case 8: //extra-plazo
                        if($notificacion->id_dominio_tipo_formato == config('global.seguimiento_asignatura')) {
                            return redirect()->route('seguimiento/editar', ['id' => $notificacion->id_formato]);
                        }
                        if($notificacion->id_dominio_tipo_formato == config('global.plan_trabajo')) {
                            return redirect()->route('plan_trabajo/view');
                        }
                    case 9: //retraso
                        if($notificacion->id_dominio_tipo_formato == config('global.seguimiento_asignatura')) {
                            return redirect()->route('seguimiento/consultar');
                        }
                        if($notificacion->id_dominio_tipo_formato == config('global.plan_trabajo')) {
                            return redirect()->route('plan_trabajo/view');
                        }
                    default:
                        echo "Accion invalida";
                        break;
                }
            }

            if (session('is_admin')==true) {
                switch ($notificacion->id_dominio_tipo) {
                    case 8: //extra-plazo
                        if($notificacion->id_dominio_tipo_formato == config('global.seguimiento_asignatura')) {
                            return redirect()->route('docente/view',['id' => $notificacion->tercero_envia->id_tercero]);
                        }
                                 
                    default:
                        echo "Accion invalida";
                        break;
                }
            }
        }
    }

    public function listar_mis_notificaciones()
    {
        $notificaciones_recibidas = DB::table('notificaciones') 
                                     ->where('id_tercero_recibe', session('id_tercero_usuario') )
                                     ->orderBy('fecha', 'desc')
                                     ->paginate(5);

        $notificaciones_enviadas = DB::table('notificaciones') 
                                    ->where('id_tercero_envia', session('id_tercero_usuario') )
                                    ->orderBy('fecha', 'desc')
                                    ->paginate(5);
        return view('notificaciones.listado_notificaciones',compact(['notificaciones_recibidas', 'notificaciones_enviadas']));
    }
}
