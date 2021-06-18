<?php

namespace App\Http\Controllers;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Tercero;
use App\TerceroGrupo;
use App\Horario;
use App\SeguimientoAsignatura;
use App\PlanTrabajo;
use App\PlanDesarrolloAsignatura;
use App\ActividadesComplementarias;
use App\Grupo;
use App\Notificaciones;
use App\PlanAsignatura;
use App\CodigoAcceso;
use Mail;


class TerceroController extends Controller
{
    public function getDocentes()
    {
    	$docentes = DB::table('terceros')
                    ->where('id_dominio_tipo_ter', 3)
                    ->where('id_licencia', session('id_licencia'))
                    ->paginate(10);
        return view('docente.listado',compact('docentes'));
    }

    public function viewDocente($id_tercero)
    {
    	$docente = Tercero::find($id_tercero);
        if (session("is_admin")==true) return view('docente.view',compact('docente'));
        if (session("is_docente")==true) return view('docente.view_perfil',compact('docente'));
        if (session("is_alumno")==true) return view('docente.view_perfil',compact('docente'));
    }

    public function buscarAsignaturas($id_periodo_academico, $id_tercero)
    {
        $grupos = Grupo::all()
                          ->where('id_periodo_academico', $id_periodo_academico)
                          ->where('id_tercero', $id_tercero);
        $asignaturas = [];
        if(count($grupos) > 0){
            foreach ($grupos as $grupo) {
                $asignatura['id_asignatura'] = $grupo->asignatura->id_asignatura;
                $asignatura['nombre'] = $grupo->asignatura->nombre." (".$grupo->asignatura->codigo.")";
                if(!in_array($asignatura, $asignaturas)) $asignaturas[] = $asignatura;
            }
        }
        return response()->json([
            'asignaturas' => $asignaturas
        ]);
    }

    public function viewHorario(Request $request, $id_tercero)
    {
        $docente = Tercero::find($id_tercero);
        if (session("is_docente") == true){
            if(session("id_tercero_usuario") != $id_tercero){
                echo "Este horario no coincide con su identidad.";
                exit();
            }
        }else{
            
            if(session("id_licencia") != $docente->id_licencia){
                echo "No puede acceder al horario de este docente debido a que no pertenece al programa academico a su cargo.";
                exit();
            }
        }

        $periodo_academico = DB::table('periodo_academico')
                               ->orderBy('id_periodo_academico','desc')
                               ->first();
        $post = $request->all();
        $horario = Horario::where('id_periodo_academico', $periodo_academico->id_periodo_academico)->where('id_tercero', $id_tercero)->first();
        if ($post) {
            $post = (object) $post;
            $periodo_academico = DB::table('periodo_academico')
                               ->where('id_periodo_academico', $post->id_periodo_escojido)
                               ->first();
            $horario = Horario::where('id_periodo_academico', $periodo_academico->id_periodo_academico)->where('id_tercero', $id_tercero)->first();
        }
        if(!$horario) $horario = new Horario;        
        
        return view('docente.view_horario',compact([
            'horario',
            'periodo_academico',
            'docente'
        ]));
            
    }

    public function updateImageDocente(Request $request, $id_tercero){
         //obtenemos el campo file definido en el formulario

        $docente = Tercero::find($id_tercero);
        $post = $request->all();

        if ($post) {
            $file = $request->file('imagen_file');
               
            $id_tercero = $request->input('id_tercero');
            $docente = Tercero::find($id_tercero);
             if ($file) {   
               //obtenemos el nombre del archivo
               $nombre = $file->getClientOriginalName();
               $ruta = '/files/'.$docente->cedula;
               
               $exists =Storage::disk('public')->exists($ruta);
               if($exists) Storage::disk('public')->delete($ruta."/".$docente->foto);
               
                Storage::makeDirectory($ruta, 0777);
                Storage::disk('public')->put($ruta."/".$nombre,  \File::get($file));

                //edito al docente
                $docente->foto = $nombre;
                $docente->save(); 
                return redirect()->route('docente/view', $docente->id_tercero);
             }
        }
        return view('docente.update_image',compact('docente'));
       
    }

