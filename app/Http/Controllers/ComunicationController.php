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


class ComunicationController extends Controller
{
    public function updateProgramasAcademicos(Request $request)
    {
    	$post = $request->all();
    	$errors = [];
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
        			$licencia->nombre = $programa->nombre;
        			$licencia->email = $programa->email;
        			$licencia->telefono = $programa->telefono;
        			$licencia->sede = $programa->sede;
        			$licencia->save();
        		}else{
        			array_push($errors, array("id_programa_error" => $programa->id_programa));
        		}
        	}

        	if(count($errors) > 0){
        		return response()->json(array(
	        		"message" => "Sincronización exitosa con algunos programas sin poder actualizarse debido a que la facultad asignada no esta en el sistema.",
	        		"errors" => $errors
	        	));
        	}

        	return response()->json(array(
	        		"message" => "Sincronización exitosa.",
	        		"errors" => $errors
	        	));
        }
    }




    public function updateFacultades(Request $request)
    {

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
        		$p->nombre = $facultad->nombre;
        		$p->save();
        	}
        	return response()->json(array(
        		"message" => "Sincronización exitosa",
        		"errors" => $errors
        	));
        }
        return response()->json(array(
        		"message" => "Error en datos enviados",
        		"errors" => $errors
        ));
    }

    public function updatePeriodosAcademicos(Request $request)
    {

    	$post = $request->all();
    	
    	$errors = [];
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
        		if($p->save()){
                    $creacion_planes_asignatura = $this->crear_planes_asignatura($p);
                    $errors = $creacion_planes_asignatura->errors;
                }else{
                    return response()->json(array(
                        "message" => "No se pudo guardar el periodo academico",
                        "errors" => $p->errors
                    ));
                }
        	}
        	return response()->json(array(
        		"message" => "Sincronización exitosa",
        		"errors" => $errors
        	));
        }
        return response()->json(array(
        		"message" => "Error en datos enviados",
        		"errors" => $errors
        ));
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
    	$post = $request->all();
    	$errors = [];
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
        			}else{
        				
        			}
        		}else{
        			array_push($errors, array("id_asignatura_error" => $asignatura->id_programa_perteneciente));
        		}	
        	}
        	if(count($errors) > 0){
        		return response()->json(array(
	        		"message" => "Sincronización exitosa con algunas asignaturas sin poder actualizarse debido a que el programa asignado no esta en el sistema.",
	        		"errors" => $errors
	        	));
        	}

        	return response()->json(array(
        		"message" => "Sincronización exitosa",
        		"errors" => $errors
        	));
        }
        return response()->json(array(
        		"message" => "Error en datos enviados",
        		"errors" => $errors
        ));
    }

    //esta actualiza la tabla intersecto que relaciona los programas a los q se les dicta una asignatura
    public function updateProgramasAsignaturas()
    {
    	$post = $request->all();
    	
    	$errors = [];
        if ($post) {
        	$post = (object) $post;
        	$programas_asignatura = $post->programas_asignatura;
        	foreach ($facultades as $facultad) {
        		$facultad = (object) $facultad;
        		$p = Facultad::where('id_academusoft', $facultad->id_facultad)->first();
        		if(!$p){
        			$p = new Facultad;
        			$p->id_academusoft = $facultad->id_facultad;
        		}
        		$p->nombre = $facultad->nombre;
        		$p->save();
        	}
        	return response()->json(array(
        		"message" => "Sincronización exitosa",
        		"errors" => $errors
        	));
        }
        return response()->json(array(
        		"message" => "Error en datos enviados",
        		"errors" => $errors
        ));
    }

     public function updateDocentes(Request $request)
    {
    	$post = $request->all();
    	$errors = [];
        if ($post) {
        	$post = (object) $post;
        	$docentes = $post->docentes;
        	foreach ($asignaturas as $asignatura) {
        		$asignatura = (object) $asignatura;
        		$p = Asignatura::where('id_academusoft', $asignatura->id_asignatura)->first();
        		if(!$p){
        			$p = new Asignatura;
        			$p->id_academusoft = $asignatura->id_asignatura;
        		}
        		$p->codigo = $asignatura->codigo;
        		$p->nombre = $asignatura->nombre;
        		$p->num_creditos = $asignatura->num_creditos;
        		$p->horas_teoricas = $asignatura->horas_teoricas;
        		$p->horas_practicas = $asignatura->horas_practicas;
        		$p->horas_atencion_estudiantes = $asignatura->horas_atencion_estudiantes;
        		$p->horas_preparacion_evaluacion = $asignatura->horas_preparacion_evaluacion;
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
        			}else{
        				
        			}
        		}else{
        			array_push($errors, array("id_asignatura_error" => $asignatura->id_programa_perteneciente));
        		}	
        	}
        	if(count($errors) > 0){
        		return response()->json(array(
	        		"message" => "Sincronización exitosa con algunas asignaturas sin poder actualizarse debido a que el programa asignado no esta en el sistema.",
	        		"errors" => $errors
	        	));
        	}

        	return response()->json(array(
        		"message" => "Sincronización exitosa",
        		"errors" => $errors
        	));
        }
       
    }

    public function auth(Request $request)
    {

    	$post = $request->all();
    	$errors = [];

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
    	 	$tercero->servicio = $tercero_post->servicio;
    	 	$tercero->categoria = $tercero_post->categoria;
    	 	$tercero->vinculacion = $tercero_post->vinculacion;

    	 	if($tercero_post->tipo_tercero == "docente"){
    	 		$tercero->id_dominio_tipo_ter = 3;
    	 	}else if($tercero_post->tipo_tercero == "jefe_departamento"){
    	 		$tercero->id_dominio_tipo_ter = 2;
    	 	}else{
    	 		return response()->json(array(
	        		"message" => "Error. Verificar el tipo de tercero: docente o jefe_departamento son los validos.",
	        		"error" => $errors,
	        	));
    	 	}

    	 	$programa = Programa::where('id_academusoft', $tercero_post->id_programa)->first();
    	 	if(!$programa){
    	 		return response()->json(array(
	        		"message" => "Error. El id_programa del tercero no esta registrado previamente.",
        			"error" => $errors,
        		));
    	 	}

    	 	$tercero->id_programa = $programa->id_programa;
    	 	$licencia = Licencia::where('id_programa', $programa->id_programa)->first();
    	 	$tercero->id_licencia = $licencia->id_licencia;

    	 	if(!$tercero->save()){
    	 		return response()->json(array(
	        		"message" => "Hubo un error al guardar la info del tercero.",
        			"error" => $tercero->errors
        		));
    	 	}

    	 	//ahora buscamos en la tabla de usuarios si tiene 
    	 	$usuario = Usuario::where('id_tercero', $tercero->id_tercero)->first();
    	 	if(!$usuario){
    	 		$usuario = new Usuario;
    	 		$usuario->id_tercero = $tercero->id_tercero;
    	 	}
    	 	if($tercero->id_dominio_tipo_ter == 3) $usuario->id_perfil = 2;
    	 	if($tercero->id_dominio_tipo_ter == 2) $usuario->id_perfil = 1;
            $usuario->usuario = $tercero->email;
            $usuario->clave = md5($tercero->cedula);
    	 	$usuario->save();

    	 	//si es docente debemos modificar la carga academica
    	 	if($usuario->id_perfil == 2){

    	 		$carga_academica = (object) $tercero_post->carga_academica;
    	 		$periodo_academico = PeriodoAcademico::where('id_academusoft', $carga_academica->id_periodo_academico)->first();
    	 		if(!$periodo_academico){
    	 			return response()->json(array(
		        		"message" => "Error. el periodo academico ingresado no esta previamente regstrado.",
	        			"error" => []
	        		));
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
    	 							  ->first();
    	 				if(!$grupo){
    	 					$grupo = new Grupo;
    	 					$grupo->id_tercero = $tercero->id_tercero;
    	 					$grupo->id_asignatura = $asignatura->id_asignatura;
    	 					$grupo->id_periodo_academico = $periodo_academico->id_periodo_academico;
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
    	 			return response()->json(array(
		        		"message" => "Se actualizo la carga academica con algunos errores.",
		        		"errors" => $errors,
	        		));
    	 		}
    	 		
    	 	}

    	 	//aca redireccionamos dependiendo el perfil del usuario
    	 	$is_admin = false;
            $is_docente = false;
            if ($usuario->id_perfil == 1) $is_admin=true;
            if ($usuario->id_perfil == 2) $is_docente=true;
    		session([
             'id_usuario' => $usuario->id,
             'id_tercero_usuario' =>  $usuario->tercero->id_tercero,
             'id_licencia' => $usuario->tercero->id_licencia,
             'is_admin' => $is_admin,
             'is_docente' => $is_docente,
    		]);

            if ($usuario->id_perfil == 1) return view('sitio.index',compact('usuario'));
            if ($usuario->id_perfil == 2) return view('sitio.index2',compact('usuario'));

    	 	return response()->json(array(
	        	"message" => "Hubo un error al redireccionar a la pagina debido al perfil del usuario ingresado.",
        		"error" => []
        	));
    	 }

    	return response()->json(array(
        		"message" => "Error en datos enviados",
        		"errors" => $errors
        ));
    }

    public function createJefeDepartamento(Request $request)
    {
        $post = $request->all();
        
        $errors = [];
        if ($post) {
            $post = (object) $post;
            $tercero_post = $post->tercero;
            foreach ($facultades as $facultad) {
                $facultad = (object) $facultad;
                $p = Facultad::where('id_academusoft', $facultad->id_facultad)->first();
                if(!$p){
                    $p = new Facultad;
                    $p->id_academusoft = $facultad->id_facultad;
                }
                $p->nombre = $facultad->nombre;
                $p->save();
            }
            return response()->json(array(
                "message" => "Sincronización exitosa",
                "errors" => $errors
            ));
        }
        return response()->json(array(
                "message" => "Error en datos enviados",
                "errors" => $errors
        ));
    }
}
