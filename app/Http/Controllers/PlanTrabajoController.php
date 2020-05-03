<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Tercero;
use App\PlanTrabajo;
use App\ActividadesPlanTrabajo;
use App\FechasEntrega;

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
        

    	return view('plan_de_trabajo.view',compact([
    		'plan_trabajo',
			'periodo_academico',
            'permiso_para_modificar'
		]));	     
    }

    public function editar(Request $request)
    {
    	
		$post = $request->all();
		if($post){
			$post = (object) $post;
			$plan_trabajo = new PlanTrabajo;
			if($post->id_plan_trabajo){
				$plan_trabajo = PlanTrabajo::find($post->id_plan_trabajo);
			}
			$plan_trabajo->fill($request->except([
                '_token',
                'id_plan_trabajo',
                'actividades'
            ]));

            if($plan_trabajo->save()){
            	//ahora se eliminan las actividades que antes tenia si tenia
            	$result_delete = DB::statement('delete from actividades_plan_trabajo where id_plan_trabajo = '.$plan_trabajo->id_plan_trabajo);
            	if(isset($post->actividades)){
            	foreach ($post->actividades as $a) {
            		$a = (object) $a;
            		$actividad = new ActividadesPlanTrabajo;
            		$actividad->id_plan_trabajo = $plan_trabajo->id_plan_trabajo;
            		$actividad->nombre = $a->nombre;
            		$actividad->descripcion = $a->descripcion;
            		$actividad->acta_aprobada = $a->acta;
            		$actividad->fecha_aprobada = $a->fecha_aprobada;
            		$actividad->fecha_iniciacion = $a->fecha_iniciacion;
            		$actividad->horas_por_semana = $a->horas_semanales;
            		$actividad->id_dominio_tipo = $a->tipo;
            		$actividad->save();
            	}
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
            $condiciones1 = "";
            $condiciones2 = "";
            if ($post->periodo_academico and $post->periodo_academico != "") $condiciones1 .= " where id_periodo_academico = ".$post->periodo_academico;
            if ($post->id_tercero and $post->id_tercero != "") $condiciones2 .= " and id_tercero = ".$post->id_tercero;
            
            $docentes = Tercero::all()
                        ->where('id_licencia', session('id_licencia'));
            $planes = [];
            $sql = "select * from periodo_academico $condiciones1"; 
            $periodos_academicos = DB::select($sql);
            $sql2 = "select * from terceros where id_dominio_tipo_ter = 3 and id_licencia = ".session('id_licencia')." $condiciones2"; 
            $docentes = DB::select($sql2);

            foreach ($periodos_academicos as $periodo_academico) {
                foreach ($docentes as $docente) {
                    $plan_trabajo = PlanTrabajo::where('id_tercero', $docente->id_tercero)->where('id_periodo_academico',  $periodo_academico->id_periodo_academico)->first();

                    $plan['id_tercero'] = $docente->id_tercero;
                    $plan['docente'] = $docente->nombre." ".$docente->apellido;
                    $plan['periodo'] = $periodo_academico->periodo;

                    //aca verifico si el docente tiene un plan en este periodo
                    $plan_trabajo = PlanTrabajo::where('id_tercero', $docente->id_tercero)->where('id_periodo_academico',  $periodo_academico->id_periodo_academico)->first();
                    if($plan_trabajo){
                        $plan['id_plan_trabajo'] = $plan_trabajo->id_plan_trabajo;
                        $plan['estado'] = $plan_trabajo->estado;
                        $plan['fecha'] = $plan_trabajo->fecha;
                    }else{
                        //como no existe hay q sacarle el retraso
                        $fecha_actual = date('Y-m-d H:i:s'); 
                        $plan['id_plan_trabajo'] = null;
                        $plan['estado'] = 'Pendiente';
                        $fechas_de_entrega = FechasEntrega::where('id_periodo_academico',$periodo_academico->id_periodo_academico)
                                ->where('id_dominio_tipo_formato',config('global.plan_trabajo'))
                                ->first();

                        if ($fecha_actual <= $fechas_de_entrega->fechafinal1){
                            $plan['retraso'] = "En espera";
                        }else{
                            $fechacierre = date("Y-m-d H:i:s", strtotime($fechas_de_entrega->fechafinal1));
                            $fecha_actual = date_create($fecha_actual);
                            $fechacierre = date_create($fechacierre);
                            $diferencia = date_diff($fecha_actual,$fechacierre);
                            $dias = $diferencia->days;
                            $horas = $diferencia->h;
                            $plan['retraso'] = "Retrasado $dias dias y $horas horas";
                        }
                    }
                    if ($post->estado and $post->estado != ""){
                        if($post->estado == $plan['estado']) array_push($planes, $plan);
                    } else{
                        array_push($planes, $plan);
                    }
                    
                }
            }
            
            return response()->json($planes);
        }
        return response()->json("nada llego");
    }

    public function imprimir($id_plan_trabajo)
    {
        $plan_trabajo = PlanTrabajo::find($id_plan_trabajo);
        if($plan_trabajo){
            if ($plan_trabajo->estado == 'Enviado' and session('id_usuario')==true and session('is_admin')==true) {
                    $plan_trabajo->estado = 'Recibido';
                    $plan_trabajo->save();
                }
                $pdf = \PDF::loadView('plan_de_trabajo.pdf_plan_trabajo', compact('plan_trabajo'));
                return $pdf->stream("Plan de trabajo ".$plan_trabajo->periodo_academico->periodo.".pdf");
        }
    }
}
