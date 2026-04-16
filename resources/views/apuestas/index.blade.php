@extends('layouts.app')

@section('content')

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

<div class="card shadow-sm mb-4 border-0">
    <div class="card-body bg-info bg-opacity-25 rounded">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h5 class="mb-1">Saldo actual</h5>
                <small class="text-muted">Resumen general de tu gestor de apuestas</small>
            </div>
            <div class="text-end">
                <h3 class="mb-0">$ {{ number_format($saldo, 2) }}</h3>
            </div>
        </div>
    </div>
</div>

<div class="row mb-4">
    <div class="col-md-3 mb-3">
        <div class="card text-bg-success shadow-sm h-100">
            <div class="card-body">
                <h6 class="card-title">Depósitos</h6>
                <h4>$ {{ number_format($totalDepositos, 2) }}</h4>
            </div>
        </div>
    </div>

    <div class="col-md-3 mb-3">
        <div class="card text-bg-danger shadow-sm h-100">
            <div class="card-body">
                <h6 class="card-title">Retiros</h6>
                <h4>$ {{ number_format($totalRetiros, 2) }}</h4>
            </div>
        </div>
    </div>

    <div class="col-md-3 mb-3">
        <div class="card text-bg-primary shadow-sm h-100">
            <div class="card-body">
                <h6 class="card-title">Apuestas ganadas</h6>
                <h4>$ {{ number_format($totalGanadas, 2) }}</h4>
            </div>
        </div>
    </div>

    <div class="col-md-3 mb-3">
        <div class="card text-bg-warning shadow-sm h-100">
            <div class="card-body">
                <h6 class="card-title">Apuestas perdidas</h6>
                <h4>$ {{ number_format($totalPerdidas, 2) }}</h4>
            </div>
        </div>
    </div>
</div>

<div class="d-flex justify-content-between align-items-center mb-3">
    <h2 class="mb-0">Lista de Apuestas</h2>
    <a href="{{ route('apuestas.create') }}" class="btn btn-primary">
        Nueva Apuesta
    </a>
</div>

<table class="table table-bordered table-striped align-middle">
    <thead class="table-dark">
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Tipo</th>
            <th>Monto</th>
            <th>Fecha</th>
            <th>Estado</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach($apuestas as $apuesta)
        <tr>
            <td>{{ $apuesta->id }}</td>
            <td>{{ $apuesta->nombre_apuesta }}</td>
            <td>{{ $apuesta->tipo_apuesta }}</td>
            <td>$ {{ number_format($apuesta->monto, 2) }}</td>
            <td>{{ $apuesta->fecha_apuesta }}</td>

            <td>
                @if($apuesta->estado == 'ganada')
                    <span class="badge bg-success">Ganada</span>
                @elseif($apuesta->estado == 'perdida')
                    <span class="badge bg-danger">Perdida</span>
                @else
                    <span class="badge bg-warning text-dark">Pendiente</span>
                @endif
            </td>

            <td>
                <a href="{{ route('apuestas.edit', $apuesta->id) }}" class="btn btn-warning btn-sm">
                    Editar
                </a>

                @if(session('tipo_usuario') == 'admin')
                    <form action="{{ route('apuestas.destroy', $apuesta->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button 
                            type="submit" 
                            class="btn btn-danger btn-sm"
                            onclick="return confirm('¿Seguro que quieres eliminar esta apuesta?')"
                        >
                            Eliminar
                        </button>
                    </form>
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection