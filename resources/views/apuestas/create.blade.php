@extends('layouts.app')

@section('content')

<div class="container mt-4">
    <div class="card shadow">
        <div class="card-header bg-dark text-white">
            <h3 class="mb-0">Registrar nueva apuesta</h3>
        </div>

        <div class="card-body">
            <form action="{{ route('apuestas.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Nombre de la apuesta</label>
                    <input 
                        type="text" 
                        name="nombre_apuesta" 
                        class="form-control" 
                        placeholder="Ejemplo: América vs Chivas"
                        required
                    >
                    <small class="text-muted">Escribe un nombre claro para identificar la apuesta.</small>
                </div>

                <div class="mb-3">
                    <label class="form-label">Tipo de apuesta</label>
                    <select name="tipo_apuesta" class="form-control" required>
                        <option value="">Selecciona una opción</option>
                        <option value="Directa">Directa</option>
                        <option value="Parlay">Parlay</option>
                        <option value="Over/Under">Over/Under</option>
                        <option value="Marcador exacto">Marcador exacto</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Monto</label>
                    <input 
                        type="number" 
                        step="0.01" 
                        min="1"
                        name="monto" 
                        class="form-control" 
                        placeholder="Ejemplo: 500.00"
                        required
                    >
                </div>

                <div class="mb-3">
                    <label class="form-label">Fecha de la apuesta</label>
                    <input 
                        type="date" 
                        name="fecha_apuesta" 
                        class="form-control"
                        value="{{ date('Y-m-d') }}"
                        required
                    >
                </div>

                <input type="hidden" name="estado" value="pendiente">

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-success">Guardar apuesta</button>
                    <a href="{{ route('apuestas.index') }}" class="btn btn-secondary">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection