<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\SeguimientoAsignatura;
use App\FechasEntrega;
use App\Asignatura;
use App\PeriodoAcademico;
use App\Tercero;
use App\UnidadAsignatura;
use App\UnidadAsignaturaSeguimiento;
use App\EjeTematicoSeguimiento;
use App\CausaSeguimiento;
use App\AnalisisCualitativoSeguimiento;
use App\PlazoDocente;
use App\Notificaciones;
use Maatwebsite\Excel\Facades\Excel;

class SeguimientoAsignaturaController extends Controller
{
    public function view($id_seguimiento)
    {
    	$seguimiento = SeguimientoAsignatura::find($id_seguimiento);
    	if ($seguimiento) {
    		if ($seguimiento->estado == 'Enviado' and session('is_admin') == true) {
    			$seguimiento->estado = 'Recibido';
        		$seguimiento->save();

                $tercero_envia = Tercero::find(session('id_tercero_usuario'));
                $notificacion = new Notificaciones;
                $tipo_tercero_envia = $tercero_envia->tipo->dominio; 
                $notificacion->notificacion = "El jefe de departamento ha revisado el seguimiento de asignatura numero $id_seguimiento.";
                $notificacion->id_tercero_envia = $tercero_envia->id_tercero;
                $notificacion->id_tercero_recibe = $seguimiento->tercero->id_tercero;
                $notificacion->id_dominio_tipo = 6;//revision
                $notificacion->id_formato = $id_seguimiento;
                $notificacion->id_dominio_tipo_formato = config('global.seguimiento_asignatura');
                $notificacion->save();
    		}

            $fechas = FechasEntrega::where('id_dominio_tipo_formato', config('global.seguimiento_asignatura'))->where('id_periodo_academico', $seguimiento->grupo->id_periodo_academico)->first();
            if ($fechas == null) {
                $titulo = "Fechas de entrega indefinidas";
                $mensaje = "El seguimiento no puede ser visualizado debido a que no se han configurado de parte del administrador las fechas correspondientes";
                return view('sitio.error',compact(['titulo', 'mensaje']));
            }
    		return view('seguimiento_asignatura.view',compact('seguimiento'),compact('fechas'));
    	}
        $titulo = "Este archivo no existe";
        $mensaje = "";
        return view('sitio.error',compact(['titulo', 'mensaje']));
    	//echo "Este archivo no existe";
    }

    public function viewInformeFinal($id_seguimiento)
    {
        $seguimiento_3 = SeguimientoAsignatura::find($id_seguimiento);

        if ($seguimiento_3) {
            $id_asignatura = $seguimiento_3->id_asignatura;
            $id_grupo = $seguimiento_3->id_grupo;
            $id_tercero = $seguimiento_3->id_tercero;

            $seguimientos = SeguimientoAsignatura::all()
                                ->where('id_asignatura', $id_asignatura)
                                ->where('id_grupo', $id_grupo)
                                ->where('id_tercero', $id_tercero);

            if ($seguimiento_3->estado == 'Enviado' and session('is_admin')==true) {
                $seguimiento_3->estado = 'Recibido';
                $seguimiento_3->save();
            }

            $fechas = FechasEntrega::where('id_dominio_tipo_formato', config('global.seguimiento_asignatura'))->where('id_periodo_academico', $seguimiento_3->grupo->id_periodo_academico)->first();

            return view('seguimiento_asignatura.view_informe_final',compact('seguimientos'),compact('fechas'));
        }
        $titulo = "Este archivo no existe";
        $mensaje = "";
        return view('sitio.error',compact(['titulo', 'mensaje']));
        //echo "Este archivo no existe";
    }

    public function listar()
    {
        $seguimientos = DB::table('seguimiento_asignatura')
                    ->paginate(10);

        $periodos_academicos = DB::table('periodo_academico')
                   ->orderBy('id_periodo_academico','desc')
                   ->get();

        $asignaturas = Asignatura::all()
                       ->where('id_licencia',session('id_licencia'));

        if (session('is_docente')==true) {
            $seguimientos = DB::table('seguimiento_asignatura')
                    ->where('id_tercero',session('id_tercero_usuario'))
                    ->paginate(10);
            $asignaturas = Tercero::find(session('id_tercero_usuario'))->asignaturas();
            return view('seguimiento_asignatura.consultar_desde_docente',compact(['periodos_academicos','seguimientos','asignaturas']));
        }
        return view('seguimiento_asignatura.consultar',compact(['periodos_academicos','seguimientos','asignaturas']));
    }

