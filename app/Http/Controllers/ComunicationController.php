<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Programa;
use App\Facultad;
use App\PeriodoAcademico;

class ComunicationController extends Controller
{
    public function updateProgramasAcademicos(Request $request)
    {
    	$post = $request->all();
    	$errors = [];
        if ($post) {
        	$post = (object) $post;
        	$programas = $post->programas;
        	foreach ($programas as $programa) {
        		$programa = (object) $programa;
        		$p = Programa::where('id_academusoft', $programa->id_programa)->first();
        		if(!$p){
        			$p = new Programa;
        			$p->id_academusoft = $programa->id_programa;
        		}
        		$facultad = Facultad::where('id_academusoft', $programa->id_facultad)->first();
        		if($facultad){
        			$p->id_facultad = $facultad->id_facultad;
        			$p->nombre = $programa->nombre;
        			$p->save();
        		}else{
        			array_push($errors, array("id_programa_error" => $programa->id_programa));
        		}
        	}

        	if(count($errors) > 0){
        		return response()->json(array(
	        		"message" => "Sincronización exitosa con algunos planes sin poder actualizarse debido a que la facultad asignada no esta en el sistema.",
	        		"errors" => $errors
	        	));
        	}

        	return response()->json(array(
	        		"message" => "Sincronización exitosa.",
	        		"errors" => $errors
	        	));
        }
    }


    public function updateFacultades(Request $request)
    {

    	$post = $request->all();
    	
    	$errors = [];
        if ($post) {
        	$post = (object) $post;
        	$facultades = $post->facultades;
        	foreach ($facultades as $facultad) {
        		$facultad = (object) $facultad;
        		$p = Facultad::where('id_academusoft', $facultad->id_facultad)->first();
        		if(!$p){
        			$p = new Facultad;
        			$p->id_academusoft = $facultad->id_facultad;
        		}
        		$p->nombre = $facultad->nombre;
        		$p->save();
        	}
        	return response()->json(array(
        		"message" => "Sincronización exitosa",
        		"errors" => $errors
        	));
        }
        return response()->json(array(
        		"message" => "Error en datos enviados",
        		"errors" => $errors
        ));
    }

    public function updatePeriodosAcademicos(Request $request)
    {

    	$post = $request->all();
    	
    	$errors = [];
        if ($post) {
        	$post = (object) $post;
        	$periodos = $post->periodos_academicos;
        	foreach ($periodos as $periodo) {
        		$periodo = (object) $periodo;
        		$p = PeriodoAcademico::where('id_academusoft', $periodo->id_periodo_academico)->first();
        		if(!$p){
        			$p = new PeriodoAcademico;
        			$p->id_academusoft = $periodo->id_periodo_academico;
        		}
        		$p->periodo = $periodo->periodo;
        		$p->fechaInicio = $periodo->fecha_inicio;
        		$p->fechaFin = $periodo->fecha_fin;
        		$p->save();
        	}
        	return response()->json(array(
        		"message" => "Sincronización exitosa",
        		"errors" => $errors
        	));
        }
        return response()->json(array(
        		"message" => "Error en datos enviados",
        		"errors" => $errors
        ));
    }

    public function updateAsignatura(Request $request)
    {

    	$post = $request->all();
    	$errors = [];
        if ($post) {
        	$post = (object) $post;
        	$periodos = $post->periodos_academicos;
        	foreach ($periodos as $periodo) {
        		$periodo = (object) $periodo;
        		$p = PeriodoAcademico::where('id_academusoft', $periodo->id_periodo_academico)->first();
        		if(!$p){
        			$p = new PeriodoAcademico;
        			$p->id_academusoft = $periodo->id_periodo_academico;
        		}
        		$p->periodo = $periodo->periodo;
        		$p->fechaInicio = $periodo->fecha_inicio;
        		$p->fechaFin = $periodo->fecha_fin;
        		$p->save();
        	}
        	return response()->json(array(
        		"message" => "Sincronización exitosa",
        		"errors" => $errors
        	));
        }
        return response()->json(array(
        		"message" => "Error en datos enviados",
        		"errors" => $errors
        ));
    }
}
