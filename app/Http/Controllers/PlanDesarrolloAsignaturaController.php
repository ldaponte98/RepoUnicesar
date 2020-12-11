<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\PlanAsignatura;
use App\PlanDesarrolloAsignatura;
use App\PlanDesarrolloAsignaturaDetalle;
use App\PlanDesarrolloAsignaturaUnidad;
use App\PlanDesarrolloAsignaturaEjeTematico;
use App\Asignatura;
use App\PeriodoAcademico;
use App\EjeTematico;
use App\UnidadAsignatura;
use App\Tercero;
use App\Grupo;
use App\FechasEntrega;
use App\Notificaciones;
use App\CodigoAcceso;
use App\PlazoDocente;
use Mail;

class PlanDesarrolloAsignaturaController extends Controller
{
     public function view($id_tercero, $id_asignatura, $id_periodo_academico)
    {
    	$plan_desarrollo_asignatura = PlanDesarrolloAsignatura::where('id_asignatura',$id_asignatura)
						   ->where('id_periodo_academico', $id_periodo_academico)
						   ->where('id_tercero', $id_tercero)
						   ->first();
		$asignatura = Asignatura::find($id_asignatura);
		$periodo_academico = PeriodoAcademico::find($id_periodo_academico);
        $plan_asignatura = PlanAsignatura::where('id_asignatura', $id_asignatura)
                                         ->where('id_periodo_academico',$id_periodo_academico)
                                         ->first();

		$tercero = Tercero::find($id_tercero);
    	if(!$plan_desarrollo_asignatura){
    		$plan_desarrollo_asignatura = new PlanDesarrolloAsignatura;
            $plan_desarrollo_asignatura->id_periodo_academico = $periodo_academico->id_periodo_academico;
            $plan_desarrollo_asignatura->id_asignatura = $asignatura->id_asignatura;
            $plan_desarrollo_asignatura->id_tercero = $id_tercero;
            $plan_desarrollo_asignatura->estado = "Pendiente";
    	}
        $codigos_acceso = CodigoAcceso::all()->where('id_plan_desarrollo_asignatura', $plan_desarrollo_asignatura->id_plan_desarrollo_asignatura)
                                             ->where('estado', 1);

        $tiene_carga_academica = Grupo::where('id_tercero', $tercero->id_tercero)
                                        ->where('id_periodo_academico',  $periodo_academico->id_periodo_academico)
                                        ->where('id_asignatura',  $asignatura->id_asignatura)
                                        ->first();
        if ($tiene_carga_academica) {
            if($plan_asignatura){
                if(session('is_admin') == true and $plan_desarrollo_asignatura->estado == "Enviado"){
                    $this->marcar_revision($plan_desarrollo_asignatura);
                }
                return view('plan_desarrollo_asignatura.view', compact(['plan_desarrollo_asignatura','tercero', 'asignatura', 'periodo_academico', 'plan_asignatura','codigos_acceso']));
            }else{
                $titulo = "No exite un plan de asignatura registrado para esta asignatura en el periodo academico ".$periodo_academico->periodo.".";
                $mensaje = "Favor verificar si tiene carga academica para este periodo academico.";
                return view('sitio.error',compact(['titulo', 'mensaje']));
            }
        }else{
            $titulo = "No tiene carga academica registrada en este periodo.";
            $mensaje = "Favor verificar si tiene carga academica para este periodo academico.";
            return view('sitio.error',compact(['titulo', 'mensaje']));
        }
    }

