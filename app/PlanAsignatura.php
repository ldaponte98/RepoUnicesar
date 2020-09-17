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
				$unidad['nombre'] =  UnidadAsignatura::find($uni->id_unidad)->nombre;
				$unidad['id_unidad'] = $uni->id_unidad;
				$unidad['resultados_aprendizaje'] = $uni->resultados_aprendizaje;
				$unidad['horas_hdd'] = $uni->horas_hdd;
				$unidad['horas_htp'] = $uni->horas_htp;
				$unidad['horas_hti'] = $uni->horas_hti;
				$unidad['horas_htt'] = $uni->horas_htt;

				$seguimientos_que_usaron_la_unidad = UnidadAsignaturaSeguimiento::where('id_unidad_asignatura',$uni->id_unidad)->first();
				if($seguimientos_que_usaron_la_unidad){
					$unidad['puede_eliminar'] = false;
				}else{
					$unidad['puede_eliminar'] = true;
				}
				$unidad['ejes'] = [];
				$unidad = (object) $unidad;
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


}
