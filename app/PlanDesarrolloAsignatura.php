<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class PlanDesarrolloAsignatura extends Model
{
    protected $table = 'plan_desarrollo_asignatura';
    protected $primaryKey = 'id_plan_desarrollo_asignatura';

    public function detalles()
    {
    	return $this->hasMany(PlanDesarrolloAsignaturaDetalle::class, 'id_plan_desarrollo_asignatura');
    }

    public function unidades()
    {
        return $this->hasMany(PlanDesarrolloAsignaturaUnidad::class, 'id_plan_desarrollo_asignatura');
    }
    public function ejes()
    {
        return $this->hasMany(PlanDesarrolloAsignaturaEjeTematico::class, 'id_plan_desarrollo_asignatura');
    }
    public function asignatura()
	{
		return $this->belongsTo(Asignatura::class, 'id_asignatura');
	}
	public function tercero()
	{
	    return $this->belongsTo(Tercero::class, 'id_tercero');
	}

	public function periodo_academico()
	{
		return $this->belongsTo(PeriodoAcademico::class, 'id_periodo_academico');
	}

    public function puede_editar()
    {
    	if (session('is_admin') == true) return false;
    		$periodo = PeriodoAcademico::find($this->id_periodo_academico);
	    	$fechas_de_entrega = FechasEntrega::where('id_periodo_academico',$periodo->id_periodo_academico)
	                            ->where('id_dominio_tipo_formato',config('global.desarrollo_asignatura'))
	                            ->where('id_licencia',session('id_licencia'))
	    						->first();
	    	$fecha_actual = date('Y-m-d');
	    	if($fechas_de_entrega){
	        
	        if ($fecha_actual <= $fechas_de_entrega->fechafinal1 and $fecha_actual >= $fechas_de_entrega->fechaInicial1){
	        	if($this->estado == "Recibido"){//aca no puede modificar porq	el jefe ya lo reviso
	        		return false;
	        	}
				return true;
			}else{
				if($this->id_plan_desarrollo_asignatura != null){
					 $plazo_extra = PlazoDocente::where('id_tercero', $this->id_tercero)
	                                       ->where('id_formato', $this->id_plan_desarrollo_asignatura)
	                                       ->where('id_dominio_tipo_formato', config('global.desarrollo_asignatura'))
	                                       ->where('estado', 1)
	                                       ->first();

	                if ($plazo_extra) {
		                $fecha_inicio_plazo = date('Y-m-d', strtotime($plazo_extra->fecha_inicio));
		                $fecha_fin_plazo = date('Y-m-d', strtotime($plazo_extra->fecha_fin));
		                if ($fecha_actual >= $fecha_inicio_plazo and $fecha_actual <= $fecha_fin_plazo) {
		                   return true;
		                }
		            }
				}
				return false;
			}
		}else{
			return false;
		}
    }

    public function cargar_plan_existente($id_periodo_academico_carga)
	{
		$message = "";
		$error = true;
		//Buscamos la informacion del plan de asignatura del cual vamos a cargar
		$plan_desarrollo_carga = PlanDesarrolloAsignatura::where('id_periodo_academico',$id_periodo_academico_carga)
                                                   ->where('id_asignatura', $this->id_asignatura)
                                                   ->where('id_tercero', $this->id_tercero)
                                                   ->first();

        if($plan_desarrollo_carga){
            //if($this->puede_cargar()){ //aca se puede validar si se usan en las clases asistidas
                if($this->save()){
                    if($this->cargar_detalles($plan_desarrollo_carga)){
                        $error = false;
                        $message = "Plan de desarrollo asignatura cargado exitosamente";
                    }else{
                        $message = "No se pudieron actualizar los detalles del actual plan de desarrollo asignatura.";
                    }
                    
                }else{
                    $message = "No se pudo actualizar la información del actual plan de  desarrollo asignatura.";
                }
            /*}else{
                $message = "Este plan de desarrollo no se puede cargar debido a que hay docentes que han utilizado las unidades y competencias unicas actuales.";
            }*/
        }else{
            $message = "No existe un plan de desarrollo registrado por el docente con este periodo academico para la asignatura ".$this->asignatura->nombre.".";
        }
        
        return (object)[
        	'error' => $error,
        	'message' => $message
        ];
	}

	public function cargar_detalles($plan_desarrollo_carga)
    {
        $result_delete = DB::statement('delete from plan_desarrollo_asignatura_eje_tematico where id_plan_desarrollo_asignatura = '.$this->id_plan_desarrollo_asignatura);
        $result_delete = DB::statement('delete from plan_desarrollo_asignatura_unidad where id_plan_desarrollo_asignatura = '.$this->id_plan_desarrollo_asignatura);
        $result_delete = DB::statement('delete from plan_desarrollo_asignatura_detalle where id_plan_desarrollo_asignatura = '.$this->id_plan_desarrollo_asignatura);

        //la primera fecha seria la del periodo academico la final
        $fecha_inicio_siguiente = date('Y-m-d', strtotime($this->periodo_academico->fechaInicio));
        foreach ($plan_desarrollo_carga->detalles as $detalle) {

            $new_detalle = new PlanDesarrolloAsignaturaDetalle;
            $new_detalle->id_plan_desarrollo_asignatura  = $this->id_plan_desarrollo_asignatura ;
            $new_detalle->semana = $detalle->semana;
            $new_detalle->fecha_inicio = $fecha_inicio_siguiente;
            //simulando que se empieza siempre desde el lunes
            
            $nueva_fecha_fin = date('Y-m-d', strtotime($fecha_inicio_siguiente.' +5 days'));
            $new_detalle->fecha_fin = $nueva_fecha_fin;
            $fecha_inicio_siguiente = date('Y-m-d', strtotime($fecha_inicio_siguiente.' +7 days'));//esto es para que se vuele sabado y domingo y cuando vuelva a asignar escoja lunes

            $new_detalle->titulo_semana_parciales = $detalle->titulo_semana_parciales;
            $new_detalle->temas_trabajo_independiente = $detalle->temas_trabajo_independiente;
            $new_detalle->estrategias_metodologicas = $detalle->estrategias_metodologicas;
            $new_detalle->competencias = $detalle->competencias;
            $new_detalle->evaluacion_academica = $detalle->evaluacion_academica;
            $new_detalle->bibliografia = $detalle->bibliografia;
            $new_detalle->is_semana_parciales = $detalle->is_semana_parciales;
            $new_detalle->estado = $detalle->estado;

            if(!$new_detalle->save()) return false;

            //ahora recorremos las unidades
            foreach ($detalle->unidades as $unidad) {
            	$new_unidad = new PlanDesarrolloAsignaturaUnidad;
           		$new_unidad->id_plan_desarrollo_asignatura  = $this->id_plan_desarrollo_asignatura;
           		$new_unidad->id_plan_desarrollo_asignatura_detalle = $new_detalle->id_plan_desarrollo_asignatura_detalle;
           		$new_unidad->id_unidad_asignatura  = $unidad->id_unidad_asignatura;
           		$new_unidad->estado  = $unidad->estado;
            	
            	if(!$new_unidad->save()) return false;

            	foreach ($unidad->ejes as $eje) {
            		$new_eje = new PlanDesarrolloAsignaturaEjeTematico;
	           		$new_eje->id_plan_desarrollo_asignatura  = $this->id_plan_desarrollo_asignatura;
	           		$new_eje->id_plan_desarrollo_asignatura_unidad = $new_unidad->id_plan_desarrollo_asignatura_unidad;
	           		$new_eje->id_eje_tematico = $eje->id_eje_tematico;
	           		$new_eje->estado  = $eje->estado;
	           		if(!$new_eje->save()) return false;
            	}
            }
        }
        return true;
    }

    public static function retraso($id_tercero, $id_periodo_academico,$id_asignatura)
    {
        $fecha_actual = date('Y-m-d H:i:s');
        $fechas_de_entrega = FechasEntrega::where('id_periodo_academico',$id_periodo_academico)
                ->where('id_dominio_tipo_formato',config('global.desarrollo_asignatura'))
                ->first();

        $plazo_extra = PlazoDocente::where('id_tercero', $id_tercero)
                   ->where('id_periodo_academico', $id_periodo_academico)
                   ->where('id_asignatura', $id_asignatura)
                   ->where('id_dominio_tipo_formato', config('global.desarrollo_asignatura'))
                   ->where('estado', 1)
                   ->first();
        if ($plazo_extra) {
            return "Tiene plazo-extra";
            $fecha_inicio_plazo = date('Y-m-d H:i:s', strtotime($plazo_extra->fecha_inicio));
            $fecha_fin_plazo = date('Y-m-d H:i:s', strtotime($plazo_extra->fecha_fin));
            if ($fecha_actual >= $fecha_inicio_plazo and $fecha_actual <= $fecha_fin_plazo) {
               return "Tiene plazo-extra";
            }            
        }

        if($fechas_de_entrega){
            if ($fecha_actual <= $fechas_de_entrega->fechafinal1){
                return "En espera";
            }else{
                $fechacierre = date("Y-m-d H:i:s", strtotime($fechas_de_entrega->fechafinal1));
                $fecha_actual = date_create($fecha_actual);
                $fechacierre = date_create($fechacierre);
                $diferencia = date_diff($fecha_actual,$fechacierre);
                $dias = $diferencia->days;
                $horas = $diferencia->h;
                return "Retrasado $dias dias y $horas horas";
            }
        }else{
            return "Fechas sin definir";
        }
    }

    public static function dias_restantes_entrega($id_tercero, $id_periodo_academico,$id_asignatura)
    {
        $fecha_actual = date('Y-m-d'). "00:00:00";
        $fechas_de_entrega = FechasEntrega::where('id_periodo_academico',$id_periodo_academico)
                ->where('id_dominio_tipo_formato',config('global.desarrollo_asignatura'))
                ->first();

        $plazo_extra = PlazoDocente::where('id_tercero', $id_tercero)
                   ->where('id_periodo_academico', $id_periodo_academico)
                   ->where('id_asignatura', $id_asignatura)
                   ->where('id_dominio_tipo_formato', config('global.desarrollo_asignatura'))
                   ->where('estado', 1)
                   ->first();
        if ($plazo_extra) {
            
            $fecha_inicio_plazo = date('Y-m-d H:i:s', strtotime($plazo_extra->fecha_inicio));
            $fecha_fin_plazo = date('Y-m-d H:i:s', strtotime($plazo_extra->fecha_fin));
            $fecha_actual = date_create($fecha_actual);
            $fecha_fin = date_create($fecha_fin_plazo);
            $diferencia = date_diff($fecha_actual,$fecha_fin);
            $dias = $diferencia->days; 
            if ($dias == 0 and ($diferencia->h > 0 or $diferencia->m > 0)) $dias = 1;
            return $dias;
                        
        }

        if($fechas_de_entrega){
            $fechacierre = date("Y-m-d", strtotime($fechas_de_entrega->fechafinal1. "+1 days"))." 00:00:00";
            $fecha_actual = date_create($fecha_actual);
            $fechacierre = date_create($fechacierre);
            $diferencia = date_diff($fecha_actual,$fechacierre);
            $dias = $diferencia->days;
            if ($dias == 0 and ($diferencia->h > 0 or $diferencia->m > 0)) $dias = 1;
            return $dias;
        }else{
            return "Sin fechas de entrega registradas";
        }
    }

    public static function reporte($periodo_academico = "", $id_tercero = "", $id_asignatura = "", $estado = "", $id_licencia = null)
    {
        $id_licencia = $id_licencia == null ? session('id_licencia') : $id_licencia;
        $condiciones1 = "";
        $condiciones2 = "";
        $condiciones3 = "";
        if ($periodo_academico and $periodo_academico != "") $condiciones1 .= " where id_periodo_academico = ".$periodo_academico;
        if ($id_tercero and $id_tercero != "") $condiciones2 .= " and id_tercero = ".$id_tercero;
        if ($id_asignatura and $id_asignatura != "") $condiciones3 .= " and id_asignatura = ".$id_asignatura;
        
        $planes = [];
        $sql = "select * from periodo_academico $condiciones1"; 
        $periodos_academicos = DB::select($sql);
        $sql2 = "select * from terceros where id_dominio_tipo_ter = 3 and id_licencia = $id_licencia $condiciones2"; 
        $docentes = DB::select($sql2);
        $sql3 = "select * from asignatura where id_licencia = $id_licencia $condiciones3"; 
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
                            $plan['dias_restantes_entrega'] = PlanDesarrolloAsignatura::dias_restantes_entrega($docente->id_tercero, $periodo_academico->id_periodo_academico, $asignatura->id_asignatura);
                        }

                        if ($estado and $estado != ""){
                            if($estado == $plan['estado']) array_push($planes, $plan);
                        }else{
                            array_push($planes, $plan);
                        }
                    }
                }
            }
        }
        return $planes;
    }
}
