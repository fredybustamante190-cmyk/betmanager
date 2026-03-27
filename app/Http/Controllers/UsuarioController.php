<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{
    public function index()
    {
        $usuarios = Usuario::all();
        return view('usuarios.index', compact('usuarios'));
    }

    public function create()
    {
        return view('usuarios.create');
    }


public function store(Request $request)
{
Usuario::create([
    'nombre_usuario' => $request->nombre_usuario,
    'password' => Hash::make($request->password),
    'fecha_registro' => now(),
    'tipo_usuario' => $request->tipo_usuario
]);

    return redirect()->route('usuarios.index')
    ->with('success', 'Usuario creado correctamente');
}

    public function edit($id)
    {
        $usuario = Usuario::findOrFail($id);
        return view('usuarios.edit', compact('usuario'));
    }

public function update(Request $request, $id)
{
    $usuario = Usuario::findOrFail($id);

    $usuario->update([
        'nombre_usuario' => $request->nombre_usuario,
        'password' => Hash::make($request->password),
    ]);

    return redirect()->route('usuarios.index');
}

    public function destroy($id)
    {
        $usuario = Usuario::findOrFail($id);
        $usuario->delete();
        return redirect()->route('usuarios.index')
            ->with('success', 'Usuario eliminado correctamente');
    }
}

