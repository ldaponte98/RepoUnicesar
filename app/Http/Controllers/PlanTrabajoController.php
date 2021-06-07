<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Tercero;
use App\PlanTrabajo;
use App\ActividadesPlanTrabajo;
use App\FechasEntrega;
use App\ActividadesComplementarias;
use App\Horario;
use App\Grupo;
use App\HorarioDetalle;
use App\Notificaciones;
use App\PlazoDocente;
use GuzzleHttp\Client;
use Mail;

class PlanTrabajoController extends Controller
{
    public function view(Request $request)
    {
    	$periodo_academico = DB::table('periodo_academico')
			                   ->orderBy('id_periodo_academico','desc')
			                   ->first();
		$post = $request->all();
		$plan_trabajo = PlanTrabajo::where('id_periodo_academico', $periodo_academico->id_periodo_academico)->where('id_tercero', session('id_tercero_usuario'))->first();
        if ($post) {
        	$post = (object) $post;
        	$periodo_academico = DB::table('periodo_academico')
			                   ->where('id_periodo_academico', $post->id_periodo_escojido)
			                   ->first();
			$plan_trabajo = PlanTrabajo::where('id_periodo_academico', $periodo_academico->id_periodo_academico)->where('id_tercero', session('id_tercero_usuario'))->first();
        }
        if(!$plan_trabajo) $plan_trabajo = new PlanTrabajo;

        $permiso_para_modificar = PlanTrabajo::tiene_permiso_para_editar(session('id_tercero_usuario'),$periodo_academico->id_periodo_academico, $plan_trabajo->id_plan_trabajo, $plan_trabajo->estado);
        
        $horario = Horario::where('id_periodo_academico', $periodo_academico->id_periodo_academico)->where('id_tercero', session('id_tercero_usuario'))->first();
    	return view('plan_de_trabajo.view',compact([
    		'plan_trabajo',
			'periodo_academico',
            'permiso_para_modificar',
            'horario'
		]));	     
    }

    public function editar(Request $request)
    {
    	
		$post = $request->all();
		if($post){
			$post = (object) $post;
            $is_new = false;
			$plan_trabajo = new PlanTrabajo;
			if($post->id_plan_trabajo){
				$plan_trabajo = PlanTrabajo::find($post->id_plan_trabajo);
			}
            if($plan_trabajo->id_plan_trabajo == null) $is_new = true;

			$plan_trabajo->fill($request->except([
                '_token',
                'id_plan_trabajo',
                'actividades'
            ]));
            //se valida si tiene actividades complementarias realizadas pues si es asi no puede modificar el plan de trabajo
            if(isset($plan_trabajo->id_plan_trabajo)){
                $sql = "SELECT acd.* 
                FROM actividades_complementarias_detalle acd 
                LEFT join actividades_complementarias ac USING(id_actividad_complementaria) 
                where ac.id_plan_trabajo = ".$plan_trabajo->id_plan_trabajo;
                $actividades_complementarias_realizadas = DB::select($sql);
                if(count($actividades_complementarias_realizadas) > 0){
                    return response()->json([
                        'error' => true,
                        'mensaje' => 'No se pudieron guardar los cambios debido a que hay actividades complementarias realizadas con relacion a las actividades ya anteriormente ingresadas.',
                    ]);
                }
            }
            


            if($plan_trabajo->save()){
            	//ahora se eliminan las actividades que antes tenia si tenia
                //pero no se puede si tiene actividades complementarias enlazadas a estas
            	$requiere_actividades_complementarias = false;

                $result_delete = DB::statement('delete from actividades_plan_trabajo where id_plan_trabajo = '.$plan_trabajo->id_plan_trabajo);
            	if(isset($post->actividades)){
                	foreach ($post->actividades as $a) {
                		$a = (object) $a;
                		$actividad = new ActividadesPlanTrabajo;
                		$actividad->id_plan_trabajo = $plan_trabajo->id_plan_trabajo;
                		$actividad->nombre = $a->nombre;
                        $actividad->descripcion = $a->descripcion;
                        $actividad->institucion = $a->institucion;
                		$actividad->acta_aprobada = $a->acta;
                		$actividad->fecha_aprobada = $a->fecha_aprobada;
                		$actividad->fecha_iniciacion = $a->fecha_iniciacion;
                		$actividad->horas_por_semana = $a->horas_semanales;
                        $actividad->id_dominio_tipo = $a->tipo;
                        $actividad->requiere_actividad_complementaria = $a->requiere_actividad_complementaria;
                		$actividad->save();

                        if($actividad->requiere_actividad_complementaria) $requiere_actividades_complementarias = true;
                	}
                }


                if(isset($post->horario)){
                    $horario = Horario::where('id_periodo_academico', $plan_trabajo->id_periodo_academico)
                                            ->where('id_tercero', session('id_tercero_usuario'))->first();
                    if(!$horario){
                        $horario = new Horario;
                        $horario->id_periodo_academico = $plan_trabajo->id_periodo_academico;
                        $horario->id_tercero = $plan_trabajo->id_tercero; 
                        $horario->save();
                    }else{
                        $result_delete = DB::statement('delete from horario_detalle where id_horario = '.$horario->id_horario);
                    }
        
                    foreach ($post->horario as $h) {
                        $h = (object) $h;
                        $detalle = new HorarioDetalle;
                        $detalle->id_horario = $horario->id_horario;
                        $detalle->id_dominio_tipo_evento = $h->id_tipo_evento;
                        $detalle->dia_semana = $h->dia;
                        $detalle->hora = $h->hora;
                        $detalle->evento = $h->nombre;
                        $detalle->save();
                    }
                }




            if($is_new == true){
                if(isset($post->actividades) and $requiere_actividades_complementarias){
                    //aca cuando es un nuevo plan de trabajo se crean 3 actividades complementarias por corte
                    for ($corte=1; $corte <= 3 ; $corte++) { 
                        $actividad_complementaria = new ActividadesComplementarias;
                        $actividad_complementaria->id_tercero = $plan_trabajo->id_tercero;
                        $actividad_complementaria->id_plan_trabajo = $plan_trabajo->id_plan_trabajo;
                        $actividad_complementaria->estado = 'Pendiente';
                        $actividad_complementaria->corte = $corte;
                        $actividad_complementaria->save();
                    }
                }
                
            }else{
                $actividades_del_plan_trabajo = ActividadesComplementarias::all()
                                               ->where('id_plan_trabajo', $plan_trabajo->id_plan_trabajo);
                
                if(count($actividades_del_plan_trabajo) == 0 and isset($post->actividades)){
                    //aca cuando es un nuevo plan de trabajo se crean 3 actividades complementarias por corte
                    for ($corte=1; $corte <= 3 ; $corte++) { 
                        $actividad_complementaria = new ActividadesComplementarias;
                        $actividad_complementaria->id_tercero = $plan_trabajo->id_tercero;
                        $actividad_complementaria->id_plan_trabajo = $plan_trabajo->id_plan_trabajo;
                        $actividad_complementaria->estado = 'Pendiente';
                        $actividad_complementaria->corte = $corte;
                        $actividad_complementaria->save();
                    }
                }

                if(!$requiere_actividades_complementarias and count($actividades_del_plan_trabajo) > 0){
                    $result_delete = DB::statement('delete from actividades_complementarias where id_plan_trabajo = '.$plan_trabajo->id_plan_trabajo);
                }
            }

            $plazos_extra = PlazoDocente::where('id_tercero',$plan_trabajo->id_tercero)
                                       ->where('id_dominio_tipo_formato', config('global.plan_trabajo'))
                                       ->where('id_periodo_academico', $plan_trabajo->id_periodo_academico)
                                       ->where('estado', 1)
                                       ->get();
            foreach ($plazos_extra as $plazo) {
                $plazo->estado = 0;
                $plazo->save();
            } 
            	return response()->json([
	            	'error' => false,
	            	'mensaje' => 'ok',
	            ]);
            }

            return response()->json([
            	'error' => true,
            	'mensaje' => 'Error al registrar el plan de trabajo',
            ]);
		}		
    }


