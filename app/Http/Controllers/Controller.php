<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\DB;
use Illuminate\Routing\Controller as BaseController;

use App\Usuario;
use App\Tercero;
use App\Unidad;
use App\SeguimientoUnidades;
use App\SeguimientoEjeTematico;
use App\SeguimientoCausas;
use App\SeguimientoAnalisisCualitativo;
use App\ProgramaAsignatura;
use App\Programa;
use App\PlazoDocente;
use App\Notificaciones;
use App\Grupo;
use App\FacultadAsignatura;
use App\EjeTematico;
use App\Dominio;
use App\Asignatura;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