    public function listarInformeFinal()
    {
        $seguimientos = DB::table('seguimiento_asignatura')
                    ->where('corte', 3)
                    ->paginate(10);

        $periodos_academicos = DB::table('periodo_academico')
                   ->orderBy('id_periodo_academico','desc')
                   ->get();

        $asignaturas = Asignatura::all()
                       ->where('id_licencia',session('id_licencia'));
        if (session('is_docente')==true) {
            $seguimientos = DB::table('seguimiento_asignatura')
                    ->where('id_tercero',session('id_tercero_usuario'))
                    ->paginate(10);
            $asignaturas = Tercero::find(session('id_tercero_usuario'))->asignaturas();
            return view('seguimiento_asignatura.consultar_informe_final_desde_docente',compact(['periodos_academicos','seguimientos','asignaturas']));
        }
        return view('seguimiento_asignatura.consultar_informe_final',compact(['periodos_academicos','seguimientos','asignaturas']));
    }

    public function getSeguimiento($id_seguimiento)
    {
        $seguimiento = SeguimientoAsignatura::find($id_seguimiento);
        return response()->json([
            "seguimiento" => $seguimiento,
            "unidades" => $seguimiento->unidades_programadas,
            "ejes" => $seguimiento->ejes_tematicos_desarrollados, 
            "causas" => $seguimiento->causas, 
            "analisis" => $seguimiento->analisis_cualitativo 
        ]
        );
    }

    public function getReporte(Request $request)
    {
        $post = $request->all();

        if ($post) {
            $post = (object) $post;
            $periodo_academico = $post->periodo_academico;
            $estado = $post->estado;
            $docente = $post->docente;
            $asignatura = $post->asignatura;
            $grupo = $post->grupo;
            $corte = $post->corte;
            $fecha = $post->fecha;
            $seguimientos = SeguimientoAsignatura::reporte($periodo_academico, $estado, $docente, $asignatura, $grupo, $corte, $fecha);
            return response()->json($seguimientos);
        }
        return response()->json("nada llego");
    }