    public function filtrar($caracteres)
    {
        if (strlen($caracteres) > 3) {
            $sql = "select * from terceros where id_licencia = ".session('id_licencia')." and (id_tercero = '".$caracteres."'".
                    " or UPPER(nombre) like '%".strtoupper($caracteres)."%'".
                    " or UPPER(apellido) like '%".strtoupper($caracteres)."%'".
                    " or UPPER(email) like '%".strtoupper($caracteres)."%'".
                    " or UPPER(cedula) like '%".strtoupper($caracteres)."%')".
                    " limit 10";
            $response = DB::select($sql);
            return response()->json($response);
        }
    }

    public function view_formato($tipo_formato, $id_tercero)
    {
        $docente = Tercero::where('id_tercero', $id_tercero)->where('id_licencia', session('id_licencia'))->first();
        if ($docente) {
            switch ($tipo_formato) {
                case config('global.seguimiento_asignatura'):
                    return view('docente.view_seguimientos_asignatura', compact('docente'));

                case config('global.plan_trabajo'):
                    return view('docente.view_plan_trabajo', compact('docente'));
                
                case config('global.desarrollo_asignatura'):
                    return view('docente.view_plan_desarrollo', compact('docente'));

                case config('global.actividades_complementarias'):
                    return view('docente.view_actividades_complementarias', compact('docente'));
                
                default:
                    $titulo = "Formato invalido";
                    $mensaje = "";
                    return view('sitio.error',compact(['titulo', 'mensaje']));
                    
            }
        }else{
            $titulo = "Este docente no existe";
            $mensaje = "";
            return view('sitio.error',compact(['titulo', 'mensaje']));
        }
        
    }

    public function marcarFormatosComoLeido(Request $request)
    {
        $post = $request->all();

        if ($post) {
            $post = (object) $post;
            $formatos = $post->formatos;
            $tipo_formato = $post->tipo_formato;


            //datos para la notificacion
            $mensaje = "";
            $id_tercero_recibe = null;
            $id_periodo_academico = null;
            $id_asignatura = null;

            //datos para el email
            $vista_email = "email.email_formato_revisado";
            $subject = "";
            $data_email = "";
            $email_tercero = "";
            foreach ($formatos as $id_formato) {

                switch ($tipo_formato) {

                        case config('global.seguimiento_asignatura'):
                        $formato = SeguimientoAsignatura::find($id_formato);
                        $formato->estado = "Recibido";
                        $formato->save();
                        $id_tercero_recibe = $formato->id_tercero;
                        $mensaje = "El jefe de departamento ha revisado el seguimiento de asignatura numero $id_formato.";
                        $subject = "Revisión de Seguimiento de asignatura";
                        $data_email = array(
                            "formato" => "Seguimiento de Asignatura",
                            "asignatura" => "(". $formato->asignatura->codigo.") ".$formato->asignatura->nombre,
                            "grupo" => $formato->grupo->codigo,
                            "corte" => $formato->corte,
                            "periodo_academico" => $formato->grupo->periodo_academico->periodo,
                            "nombre_tercero" => $formato->tercero->nombre
                        );
                        $id_periodo_academico = $formato->grupo->periodo_academico->id_periodo_academico;
                        $id_asignatura = $formato->id_asignatura;
                        break;

                    case config('global.plan_trabajo'):
                        $formato = PlanTrabajo::find($id_formato);
                        $formato->estado = "Recibido";
                        $formato->save();
                        $id_tercero_recibe = $formato->id_tercero;
                        $mensaje = "El jefe de departamento te ha revisado el plan de trabajo del periodo ".$formato->periodo_academico->periodo;
                        $subject = "Revisión de Plan de trabajo";
                        $data_email = array(
                            "formato" => "Plan de trabajo",
                            "periodo_academico" => $formato->periodo_academico->periodo,
                            "nombre_tercero" => $formato->tercero->nombre
                        );
                        $id_periodo_academico = $formato->id_periodo_academico;
                        break;
                    
                    case config('global.desarrollo_asignatura'):
                        $formato = PlanDesarrolloAsignatura::find($id_formato);
                        $formato->estado = "Recibido";
                        $formato->save();
                        $id_tercero_recibe = $formato->id_tercero;
                        $mensaje = 'El jefe de departamento ha revisado el plan de desarrollo de la asignatura '.$formato->asignatura->nombre." - ".$formato->asignatura->codigo." correspondiente al P.Academico ".$formato->periodo_academico->nombre; 
                        $subject = "Revisión de Plan de desarrollo asignatura";
                        $data_email = array(
                            "formato" => "Plan de desarrollo asignatura",
                            "periodo_academico" => $formato->periodo_academico->periodo,
                            "asignatura" => $formato->asignatura->nombre." - ".$formato->asignatura->codigo,
                            "nombre_tercero" => $formato->tercero->nombre
                        );
                        $id_periodo_academico = $formato->id_periodo_academico;
                        $id_asignatura = $formato->id_asignatura;
                        break;

                    case config('global.actividades_complementarias'):
                        $formato = ActividadesComplementarias::find($id_formato);
                        $formato->estado = "Recibido";
                        $formato->save();
                        $id_tercero_recibe = $formato->plan_trabajo->id_tercero;
                        $mensaje = 'El jefe de departamento te ha revisado las actividades complementarias perteneciente al '.$formato->corte.' corte del periodo '.$formato->plan_trabajo->periodo_academico->periodo;
                        $subject = "Revisión de Actividad complementaria";
                        $data_email = array(
                            "formato" => "Actividades complementarias",
                            "periodo_academico" => $formato->plan_trabajo->periodo_academico->periodo,
                            "corte" => $formato->corte,
                            "nombre_tercero" => $formato->plan_trabajo->tercero->nombre,
                        );
                        break;
                    
                    default:
                        echo "<b>Formato invalido<b>";
                        return response()->json(array(
                            'error' => false
                        )); 
                        break;
                }    

                $notificacion = new Notificaciones;
                $notificacion->notificacion = $mensaje;
                $notificacion->id_tercero_envia = session('id_tercero_usuario');
                $notificacion->id_tercero_recibe = $id_tercero_recibe;
                $notificacion->id_dominio_tipo = 6; //revision
                if($id_formato) $notificacion->id_formato = $id_formato;
                if($id_periodo_academico)$notificacion->id_periodo_academico = $id_periodo_academico;
                if($id_asignatura) $notificacion->id_asignatura = $id_asignatura;
                $notificacion->id_dominio_tipo_formato = $tipo_formato;
                if ($notificacion->save()) {
                    $for = $notificacion->tercero_recibe->email;
                    Mail::send($vista_email, $data_email, function($msj) use($subject ,$for){
                        $msj->from(config('global.email_general'),"Universidad Popular Del Cesar");
                        $msj->subject($subject);
                        $msj->to($for);
                    });
                }
                
            }
            return response()->json(array(
                'error' => false
            )); 
        }
        return response()->json(array(
            'error' => true
        ));
    }

