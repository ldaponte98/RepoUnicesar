<?php

namespace App\Http\Controllers;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Asignatura;
use App\UnidadAsignatura;
use App\UnidadAsignaturaSeguimiento;

class AsignaturaController extends Controller
{
    public function getAsignaturas()
    {
    	$asignaturas = DB::table('asignatura')
                    ->where('id_licencia', session('id_licencia'))
                    ->paginate(10);
        return view('asignatura.listado',compact('asignaturas'));
    }

    public function viewAsignatura($id_asignatura)
    {
    	$asignatura = Asignatura::find($id_asignatura);

        return view('asignatura.view',compact('asignatura'));
    }
    public function buscarGrupos($id)
    {
        $asignatura = Asignatura::find($id);
        return response()->json($asignatura->grupos);
    }

    public function agregarUnidad(Request $request)
    {
        $post = $request->all();

        if ($post) {
            $post = (object) $post;
            $unidad = new UnidadAsignatura;
            $unidad->id_asignatura = $post->id_asignatura;
            $unidad->nombre = $post->unidad;
            if ($unidad->save()) {
               return response()->json([
                    'error' => false,
                    'mensaje' => 'Unidad guardada correctamente'
                ]);
            }

            return response()->json([
                'error' => true,
                'mensaje' => 'Error verifique los caracteres e intentelo nuevamente'
            ]);
        }
    }

    public function getUnidades($id_asignatura)
    {
        $asignatura =  Asignatura::find($id_asignatura);
        if ($asignatura) return $asignatura->unidades;
        return null;
    }
    public function eliminarUnidad($id_unidad)
    {
        $unidad = UnidadAsignatura::find($id_unidad);
        if ($unidad) {
            $seguimientos_con_esta_unidad = UnidadAsignaturaSeguimiento::all()->where('id_unidad_asignatura', $id_unidad);
            if (count($seguimientos_con_esta_unidad) == 0) {
                $unidad->delete();
                return response()->json([
                        'error' => false,
                        'mensaje' => 'Unidad eliminada correctamente'
                ]);
            }else{
                return response()->json([
                        'error' => true,
                        'mensaje' => 'No se pudo eliminar esta unidad debido a que hay seguimientos de asignatura que han usado esta unidad'
                ]);
            }
            
        }
        return response()->json([
                        'error' => true,
                        'mensaje' => 'No existe la unidad'
                ]);
    }
}
