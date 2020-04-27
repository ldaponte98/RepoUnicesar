<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SeguimientoAsignatura extends Model
{
    protected $table = 'seguimiento_asignatura';
    protected $primaryKey = 'id_seguimiento';
    protected $fillable = [
    	'id_seguimiento',
    	'id_tercero',
    	'corte',
    	'id_asignatura',
    	'id_grupo',
    	'num_creditos',
    	'num_estudiantes',
    	'porcentaje_desarrollo',
    	'porcentaje_ideal',
    	'relacion_ideal_real',
    	'prom_notas',
    	'aprobados',
        'reprobados',
        'num_est_sup_promedio',
        'num_est_no_sup_promedio',
        'reprobados',
    	'estrategias_didacticas',
    	'estrategias_evaluativas',
    	'estrategias_desa_cont_programatico',
    	'si_porc_efi_critico',
    	'sugerencias',
    	'fecha',
    	'estado',
    ];

    public $errores = [];

    public function rules()
    {
        return [
            'num_estudiantes' => 'required',
            'prom_notas' => 'required',
            'aprobados' => 'required',
            'reprobados' => 'required',
            'num_est_sup_promedio' => 'required',
            'num_est_no_sup_promedio' => 'required',
            'estrategias_didacticas' => 'required',
            'estrategias_evaluativas' => 'required',
            'si_porc_efi_critico' => 'required',
        ];
    }



    public function validar()
    {

    	if ($this->num_estudiantes == null or $this->num_estudiantes == "") array_push($this->errores, "El campo de numero de estudiantes es requerido");
    	if ($this->prom_notas == null or $this->prom_notas == "") array_push($this->errores, "El campo de promedio de notas es requerido");
    	if ($this->aprobados == null or $this->aprobados == "") array_push($this->errores, "El campo de aprobados es requerido") ;
        if ($this->reprobados == null or $this->reprobados == "") array_push($this->errores, "El campo de reprobados es requerido") ;
        if ($this->num_est_sup_promedio == null or $this->num_est_sup_promedio == "") array_push($this->errores, "El campo numero de estudiantes que superan el promedio es requerido");
        if ($this->num_est_no_sup_promedio == null or $this->num_est_no_sup_promedio == "") array_push($this->errores, "El campo numero de estudiantes que estan por debajo del promedio es requerido");
    	if ($this->estrategias_didacticas == null or $this->estrategias_didacticas == "") array_push($this->errores, "El campo de estrategias didacticas es requerido");
    	if ($this->estrategias_evaluativas == null or $this->estrategias_evaluativas == "") array_push($this->errores, "El campo de estrategias evaluativas es requerido");
    	if ($this->si_porc_efi_critico == null or $this->si_porc_efi_critico == "") array_push($this->errores, "El campo de si el porcentaje de eficiencia es critico es requerido");
    	if (count($this->errores) > 0) {
    		return false;
    	}
    	return true;
    }

    public function getNameCorte()
    {
        switch ($this->corte) {
        case 1:
           return "Primer corte";
        case 2:
           return "Segundo corte";
        case 3:
           return "Tercer corte";
        default:
           return "Corte invalido";
        }
    }

    public function asignatura()
	{
	    return $this->belongsTo(Asignatura::class, 'id_asignatura');
	}

	public function tercero()
	{
	    return $this->belongsTo(Tercero::class, 'id_tercero');
	}

	public function grupo()
	{
		return $this->belongsTo(Grupo::class, 'id_grupo');
	}

	public function unidades_programadas()
	{
		return $this->hasMany(UnidadAsignaturaSeguimiento::class, 'id_seguimiento_asignatura');
	}

	public function ejes_tematicos_desarrollados()
	{
		return $this->hasMany(EjeTematicoSeguimiento::class, 'id_seguimiento_asignatura');
	}

	public function causas()
	{
		return $this->hasMany(CausaSeguimiento::class, 'id_seguimiento_asignatura');
	}

	public function analisis_cualitativo()
	{
		return $this->hasMany(AnalisisCualitativoSeguimiento::class, 'id_seguimiento_asignatura');
	}

	public function tiene_permiso_de_editar($value='')
	{
		$periodo = $this->grupo->periodo_academico;
    	$fechas_de_entrega = FechasEntrega::where('id_periodo_academico',$periodo->id_periodo_academico)
    						->where('id_dominio_tipo_formato',config('global.seguimiento_asignatura'))
    						->first();
    	$fecha_actual = date('Y-m-d');

        $plazo_extra = PlazoDocente::where('id_tercero', $this->id_tercero)
                                       ->where('id_formato', $this->id_seguimiento)
                                       ->where('estado', 1)
                                       ->first();
            if ($plazo_extra) {
                $fecha_inicio_plazo = date('Y-m-d', strtotime($plazo_extra->fecha_inicio));
                $fecha_fin_plazo = date('Y-m-d', strtotime($plazo_extra->fecha_fin));
                if ($fecha_actual >= $fecha_inicio_plazo and $fecha_actual <= $fecha_fin_plazo) {
                   return true;
                }
            }

    	switch ($this->corte) {
        		case 1:
        			if ($fecha_actual <= $fechas_de_entrega->fechafinal1 and $fecha_actual >= $fechas_de_entrega->fechaInicial1 and ($this->estado == 'Pendiente' or $this->estado == 'Enviado'))
        			{
        				return true;
        			}else{
        				return false;
        			}
        		case 2:
        			if ($fecha_actual <= $fechas_de_entrega->fechafinal2 and $fecha_actual >= $fechas_de_entrega->fechaInicial2 and ($this->estado == 'Pendiente' or $this->estado == 'Enviado'))
        			{
        				return true;
        			}else{
        				return false;
        			}
        		case 3:
        			if ($fecha_actual <= $fechas_de_entrega->fechafinal3 and $fecha_actual >= $fechas_de_entrega->fechaInicial3 and ($this->estado == 'Pendiente' or $this->estado == 'Enviado'))
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
        	$periodo = $this->grupo->periodo_academico;
        	$fechas_de_entrega = FechasEntrega::where('id_periodo_academico',$periodo->id_periodo_academico)
        						->where('id_dominio_tipo_formato',config('global.seguimiento_asignatura'))
        						->first();
        	$fecha_actual = date('Y-m-d H:i:s'); 
            $plazo_extra = PlazoDocente::where('id_tercero', $this->id_tercero)
                                       ->where('id_formato', $this->id_seguimiento)
                                       ->where('estado', 1)
                                       ->first();
            if ($plazo_extra) {
                $fecha_inicio_plazo = date('Y-m-d H:i:s', strtotime($plazo_extra->fecha_inicio));
                $fecha_fin_plazo = date('Y-m-d H:i:s', strtotime($plazo_extra->fecha_fin));
                if ($fecha_actual >= $fecha_inicio_plazo and $fecha_actual <= $fecha_fin_plazo) {
                   return "Tiene plazo-extra";
                }
                
            }
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


    public function porcentaje_desarrollo_por_corte()
    {
       $total_ejes_tematicos_todos = count($this->asignatura->ejes_tematicos());
       $total_ejes_tematicos_desarrollados = count($this->ejes_tematicos_desarrollados);
       $porcentaje = 0;
       if ($total_ejes_tematicos_todos == 0){
            $porcentaje = 100;
       }else{
            $porcentaje = ($total_ejes_tematicos_desarrollados / $total_ejes_tematicos_todos) * 100;
       }
       return round($porcentaje, 2);
    }

	
}
