@extends('layouts.app')

@section('content')

<h2>Crear Usuario</h2>

<form action="{{ route('usuarios.store') }}" method="POST">
    @csrf

    <div class="mb-3">
        <label class="form-label">Nombre</label>
        <input type="text" name="nombre_usuario" class="form-control">
    </div>

    <div class="mb-3">
    <label class="form-label">Correo electrónico</label>
    <input type="email" name="correo" class="form-control" required>
</div>

    <div class="mb-3">
        <label class="form-label">Password</label>
        <input type="text" name="password" class="form-control">
    </div>

    <div class="mb-3">
    <label>Tipo de usuario</label>
    <select name="tipo_usuario" class="form-control">
    <option value="usuario">Usuario</option>
    <option value="admin">Administrador</option>
    </select>
    </div>

    <button type="submit" class="btn btn-success">
        <i class="fa-solid fa-save"></i> Guardar
    </button>

    <a href="{{ route('usuarios.index') }}" class="btn btn-secondary">
        Regresar
    </a>
</form>

@endsection