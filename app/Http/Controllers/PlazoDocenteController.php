<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PlazoDocente;
use App\Notificaciones;


class PlazoDocenteController extends Controller
{
    public function registrar(Request $request)
    {
    	$post = $request->all();
        if ($post) {
            $post = (object) $post;
        $plazo_docente = new PlazoDocente;
        $fecha_inicio = date('Y-m-d', strtotime(str_replace("/", "-",explode(' - ', $post->fechas_plazo)[0])));
        $fecha_fin = date('Y-m-d', strtotime(str_replace("/", "-",explode(' - ', $post->fechas_plazo)[1])));

        $plazo_docente->id_tercero = $post->id_tercero;
        if(isset($post->id_formato)) $plazo_docente->id_formato = $post->id_formato;
        if(isset($post->id_periodo_academico)) $plazo_docente->id_periodo_academico = $post->id_periodo_academico;
        if(isset($post->id_asignatura)) $plazo_docente->id_asignatura = $post->id_asignatura;
        $plazo_docente->id_dominio_tipo_formato = $post->id_dominio_tipo_formato;
        $plazo_docente->fecha_inicio = $fecha_inicio;
        $plazo_docente->fecha_fin = $fecha_fin. " 23:59:59";
        $plazo_docente->id_tercero_otorga = session('id_tercero_otorga');

        $mensaje_notificacion = "";


        if ($plazo_docente->save()) {

            switch ($post->id_dominio_tipo_formato) {
                case config('global.seguimiento_asignatura'):
                    $mensaje_notificacion = "Se ah generado un nuevo plazo-extra para el seguimiento con codigo ".$post->id_formato." con un nuevo lapso de tiempo desde ".$fecha_inicio." hasta ".$fecha_fin;
                    break;

                case config('global.plan_trabajo'):
                    $mensaje_notificacion = "Se ah generado un nuevo plazo-extra para el plan de trabajo del ".$plazo_docente->periodo_academico->periodo." con un nuevo lapso de tiempo desde ".$fecha_inicio." hasta ".$fecha_fin;
                    break;
                
                case config('global.desarrollo_asignatura'):
                    $mensaje_notificacion = "Se ah generado un nuevo plazo-extra para el plan de desarrollo de la asignatura ".$plazo_docente->asignatura->nombre." (".$plazo_docente->asignatura->codigo.")"." del ".$plazo_docente->periodo_academico->periodo." con un nuevo lapso de tiempo desde ".$fecha_inicio." hasta ".$fecha_fin;
                    break;

                case config('global.actividades_complementarias'):
                    break;
                
                default:
                    $titulo = "Formato invalido";
                    $mensaje = "";
                    return view('sitio.error',compact(['titulo', 'mensaje']));
            }

            //AHORA SE CREA LA NOTIFICACION PARA EL TERCERO
            $notificacion = new Notificaciones;
            $notificacion->notificacion = $mensaje_notificacion;
            $notificacion->id_tercero_envia = session('id_tercero_usuario');
            $notificacion->id_tercero_recibe = $post->id_tercero;
            $notificacion->id_dominio_tipo = config('global.notificacion_extra_pazo');
            if(isset($post->id_formato)) $notificacion->id_formato = $post->id_formato;
            if(isset($post->id_periodo_academico)) $notificacion->id_periodo_academico = $post->id_periodo_academico;
            if(isset($post->id_asignatura)) $notificacion->id_asignatura = $post->id_asignatura;
            $notificacion->id_dominio_tipo_formato = $post->id_dominio_tipo_formato;
            $notificacion->save();
        	return response()->json([
        		'error' => false,
        		'mensaje' => 'Plazo registrado correctamente'
        	]);
        }

        return response()->json([
        		'error' => true,
        		'mensaje' => 'Ocurrio un error al registrar el plazo extra'
        ]);
        	
        }
    }

    public function buscar($id_plazo)
    {
        $plazo = PlazoDocente::find($id_plazo);
        $error = true;
        $data = null;
        $message = "";
        if($plazo){
            $data['id_plazo'] = $plazo->id_plazo_docente;
            $data['id_docente'] = $plazo->id_tercero;
            $data['docente'] = $plazo->tercero->getNameFull();
            $data['id_tercero_otorga'] = $plazo->id_tercero_otorga;
            $data['tercero_otorga'] = $plazo->tercero_otorga->getNameFull();
            $data['fecha_inicio'] = date('d/m/Y', strtotime($plazo->fecha_inicio));
            $data['fecha_fin'] = date('d/m/Y', strtotime($plazo->fecha_fin));
            $data['fechas'] = date('d/m/Y', strtotime($data['fecha_inicio']))." - ".date('d/m/Y', strtotime($data['fecha_fin']));
            $data['estado'] = $plazo->estado;
            $error = false;
        }else{
            $message = "Plazo invalido";
        }
        return response()->json([
            'error' => $error,
            'data' => $data,
            'message' => $message
        ]);
    }

