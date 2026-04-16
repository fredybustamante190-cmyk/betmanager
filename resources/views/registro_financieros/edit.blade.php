@extends('layouts.app')

@section('content')

<div class="container mt-4">

    <div class="card shadow-sm mb-4 border-0">
        <div class="card-body bg-light rounded">
            <h4 class="mb-1">Editar movimiento financiero</h4>
            <small class="text-muted">
                Modifica la información del movimiento para mantener tu control financiero actualizado.
            </small>
        </div>
    </div>

    <div class="card shadow">
        <div class="card-header bg-warning">
            <h3 class="mb-0">Actualizar movimiento financiero</h3>
        </div>

        <div class="card-body">
            <form action="{{ route('registro-financieros.update', $registro->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label fw-bold">Tipo de movimiento</label>
                    <select name="tipo_movimiento" class="form-control" required>
                        <option value="deposito" {{ $registro->tipo_movimiento == 'deposito' ? 'selected' : '' }}>
                             Depósito
                        </option>
                        <option value="retiro" {{ $registro->tipo_movimiento == 'retiro' ? 'selected' : '' }}>
                             Retiro
                        </option>
                        <option value="ajuste" {{ $registro->tipo_movimiento == 'ajuste' ? 'selected' : '' }}>
                             Ajuste
                        </option>
                    </select>
                    <small class="text-muted">
                        Puedes cambiar el tipo de movimiento si registraste uno incorrecto.
                    </small>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Monto</label>
                    <div class="input-group">
                        <span class="input-group-text">$</span>
                        <input 
                            type="number" 
                            step="0.01" 
                            min="1"
                            name="monto" 
                            class="form-control" 
                            value="{{ $registro->monto }}"
                            required
                        >
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Descripción</label>
                    <input 
                        type="text" 
                        name="descripcion" 
                        class="form-control" 
                        value="{{ $registro->descripcion }}"
                        placeholder="Ejemplo: Saldo inicial, corrección, retiro personal"
                    >
                    <small class="text-muted">
                        Este campo es opcional, pero ayuda a identificar mejor el movimiento.
                    </small>
                </div>

                <div class="mb-4">
                    <label class="form-label fw-bold">Fecha del movimiento</label>
                    <input 
                        type="date" 
                        name="fecha_movimiento" 
                        class="form-control"
                        value="{{ $registro->fecha_movimiento }}"
                        required
                    >
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-success">Actualizar movimiento</button>
                    <a href="{{ route('registro-financieros.index') }}" class="btn btn-secondary">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection