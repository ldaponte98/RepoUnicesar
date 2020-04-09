<?php

namespace App\Http\Controllers;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Asignatura;

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
}
