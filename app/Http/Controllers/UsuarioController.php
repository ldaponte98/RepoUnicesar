<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Redirect;

use App\Usuario;

class UsuarioController extends Controller
{
    public function login(Request $post)
    {
    	$usuario = new Usuario;

        
    	if ($post) {
    		$usuario = Usuario::where('usuario','=',$post->usuario)
    					->where('clave','=',md5($post->clave))
    					->first();
    		$mensaje = "Credenciales invalidas";
    		if ($usuario) {
                $is_admin = false;
                $is_docente = false;
                if ($usuario->id_perfil == 1) $is_admin=true;
                if ($usuario->id_perfil == 2) $is_docente=true;
                $session = [
                    'id_usuario' => $usuario->id,
                    'id_tercero_usuario' =>  $usuario->tercero->id_tercero,
                    'id_licencia' => $usuario->tercero->id_licencia,
                    'is_admin' => $is_admin,
                    'is_docente' => $is_docente,
                ];
    			session($session);

                if ($usuario->id_perfil == 1) return view('sitio.index',compact('usuario'));
                if ($usuario->id_perfil == 2) return view('sitio.index2',compact('usuario'));
    			
    		}	
    	}	
    	return back()->withErrors(['mensaje'=>$mensaje]);
    }

    public function logout(Request $request)
    {
        $request->session()->flush();
         return redirect('/');
    }
}
