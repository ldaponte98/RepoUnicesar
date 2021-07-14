<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

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

    public function plan_asignatura()
    {
        $plan_asignatura = PlanAsignatura::where('id_asignatura', $this->id_asignatura)
                                         ->where('id_periodo_academico', $this->grupo->id_periodo_academico)
                                         ->first();
        return $plan_asignatura;
    }

	public function tiene_permiso_de_editar($value='')
	{
		$periodo = $this->grupo->periodo_academico;
    	$fechas_de_entrega = FechasEntrega::where('id_periodo_academico',$periodo->id_periodo_academico)
                            ->where('id_dominio_tipo_formato',config('global.seguimiento_asignatura'))
                            ->where('id_licencia',session('id_licencia'))
    						->first();
        if(!$fechas_de_entrega) return false;
    	$fecha_actual = date('Y-m-d');

        $plazo_extra = PlazoDocente::where('id_tercero', $this->id_tercero)
                                       ->where('id_formato', $this->id_seguimiento)
                                       ->where('id_dominio_tipo_formato', config('global.seguimiento_asignatura'))
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
    	$periodo = $this->grupo->periodo_academico;
    	$fechas_de_entrega = FechasEntrega::where('id_periodo_academico',$periodo->id_periodo_academico)
    						->where('id_dominio_tipo_formato',config('global.seguimiento_asignatura'))
                            ->where('id_licencia',session('id_licencia'))
    						->first();
        if(!$fechas_de_entrega) return "En espera";
    	$fecha_actual = date('Y-m-d H:i:s'); 
        $plazo_extra = PlazoDocente::where('id_tercero', $this->id_tercero)
                                   ->where('id_formato', $this->id_seguimiento)
                                   ->where('id_dominio_tipo_formato', config('global.seguimiento_asignatura'))
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
    	switch ($this->corte) {
    		case 1:
    			if ($fecha_actual <= $fechas_de_entrega->fechafinal1) return "En espera";
	            $fechacierre = date("Y-m-d H:i:s", strtotime($fechas_de_entrega->fechafinal1));
	            $fecha_actual = date_create($fecha_actual);
	            $fechacierre = date_create($fechacierre);
	            $diferencia = date_diff($fecha_actual,$fechacierre);
	            $dias = $diferencia->days;
	            $horas = $diferencia->h;
                $retraso = "";
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

    public function dias_restantes_entrega()
    {
        $periodo = $this->grupo->periodo_academico;
        $fechas_de_entrega = FechasEntrega::where('id_periodo_academico',$periodo->id_periodo_academico)
                            ->where('id_dominio_tipo_formato',config('global.seguimiento_asignatura'))
                            ->where('id_licencia',$this->asignatura->id_licencia)
                            ->first();
        if(!$fechas_de_entrega) return "Sin fechas de entrega registradas";
        $fecha_actual = date('Y-m-d H:i:s'); 
        $plazo_extra = PlazoDocente::where('id_tercero', $this->id_tercero)
                                   ->where('id_formato', $this->id_seguimiento)
                                   ->where('id_dominio_tipo_formato', config('global.seguimiento_asignatura'))
                                   ->where('estado', 1)
                                   ->first();
        if ($plazo_extra) {
            $fecha_inicio_plazo = date('Y-m-d H:i:s', strtotime($plazo_extra->fecha_inicio));
            $fecha_fin_plazo = date('Y-m-d H:i:s', strtotime($plazo_extra->fecha_fin. "+1 days"));
            $fecha_actual = date('Y-m-d'). "00:00:00";
            $fecha_actual = date_create($fecha_actual);
            $fecha_fin = date_create($fecha_fin_plazo);
            $diferencia = date_diff($fecha_actual,$fecha_fin);
            $dias = $diferencia->days; 
            if ($dias == 0 and ($diferencia->h > 0 or $diferencia->m > 0)) $dias = 1;
            return $dias;
        }
        $fecha_actual = date('Y-m-d'). "00:00:00";
        switch ($this->corte) {
            case 1:
                if ($fecha_actual > $fechas_de_entrega->fechafinal1){
                    return "Sin dias disponibles";
                }else{
                    $fechacierre = date("Y-m-d", strtotime($fechas_de_entrega->fechafinal1. "+1 days"))." 00:00:00";
                    $fecha_actual = date_create($fecha_actual);
                    $fechacierre = date_create($fechacierre);
                    $diferencia = date_diff($fecha_actual,$fechacierre);
                    $dias = $diferencia->days;
                    if ($dias == 0 and ($diferencia->h > 0 or $diferencia->m > 0)) $dias = 1;
                    return $dias;
                }
                break;
            case 2:
                if ($fecha_actual > $fechas_de_entrega->fechafinal2){
                    return "Sin dias disponibles";
                }else{
                    $fechacierre = date("Y-m-d", strtotime($fechas_de_entrega->fechafinal2. "+1 days"))." 00:00:00";
                    $fecha_actual = date_create($fecha_actual);
                    $fechacierre = date_create($fechacierre);
                    $diferencia = date_diff($fecha_actual,$fechacierre);
                    $dias = $diferencia->days;
                    if ($dias == 0 and ($diferencia->h > 0 or $diferencia->m > 0)) $dias = 1;
                    return $dias;
                }
                break;
            case 3:
                if ($fecha_actual > $fechas_de_entrega->fechafinal3){
                    return "Sin dias disponibles";
                }else{
                    $fechacierre = date("Y-m-d", strtotime($fechas_de_entrega->fechafinal3. "+1 days"))." 00:00:00";
                    $fecha_actual = date_create($fecha_actual);
                    $fechacierre = date_create($fechacierre);
                    $diferencia = date_diff($fecha_actual,$fechacierre);
                    $dias = $diferencia->days;
                    if ($dias == 0 and ($diferencia->h > 0 or $diferencia->m > 0)) $dias = 1;
                    return $dias;
                }
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


    public static function reporte($periodo_academico = "", $estado = "", $docente = "", $asignatura = "", $grupo = "", $corte = "", $fecha = "", $id_tercero = null, $id_licencia = null)
    {
        $id_licencia = $id_licencia == null ? session('id_licencia') : $id_licencia; 
        $condiciones = "";
        if ($estado and $estado != "") $condiciones .= " and s.estado = '".$estado."'";
        if ($asignatura and $asignatura != "") $condiciones .= " and s.id_asignatura = ".$asignatura;
        if ($grupo and $grupo != "") $condiciones .= " and s.id_grupo = ".$grupo;
        if ($periodo_academico and $periodo_academico != "") $condiciones .= " and g.id_periodo_academico = ".$periodo_academico;
        if ($corte and $corte != "") $condiciones .= " and s.corte = ".$corte;
        if ($fecha and $fecha != ""){
            $desde = explode(' - ', $fecha)[0];
            $hasta = explode(' - ', $fecha)[1];
             $condiciones .= " and DATE_FORMAT(s.fecha, '%Y/%m/%d') BETWEEN '$desde' AND '$hasta'";
        }
        if ($docente and $docente != ""){
            $condiciones .= " and (LOWER(t.id_tercero) like LOWER('%".$docente."%')
                                   or LOWER(t.cedula) like LOWER('%".$docente."%')
                                   or LOWER(t.nombre) like LOWER('%".$docente."%')
                                   or LOWER(t.apellido) like LOWER('%".$docente."%')
                                   or LOWER(t.email) like LOWER('%".$docente."%')
                                   or LOWER(t.servicio) like LOWER('%".$docente."%')
                                   )";
        }

        $condiciones .= " and a.id_licencia = $id_licencia";
        if ($id_tercero != null) $condiciones .= " and t.id_tercero = $id_tercero";
        $sql = "select s.id_seguimiento,
                t.id_tercero,
                concat(t.nombre,' ',t.apellido) as docente,
                a.id_asignatura,
                concat(a.nombre,' (',a.codigo,') ') as asignatura,
                g.id_grupo,
                g.codigo as grupo,
                s.fecha,
                s.estado,
                s.corte,
                p.periodo as periodo_academico
                from seguimiento_asignatura s
                left join asignatura a using(id_asignatura)
                left join grupo g using(id_grupo)
                left join periodo_academico p on g.id_periodo_academico = p.id_periodo_academico
                left join terceros t  on t.id_tercero = s.id_tercero
                where s.id_seguimiento is not null 
                $condiciones";
        $data = DB::select($sql);

        $seguimientos = [];
        foreach ($data as $key => $value) {
           $seguimiento = $value;
           if($value->estado == 'Pendiente') {
             $seguimiento->retraso = SeguimientoAsignatura::find($value->id_seguimiento)->retraso();
             $seguimiento->dias_restantes_entrega = SeguimientoAsignatura::find($value->id_seguimiento)->dias_restantes_entrega();
           }
           array_push($seguimientos, $seguimiento);
        }

        return $seguimientos;
    }


    public static function rendimiento($id_asignatura, $id_periodo, $corte)
    {
        $sql = "SELECT
                SUM(s.num_estudiantes) as num_estudiantes,
                SUM(s.aprobados) as aprobados,
                SUM(s.reprobados) as reprobados,
                SUM(s.prom_notas) as prom_notas
                FROM seguimiento_asignatura s
                INNER JOIN grupo g USING(id_grupo)
                WHERE g.id_periodo_academico = $id_periodo
                AND s.id_asignatura = $id_asignatura
                AND s.estado <> 'Pendiente'
                AND s.corte = $corte";
        $results_seg = DB::select($sql);

        $sql = "SELECT s.id_seguimiento
                FROM seguimiento_asignatura s
                INNER JOIN grupo g USING(id_grupo)
                WHERE g.id_periodo_academico = $id_periodo
                AND s.id_asignatura = $id_asignatura
                AND s.estado <> 'Pendiente'
                AND s.corte = $corte";
        $total = count(DB::select($sql));
        $promedio_notas = 0;
        $porc_aprobacion = 0;

        foreach ($results_seg as $result_seg) {
            $result_seg = (object) $result_seg;
            if ($result_seg->num_estudiantes > 0) {
                $porc_aprobacion = round(($result_seg->aprobados / $result_seg->num_estudiantes) * 100, 1);
            }
            if ($total > 0) {
                $promedio_notas = round(($result_seg->prom_notas / $total), 1);
            }
        } 

        return (object) [
           'promedio_notas' => $promedio_notas,
           'porc_aprobacion' => $porc_aprobacion
        ];
    }
}