    public function marcar_revision($plan_desarrollo_asignatura)
    {
                $notificacion = new Notificaciones;
                $notificacion->notificacion = 'El jefe de departamento ha revisado el plan de desarrollo de la asignatura '.$plan_desarrollo_asignatura->asignatura->nombre." - ".$plan_desarrollo_asignatura->asignatura->codigo." correspondiente al P.Academico ".$plan_desarrollo_asignatura->periodo_academico->nombre; 
                $notificacion->id_tercero_envia = session('id_tercero_usuario');
                $notificacion->id_tercero_recibe = $plan_desarrollo_asignatura->id_tercero;
                $notificacion->id_dominio_tipo = 6;
                $notificacion->id_formato = $plan_desarrollo_asignatura->id_plan_desarrollo_asignatura;
                $notificacion->id_dominio_tipo_formato = config('global.desarrollo_asignatura');
                $vista_email = "";
                if ($notificacion->save()) {
                    //aca enviamos el email de revision
                    $vista_email = "email.email_formato_revisado";
                    $subject = "Revisión de Plan de desarrollo asignatura";
                    $data_email = array(
                                "formato" => "Plan de desarrollo asignatura",
                                "periodo_academico" => $plan_desarrollo_asignatura->periodo_academico->periodo,
                                "asignatura" => $plan_desarrollo_asignatura->asignatura->nombre." - ".$plan_desarrollo_asignatura->asignatura->codigo,
                                "nombre_tercero" => $notificacion->tercero_recibe->nombre
                            );
                    $for = $notificacion->tercero_recibe->email;
                    Mail::send($vista_email, $data_email, function($msj) use($subject ,$for){
                        $msj->from(config('global.email_general'),"Universidad Popular Del Cesar");
                        $msj->subject($subject);
                        $msj->to($for);
                    });
                }
                    $plan_desarrollo_asignatura->estado = 'Recibido';
                    $plan_desarrollo_asignatura->save();
    }

    public function obtener_fecha_sugerida(Request $request)
    {
    	$post = $request->all();
    	$fecha_inicio = "";
    	$fecha_fin = "";
    	if($post){
            $post = (object) $post;
            $fecha_inicio = date('d/m/Y', strtotime($post->fecha));
            $fecha_fin = date('d/m/Y', strtotime($post->fecha.' +5 days'));
            if($post->saltarse_domingo == 1){
                $fecha_inicio = date('d/m/Y', strtotime($post->fecha.' +2 days'));
                $fecha_fin = date('d/m/Y', strtotime($post->fecha.' +7 days'));
            }
    		
    	}
    	return response()->json([
    		'fecha_inicio' => $fecha_inicio,
    		'fecha_fin' => $fecha_fin
    	]);
    }

