@extends('layouts.app')

@section('content')

<div class="container mt-4">

    <div class="card shadow-sm mb-4 border-0">
        <div class="card-body bg-light rounded">
            <h4 class="mb-1">Nuevo movimiento financiero</h4>
            <small class="text-muted">
                Registra un depósito, retiro o ajuste para llevar control de tu saldo.
            </small>
        </div>
    </div>

    <div class="card shadow">
        <div class="card-header bg-dark text-white">
            <h3 class="mb-0">Registrar movimiento financiero</h3>
        </div>

        <div class="card-body">
            <form action="{{ route('registro-financieros.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label class="form-label fw-bold">Tipo de movimiento</label>
                    <select name="tipo_movimiento" class="form-control" required>
                        <option value="">Selecciona una opción</option>
                        <option value="deposito"> Depósito</option>
                        <option value="retiro"> Retiro</option>
                        <option value="ajuste"> Ajuste</option>
                    </select>
                    <small class="text-muted">
                        Usa depósito para agregar dinero, retiro para descontarlo y ajuste para correcciones.
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
                            placeholder="Ejemplo: 1000.00"
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
                        placeholder="Ejemplo: Saldo inicial, recarga semanal, retiro personal"
                    >
                    <small class="text-muted">
                        Este campo es opcional, pero ayuda a identificar el movimiento.
                    </small>
                </div>

                <div class="mb-4">
                    <label class="form-label fw-bold">Fecha del movimiento</label>
                    <input 
                        type="date" 
                        name="fecha_movimiento" 
                        class="form-control"
                        value="{{ date('Y-m-d') }}"
                        required
                    >
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-success">
                        Guardar movimiento
                    </button>
                    <a href="{{ route('registro-financieros.index') }}" class="btn btn-secondary">
                        Cancelar
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection