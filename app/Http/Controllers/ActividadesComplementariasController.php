<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ActividadesComplementarias;
use App\ActividadesComplementariasDetalle;
use App\PlanTrabajo;
use App\ActividadesPlanTrabajo;
use App\Dominio;
use App\Notificaciones;
use Illuminate\Support\Facades\DB;
use Mail;

class ActividadesComplementariasController extends Controller
{
    public function listar()
    {
        
        $periodos_academicos = DB::table('periodo_academico')
                   ->orderBy('id_periodo_academico','desc')
                   ->get();

        if (session('is_docente')==true) {
            return view('actividades_complementarias.consultar_desde_docente',compact('periodos_academicos'));
        }
        return view('actividades_complementarias.consultar',compact('periodos_academicos'));
   }

   public function getReporte(Request $request)
   {
   		$post = $request->all();
        if ($post) {
            $post = (object) $post;
            $periodo_academico = $post->periodo_academico;
            $estado = $post->estado;
            $corte = $post->corte;
            $id_tercero = $post->id_tercero;
            $actividades = ActividadesComplementarias::reporte($periodo_academico, $estado, $corte, $id_tercero);
            return response()->json($actividades);
        }
        return response()->json("nada llego");
   }

   public function editar($id_actividad_complementaria)
   {
    $actividad_complementaria = ActividadesComplementarias::find($id_actividad_complementaria);
     return view('actividades_complementarias.vista_general', compact('actividad_complementaria'));
   }

    public function editar_detalle($id_actividad_complementaria, $id_dominio_tipo_actividad)
   {
      $actividad_complementaria = ActividadesComplementarias::find($id_actividad_complementaria);
      $tipo_de_actividad = Dominio::find($id_dominio_tipo_actividad);

      if ($actividad_complementaria->estado == 'Enviado' and session('id_usuario')==true and session('is_admin')==true) {
                $notificacion = new Notificaciones;
                //$notificacion->notificacion = 'El administrador te ah revisado las actividades complementarias del enfasis de '.$tipo_de_actividad->dominio.' perteneciente al '.$actividad_complementaria->corte.' corte del periodo '.$actividad_complementaria->plan_trabajo->periodo_academico->periodo;
                $notificacion->notificacion = 'El jefe de departamento te ha revisado las actividades complementarias perteneciente al '.$actividad_complementaria->corte.' corte del periodo '.$actividad_complementaria->plan_trabajo->periodo_academico->periodo;
                $notificacion->id_tercero_envia = session('id_tercero_usuario');
                $notificacion->id_tercero_recibe = $actividad_complementaria->id_tercero;
                $notificacion->id_dominio_tipo = 6;
                $notificacion->id_formato = $id_actividad_complementaria;
                $notificacion->id_dominio_tipo_formato = config('global.actividades_complementarias');
                $vista_email = "";
                if ($notificacion->save()) {
                    //aca enviamos el email de revision
                    $vista_email = "email.email_formato_revisado";
                    $subject = "Revisión de Actividad complementaria";
                    $data_email = array(
                                "formato" => "Actividades complementarias",
                                "periodo_academico" => $actividad_complementaria->plan_trabajo->periodo_academico->periodo,
                                "corte" => $actividad_complementaria->corte,
                                "nombre_tercero" => $notificacion->tercero_recibe->nombre,
                                /*"actividades_complementarias" => $tipo_de_actividad->dominio*/
                            );
                    $for = $notificacion->tercero_recibe->email;
                    Mail::send($vista_email, $data_email, function($msj) use($subject ,$for){
                        $msj->from(config('global.email_general'),"Universidad Popular Del Cesar");
                        $msj->subject($subject);
                        $msj->to($for);
                    });
                }
                    $actividad_complementaria->estado = 'Recibido';
                    $actividad_complementaria->save();
                }

      return view('actividades_complementarias.editar_detalle', compact('actividad_complementaria', 'tipo_de_actividad'));
   }

   public function guardar_detalles(Request $request)
   {
      $post = $request->all();
      if($post){
        $post = (object) $post;
        try {
          
        $actividad_complementaria = ActividadesComplementarias::find($post->id_actividad_complementaria);
        if($actividad_complementaria->tiene_permiso_de_editar() == true){


          //eliminamos los detalles anteriores
          foreach ($actividad_complementaria->detalles as $detalle) {
            if($detalle->actividad_plan_trabajo->id_dominio_tipo == $post->tipo_actividad){
              $detalle->delete();
            }
          }
          if(isset($post->detalles)){
            foreach ($post->detalles as $d) {
              $detalle = new ActividadesComplementariasDetalle;
              $d = (object)$d;
              $detalle->id_actividad_complementaria = $actividad_complementaria->id_actividad_complementaria;
              $detalle->id_actividad_plan_trabajo = $d->id_actividad_plan_trabajo;
              $detalle->descripcion = $d->descripcion;
              $detalle->evidencia = $d->evidencia;
              $detalle->link_evidencia = $d->link;
              $detalle->fecha_evidencia = $d->fecha;
              $detalle->fecha = date('Y-m-d H:i:s');
              $detalle->save();
            }
          }
          return response()->json([
            'mensaje' => 'Informes registrados correctamente',
            'error' => false
          ]);
        }else{
          return response()->json([
          'mensaje' => 'No se encuentra en fechas para editar este informe de actividades complementarias',
          'error' => true
        ]);
        }
        } catch (Exception $e) {
          return response()->json([
          'mensaje' => $e,
          'error' => true
        ]);
        }
      }
   }

   public function enviar_formato($id_actividad_complementaria)
   {
     $actividad_complementaria = ActividadesComplementarias::find($id_actividad_complementaria);
     $actividad_complementaria->estado = 'Enviado';
     $actividad_complementaria->fecha = date('Y-m-d H:i:s');
     $actividad_complementaria->save();
     return response()->json([
          'mensaje' => 'Se envio el formato de actividades complementarias correctamente.',
          'error' => false
        ]);
   }

   public function imprimir($id_actividad_complementaria, $id_actividad_plan_trabajo)
    {
      $actividad_complementaria = ActividadesComplementarias::find($id_actividad_complementaria);
      $actividad_plan_trabajo = ActividadesPlanTrabajo::find($id_actividad_plan_trabajo);
      if($actividad_complementaria){
        $pdf = \PDF::loadView('actividades_complementarias.pdf_actividades_complementarias', compact(['actividad_complementaria', 'actividad_plan_trabajo']));
              return $pdf->stream("Actividades complementarias ".$actividad_complementaria->plan_trabajo->periodo_academico->periodo.".pdf");
      }
    }
}
