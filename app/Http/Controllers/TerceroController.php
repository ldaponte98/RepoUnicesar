<?php

namespace App\Http\Controllers;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Tercero;
use App\Horario;
use App\SeguimientoAsignatura;
use App\PlanTrabajo;
use App\PlanDesarrolloAsignatura;
use App\ActividadesComplementarias;
use App\Grupo;


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

            foreach ($formatos as $id_formato) {

                switch ($tipo_formato) {
                    case config('global.seguimiento_asignatura'):
                        $formato = SeguimientoAsignatura::find($id_formato);
                        $formato->estado = "Recibido";
                        $formato->save();
                        break;

                    case config('global.plan_trabajo'):
                        $formato = PlanTrabajo::find($id_formato);
                        $formato->estado = "Recibido";
                        $formato->save();
                        break;
                    
                    case config('global.desarrollo_asignatura'):
                        $formato = PlanDesarrolloAsignatura::find($id_formato);
                        $formato->estado = "Recibido";
                        $formato->save();
                        break;

                    case config('global.actividades_complementarias'):
                        $formato = ActividadesComplementarias::find($id_formato);
                        $formato->estado = "Recibido";
                        $formato->save();
                        break;
                    
                    default:
                        echo "<b>Formato invalido<b>";
                        break;
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

}