    public function actualizar(Request $request)
    {
        $post = $request->all();
        if ($post) {
        $post = (object) $post;
        $plazo_docente = PlazoDocente::find($post->id_plazo);
        $fecha_inicio = date('Y-m-d', strtotime(str_replace("/", "-",explode(' - ', $post->fechas_plazo)[0])));
        $fecha_fin = date('Y-m-d', strtotime(str_replace("/", "-",explode(' - ', $post->fechas_plazo)[1])));

        $plazo_docente->fecha_inicio = $fecha_inicio. " 00:00:00";
        $plazo_docente->fecha_fin = $fecha_fin. " 23:59:59";
        $plazo_docente->id_tercero_otorga = session('id_tercero_usuario');

        $mensaje_notificacion = "";


        if ($plazo_docente->save()) {

            switch ($plazo_docente->id_dominio_tipo_formato) {
                case config('global.seguimiento_asignatura'):
                    $mensaje_notificacion = "Se han actualizado las fechas de el plazo-extra para el seguimiento con codigo ".$plazo_docente->id_formato." con un nuevo lapso de tiempo desde ".$fecha_inicio." hasta ".$fecha_fin;
                    break;

                case config('global.plan_trabajo'):
                    $mensaje_notificacion = "Se han actualizado las fechas de el plazo-extra para el plan de trabajo del ".$plazo_docente->periodo_academico->periodo." con un nuevo lapso de tiempo desde ".$fecha_inicio." hasta ".$fecha_fin;
                    break;
                
                case config('global.desarrollo_asignatura'):
                    $mensaje_notificacion = "Se han actualizado las fechas de el plazo-extra para el plan de desarrollo de la asignatura ".$plazo_docente->asignatura->nombre." (".$plazo_docente->asignatura->codigo.")"." del ".$plazo_docente->periodo_academico->periodo." con un nuevo lapso de tiempo desde ".$fecha_inicio." hasta ".$fecha_fin;
                    break;

                case config('global.actividades_complementarias'):
                    break;
                
                default:
                    $titulo = "Formato invalido";
                    $mensaje = "";
                    return view('sitio.error',compact(['titulo', 'mensaje']));
            }

            //AHORA SE CREA LA NOTIFICACION PARA EL TERCERO
            $notificacion = new Notificaciones;
            $notificacion->notificacion = $mensaje_notificacion;
            $notificacion->id_tercero_envia = session('id_tercero_usuario');
            $notificacion->id_tercero_recibe = $plazo_docente->id_tercero;
            $notificacion->id_dominio_tipo = config('global.notificacion_extra_pazo');
            if(isset($plazo_docente->id_formato)) $notificacion->id_formato = $plazo_docente->id_formato;
            if(isset($plazo_docente->id_periodo_academico)) $notificacion->id_periodo_academico = $plazo_docente->id_periodo_academico;
            if(isset($plazo_docente->id_asignatura)) $notificacion->id_asignatura = $plazo_docente->id_asignatura;
            $notificacion->id_dominio_tipo_formato = $plazo_docente->id_dominio_tipo_formato;
            $notificacion->save();
            return response()->json([
                'error' => false,
                'mensaje' => 'Plazo actualizado correctamente'
            ]);
        }

        return response()->json([
                'error' => true,
                'mensaje' => 'Ocurrio un error al actualizar el plazo extra'
        ]);
            
        }
    }

    public function cancelar($id_plazo)
    {
        $plazo_docente = PlazoDocente::find($id_plazo);
        $error = true;
        $data = null;
        $message = "";
        if($plazo_docente){
            $plazo_docente->estado = 2;
            $plazo_docente->id_tercero_cancela = session('id_tercero_usuario');
            if ($plazo_docente->save()) {

                switch ($plazo_docente->id_dominio_tipo_formato) {
                    case config('global.seguimiento_asignatura'):
                        $mensaje_notificacion = "El jefe de departamento actual ha cancelado el plazo-extra para el seguimiento con codigo ".$plazo_docente->id_formato." vigente desde ".$plazo_docente->fecha_inicio." hasta ".$plazo_docente->fecha_fin;
                        break;

                    case config('global.plan_trabajo'):
                        $mensaje_notificacion = "El jefe de departamento actual ha cancelado el plazo-extra para el plan de trabajo del ".$plazo_docente->periodo_academico->periodo." vigente desde ".$plazo_docente->fecha_inicio." hasta ".$plazo_docente->fecha_fin;
                        break;
                    
                    case config('global.desarrollo_asignatura'):
                        $mensaje_notificacion = "El jefe de departamento actual ha cancelado el plazo-extra para el plan de desarrollo de la asignatura ".$plazo_docente->asignatura->nombre." (".$plazo_docente->asignatura->codigo.")"." del ".$plazo_docente->periodo_academico->periodo." vigente desde ".$plazo_docente->fecha_inicio." hasta ".$plazo_docente->fecha_fin;
                        break;

                    case config('global.actividades_complementarias'):
                        break;
                    
                    default:
                        $titulo = "Formato invalido";
                        $mensaje = "";
                        return view('sitio.error',compact(['titulo', 'mensaje']));
                }

                //AHORA SE CREA LA NOTIFICACION PARA EL TERCERO
                $notificacion = new Notificaciones;
                $notificacion->notificacion = $mensaje_notificacion;
                $notificacion->id_tercero_envia = session('id_tercero_usuario');
                $notificacion->id_tercero_recibe = $plazo_docente->id_tercero;
                $notificacion->id_dominio_tipo = config('global.notificacion_extra_pazo');
                if(isset($plazo_docente->id_formato)) $notificacion->id_formato = $plazo_docente->id_formato;
                if(isset($plazo_docente->id_periodo_academico)) $notificacion->id_periodo_academico = $plazo_docente->id_periodo_academico;
                if(isset($plazo_docente->id_asignatura)) $notificacion->id_asignatura = $plazo_docente->id_asignatura;
                $notificacion->id_dominio_tipo_formato = $plazo_docente->id_dominio_tipo_formato;
                $notificacion->save();
                return response()->json([
                    'error' => false,
                    'mensaje' => 'Plazo cancelado correctamente'
                ]);
            }
            $error = false;
        }else{
            $message = "Plazo invalido";
        }
        return response()->json([
            'error' => $error,
            'data' => $data,
            'message' => $message
        ]);
    }
}