    public function editar(Request $request)
    {
       $post = $request->all();
       $error = true;
       $message = "";
       $errors = [];
       if($post){
            $post = (object) $post;
            $plan_desarrollo = PlanDesarrolloAsignatura::find($post->id_plan_desarrollo_asignatura);
            if(!$plan_desarrollo){
                $plan_desarrollo = new PlanDesarrolloAsignatura;
                $plan_desarrollo->id_tercero = session('id_tercero_usuario');
                $plan_desarrollo->id_asignatura = $post->id_asignatura;
                $plan_desarrollo->id_periodo_academico = $post->id_periodo_academico;
            }
            $plan_desarrollo->updated_at = date('Y-m-d H:i:s');
            $plan_desarrollo->save();


            $result_delete = DB::statement('delete from plan_desarrollo_asignatura_eje_tematico where id_plan_desarrollo_asignatura = '.$plan_desarrollo->id_plan_desarrollo_asignatura);
            $result_delete = DB::statement('delete from plan_desarrollo_asignatura_unidad where id_plan_desarrollo_asignatura = '.$plan_desarrollo->id_plan_desarrollo_asignatura);
            $result_delete = DB::statement('delete from plan_desarrollo_asignatura_detalle where id_plan_desarrollo_asignatura = '.$plan_desarrollo->id_plan_desarrollo_asignatura);
            
            //ahora recorremos los detalles
            $cont = 1;
            foreach ($post->detalles as $detalle) {
                $detalle = (object) $detalle;
                $plan_desarrollo_detalle = new PlanDesarrolloAsignaturaDetalle;
                $plan_desarrollo_detalle->id_plan_desarrollo_asignatura = $plan_desarrollo->id_plan_desarrollo_asignatura;
                $plan_desarrollo_detalle->semana = $detalle->semana;
                $fecha_inicio = explode("/", $detalle->fecha_inicio)[2]."-".explode("/", $detalle->fecha_inicio)[1]."-".explode("/", $detalle->fecha_inicio)[0];
                $fecha_fin = explode("/", $detalle->fecha_fin)[2]."-".explode("/", $detalle->fecha_fin)[1]."-".explode("/", $detalle->fecha_fin)[0];
                
                $plan_desarrollo_detalle->fecha_inicio = date('Y-m-d', strtotime($fecha_inicio));
                $plan_desarrollo_detalle->fecha_fin = date('Y-m-d', strtotime($fecha_fin));
                $plan_desarrollo_detalle->titulo_semana_parciales = $detalle->titulo_semana_parciales;
                $plan_desarrollo_detalle->temas_trabajo_independiente = $detalle->temas_trabajo;
                $plan_desarrollo_detalle->estrategias_metodologicas = $detalle->estrategias_metodologicas;
                $plan_desarrollo_detalle->competencias = $detalle->competencias;
                $plan_desarrollo_detalle->evaluacion_academica = $detalle->evaluacion_academica;
                $plan_desarrollo_detalle->bibliografia = $detalle->bibliografia;
                $plan_desarrollo_detalle->is_semana_parciales = false;
                if($detalle->semana_parciales != "false")  $plan_desarrollo_detalle->is_semana_parciales = true;
                
                if($plan_desarrollo_detalle->save()){
                    if($plan_desarrollo_detalle->is_semana_parciales == false){
                        foreach ($detalle->unidades_escojidas as $unidad_escojida) {
                            $unidad_escojida = (object) $unidad_escojida;
                            $unidad_plan_desarrollo = new PlanDesarrolloAsignaturaUnidad;
                            $unidad_plan_desarrollo->id_plan_desarrollo_asignatura = $plan_desarrollo_detalle->id_plan_desarrollo_asignatura;
                            $unidad_plan_desarrollo->id_plan_desarrollo_asignatura_detalle  = $plan_desarrollo_detalle->id_plan_desarrollo_asignatura_detalle;
                            $unidad_plan_desarrollo->id_unidad_asignatura = $unidad_escojida->id_unidad;
                            if($unidad_plan_desarrollo->save()){
                                foreach ($unidad_escojida->ejes as $eje_escojido) {
                                    $eje_escojido = (object) $eje_escojido;
                                    $eje_plan_desarrollo = new PlanDesarrolloAsignaturaEjeTematico;
                                    $eje_plan_desarrollo->id_plan_desarrollo_asignatura = $plan_desarrollo->id_plan_desarrollo_asignatura;
                                    $eje_plan_desarrollo->id_plan_desarrollo_asignatura_unidad  = $unidad_plan_desarrollo->id_plan_desarrollo_asignatura_unidad;
                                    $eje_plan_desarrollo->id_eje_tematico = $eje_escojido->id_eje;
                                    if(!$eje_plan_desarrollo->save()){
                                        $message = "Ocurrio un error al guardar el tema de docencia directa '".$eje_escojido->nombre."' de la semana $cont.";
                                        $errors = $eje_plan_desarrollo->errors;
                                    }
                                }
                            }else{
                                $message = "Ocurrio un error al guardar el eje tematico '".$unidad_escojida->nombre."' de la semana $cont.";
                                $errors = $unidad_plan_desarrollo->errors;
                            }
                        }
                    }
                }else{
                    $message = "Ocurrio un error al guardar la informacion de la semana $cont.";
                    $errors = $plan_desarrollo_detalle->errors;
                }

                $cont++;
            }

            $plazos_extra = PlazoDocente::where('id_tercero',$plan_desarrollo->id_tercero)
                                       ->where('id_dominio_tipo_formato', config('global.desarrollo_asignatura'))
                                       ->where('id_periodo_academico', $plan_desarrollo->id_periodo_academico)
                                       ->where('id_asignatura', $plan_desarrollo->id_asignatura)
                                       ->where('estado', 1)
                                       ->get();
            foreach ($plazos_extra as $plazo) {
                $plazo->estado = 0;
                $plazo->save();
            } 

            //ahora verificamos si han cambiado la carga academica del tercero para los codigos de acceso a las clases
            $query_update = DB::statement('update codigo_acceso set estado = 0 where id_plan_desarrollo_asignatura = '.$plan_desarrollo->id_plan_desarrollo_asignatura);

            $carga_academica = Grupo::where('id_tercero', $plan_desarrollo->id_tercero)
                                    ->where('id_periodo_academico',  $plan_desarrollo->id_periodo_academico)
                                    ->where('id_asignatura',  $plan_desarrollo->id_asignatura)
                                    ->get();

            foreach ($carga_academica as $grupo) {
                $codigo_acceso = CodigoAcceso::where('id_plan_desarrollo_asignatura', $plan_desarrollo->id_plan_desarrollo_asignatura)
                                             ->where('id_grupo', $grupo->id_grupo)
                                             ->first();
                if($codigo_acceso){
                    $codigo_acceso->estado = 1;
                }else{
                    $codigo_acceso = new CodigoAcceso;
                    $codigo_acceso->token = md5($plan_desarrollo->id_plan_desarrollo_asignatura.'-'.$plan_desarrollo->id_asignatura.'-'.$plan_desarrollo->id_grupo.'-'.date('Y-m-d-H-i-s'));
                    $codigo_acceso->id_plan_desarrollo_asignatura = $plan_desarrollo->id_plan_desarrollo_asignatura;
                    $codigo_acceso->id_asignatura = $plan_desarrollo->id_asignatura;
                    $codigo_acceso->id_grupo = $grupo->id_grupo;                    
                }                             
                $codigo_acceso->save();
            }

            //aca ya registro bien todos los detalles
            $error = false;
            $message = "Plan de desarrollo asignatura actualizado correctamente.";
       }else{
            $message = "Error en la informacion enviada.";
       }

       if(count($errors) > 0) $error = true;

       return response()->json([
            'error' => $error,
            'message' => $message,
            'errors' => $errors
       ]);
    }

