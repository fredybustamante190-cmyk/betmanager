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
                <h5 class="mb-1">Saldo total</h5>
                <small class="text-muted">Incluye movimientos financieros y resultados de apuestas</small>
            </div>
            <div class="text-end">
                <h3 class="mb-0">$ {{ number_format($saldo, 2) }}</h3>
            </div>
        </div>
    </div>
</div>

<div class="row mb-4">
    <div class="col-md-4 mb-3">
        <div class="card text-bg-success shadow-sm h-100">
            <div class="card-body">
                <h6 class="card-title">Depósitos</h6>
                <h4>$ {{ number_format($totalDepositos, 2) }}</h4>
            </div>
        </div>
    </div>

    <div class="col-md-4 mb-3">
        <div class="card text-bg-danger shadow-sm h-100">
            <div class="card-body">
                <h6 class="card-title">Retiros</h6>
                <h4>$ {{ number_format($totalRetiros, 2) }}</h4>
            </div>
        </div>
    </div>

    <div class="col-md-4 mb-3">
        <div class="card text-bg-warning shadow-sm h-100">
            <div class="card-body">
                <h6 class="card-title">Ajustes</h6>
                <h4>$ {{ number_format($totalAjustes, 2) }}</h4>
            </div>
        </div>
    </div>
</div>

<div class="d-flex justify-content-between align-items-center mb-3">
    <h2 class="mb-0">Registro Financiero</h2>
    <a href="{{ route('registro-financieros.create') }}" class="btn btn-primary">
        Nuevo Movimiento
    </a>
</div>

<table class="table table-bordered table-striped align-middle">
    <thead class="table-dark">
        <tr>
            <th>ID</th>
            <th>Tipo de movimiento</th>
            <th>Monto</th>
            <th>Descripción</th>
            <th>Fecha</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach($registros as $registro)
        <tr>
            <td>{{ $registro->id }}</td>

            <td>
                @if($registro->tipo_movimiento == 'deposito')
                    <span class="badge bg-success">Depósito</span>
                @elseif($registro->tipo_movimiento == 'retiro')
                    <span class="badge bg-danger">Retiro</span>
                @else
                    <span class="badge bg-warning text-dark">Ajuste</span>
                @endif
            </td>

            <td>$ {{ number_format($registro->monto, 2) }}</td>
            <td>{{ $registro->descripcion }}</td>
            <td>{{ $registro->fecha_movimiento }}</td>

            <td>
                <a href="{{ route('registro-financieros.edit', $registro->id) }}" class="btn btn-warning btn-sm">
                    Editar
                </a>

                @if(session('tipo_usuario') == 'admin')
                    <form action="{{ route('registro-financieros.destroy', $registro->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button 
                            type="submit" 
                            class="btn btn-danger btn-sm"
                            onclick="return confirm('¿Seguro que quieres eliminar este movimiento?')"
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