    public function listar()
    {

        $periodos_academicos = DB::table('periodo_academico')
                   ->orderBy('id_periodo_academico','desc')
                   ->get();

        return view('plan_de_trabajo.consultar',compact('periodos_academicos'));
    }
    public function getReporte(Request $request)
    {
       $post = $request->all();

        if ($post) {
            $post = (object) $post;
            $id_periodo = $post->periodo_academico;
            $id_tercero = $post->id_tercero;
            $estado = $post->estado;
            $planes = PlanTrabajo::reporte($id_periodo, $id_tercero, $estado);
            return response()->json($planes);
        }
        return response()->json("nada llego");
    }

    public function imprimir($id_plan_trabajo)
    {
        

        $plan_trabajo = PlanTrabajo::find($id_plan_trabajo);
        if($plan_trabajo){
            if ($plan_trabajo->estado == 'Enviado' and session('is_admin')==true) {
                $notificacion = new Notificaciones;
                $notificacion->notificacion = 'El jefe de departamento te ha revisado el plan de trabajo del periodo '.$plan_trabajo->periodo_academico->periodo;
                $notificacion->id_tercero_envia = session('id_tercero_usuario');
                $notificacion->id_tercero_recibe = $plan_trabajo->id_tercero;
                $notificacion->id_dominio_tipo = 6;
                $notificacion->id_formato = $id_plan_trabajo;
                $notificacion->id_dominio_tipo_formato = config('global.plan_trabajo');
                $vista_email = "";
                if ($notificacion->save()) {
                    //aca enviamos el email de revision
                    $vista_email = "email.email_formato_revisado";
                    $subject = "Revisión de Plan de trabajo";
                    $data_email = array(
                                "formato" => "Plan de trabajo",
                                "periodo_academico" => $plan_trabajo->periodo_academico->periodo,
                                "nombre_tercero" => $notificacion->tercero_recibe->nombre
                            );
                    $for = $notificacion->tercero_recibe->email;
                    Mail::send($vista_email, $data_email, function($msj) use($subject ,$for){
                        $msj->from(config('global.email_general'),"Universidad Popular Del Cesar");
                        $msj->subject($subject);
                        $msj->to($for);
                    });
                }
                    $plan_trabajo->estado = 'Recibido';
                    $plan_trabajo->save();
                }
                $horario = Horario::where('id_periodo_academico', $plan_trabajo->periodo_academico->id_periodo_academico)->where('id_tercero', $plan_trabajo->id_tercero)->first();
                $pdf = \PDF::loadView('plan_de_trabajo.pdf_plan_trabajo', compact('plan_trabajo'), compact('horario'));
                return $pdf->stream("Plan de trabajo ".$plan_trabajo->periodo_academico->periodo.".pdf");
        }
    }
}
