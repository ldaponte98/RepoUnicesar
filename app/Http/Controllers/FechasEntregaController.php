<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\FechasEntrega;
use App\PeriodoAcademico;
use App\Dominio;
use App\Tercero;


class FechasEntregaController extends Controller
{
    public function index(Request $request)
    {

    	$periodo_academico = DB::table('periodo_academico')
			                   ->orderBy('id_periodo_academico','desc')
			                   ->first();
		$post = $request->all();

        if ($post) {
        	$post = (object) $post;
        	$periodo_academico = DB::table('periodo_academico')
			                   ->where('id_periodo_academico', $post->id_periodo_escojido)
			                   ->first();
        }

        $fechas_de_entrega_seguimiento = FechasEntrega::
        						where('id_periodo_academico', $periodo_academico->id_periodo_academico)
        					 	->where('id_dominio_tipo_formato', config('global.seguimiento_asignatura'))
        					 	->where('id_licencia', session('id_licencia'))
        					 	->first();
        $fechas_de_entrega_plan_trabajo = FechasEntrega::
        						where('id_periodo_academico', $periodo_academico->id_periodo_academico)
					 			->where('id_dominio_tipo_formato', config('global.plan_trabajo'))
					 			->where('id_licencia', session('id_licencia'))
					 			->first();
        $fechas_de_entrega_plan_desarrollo_asignatura = FechasEntrega::
								  where('id_periodo_academico', $periodo_academico->id_periodo_academico)
					 			->where('id_dominio_tipo_formato', config('global.desarrollo_asignatura'))
					 			->where('id_licencia', session('id_licencia'))
					 			->first();
        $fechas_de_entrega_actividades_complementarias = FechasEntrega::
								  where('id_periodo_academico', $periodo_academico->id_periodo_academico)
					 			->where('id_dominio_tipo_formato', config('global.actividades_complementarias'))
					 			->where('id_licencia', session('id_licencia'))
					 			->first();
       	

		return view('fechas.fechas_de_entrega',compact([
			'fechas_de_entrega_seguimiento', 
			'fechas_de_entrega_actividades_complementarias', 
			'fechas_de_entrega_plan_trabajo', 
			'fechas_de_entrega_plan_desarrollo_asignatura', 
			'periodo_academico'
		]));	     
    }

    public function editar(Request $request,$id_periodo_academico, $id_tipo_formato)
    {
    	$errores = "";
    	$fecha_de_entrega = FechasEntrega::
    						  where('id_periodo_academico', $id_periodo_academico)
				 			->where('id_dominio_tipo_formato', $id_tipo_formato)
				 			->where('id_licencia', session('id_licencia'))
				 			->first();
		$periodo_academico = PeriodoAcademico::find($id_periodo_academico);
		$formato = Dominio::find($id_tipo_formato);
		$post = $request->all();
        if ($post) {
        	//aca va a guardar o editar las fechas
        	$post = (object) $post;
        	$fecha_de_entrega = FechasEntrega::
    						  where('id_periodo_academico', $id_periodo_academico)
				 			->where('id_dominio_tipo_formato', $id_tipo_formato)
				 			->where('id_licencia', session('id_licencia'))
				 			->first();

			//aca creo un objeto si no to tiene registros
			if (!$fecha_de_entrega) {
				$fecha_de_entrega = new FechasEntrega;
				$fecha_de_entrega->id_periodo_academico = $id_periodo_academico;
				$fecha_de_entrega->id_dominio_tipo_formato = $id_tipo_formato;
				$fecha_de_entrega->id_licencia = session('id_licencia');
			}


			//esta fecha siempre va a venir
			if ($post->fechas1 == "Sin definir"){
				$errores = "La primera fecha debe definirla";
				return view('fechas.editar_fechas_de_entrega', compact(['fecha_de_entrega','periodo_academico','formato', 'errores']));	
			}	

			//esta fecha siempre va a venir
			$fecha_de_entrega->fechainicial1 = date('Y-m-d', strtotime(str_replace("/", "-",explode(' - ', $post->fechas1)[0])));
			$fecha_de_entrega->fechafinal1 = date('Y-m-d', strtotime(str_replace("/", "-",explode(' - ', $post->fechas1)[1])));
			
			if (isset($post->fechas2)) {
				if ($post->fechas2 != "Sin definir"){
					$fecha_de_entrega->fechainicial2 = date('Y-m-d', strtotime(str_replace("/", "-",explode(' - ', $post->fechas2)[0])));
					$fecha_de_entrega->fechafinal2 = date('Y-m-d', strtotime(str_replace("/", "-",explode(' - ', $post->fechas2)[1])));
				}
			}
			if (isset($post->fechas3)) {
				if ($post->fechas3 != "Sin definir"){
					$fecha_de_entrega->fechainicial3 = date('Y-m-d', strtotime(str_replace("/", "-",explode(' - ', $post->fechas3)[0])));
					$fecha_de_entrega->fechafinal3 = date('Y-m-d', strtotime(str_replace("/", "-",explode(' - ', $post->fechas3)[1])));
				}
			}

			$fecha_de_entrega->save();
			$request->session()->flash('mensaje_update_fechas', 'Fechas de '.$formato->dominio."(".$periodo_academico->periodo.") actualizadas");
        	return redirect()->route('fechas/fechas_de_entrega');

        }
    	return view('fechas.editar_fechas_de_entrega', compact(['fecha_de_entrega','periodo_academico','formato', 'errores']));	
    }

    public function plazo_extra(Request $request)
    {
    	$post = $request->all();
    	$docente = null;
        if ($post) {
        	$post = (object) $post;
        	if (isset($post->id_tercero)) {
        		if ($post->id_tercero != "" and $post->id_tercero != null) {
        			$docente = Tercero::find($post->id_tercero);
        		}
        	}
        }
        return view('fechas.plazo_extra_por_docente', compact(['docente']));	
    }
}
