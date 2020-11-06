<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ActividadesComplementarias extends Model
{
    protected $table = 'actividades_complementarias';
    protected $primaryKey = 'id_actividad_complementaria';

    protected $fillable = [
    	'id_tercero',
    	'id_plan_trabajo',
    	'observaciones',
    	'corte',
    	'estado'
    ];

    public function plan_trabajo()
	{
	    return $this->belongsTo(PlanTrabajo::class, 'id_plan_trabajo');
	}
    public function detalles()
    {
        return $this->hasMany(ActividadesComplementariasDetalle::class, 'id_actividad_complementaria');
    }

    public function get_tipos_de_actividades_realizadas()
    {
      $tipos_de_actividades = [];
      $tipos_de_actividades_ya_insertadas = [];
      foreach ($this->detalles as $detalle) {
           if (!in_array($detalle->actividad_plan_trabajo->id_dominio_tipo, $tipos_de_actividades_ya_insertadas)) {
            $tipo = Dominio::find($detalle->actividad_plan_trabajo->id_dominio_tipo);
            array_push($tipos_de_actividades, $tipo);
            array_push($tipos_de_actividades_ya_insertadas, $detalle->actividad_plan_trabajo->id_dominio_tipo);
            } 
      }

      return $tipos_de_actividades;
    }

    public function tiene_permiso_de_editar()
	{
		$periodo = $this->plan_trabajo->periodo_academico;
    	$fechas_de_entrega = FechasEntrega::where('id_periodo_academico',$periodo->id_periodo_academico)
                            ->where('id_dominio_tipo_formato',config('global.actividades_complementarias'))
                            ->where('id_licencia',session('id_licencia'))
    						->first();
    	$fecha_actual = date('Y-m-d');

        $plazo_extra = PlazoDocente::where('id_tercero', $this->id_tercero)
                                       ->where('id_formato', $this->id_actividad_complementaria)
                                       ->where('id_dominio_tipo_formato', config('global.actividades_complementarias'))
                                       ->where('estado', 1)
                                       ->first();
            if ($plazo_extra) {
                $fecha_inicio_plazo = date('Y-m-d', strtotime($plazo_extra->fecha_inicio));
                $fecha_fin_plazo = date('Y-m-d', strtotime($plazo_extra->fecha_fin));
                if ($fecha_actual >= $fecha_inicio_plazo and $fecha_actual <= $fecha_fin_plazo) {
                   return true;
                }
            }

        if(!$fechas_de_entrega) return false;

    	switch ($this->corte) {
        		case 1:
        			if ($fecha_actual <= $fechas_de_entrega->fechafinal1 and $fecha_actual >= $fechas_de_entrega->fechainicial1 and ($this->estado == 'Pendiente' or $this->estado == 'Enviado'))
        			{
        				return true;
        			}else{
        				return false;
        			}
        		case 2:
        			if ($fecha_actual <= $fechas_de_entrega->fechafinal2 and $fecha_actual >= $fechas_de_entrega->fechainicial2 and ($this->estado == 'Pendiente' or $this->estado == 'Enviado'))
        			{
        				return true;
        			}else{
        				return false;
        			}
        		case 3:
        			if ($fecha_actual <= $fechas_de_entrega->fechafinal3 and $fecha_actual >= $fechas_de_entrega->fechainicial3 and ($this->estado == 'Pendiente' or $this->estado == 'Enviado'))
        			{
        				return true;
        			}else{
        				return false;
        			}
        		
        		default:
        			return "Verifique el corte";
        			break;
        	}
	}

	public function retraso()
        {
        	$periodo = $this->plan_trabajo->periodo_academico;
        	$fechas_de_entrega = FechasEntrega::where('id_periodo_academico',$periodo->id_periodo_academico)
        						->where('id_dominio_tipo_formato',config('global.actividades_complementarias'))
                                ->where('id_licencia',session('id_licencia'))
        						->first();
        	$fecha_actual = date('Y-m-d H:i:s'); 
            $plazo_extra = PlazoDocente::where('id_tercero', $this->id_tercero)
                                       ->where('id_formato', $this->id_actividad_complementaria)
                                       ->where('id_dominio_tipo_formato', config('global.actividades_complementarias'))
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

            if(!$fechas_de_entrega) return "No se han configurado fechas";

        	switch ($this->corte) {
        		case 1:
        			if ($fecha_actual <= $fechas_de_entrega->fechafinal1) return "En espera";
		            $fechacierre = date("Y-m-d H:i:s", strtotime($fechas_de_entrega->fechafinal1));
		            $fecha_actual = date_create($fecha_actual);
		            $fechacierre = date_create($fechacierre);
		            $diferencia = date_diff($fecha_actual,$fechacierre);
		            $dias = $diferencia->days;
		            $horas = $diferencia->h;
		            return "Retrasado $dias dias y $horas horas";
        			break;
        		case 2:
        			if ($fecha_actual <= $fechas_de_entrega->fechafinal2) return "En espera";
		            $fechacierre = date("Y-m-d", strtotime($fechas_de_entrega->fechafinal2));
		            $fecha_actual = date_create($fecha_actual);
		            $fechacierre = date_create($fechacierre);
		            $diferencia = date_diff($fecha_actual,$fechacierre);
		            $dias = $diferencia->days;
		            $horas = $diferencia->h;
		            return "Retrasado $dias dias y $horas horas";
        			break;
        		case 3:
        			if ($fecha_actual <= $fechas_de_entrega->fechafinal3) return "En espera";
		            $fechacierre = date("Y-m-d", strtotime($fechas_de_entrega->fechafinal3));
		            $fecha_actual = date_create($fecha_actual);
		            $fechacierre = date_create($fechacierre);
		            $diferencia = date_diff($fecha_actual,$fechacierre);
		            $dias = $diferencia->days;
		            $horas = $diferencia->h;
		            return "Retrasado $dias dias y $horas horas";
        			break;
        		
        		default:
        			return "Verifique el corte";
        			break;
        	}
        
        }
        public function get_tipos_de_actividades_realizadas_por_tipo($tipo_actividad)
        {
          $detalles = [];
          foreach ($this->detalles as $detalle) {

            if($detalle->actividad_plan_trabajo->id_dominio_tipo == $tipo_actividad){
                array_push($detalles, $detalle);
            } 
          }
          return $detalles;
        } 

        public function get_ultima_fecha_actualizada($tipo_actividad)
        {
           $ultima_fecha_modificada = "Sin modificar";
           foreach ($this->detalles as $detalle) {
                if($detalle->actividad_plan_trabajo->id_dominio_tipo == $tipo_actividad){
                    if($ultima_fecha_modificada=="Sin modificar"){
                        $ultima_fecha_modificada = date('d/m/Y', strtotime($detalle->fecha));
                    }else{
                        if(date('Y-m-d', strtotime($detalle->fecha)) > $ultima_fecha_modificada){
                            $ultima_fecha_modificada = date('d/m/Y', strtotime($detalle->fecha));
                        }
                    }
                }
            }

            return $ultima_fecha_modificada;
        }

        public function get_total_detalles_por_actividad($tipo_actividad)
        {
           $array_actividades_ya_contadas =[];
           $cont = 0;
           foreach ($this->detalles as $detalle) {
            if($detalle->actividad_plan_trabajo->id_dominio_tipo == $tipo_actividad){
                if(!in_array($detalle->actividad_plan_trabajo->id_actividad_plan_trabajo, $array_actividades_ya_contadas)){
                    $cont++;
                }
                array_push($array_actividades_ya_contadas, $detalle->actividad_plan_trabajo->id_actividad_plan_trabajo);
            } 
          }
          return $cont;
        }

    
}
