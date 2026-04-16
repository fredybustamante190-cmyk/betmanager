@extends('layouts.app')

@section('content')

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<h2 class="mb-3">Lista de Usuarios</h2>

@if(session('tipo_usuario') == 'admin')
    <a href="{{ route('usuarios.create') }}" class="btn btn-primary mb-3">
        <i class="fa-solid fa-user-plus"></i> Nuevo Usuario
    </a>
@endif

<table class="table table-bordered table-striped">
    <thead class="table-dark">
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Password</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        
        @foreach($usuarios as $usuario)
        <tr>
            <td>{{ $usuario->id_usuario }}</td>
            <td>{{ $usuario->nombre_usuario }}</td>
            <td>{{ $usuario->password }}</td>
            <td>

                @if(session('tipo_usuario') == 'admin')
                    <a href="{{ route('usuarios.edit', $usuario->id_usuario) }}" class="btn btn-warning btn-sm">
                        <i class="fa-solid fa-pen"></i>
                    </a>

                    <form action="{{ route('usuarios.destroy', $usuario->id_usuario) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">
                            <i class="fa-solid fa-trash"></i>
                        </button>
                    </form>
                @endif

            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection