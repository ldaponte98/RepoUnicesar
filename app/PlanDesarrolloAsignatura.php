<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PlanDesarrolloAsignatura extends Model
{
    protected $table = 'plan_desarrollo_asignatura';
    protected $primaryKey = 'id_plan_desarrollo_asignatura';

    public function detalles()
    {
    	return $this->hasMany(PlanDesarrolloAsignaturaDetalle::class, 'id_plan_desarrollo_asignatura');
    }

    public function puede_editar()
    {
    	if (session('id_perfil') == 1) return false;
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
					 $plazo_extra = PlazoDocente::where('id_tercero', $id_tercero)
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
}
