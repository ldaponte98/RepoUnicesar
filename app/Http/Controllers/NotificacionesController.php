<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;
use App\Notificaciones;
use App\SeguimientoAsignatura;
use App\ActividadesComplementarias;
use App\PlanTrabajo;
use Mail;

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
            if(isset($post->id_formato))$notificacion->id_formato = $post->id_formato;
            $notificacion->id_dominio_tipo_formato = $post->id_dominio_tipo_formato;
            $vista_email = "";
        	if ($notificacion->save()) {
                if (session('is_admin')==true) {
                switch (intval($notificacion->id_dominio_tipo)) {
                    case 6: //revision
                        if($notificacion->id_dominio_tipo_formato == config('global.seguimiento_asignatura')) {
                            $vista_email = "email.email_formato_revisado";
                            $subject = "Revisión de Seguimiento de asignatura";
                            $seguimiento = SeguimientoAsignatura::find($notificacion->id_formato);
                            $data_email = array(
                                "formato" => "Seguimiento de Asignatura",
                                "asignatura" => "(". $seguimiento->asignatura->codigo.") ".$seguimiento->asignatura->nombre,
                                "grupo" => $seguimiento->grupo->codigo,
                                "corte" => $seguimiento->corte,
                                "periodo_academico" => $seguimiento->grupo->periodo_academico->periodo,
                                "nombre_tercero" => $notificacion->tercero_recibe->nombre
                            );
                        }
                        if($notificacion->id_dominio_tipo_formato == config('global.plan_trabajo')) {
                            $vista_email = "email.email_formato_revisado";
                            $subject = "Revisión de Plan de trabajo";
                            $plan_trabajo = PlanTrabajo::find($notificacion->id_formato);
                            $data_email = array(
                                "formato" => "Plan de trabajo",
                                "periodo_academico" => $post->periodo_academico,
                                "nombre_tercero" => $notificacion->tercero_recibe->nombre
                            );
                        }
                        break;
                    case 8: //extra-plazo
                        if($notificacion->id_dominio_tipo_formato == config('global.seguimiento_asignatura')) {
                          
                        }
                        if($notificacion->id_dominio_tipo_formato == config('global.plan_trabajo')) {
                            
                        }
                    case 9: //retraso
                        if($notificacion->id_dominio_tipo_formato == config('global.seguimiento_asignatura')) {
                            $subject = "Aviso de retraso en Seguimiento de asignatura";
                            $vista_email = "email.email_retraso";
                            $seguimiento = SeguimientoAsignatura::find($notificacion->id_formato);

                            $data_email = array(
                                "formato" => "Seguimiento de Asignatura",
                                "asignatura" => "(". $seguimiento->asignatura->codigo.") ".$seguimiento->asignatura->nombre,
                                "grupo" => $seguimiento->grupo->codigo,
                                "corte" => $seguimiento->corte,
                                "periodo_academico" => $seguimiento->grupo->periodo_academico->periodo,
                                "nombre_tercero" => $notificacion->tercero_recibe->nombre
                            );
                        }
                        if($notificacion->id_dominio_tipo_formato == config('global.plan_trabajo')) {
                            $subject = "Aviso de retraso en Plan de trabajo";
                            $vista_email = "email.email_retraso";
                            $plan_trabajo = PlanTrabajo::find($notificacion->id_formato);
                            $data_email = array(
                                "formato" => "Plan de trabajo",
                                "periodo_academico" => $post->periodo_academico,
                                "nombre_tercero" => $notificacion->tercero_recibe->nombre
                            );
                        }
                        if($notificacion->id_dominio_tipo_formato == config('global.actividades_complementarias')) {
                            $subject = "Aviso de retraso en Actividades complementarias";
                            $vista_email = "email.email_retraso";
                            $actividades = ActividadesComplementarias::find($notificacion->id_formato);

                            $data_email = array(
                                "formato" => "Actividades complementarias",
                                "corte" => $actividades->corte,
                                "periodo_academico" => $actividades->plan_trabajo->periodo_academico->periodo,
                                "nombre_tercero" => $notificacion->tercero_recibe->nombre
                            );
                        }
                        break;
                    default:
                        echo "Accion invalida";
                        break;
                }
            }

                
                $for = $notificacion->tercero_recibe->email;
                
                Mail::send($vista_email, $data_email, function($msj) use($subject ,$for){
                    $msj->from("repounicesar@gmail.com","Universidad Popular Del Cesar");
                    $msj->subject($subject);
                    $msj->to($for);
                });
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
                        if($notificacion->id_dominio_tipo_formato == config('global.actividades_complementarias')) {
                            return redirect()->route('actividades_complementarias/consultar');
                        }
                    default:
                        echo "Accion invalida";
                        break;
                }
            }

            if (session('is_admin')==true) {
                switch ($notificacion->id_dominio_tipo) {
                    case 8: //extra-plazo
                            return redirect()->route('docente/view',['id' => $notificacion->tercero_envia->id_tercero]);
                                 
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
