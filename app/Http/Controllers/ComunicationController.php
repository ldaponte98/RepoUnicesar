<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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


class ComunicationController extends Controller
{
    public function validateAccess(Request $request)
    {
        $ips = config('global.ips');
        return in_array($request->ip(), $ips);
    }

    public function updateProgramasAcademicos(Request $request)
    {
        $status_code = 401;
        $status_text = "";
        $errors = [];
        if ($this->validateAccess($request)) {
            $post = $request->all();
            if ($post) {
                $post = (object) $post;
                $programas = $post->programas;
                foreach ($programas as $programa) {
                    $programa = (object) $programa;
                    $p = Programa::where('id_academusoft', $programa->id_programa)->first();
                    if(!$p){
                        $p = new Programa;
                        $p->id_academusoft = $programa->id_programa;
                    }
                    $p->estado = isset($programa->estado) ? $programa->estado : 1; 
                    $facultad = Facultad::where('id_academusoft', $programa->id_facultad)->first();
                    if($facultad){
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
                        $licencia->email = $programa->email;
                        $licencia->telefono = $programa->telefono;
                        $licencia->sede = $programa->sede;
                        $licencia->save();
                    }else{
                        array_push($errors, array("id_programa_error" => $programa->id_programa));
                    }
                }

                $status_text = "Sincronizacion exitosa"; $status_code = 200;
                if(count($errors) > 0){
                    $status_text = "Sincronización exitosa con algunos programas sin poder actualizarse debido a que la facultad asignada no esta en el sistema.";
                }
            }
        }else{
            $status_text = "Acceso denegado";
        }
        return response()->json([
            "message" => $status_text,
            "errors" => $errors
        ], $status_code);
    }

    public function updateFacultades(Request $request)
    {
        $status_code = 401;
        $status_text = "";
        $errors = [];
        if ($this->validateAccess($request)) {
        	$post = $request->all();
        	$errors = [];
            if ($post) {
            	$post = (object) $post;
            	$facultades = $post->facultades;
            	foreach ($facultades as $facultad) {
            		$facultad = (object) $facultad;
            		$p = Facultad::where('id_academusoft', $facultad->id_facultad)->first();
            		if(!$p){
            			$p = new Facultad;
            			$p->id_academusoft = $facultad->id_facultad;
            		}
                    $p->estado = isset($facultad->estado) ? $facultad->estado : 1; 
            		$p->nombre = $facultad->nombre;
            		$p->save();
            	}
            	$status_text = "Sincronizacion exitosa"; $status_code = 200;
            }else{
                $status_text = "Error en datos enviados"; $status_code = 400;
            }
        }else{
            $status_text = "Acceso denegado";
        }
        return response()->json([
            "message" => $status_text,
            "errors" => $errors
        ], $status_code);
    }

