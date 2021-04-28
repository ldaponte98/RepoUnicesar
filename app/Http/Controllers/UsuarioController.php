<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Redirect;

use App\Usuario;
use App\CodigoAcceso;
use App\Tercero;
use App\TerceroGrupo;

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
                $is_alumno = false;
                if ($usuario->id_perfil == 1) $is_admin=true;
                if ($usuario->id_perfil == 2) $is_docente=true;
                if ($usuario->id_perfil == 3) $is_alumno=true;
                $session = [
                    'id_usuario' => $usuario->id,
                    'id_tercero_usuario' =>  $usuario->tercero->id_tercero,
                    'id_licencia' => $usuario->tercero->id_licencia,
                    'is_admin' => $is_admin,
                    'is_docente' => $is_docente,
                    'is_alumno' => $is_alumno,
                ];
    			session($session);

                return redirect()->route("panel");
    			
    		}	
    	}	
    	return back()->withErrors(['mensaje'=>$mensaje]);
    }

    public function panel()
    {
        if (session('is_admin')) return view('sitio.index');
        if (session('is_docente')) return view('sitio.index2');
        if (session('is_alumno')) return view('sitio.index3');
    }

    public function logout(Request $request)
    {
        $request->session()->flush();

         return redirect('http://www2.unicesar.edu.co/unicesar/hermesoft/vortal/miVortal/logueo.jsp');
    }

    public function registro(Request $request)
    {
        $request = (object) $request->all();
        $token = null;
        if(isset($request->token)){
            $token = $request->token;
        }

        return view('sitio.registro', compact(['token']));
    }

    public function validar_registro(Request $request)
    {
        $post = (object) $request->all();
        $error = true;
        $message = "";
        if($post){
            $validar_token = CodigoAcceso::validar($post->token);
            if(!$validar_token->error){
                //ahora validamos el tercero si ya esta registrado por cedula
                $validar_cedula = Tercero::where('cedula', $post->identificacion)->where('estado', 1)->first();
                if(!$validar_cedula){
                     //ahora validamos el tercero si ya esta registrado por email
                    $validar_email = Tercero::where('email', $post->email)->where('estado', 1)->first();
                    if(!$validar_email){
                        //ahora validamos que las claves enviadas sean iguales
                        if($post->clave == $post->clave_confirmacion){
                            $tercero = new Tercero;
                            $tercero->nombre = $post->nombres;
                            $tercero->apellido = $post->apellidos;
                            $tercero->cedula = $post->identificacion;
                            $tercero->email = $post->email;
                            $tercero->id_dominio_tipo_ter = 4;// Alumno

                            if($tercero->save()){
                                //GUARDAMOS EL USUARIO
                                $usuario = new Usuario;
                                $usuario->id_tercero = $tercero->id_tercero;
                                $usuario->usuario = $tercero->email;
                                $usuario->clave = md5($post->clave);
                                $usuario->id_perfil = 3; //alumno
                                if($usuario->save()){
                                    //ahora registramos al alumno con el grupo segun el token pero validamos si el token requiere aprobación
                                    $codigo_acceso = CodigoAcceso::where('token', $post->token)
                                                     ->where('estado', 1)
                                                     ->first();
                                    $tercero_grupo = new TerceroGrupo;
                                    $tercero_grupo->id_tercero = $tercero->id_tercero;
                                    $tercero_grupo->id_grupo = $codigo_acceso->id_grupo;
                                    if($codigo_acceso->requiere_autorizacion == 1) $tercero_grupo->estado = 2; //pendiente hasta que el profesor acepte
                                    if($tercero_grupo->save()){
                                        $session = [
                                            'id_usuario' => $usuario->id,
                                            'id_tercero_usuario' =>  $usuario->tercero->id_tercero,
                                            'id_licencia' => $usuario->tercero->id_licencia,
                                            'is_admin' => false,
                                            'is_docente' => false,
                                            'is_alumno' => true,
                                        ];
                                        session($session);
                                        $request->session()->flash('bienvenida', 1);
                                        return redirect()->route('alumno/panel');
                                    }else{
                                        $message = "Ocurrio un error al asociar al alumno con el grupo. Error: ".$tercero_grupo->errors[0];
                                    }
                                }else{
                                    $message = "Ocurrio un error al crear el usuario para el alumno. Error: ".$usuario->errors[0];
                                }                          
                            }else{
                                $message = "Ocurrio un error al registrar al alumno. Error: ".$tercero->errors[0];
                            }
                        }else{
                            $message = "Las contraseñas no coinciden.";
                        }
                    }else{
                        $message = "Ya existe un usuario registrado con este correo electrónico.";
                    }
                }else{
                    $message = "Ya existe un usuario registrado con esta identificación.";
                }
            }else{
                $message = $validar_token->message;
            }
        }

        return back()->withErrors(['mensaje'=>$message, 'data' => $post]);
    }
}