    public function imprimir($id_plan_desarrollo_asignatura)
    {
        $plan_desarrollo_asignatura = PlanDesarrolloAsignatura::find($id_plan_desarrollo_asignatura);
        if($plan_desarrollo_asignatura){
            if(session('is_admin') == true and $plan_desarrollo_asignatura->estado == "Enviado"){
                $this->marcar_revision($plan_desarrollo_asignatura);
            }
            $asignatura = $plan_desarrollo_asignatura->asignatura;
            $periodo_academico = $plan_desarrollo_asignatura->periodo_academico;
            $tercero = $plan_desarrollo_asignatura->tercero;
            $pdf = \PDF::loadView('plan_desarrollo_asignatura.pdf', compact([
                'plan_desarrollo_asignatura',
                'asignatura',
                'periodo_academico',
                'tercero'
            ]));/*
            return view('plan_asignatura.pdf', compact([
                'plan_asignatura',
                'asignatura',
                'periodo_academico'
            ]));*/
            return $pdf->stream("Plan de desarrollo asignatura ".$asignatura->nombre." de ".$periodo_academico->periodo.".pdf");
        }else{
            $titulo = "Formato invalido";
            $mensaje = "";
            return view('sitio.error',compact(['titulo', 'mensaje']));
            //echo "<br><br><br><center><h1></h1></center>";
        }
    }

    public function cargar_plan_existente(Request $request)
    {
        $post = $request->all();
        $error = true;
        $message = "";
        if($post){
            $post = (object) $post;
            //validamos si puede cargar desde cero el plan de asignatura siempre y cuando 
            //no hayan utilizado algun docente alguna de las unidades del plan
            $plan_desarrollo_asignatura_actual = new PlanDesarrolloAsignatura;
            if($post->id_plan_desarrollo_asignatura)
                $plan_desarrollo_asignatura_actual = PlanDesarrolloAsignatura::find($post->id_plan_desarrollo_asignatura);
 
            $plan_desarrollo_asignatura_actual->id_tercero = session('id_tercero_usuario');
            $plan_desarrollo_asignatura_actual->id_asignatura = $post->id_asignatura;
            $plan_desarrollo_asignatura_actual->id_periodo_academico = $post->id_periodo_academico_actual;

            //aca validamos todo para poder cargar
            $carga = $plan_desarrollo_asignatura_actual->cargar_plan_existente($post->id_periodo_academico_carga);
            $error = $carga->error;
            $message = $carga->message;
        }else{
            $message = "Error con la información enviada.";
        }

        return response()->json([
            'error' => $error,
            'message' => $message
        ]);

    }


    public function obtener_vista($id_plan_desarrollo_asignatura)
    {
        $plan_desarrollo_asignatura = PlanDesarrolloAsignatura::find($id_plan_desarrollo_asignatura);

        if($plan_desarrollo_asignatura){
            $asignatura = $plan_desarrollo_asignatura->asignatura;
            $periodo_academico = $plan_desarrollo_asignatura->periodo_academico;
            $tercero = $plan_desarrollo_asignatura->tercero;
            $vista = view('plan_desarrollo_asignatura.pdf', compact([
                'plan_desarrollo_asignatura',
                'asignatura',
                'periodo_academico',
                'tercero'
            ]));

            return response()->json($vista->render());
        }
    }

