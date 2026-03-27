@extends('layouts.app')

@section('content')

<h2>Editar Usuario</h2>

<form action="{{ route('usuarios.update', $usuario->id_usuario) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label class="form-label">Nombre</label>
        <input type="text" name="nombre_usuario" value="{{ $usuario->nombre_usuario }}" class="form-control">
    </div>

    <div class="mb-3">
        <label class="form-label">Password</label>
        <input type="text" name="password" value="{{ $usuario->password }}" class="form-control">
    </div>

    <button type="submit" class="btn btn-primary">
        <i class="fa-solid fa-rotate"></i> Actualizar
    </button>

    <a href="{{ route('usuarios.index') }}" class="btn btn-secondary">
        Regresar
    </a>
</form>

@endsection