    public function panel()
    {
        return view('sitio.index3');
    }

    public function agregar_clase($codigo_acceso)
    {
        $error = true;
        $message = "";

        $codigo_acceso = CodigoAcceso::where('token', $codigo_acceso)
                                       ->where('estado', 1)
                                       ->first();
        if($codigo_acceso){
            $tercero_grupo = TerceroGrupo::where('id_tercero', session('id_tercero_usuario'))
                                         ->where('id_grupo', $codigo_acceso->grupo->id_grupo)
                                         ->where('estado', '<>', 0)
                                         ->first();
            if(!$tercero_grupo){
                //asignamos estudiante a grupo
                $tercero_grupo = new TerceroGrupo;
                $tercero_grupo->id_tercero = session('id_tercero_usuario');
                $tercero_grupo->id_grupo = $codigo_acceso->grupo->id_grupo;
                $tercero_grupo->estado = 1;
                if($codigo_acceso->requiere_autorizacion == 1){
                    $tercero_grupo->estado = 2;
                }
                if($tercero_grupo->save()){
                    $error = false;
                    $message = "Registro de clase exitoso";
                }else{
                    $message = "Ocurrio un error al agregar la clase.";
                }
            }else{
                $message = "Ya se encuentra inscrito en la clase correspondiente a este codigo de acceso.";
            }
        }else{
            $message = "Codigo de clase no valido.";
        }

        return response()->json(array(
            'error' => $error,
            'message' => $message,
        )); 
    }

    public function notificar_retraso_formatos()
    {
        $for = "ldaponte98@gmail.com";
        $subject = "Cron repo";
        $vista_email = 'email.test';
        $data_email = [
            'html' => "<h1>Hola soy el cron desde el server</h1>"
        ];
        $response = Mail::send($vista_email, $data_email, function($msj) use($subject ,$for){
            $msj->from(config('global.email_general'),"Universidad Popular Del Cesar");
            $msj->subject($subject);
            $msj->to($for);
        });

        return response()->json(array(
            'estado_envio' => $response,
            'message' => "Se ejecuto"
        )); 
    }

   

}