    public function consultar_general()
    {

        $periodos_academicos = DB::table('periodo_academico')
                   ->orderBy('id_periodo_academico','desc')
                   ->get();

        return view('plan_desarrollo_asignatura.consultar_general',compact('periodos_academicos'));
    }


    public function getReporte(Request $request)
    {
       $post = $request->all();

        if ($post) {
            $post = (object) $post;
            $condiciones1 = "";
            $condiciones2 = "";
            $condiciones3 = "";
            if ($post->periodo_academico and $post->periodo_academico != "") $condiciones1 .= " where id_periodo_academico = ".$post->periodo_academico;
            if ($post->id_tercero and $post->id_tercero != "") $condiciones2 .= " and id_tercero = ".$post->id_tercero;
            if ($post->id_asignatura and $post->id_asignatura != "") $condiciones3 .= " and id_asignatura = ".$post->id_asignatura;
            
            $planes = [];
            $sql = "select * from periodo_academico $condiciones1"; 
            $periodos_academicos = DB::select($sql);
            $sql2 = "select * from terceros where id_dominio_tipo_ter = 3 and id_licencia = ".session('id_licencia')." $condiciones2"; 
            $docentes = DB::select($sql2);
            $sql3 = "select * from asignatura where id_licencia = ".session('id_licencia')." $condiciones3"; 
            $asignaturas = DB::select($sql3);
            foreach ($periodos_academicos as $periodo_academico) {
                foreach ($docentes as $docente) {
                    foreach ($asignaturas as $asignatura) {
                        $tiene_carga_academica = Grupo::where('id_tercero', $docente->id_tercero)
                                                      ->where('id_periodo_academico',  $periodo_academico->id_periodo_academico)
                                                      ->where('id_asignatura',  $asignatura->id_asignatura)
                                                      ->first();


                        $plan['id_tercero'] = $docente->id_tercero;
                        $plan['docente'] = $docente->nombre." ".$docente->apellido;
                        $plan['periodo'] = $periodo_academico->periodo;
                        $plan['asignatura'] = $asignatura->nombre." (".$asignatura->codigo.")";

                        if($tiene_carga_academica){
                            $plan['tiene_carga_academica'] = 1;
                            $plan_desarrollo_asignatura = PlanDesarrolloAsignatura::where('id_tercero', $docente->id_tercero)
                                                      ->where('id_periodo_academico',  $periodo_academico->id_periodo_academico)
                                                      ->where('id_asignatura',  $asignatura->id_asignatura)
                                                      ->first();

                            if($plan_desarrollo_asignatura){
                                $plan['id_plan_desarrollo_asignatura'] = $plan_desarrollo_asignatura->id_plan_desarrollo_asignatura;
                                $plan['estado'] = $plan_desarrollo_asignatura->estado;
                                $plan['fecha'] = date('d/m/Y H:i', strtotime($plan_desarrollo_asignatura->created_at));
                            }else{
                                //como no existe hay q sacarle el retraso
                                $fecha_actual = date('Y-m-d H:i:s'); 
                                $plan['id_plan_desarrollo_asignatura'] = null;
                                $plan['estado'] = 'Pendiente';
                                $plan['retraso'] = PlanDesarrolloAsignatura::retraso($docente->id_tercero, $periodo_academico->id_periodo_academico, $asignatura->id_asignatura);
                            }

                            if ($post->estado and $post->estado != ""){
                                if($post->estado == $plan['estado']) array_push($planes, $plan);
                            }else{
                                array_push($planes, $plan);
                            }

                        }
                    }
                }
            }
            
            return response()->json($planes);
        }
        return response()->json("Error de data enviada");
    }


    public function obtener_temas(Request $request)
    {
        $post = $request->all();
        $temas = [];
        if($post){
            $post = (object) $post;
            $id_periodo_academico = $post->id_periodo_academico;
            $id_asignatura = $post->id_asignatura;
            $id_tercero = $post->id_tercero;

            $plan_desarrollo = PlanDesarrolloAsignatura::where('id_periodo_academico', $id_periodo_academico)
                                                       ->where('id_asignatura', $id_asignatura)
                                                       ->where('id_tercero', $id_tercero)
                                                       ->first();
            if($plan_desarrollo){
                foreach ($plan_desarrollo->ejes as $eje_plan_desarrollo) {
                    $temas[] = $eje_plan_desarrollo->eje->nombre;
                }
            }
        }
        return response()->json([
            'temas' => $temas
        ]);
    }
}
