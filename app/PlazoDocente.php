<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class PlazoDocente extends Model
{
    protected $table = 'plazo_docente';
    protected $primaryKey = 'id_plazo_docente';

    public function tipo_formato()
	{
	    return $this->belongsTo(Dominio::class, 'id_dominio_tipo_formato');
	}

	public function tercero()
	{
	    return $this->belongsTo(Tercero::class, 'id_tercero');
	}

	public function tercero_otorga()
	{
	    return $this->belongsTo(Tercero::class, 'id_tercero_otorga');
	}

	public function asignatura()
	{
	    return $this->belongsTo(Asignatura::class, 'id_asignatura');
	}

	public function periodo_academico()
	{
		return $this->belongsTo(PeriodoAcademico::class, 'id_periodo_academico');
	}

	public static function reporte($id_dominio_tipo_formato, $id_periodo = null, $estado = null, $id_tercero = null)
	{

		$plazos = DB::table('plazo_docente')
                ->join('terceros','terceros.id_tercero', '=', 'plazo_docente.id_tercero')
                ->where('plazo_docente.id_dominio_tipo_formato', $id_dominio_tipo_formato)
			   	->where('terceros.id_licencia', session('id_licencia')); 

		if ($id_tercero) $plazos->where('id_tercero', $id_tercero);
		if ($estado) $plazos->where('plazo_docente.estado', $estado);
		$plazos = $plazos->get();
		$plazos_docente = [];
		if ($id_periodo) {
			foreach ($plazos as $plazo) {
				switch ($id_dominio_tipo_formato) {
		    		case config('global.plan_trabajo'):
		    			if ($plazo->id_periodo_academico == $id_periodo) $plazos_docente[] = $plazo;
		    			break;
		    		case config('global.desarrollo_asignatura'):
		    			if ($plazo->id_periodo_academico == $id_periodo) $plazos_docente[] = $plazo;
		    			break;
		    		case config('global.seguimiento_asignatura'):
		    			$seguimiento = SeguimientoAsignatura::find($plazo->id_formato);
		    			if ($seguimiento->grupo->id_periodo_academico == $id_periodo) $plazos_docente[] = $plazo;
		    			break;
		    		case config('global.actividades_complementarias'):
		    			$actividad = ActividadesComplementarias::find($plazo->id_formato);
		    			if ($actividad->plan_trabajo->id_periodo_academico == $id_periodo) $plazos_docente[] = $plazo;
		    			break;
		    	}
			}
		}else{
			$plazos_docente = $plazos;
		}
		
		return $plazos_docente;
	}
}