    public function getReporteInformeFinal(Request $request)
    {
        $post = $request->all();

        if ($post) {
            $post = (object) $post;
            $condiciones = "";
            if ($post->estado and $post->estado != "") $condiciones .= " and s.estado = '".$post->estado."'";
            if ($post->asignatura and $post->asignatura != "") $condiciones .= " and s.id_asignatura = ".$post->asignatura;
            if ($post->grupo and $post->grupo != "") $condiciones .= " and s.id_grupo = ".$post->grupo;
            if ($post->periodo_academico and $post->periodo_academico != "") $condiciones .= " and g.id_periodo_academico = ".$post->periodo_academico;
            if ($post->fecha and $post->fecha != ""){
                $desde = explode(' - ', $post->fecha)[0];
                $hasta = explode(' - ', $post->fecha)[1];
                 $condiciones .= " and DATE_FORMAT(s.fecha, '%Y/%m/%d') BETWEEN '$desde' AND '$hasta'";
            }
            if (isset($post->docente) and $post->docente != ""){
                $condiciones .= " and (LOWER(t.id_tercero) like LOWER('%".$post->docente."%')
                                       or LOWER(t.cedula) like LOWER('%".$post->docente."%')
                                       or LOWER(t.nombre) like LOWER('%".$post->docente."%')
                                       or LOWER(t.apellido) like LOWER('%".$post->docente."%')
                                       or LOWER(t.email) like LOWER('%".$post->docente."%')
                                       or LOWER(t.servicio) like LOWER('%".$post->docente."%')
                                       )";
            }

            $condiciones .= " and a.id_licencia = ".session('id_licencia');
            if(session('is_docente') == true) $condiciones .= " and s.id_tercero = ".session('id_tercero_usuario');
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
                    and s.corte = 3 
                    $condiciones 
                    order by s.fecha desc";
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
            return response()->json($seguimientos);
        }
        return response()->json("nada llego");
    }

    public function editar(Request $request, $id)
    {
        $post = $request->all();


        if ($post) {
            $post = (object)$post;
            $seguimiento = SeguimientoAsignatura::find($post->id_seguimiento);
            $datos_seguimiento = $request->except([
                '_token',
                'unidades_programadas',
                'ejes_desarrollados',
                'causas',
                'analisis_cualitativo'
            ]);

            $seguimiento->fill($datos_seguimiento);
            $error = true;
            if ($seguimiento->validar()) {
               //aca se guarda el seguimiento
                $seguimiento->estado = 'Enviado';
                $seguimiento->fecha = date('Y-m-d H:i:s');
                $seguimiento->save();
                $error = false; 
                //eliminamos la informacion vieja
                $delete_unidades = UnidadAsignaturaSeguimiento::where('id_seguimiento_asignatura', $seguimiento->id_seguimiento)->delete();
                $delete_ejes = EjeTematicoSeguimiento::where('id_seguimiento_asignatura', $seguimiento->id_seguimiento)->delete();
                $delete_causas = CausaSeguimiento::where('id_seguimiento_asignatura', $seguimiento->id_seguimiento)->delete();
                $delete_analisis = AnalisisCualitativoSeguimiento::where('id_seguimiento_asignatura', $seguimiento->id_seguimiento)->delete();

                if (isset($post->unidades_programadas)) {
                //ahora miro las unidades que programo
                foreach ($post->unidades_programadas as $key => $id_unidad) {
                    $unidad_seguimiento = new UnidadAsignaturaSeguimiento;
                    $unidad_seguimiento->id_seguimiento_asignatura = $seguimiento->id_seguimiento;
                    $unidad_seguimiento->id_unidad_asignatura = $id_unidad;
                    $unidad_seguimiento->save();
                } 
                }

                if(isset($post->ejes_desarrollados)){
                    # code...
               
                //ahora miro los ejes que programo
                foreach ($post->ejes_desarrollados as $key => $id_eje) {
                    $eje_seguimiento = new EjeTematicoSeguimiento;
                    $eje_seguimiento->id_seguimiento_asignatura = $seguimiento->id_seguimiento;
                    $eje_seguimiento->id_eje_tematico = $id_eje;
                    $eje_seguimiento->save();
                }
                }

                if(isset($post->causas)){
                //ahora miro las causas que selecciono
                foreach ($post->causas as $new_causa) {
                    $causa = new CausaSeguimiento;
                    $causa->id_seguimiento_asignatura = $seguimiento->id_seguimiento;
                    $causa->causa = $new_causa;
                    $causa->save();
                } 
                } 

                if(isset($post->analisis_cualitativo)){
                //ahora miro los analisis cualitativos que selecciono
                foreach ($post->analisis_cualitativo as $new_analisis) {
                    $analisis = new AnalisisCualitativoSeguimiento;
                    $analisis->id_seguimiento_asignatura = $seguimiento->id_seguimiento;
                    $analisis->analisis = $new_analisis;
                    $analisis->save();
                } 
                }

                $plazos_extra = PlazoDocente::where('id_tercero',$seguimiento->id_tercero)
                                       ->where('id_formato', $seguimiento->id_seguimiento)
                                       ->where('estado', 1)
                                       ->get();
                foreach ($plazos_extra as $plazo) {
                    $plazo->estado = 0;
                    $plazo->save();
                }         
            }


            //$seguimiento->save();
            return response()->json([
                    "mensaje" => "Guardado bien",
                    "error" => $error,
                    "seguimiento" => $seguimiento,
                    "errores" => $seguimiento->errores
                ]);
        }
        $seguimiento = SeguimientoAsignatura::find($id);
        if($seguimiento){
            if (session('is_docente')==true and $seguimiento->tiene_permiso_de_editar()){
                if($seguimiento->plan_asignatura()){
                    return view('seguimiento_asignatura.editar_desde_docente',compact(['seguimiento']));
                }else{
                    $titulo = "No se encuentra plan de asignatura registrado";
                    $mensaje = "No puede realizar este plan de seguimiento asignatura debido a que no hay un plan de asignatura registrado para el periodo academico escojido con relacion a la asignatura.";
                    return view('sitio.error',compact(['titulo', 'mensaje']));
                }
                
            }else{
                $titulo = "No tiene permisos para editar este formato";
                $mensaje = "";
                return view('sitio.error',compact(['titulo', 'mensaje']));
                //echo "No tiene permisos para editar este formato";
            } 
        }

        $titulo = "Seguimiento de asignatura invalido.";
        $mensaje = "";
        return view('sitio.error',compact(['titulo', 'mensaje']));
        

    }

    public function getEjesTematicos($id_unidad,$id_seguimiento)
    {
       $unidad = new UnidadAsignatura;


       $seguimiento = SeguimientoAsignatura::find($id_seguimiento);
       $plan_asignatura = $seguimiento->plan_asignatura();
       foreach ($plan_asignatura->unidades() as $uni) {
           if($uni->id_unidad == $id_unidad){
             $unidad =  UnidadAsignatura::find($uni->id_unidad);
             $unidad->ejes = $uni->ejes;
             break;
           }
       }
       return response()->json([
                    "unidad" => $unidad,
                    "ejes_tematicos" => $unidad->ejes,
        ]);
    }

    public function imprimir($id_seguimiento)
    {
        $seguimiento = SeguimientoAsignatura::find($id_seguimiento);
        $pdf = \PDF::loadView('seguimiento_asignatura.pdf_seguimiento', compact('seguimiento'));
        return $pdf->stream('Seguimiento de asignatura.pdf');
    }

    public function imprimir_informe_final($id_seguimiento)
    {
        $seguimiento_3 = SeguimientoAsignatura::find($id_seguimiento);

        if ($seguimiento_3) {
            $id_asignatura = $seguimiento_3->id_asignatura;
            $id_grupo = $seguimiento_3->id_grupo;
            $id_tercero = $seguimiento_3->id_tercero;

        $seguimiento_1 = SeguimientoAsignatura::
                                where('id_asignatura', $id_asignatura)
                                ->where('id_grupo', $id_grupo)
                                ->where('id_tercero', $id_tercero)
                                ->where('corte', 1)
                                ->first();
        $seguimiento_2 = SeguimientoAsignatura::
                                where('id_asignatura', $id_asignatura)
                                ->where('id_grupo', $id_grupo)
                                ->where('id_tercero', $id_tercero)
                                ->where('corte', 2)
                                ->first();
        $pdf = \PDF::loadView('seguimiento_asignatura.pdf_informe_final', compact([
            'seguimiento_1',
            'seguimiento_2',
            'seguimiento_3'
        ]));
        return $pdf->stream('Informe final seguimiento de asignatura.pdf');
        }
        $titulo = "No se pudo realizar el archivo";
        $mensaje = "";
        return view('sitio.error',compact(['titulo', 'mensaje']));
        //echo "No se pudo realizar el archivo"; die();
    }

    public function imprimir_informe_final_prueba($id_seguimiento)
    {
        $seguimiento_3 = SeguimientoAsignatura::find($id_seguimiento);

        if ($seguimiento_3) {
            $id_asignatura = $seguimiento_3->id_asignatura;
            $id_grupo = $seguimiento_3->id_grupo;
            $id_tercero = $seguimiento_3->id_tercero;

        $seguimiento_1 = SeguimientoAsignatura::
                                where('id_asignatura', $id_asignatura)
                                ->where('id_grupo', $id_grupo)
                                ->where('id_tercero', $id_tercero)
                                ->where('corte', 1)
                                ->first();
        $seguimiento_2 = SeguimientoAsignatura::
                                where('id_asignatura', $id_asignatura)
                                ->where('id_grupo', $id_grupo)
                                ->where('id_tercero', $id_tercero)
                                ->where('corte', 2)
                                ->first();
        return view('seguimiento_asignatura.pdf_informe_final', compact([
            'seguimiento_1',
            'seguimiento_2',
            'seguimiento_3'
        ]));
        
        }
        echo "No se pudo realizar el archivo"; die();
    }
    public function imprimir_prueba($id_seguimiento)
    { 
        $seguimiento = SeguimientoAsignatura::find($id_seguimiento);
        return view('seguimiento_asignatura.pdf_seguimiento', compact('seguimiento'));
    }
}
