<?php

namespace App\Http\Controllers;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Tercero;
use App\Horario;
use App\SeguimientoAsignatura;


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

}
