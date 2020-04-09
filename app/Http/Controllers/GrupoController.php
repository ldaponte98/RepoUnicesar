<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Grupo;

class GrupoController extends Controller
{
    public function buscar(Request $request)
    {
    	//$grupos = Grupo::all()
    	$grupos = DB::table('grupo')
    			  ->join('periodo_academico', 'periodo_academico.id_periodo_academico', '=', 'grupo.id_periodo_academico')
    			  ->select('grupo.*','periodo_academico.periodo')
    			  ->where('id_tercero',$request->id_tercero)
    			  ->where('id_asignatura',$request->id_asignatura)->get();
    	return response()->json($grupos->toArray());
    }
}
