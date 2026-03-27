<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{

    public function showLogin()
    {
        return view('auth.login');
    }

 
    public function login(Request $request)
    {
        $usuario = Usuario::where('nombre_usuario', $request->nombre_usuario)->first();

        if ($usuario && Hash::check($request->password, $usuario->password)) {
           Session::put('usuario_id', $usuario->id_usuario);
            Session::put('usuario_nombre', $usuario->nombre_usuario);
            Session::put('tipo_usuario', $usuario->tipo_usuario);

            return redirect()->route('usuarios.index');
        }

        return back()->with('error', 'Credenciales incorrectas');
    }

    public function logout()
    {
        Session::flush();
        return redirect()->route('login');
    }
}