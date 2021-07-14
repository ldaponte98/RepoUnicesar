<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http;
use App\Programa;
use App\Licencia;
use App\Facultad;
use App\PeriodoAcademico;
use App\Asignatura;
use App\Tercero;
use App\Usuario;
use App\Horario;
use App\Grupo;
use App\AsignaturaPrograma;
use App\SeguimientoAsignatura;
use App\HorarioDetalle;
use App\PlanAsignatura;
use App\TerceroGrupo;

class AcademusoftServiceController extends Controller
{
    public function sincronizar()
    {
    	$status_code = 401;
        $status_text = "";
        $errors = [];

        $sync_programas_facultades = $this->sincronizar_programas_facultades();
        if (!$sync_programas_facultades->error) {
        	//AHORA SE DEBEN SINCRONIZAR LAS ASIGNATURAS
        	$sync_periodo_actual = $this->sincronizar_periodo_academico();
	        if (!$sync_periodo_actual->error) {
	        	$status_text = "OK"; $status_code = 200;
	        }else{
	        	$status_text = $sync_programas_facultades->mensaje;
	        }
        }else{
        	$status_text = $sync_programas_facultades->mensaje;
        }

		return response()->json([
            "message" => $status_text,
            "errors" => $errors
        ], $status_code);
    }

    public function sincronizar_programas_facultades()
    {
    	$error = true;
    	$mensaje = "";
    	$url = config('global.services')->academusoft->sync_programas_facultades;
        $http = Http::get($url);
        if (!$http->error) {
        	if ($http->response->status == "200") {
        		$data = $http->response->data;
        		foreach ($data as $programa) {
                    $programa = (object) $programa;
                    $p = Programa::where('id_academusoft', $programa->id)->first();
                    if(!$p){
                        $p = new Programa;
                        $p->id_academusoft = $programa->id;
                    }
                    $p->estado = isset($programa->estado) ? $programa->estado : 1; 

                    //SE REGISTRA LA FACULTAD SI YA NO EXOSTE
                    $facultad = Facultad::where('nombre', $programa->facultad)->first();
                    if(!$facultad){
                        $facultad = new Facultad;
                        $facultad->nombre = $programa->facultad;
                        $facultad->save();
                    }
                    
                    $p->id_facultad = $facultad->id_facultad;
                    $p->nombre = $programa->nombre;
                    $p->save();

                    //ahora registro la licencia del programa academico
                    $licencia = Licencia::where('id_programa', $p->id_programa)->first();
                    if (!$licencia) {
                        $licencia = new Licencia;
                        $licencia->id_programa = $p->id_programa;
                    }
                    $licencia->estado = $p->estado;
                    $licencia->nombre = $programa->nombre;
                    $licencia->email = isset($programa->email) ? $programa->email : "No definido";
                    $licencia->telefono = isset($programa->telefono) ? $programa->telefono : "No definido"; 
                    $licencia->sede = isset($programa->sede) ? $programa->sede : "No definido"; 
                    $licencia->save();
                }
                $error = false; $mensaje = "OK";
        	}else{
        		$mensaje = $http->response->message;
        	}
        }else{
        	$mensaje = $http->message;
        }
        return (object) [
        	'error' => $error,
        	'mensaje' => $mensaje
        ];
    }

    public function sincronizar_periodo_academico()
    {
    	$error = true;
    	$mensaje = "";
    	$url = config('global.services')->academusoft->sync_periodo_actual;
        $http = Http::get($url);
        if (!$http->error) {
            if (isset($http->response->status)) {
                if ($http->response->status == "200") {
                    $data = $http->response->data;
                    $codigo_periodo = $data->anio."-".$data->periodo;
                    $periodo = PeriodoAcademico::where('periodo', $codigo_periodo)->first();
                    if(!$periodo){
                        $periodo = new PeriodoAcademico;
                        $periodo->periodo = $codigo_periodo;
                    }
                    
                    $periodo->fechaInicio = date('Y-m-d', strtotime($data->fecha_inicio));
                    $periodo->fechaFin = date('Y-m-d', strtotime($data->fecha_fin));
                    $periodo->estado = isset($periodo->estado) ? $periodo->estado : 1;

                    //CALCULAMOS LA CANTIDAD DE SEMANAS DEL PERIODO
                    $fecha_inicio = new \DateTime($periodo->fechaInicio);
                    $fecha_fin = new \DateTime($periodo->fechaFin);
                    $interval = $fecha_inicio->diff($fecha_fin);
                    $semanas = floor(($interval->format('%a') / 7));
                    $periodo->total_semanas =  $semanas;

                    if($periodo->save()){
                        $creacion_planes_asignatura = $this->crear_planes_asignatura($periodo);
                        $error = false; $mensaje = "OK";
                    }else{
                        $mensaje = "No se pudo guardar el periodo academico $codigo_periodo";
                    }
                }else{
                    $mensaje = $http->response->message;
                }
            }else{
                $mensaje = "Servicio de academusoft caido";
            }
        }else{
        	$mensaje = $http->message;
        }
        return (object) [
        	'error' => $error,
        	'mensaje' => $mensaje
        ];
    }


    public function crear_planes_asignatura($periodo_academico)
    {

        $error = true;
        $errors = [];
        $message = "";
        //buscamos el ultimo periodo academico registrado
        $ultimo_periodo = DB::table('periodo_academico') 
                              ->orderBy('id_periodo_academico', 'desc')
                              ->where('id_periodo_academico','<>',$periodo_academico->id_periodo_academico)
                              ->first();
        if($ultimo_periodo){
            //Buscamos todas las asignaturas
            $asignaturas = Asignatura::all()->where('id_licencia', 6);
            foreach ($asignaturas as $asignatura) {
                //miramos si ya existe el plan de asignatura y se deja como esta
                $existe = PlanAsignatura::where('id_periodo_academico',$periodo_academico->id_periodo_academico)
                                                   ->where('id_asignatura', $asignatura->id_asignatura)
                                                   ->first();
                if (!$existe) {
                    //creamos los planes de asignatura a las asignaturas
                    $plan_asignatura = new PlanAsignatura;
                    $plan_asignatura->id_asignatura = $asignatura->id_asignatura;
                    $plan_asignatura->id_periodo_academico = $periodo_academico->id_periodo_academico;
                    
                    //le cargamos al nuevo plan de asignatura el plan de asignatura del ultimi
                    $carga = $plan_asignatura->cargar_plan_existente($ultimo_periodo->id_periodo_academico);
                    $error = $carga->error;
                    $message = $carga->message; 

                    if($error){
                        $errors[] = $message;
                    }
                }
            }
            $error = false;
        }else{
            $error = false;
            $message = "No hay periodos academicos antiguos"; 
        }

        return (object)[
        	'error' => $error,
            'errors' => $errors,
            'message' => $message
        ];
    }

    
}
