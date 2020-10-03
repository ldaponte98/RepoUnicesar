<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class PlanAsignatura extends Model
{
    protected $table = 'plan_asignatura';
    protected $primaryKey = 'id_plan_asignatura';

    public function periodo_academico()
	{
		return $this->belongsTo(PeriodoAcademico::class, 'id_periodo_academico');
	}
	public function asignatura()
	{
		return $this->belongsTo(Asignatura::class, 'id_asignatura');
	}
	public function detalles()
	{
		return $this->hasMany(PlanAsignaturaDetalle::class, 'id_plan_asignatura');
	}

	public function unidades()
	{
		$unidades = [];
		if($this->id_plan_asignatura){
			$sql = "select * from plan_asignatura_unidad where id_plan_asignatura = ".$this->id_plan_asignatura;
			$data = DB::select($sql);
			$unidades = [];
			foreach ($data as $uni) {
				$uni = (object) $uni;

				$unidad = (object)[];
				$unidad->nombre =  UnidadAsignatura::find($uni->id_unidad)->nombre;
				$unidad->id_unidad = $uni->id_unidad;
				$unidad->resultados_aprendizaje = $uni->resultados_aprendizaje;
				$unidad->horas_hdd = $uni->horas_hdd;
				$unidad->horas_htp = $uni->horas_htp;
				$unidad->horas_hti = $uni->horas_hti;
				$unidad->horas_htt = $uni->horas_htt;


				//ahora miramos si la unidad la usaron en el mismo periodo academico 
				//que el del actual plan de asignatura
				$sql = "select uas.* from 
				unidad_asignatura_seguimiento uas 
				left join seguimiento_asignatura sa on uas.id_seguimiento_asignatura = sa.id_seguimiento
				left join grupo g using(id_grupo)
				where uas.id_unidad_asignatura = ".$uni->id_unidad."
				and g.id_periodo_academico = ".$this->id_periodo_academico;

				$seguimientos_que_usaron_la_unidad = DB::select($sql);

				if(count($seguimientos_que_usaron_la_unidad) > 0){
					$unidad->puede_eliminar = false;
				}else{
					$unidad->puede_eliminar = true;
				}
				$unidad->ejes = [];
				
				$sql_ejes = "select id_eje_tematico from plan_asignatura_eje_tematico where id_plan_asignatura_unidad = ".$uni->id_plan_asignatura_unidad;
				$data_ejes = DB::select($sql_ejes);
				foreach ($data_ejes as $eje) {
					$eje = (object) $eje;
					$unidad->ejes[] = EjeTematico::find($eje->id_eje_tematico);
				}

				$unidades[] = $unidad;
			}
		
		}
		return $unidades;
	}

	public function puede_cargar()
	{
		foreach ($this->unidades() as $unidad) {
			if(!$unidad->puede_eliminar) return false;
		}
		return true;
	}

	public function cargar_plan_existente($id_periodo_academico_carga)
	{
		$message = "";
		$error = true;
		//Buscamos la informacion del plan de asignatura del cual vamos a cargar
		$plan_asignatura_carga = PlanAsignatura::where('id_periodo_academico',$id_periodo_academico_carga)
                                                   ->where('id_asignatura', $this->id_asignatura)
                                                   ->first();

        if($plan_asignatura_carga){
            if($this->puede_cargar()){
                $this->descripcion_asignatura = $plan_asignatura_carga->descripcion_asignatura;
                $this->objetivo_general = $plan_asignatura_carga->objetivo_general;
                $this->objetivos_especificos = $plan_asignatura_carga->objetivos_especificos;
                $this->estrategias_pedagogicas = $plan_asignatura_carga->estrategias_pedagogicas;
                $this->competencias_genericas = $plan_asignatura_carga->competencias_genericas;
                $this->mecanismos_evaluacion = $plan_asignatura_carga->mecanismos_evaluacion;
                $this->referencias_bibliograficas = $plan_asignatura_carga->referencias_bibliograficas;
                if($this->save()){
                     if($this->cargar_unidades_ejes($plan_asignatura_carga)){
                        $error = false;
                        $message = "Plan de asignatura cargado exitosamente";
                    }else{
                        $message = "No se pudieron actualizar las unidades y ejes tematicos del actual plan de asignatura.";
                    }
                    
                }else{
                    $message = "No se pudo actualizar la información del actual plan de asignatura.";
                }
            }else{
                $message = "Este plan de asignatura no se puede cargar debido a que hay docentes que han utilizado las unidades y competencias unicas actuales.";
            }
        }else{
            $message = "No existe un plan de trabajo registrado con este periodo academico para la asignatura ".$this->asignatura->nombre.".";
        }
        
        return (object)[
        	'error' => $error,
        	'message' => $message
        ];
	}

    public function cargar_unidades_ejes($plan_asignatura_carga)
    {
        $result_delete = DB::statement('delete from plan_asignatura_eje_tematico where id_plan_asignatura = '.$this->id_plan_asignatura);
        $result_delete = DB::statement('delete from plan_asignatura_unidad where id_plan_asignatura = '.$this->id_plan_asignatura);
        
        foreach ($plan_asignatura_carga->unidades() as $unidad) {

            $unidad_plan_asignatura = new PlanAsignaturaUnidad;
            $unidad_plan_asignatura->id_plan_asignatura = $this->id_plan_asignatura;
            $unidad_plan_asignatura->id_unidad = $unidad->id_unidad;
            $unidad_plan_asignatura->resultados_aprendizaje = $unidad->resultados_aprendizaje;
            $unidad_plan_asignatura->horas_hdd = $unidad->horas_hdd;
            $unidad_plan_asignatura->horas_htp = $unidad->horas_htp;
            $unidad_plan_asignatura->horas_hti = $unidad->horas_hti;
            $unidad_plan_asignatura->horas_htt = $unidad->horas_htt;
            if(!$unidad_plan_asignatura->save()) return false;

            //ahora recorremos los ejes de la unidad
            foreach ($unidad->ejes as $competencia) {
                $competencia = (object) $competencia;
                $eje_plan_asignatura = new PlanAsignaturaEjeTematico;
                $eje_plan_asignatura->id_plan_asignatura = $this->id_plan_asignatura;
                $eje_plan_asignatura->id_plan_asignatura_unidad = $unidad_plan_asignatura->id_plan_asignatura_unidad;
                $eje_plan_asignatura->id_eje_tematico = $competencia->id_eje_tematico;
                if(!$eje_plan_asignatura->save()) return false;
            }
        }
        return true;
    }



}