    public function updatePeriodosAcademicos(Request $request)
    {
        $status_code = 401;
        $status_text = "";
        $errors = [];
        if ($this->validateAccess($request)) {
        	$post = $request->all();
            if ($post) {
            	$post = (object) $post;
            	$periodos = $post->periodos_academicos;
            	foreach ($periodos as $periodo) {
            		$periodo = (object) $periodo;
            		$p = PeriodoAcademico::where('id_academusoft', $periodo->id_periodo_academico)->first();
            		if(!$p){
            			$p = new PeriodoAcademico;
            			$p->id_academusoft = $periodo->id_periodo_academico;
            		}
            		$p->periodo = $periodo->periodo;
            		$p->fechaInicio = $periodo->fecha_inicio;
            		$p->fechaFin = $periodo->fecha_fin;
                    $p->estado = isset($periodo->estado) ? $periodo->estado : 1; 
            		if($p->save()){
                        $creacion_planes_asignatura = $this->crear_planes_asignatura($p);
                        $errors = $creacion_planes_asignatura->errors;
                    }else{
                        $status_text = "No se pudo guardar el periodo academico $periodo->id_periodo_academico";
                        $status_code = 400;
                        $errors[] = $p->errors;
                        break;
                    }
            	}
                $status_text = "Sincronizacion realizada"; $status_code = 200;
            }else{
                $status_text = "Error en datos enviados"; $status_code = 400;
            }
        }else{
            $status_text = "Acceso denegado";
        }
        return response()->json([
            "message" => $status_text,
            "errors" => $errors
        ], $status_code);
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
            'errors' => $errors,
            'message' => $message
        ];
    }

    public function updateAsignaturas(Request $request)
    {   
    	$status_code = 401;
        $status_text = "";
        $errors = [];
        if ($this->validateAccess($request)) {
            $post = $request->all();
            if ($post) {

            	$post = (object) $post;
            	$asignaturas = $post->asignaturas;
            	foreach ($asignaturas as $asignatura) {
            		$asignatura = (object) $asignatura;
            		$p = Asignatura::where('id_academusoft', $asignatura->id_asignatura)->first();
            		if(!$p){
            			$p = new Asignatura;
            			$p->id_academusoft = $asignatura->id_asignatura;
            		}
            		$p->codigo = $asignatura->codigo;
                    $p->nombre = $asignatura->nombre;
                    $p->tipo = $asignatura->tipo;
                    $p->naturaleza = $asignatura->naturaleza;
                    $p->prerrequisitos = $asignatura->prerrequisitos;
                    $p->correquisitos = $asignatura->correquisitos;
                    $p->num_creditos = $asignatura->num_creditos;
                    $p->habilitable = $asignatura->habilitable;
                    $p->validable = $asignatura->validable;
                    $p->homologable = $asignatura->homologable;
            		$p->horas_teoricas = $asignatura->horas_teoricas;
            		$p->horas_practicas = $asignatura->horas_practicas;
            		$p->horas_atencion_estudiantes = $asignatura->horas_atencion_estudiantes;
                    $p->horas_preparacion_evaluacion = $asignatura->horas_preparacion_evaluacion;
                    $p->horas_totales_trabajo_independiente = $asignatura->horas_totales_trabajo_independiente;
                    $p->horas_totales_semestre = $asignatura->horas_totales_semestre;
                    $p->estado = isset($asignatura->estado) ? $asignatura->estado : 1; 
            		$programa = Programa::where('id_academusoft', $asignatura->id_programa_perteneciente)->first();
            		if($programa){
            			$licencia = Licencia::where('id_programa', $programa->id_programa)->first();
            			if ($licencia) {
            				$p->id_licencia = $licencia->id_licencia;
            				$p->save();
            				//ahora guardamos en la intersecto de los programas a los q esta asignatura les puede dictar
            				$delete = AsignaturaPrograma::where('id_asignatura', $p->id_asignatura)->delete();
            				$programas = $asignatura->programas_dirigentes;
            				foreach ($programas as $id_programa) {
            					$programa = Programa::where('id_academusoft', $id_programa)->first();
            					if($programa){
            							$intersecto = new AsignaturaPrograma;
            							$intersecto->id_asignatura =  $p->id_asignatura;
            							$intersecto->id_programa =  $programa->id_programa;
            							$intersecto->save();
            					}else{
            						array_push($errors, array("id_programa_dirigente_error" => $id_programa));
            					}
            				}
            			}
            		}else{
            			array_push($errors, array("id_asignatura_error" => $asignatura->id_programa_perteneciente));
            		}	
            	}
            	$status_text = "Sincronizacion exitosa"; $status_code = 200;
                if(count($errors) > 0){
                    $status_text = "Sincronización exitosa con algunos programas sin poder actualizarse debido a que la facultad asignada no esta en el sistema.";
                }
            }else{
                $status_text = "Error en datos enviados"; $status_code = 400;
            }
        }else{
            $status_text = "Acceso denegado";
        }
        return response()->json([
            "message" => $status_text,
            "errors" => $errors
        ], $status_code);
    }

    public function auth(Request $request)
    {
        $status_code = 401;
        $status_text = "";
        $token = null;
        $errors = [];
        if ($this->validateAccess($request)) {
        	$post = $request->all();
        	if ($post) {
        	 	$post = (object) $post;
        	 	//primero registramos o editamos a el tercero
        	 	$tercero_post = (object)$post->tercero;
        	 	$tercero = Tercero::where('id_academusoft', $tercero_post->id_tercero)->first();
        	 	if(!$tercero){
        	 		$tercero = new Tercero;
        	 		$tercero->id_academusoft = $tercero_post->id_tercero;
        	 	}
        	 	$tercero->cedula = $tercero_post->identificacion;
        	 	$tercero->nombre = $tercero_post->nombres;
        	 	$tercero->apellido = $tercero_post->apellidos;
        	 	$tercero->email = $tercero_post->email;
        	 	$tercero->servicio = isset($tercero_post->servicio) ? $tercero_post->servicio : "";
        	 	$tercero->categoria = isset($tercero_post->categoria) ? $tercero_post->categoria : "";
        	 	$tercero->vinculacion = isset($tercero_post->vinculacion) ? $tercero_post->vinculacion : "";
                $tercero->estado = isset($tercero_post->estado) ? $tercero_post->estado : 1; 
        	 	if($tercero_post->tipo_tercero == "docente"){
        	 		$tercero->id_dominio_tipo_ter = 3;
        	 	}else if($tercero_post->tipo_tercero == "jefe_departamento"){
        	 		$tercero->id_dominio_tipo_ter = 2;
        	 	}else if($tercero_post->tipo_tercero == "alumno"){
                    $tercero->id_dominio_tipo_ter = 4;
                }else{
                    return response()->json([
                        "message" => "Error. Verificar el tipo de tercero: docente, jefe_departamento, alumno son los validos.",
                        "token" => $token,
                        "access" => config('global.url_base').'comunication/redirect/'.$token,
                        "errors" => $errors
                    ], 400);
        	 	}

        	 	$programa = Programa::where('id_academusoft', $tercero_post->id_programa)->first();
        	 	if(!$programa){
                    return response()->json([
                        "message" => "Error. El id_programa del tercero no esta registrado previamente.",
                        "token" => $token,
                        "errors" => $errors
                    ], 400);
        	 	}

        	 	$tercero->id_programa = $programa->id_programa;
        	 	$licencia = Licencia::where('id_programa', $programa->id_programa)->first();
        	 	$tercero->id_licencia = $licencia->id_licencia;

        	 	if(!$tercero->save()){
                    return response()->json([
                        "message" => "Hubo un error al guardar la info del tercero.",
                        "token" => $token,
                        "error" => $tercero->errors
                    ], 400);
        	 	}

        	 	//ahora buscamos en la tabla de usuarios si tiene 
        	 	$usuario = Usuario::where('id_tercero', $tercero->id_tercero)->first();
        	 	if(!$usuario){
        	 		$usuario = new Usuario;
        	 		$usuario->id_tercero = $tercero->id_tercero;
        	 	}
                if($tercero->id_dominio_tipo_ter == 4) $usuario->id_perfil = 3;
        	 	if($tercero->id_dominio_tipo_ter == 3) $usuario->id_perfil = 2;
                if($tercero->id_dominio_tipo_ter == 2) $usuario->id_perfil = 1;
                
                $usuario->usuario = $tercero->email;
                $usuario->clave = md5($tercero->cedula);
                $usuario->estado = isset($tercero_post->estado) ? $tercero_post->estado : 1; 
        	 	$usuario->save();

        	 	//ES DOCENTE Y SE DEBE VALIDAR LA CARGA ACADEMICA Y HORARIO
        	 	if($usuario->id_perfil == 2){

        	 		$carga_academica = (object) $tercero_post->carga_academica;
        	 		$periodo_academico = PeriodoAcademico::where('id_academusoft', $carga_academica->id_periodo_academico)->first();
        	 		if(!$periodo_academico){
                        return response()->json([
                            "message" => "Error. el periodo academico ingresado no esta previamente registrado.",
                            "token" => $token,
                            "error" => []
                        ], 400);
        	 		}
        	 		$horario = Horario::where('id_tercero', $tercero->id_tercero)->where('id_periodo_academico', $periodo_academico->id_periodo_academico)->first();
        	 		if(!$horario){
        	 			$horario = new Horario;
        	 			$horario->id_tercero =  $tercero->id_tercero;
        	 			$horario->id_periodo_academico =   $periodo_academico->id_periodo_academico;
        	 			$horario->save();
        	 		}
        	 		//ahora eliminamos todas las clases anteriormente registradas
        	 		//las clases son el dominio 25 en la bd
        	 		$result_delete = DB::statement('delete from horario_detalle where id_dominio_tipo_evento = 25 and id_horario = '.$horario->id_horario);

        	 		foreach ($carga_academica->horario as $detalle_horario) {
        	 			$detalle_horario = (object) $detalle_horario;
        	 			$asignatura = Asignatura::where('id_academusoft', $detalle_horario->id_asignatura)->first();
        	 			if($asignatura){
        	 				//primero le asignamos el grupo y asignatura al docente si no tiene (osea la carga academica)
        	 				$grupo = Grupo::where('id_periodo_academico', $periodo_academico->id_periodo_academico)
        	 							  ->where('id_asignatura', $asignatura->id_asignatura)
                                          ->where('id_tercero', $tercero->id_tercero)
                                          ->where('id_academusoft', $detalle_horario->id_grupo)
        	 							  ->first();
        	 				if(!$grupo){
        	 					$grupo = new Grupo;
        	 					$grupo->id_tercero = $tercero->id_tercero;
        	 					$grupo->id_asignatura = $asignatura->id_asignatura;
                                $grupo->id_periodo_academico = $periodo_academico->id_periodo_academico;
                                $grupo->id_academusoft = $detalle_horario->id_grupo;
        	 				}

        	 				$grupo->codigo = $detalle_horario->grupo;
        	 				$grupo->num_est_ini = $detalle_horario->num_estudiantes;
        	 				$grupo->save();

        	 				//ahora le registramos 3 seguimientos de asignatura por grupo
        	 				//si ya tiene no lo tocamos

        	 				$seguimientos = SeguimientoAsignatura::where('id_grupo', $grupo->id_grupo)
        	 													 ->where('id_asignatura', $asignatura->id_asignatura)
        	 													 ->where('id_tercero', $tercero->id_tercero)
        	 													 ->get();
        	 				if(count($seguimientos) != 3){
        	 					for ($corte = 1; $corte <= 3 ; $corte++) { 
        	 						$seguimiento = new SeguimientoAsignatura;
        	 						$seguimiento->id_tercero = $tercero->id_tercero;
        	 						$seguimiento->id_asignatura = $asignatura->id_asignatura;
        	 						$seguimiento->id_grupo = $grupo->id_grupo;
        	 						$seguimiento->corte = $corte;
        	 						$seguimiento->save();
        	 					}
        	 				}

        	 				//ahora creamos el evento en el horario osea el horario_detalle 

        	 				$evento = ucfirst(strtolower($asignatura->nombre))." (Grupo ".$grupo->codigo.")";
        	 				$detalle = new HorarioDetalle;
                            $detalle->id_horario = $horario->id_horario;
                            $detalle->id_dominio_tipo_evento = 25; //este es el dominio de las clases.
                            $detalle->dia_semana = $detalle_horario->dia;
                            $detalle->hora = $detalle_horario->hora;
                            $detalle->evento = $evento;
                            $detalle->save();


        	 			}else{
        	 				array_push($errors, array("id_asignatura_no_registrado" => $detalle_horario->id_asignatura));
        	 			}
        	 		}
        	 		if(count($errors) > 0){
        	 			return response()->json([
    		        		"message" => "Se actualizo la carga academica con algunos errores.",
                            "token" => $token,
    		        		"errors" => $errors,
    	        		], 400);
        	 		}
        	 	}

                if ($usuario->id_perfil == 3) {
                    //ES UN ALUMNO Y SE DEBE VALIDAR LA CARGA ACADEMICA
                    $carga_academica = (object) $tercero_post->carga_academica;
                    $periodo_academico = PeriodoAcademico::where('id_academusoft', $carga_academica->id_periodo_academico)
                                                         ->first();
                    if(!$periodo_academico){
                        return response()->json([
                            "message" => "Error. el periodo academico ingresado no esta previamente registrado.",
                            "token" => $token,
                            "error" => []
                        ], 400);
                    }

                    foreach ($carga_academica->grupos as $gru) {
                        $gru = (object) $gru;
                        $grupo = Grupo::where('id_academusoft', $gru->id_grupo)
                                        ->where('id_periodo_academico', $periodo_academico->id_periodo_academico)
                                        ->first();
                        if ($grupo) {
                            $tercero_grupo = TerceroGrupo::where('id_tercero', $usuario->id_tercero)
                                                         ->where('id_grupo', $grupo->id_grupo)
                                                         ->first();
                            if (!$tercero_grupo) {
                                $tercero_grupo = new TerceroGrupo;
                                $tercero_grupo->id_tercero = $usuario->id_tercero;
                                $tercero_grupo->id_grupo = $grupo->id_grupo;
                            }
                            $tercero_grupo->estado = $gru->estado;
                            $tercero_grupo->save();
                        }else{
                            return response()->json([
                                "message" => "Error. el grupo con id [".$gru->id_grupo."] no esta previamente registrado.",
                                "token" => $token,
                                "error" => []
                            ], 400);
                        }
                    }  
                }

        	 	//aca creamos el token de acceso para el usuario

                $status_text = "Carga academica actualizada"; $status_code = 200;
                $token = md5($usuario->id."-".date("Y-m-d-H-i-s"));
                $usuario->token = $token;
                $usuario->expiracion_token = date('Y-m-d H:i:s', strtotime(date('Y-m-d H:i:s')." 30 minutes"));
                $usuario->save();
        	}else{
                $status_text = "Error en datos enviados"; $status_code = 400;
            }
        }else{
            $status_text = "Acceso denegado";
        }
        return response()->json([
            "message" => $status_text,
            "token" => $token,
            "errors" => $errors
        ], $status_code);
    }

    

    public function login($token, Request $request)
    {
        $titulo = ""; $mensaje = "";
        $usuario = Usuario::where('token', $token)->where('estado', 1)->first();
        if ($usuario) {
            $fecha_actual = date('Y-m-d H:i:s');
            if ($fecha_actual <= $usuario->expiracion_token) {
                $is_admin = false;
                $is_docente = false;
                $is_alumno = false;
                if ($usuario->id_perfil == 1) $is_admin=true;
                if ($usuario->id_perfil == 2) $is_docente=true;
                if ($usuario->id_perfil == 3) $is_alumno=true;
                $session = [
                    'id_usuario' => $usuario->id,
                    'id_tercero_usuario' =>  $usuario->tercero->id_tercero,
                    'id_licencia' => $usuario->tercero->id_licencia,
                    'is_admin' => $is_admin,
                    'is_docente' => $is_docente,
                    'is_alumno' => $is_alumno,
                ];
                $request->session()->flush();
                session($session);
                return redirect()->route("panel");
            }else{
                $titulo = "Acceso denegado"; $mensaje = "Sesión finalizada";
            }
        }else{
            $titulo = "Acceso denegado"; $mensaje = "No tiene permisos para ingresar a este sitio";
        }
        return view('sitio.error',compact(['titulo', 'mensaje']));
    }
}
