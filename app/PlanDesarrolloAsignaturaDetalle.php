<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PlanDesarrolloAsignaturaDetalle extends Model
{
    protected $table = 'plan_desarrollo_asignatura_detalle';
    protected $primaryKey = 'id_plan_desarrollo_asignatura_detalle';

    public function unidades()
    {
    	return $this->hasMany(PlanDesarrolloAsignaturaUnidad::class, 'id_plan_desarrollo_asignatura_detalle');
    }

    public function puede_eliminar()
    {
    	return true;
    }

    public function plan_desarrollo_asignatura()
    {
        return $this->belongsTo(PlanDesarrolloAsignatura::class, 'id_plan_desarrollo_asignatura');
    }

    public function texto_fecha()
    {
        $dia_inicio = explode('-', date('Y-m-d', strtotime($this->fecha_inicio)))[2];
        $mes_inicio = explode('-', date('Y-m-d', strtotime($this->fecha_inicio)))[1];
        $ano_inicio = explode('-', date('Y-m-d', strtotime($this->fecha_inicio)))[0];

        $dia_fin = explode('-', date('Y-m-d', strtotime($this->fecha_fin)))[2];
        $mes_fin = explode('-', date('Y-m-d', strtotime($this->fecha_fin)))[1];
        $ano_fin = explode('-', date('Y-m-d', strtotime($this->fecha_fin)))[0];

        $meses = [
          'enero', 
          'febrero', 
          'marzo',
          'abril',
          'mayo',
          'junio',
          'julio',
          'agosto',
          'septiembre',
          'octubre',
          'noviembre',
          'diciembre'
        ];

        if($mes_inicio == $mes_fin and $ano_inicio == $ano_fin){
          return "Del ".$dia_inicio." al ".$dia_fin." de ".$meses[intval($mes_inicio)-1]." de ".$ano_inicio;
        }

        if($mes_inicio != $mes_fin and $ano_inicio == $ano_fin){
          return "Del ".$dia_inicio." de ".$meses[intval($mes_inicio) - 1]." al ".$dia_fin." de ".$meses[intval($mes_fin) - 1]." de ".$ano_inicio;
        }

        if($mes_inicio != $mes_fin and $ano_inicio != $ano_fin){
          return "Del ".$dia_inicio." de ".$meses[intval($mes_inicio) - 1]." de ".$ano_inicio." al ".$dia_fin." de ".$meses[intval($mes_fin) - 1]." de ".$ano_fin;
        }

        return "Fecha no valida";
    }

    public function numero_unidad($id_unidad_asignatura)
    {
        $plan_asignatura = PlanAsignatura::where('id_asignatura', $this->plan_desarrollo_asignatura->id_asignatura)
                                         ->where('id_periodo_academico',$this->plan_desarrollo_asignatura->id_periodo_academico)
                                         ->first();
        $cont = 1;
        foreach($plan_asignatura->unidades() as $unidad){
            if($unidad->id_unidad == $id_unidad_asignatura) return $cont;
            $cont++;
        }

        return 0;
    }
    public function numero_eje($id_eje_tematico)
    {
        $plan_asignatura = PlanAsignatura::where('id_asignatura', $this->plan_desarrollo_asignatura->id_asignatura)
                                         ->where('id_periodo_academico',$this->plan_desarrollo_asignatura->id_periodo_academico)
                                         ->first();
        
        $eje = EjeTematico::find($id_eje_tematico);
        $unidad_search = UnidadAsignatura::find($eje->id_unidad_asignatura);

        foreach($plan_asignatura->unidades() as $unidad){
            if($unidad_search->id_unidad_asignatura == $unidad->id_unidad){
                 $cont = 1;
                foreach($unidad->ejes as $eje){
                    if($eje->id_eje_tematico == $id_eje_tematico) return $cont;
                    $cont++;
                }
            }
            
        }

        return 0;
        
    }
}
