@extends('layouts.app')

@section('content')

<h2>Iniciar Sesión</h2>

@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

<form action="{{ route('login.post') }}" method="POST">
    @csrf

    <div class="mb-3">
        <label>Nombre de Usuario</label>
        <input type="text" name="nombre_usuario" class="form-control">
    </div>

    <div class="mb-3">
        <label>Password</label>
        <input type="password" name="password" class="form-control">
    </div>

    <button type="submit" class="btn btn-primary">
        Ingresar
    </button>
</form>

@endsection