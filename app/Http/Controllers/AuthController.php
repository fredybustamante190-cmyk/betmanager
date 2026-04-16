<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Mail;
use App\Mail\LoginMail;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        Usuario::create([
            'nombre_usuario' => $request->nombre_usuario,
            'correo' => $request->correo,
            'password' => Hash::make($request->password),
            'fecha_registro' => now(),
            'tipo_usuario' => 'usuario',
        ]);

        return redirect()->route('login')
            ->with('success', 'Cuenta creada correctamente, ahora puedes iniciar sesión');
    }

    public function login(Request $request)
    {
        $usuario = Usuario::where('nombre_usuario', $request->nombre_usuario)->first();

        if ($usuario && Hash::check($request->password, $usuario->password)) {

            Session::put('usuario_id', $usuario->id_usuario);
            Session::put('usuario_nombre', $usuario->nombre_usuario);
            Session::put('tipo_usuario', $usuario->tipo_usuario);

            if (!empty($usuario->correo)) {
                Mail::to($usuario->correo)->send(new LoginMail($usuario));
            }

            return redirect()->route('apuestas.index');
        }

        return back()->with('error', 'Credenciales incorrectas');
    }

    public function logout()
    {
        Session::flush();
        return redirect()->route('login');
    }
}