@extends('layouts.app')

@section('content')

<h2 class="mb-3">Editar Apuesta</h2>

<form action="{{ route('apuestas.update', $apuesta->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label class="form-label">Nombre de la apuesta</label>
        <input type="text" name="nombre_apuesta" class="form-control" value="{{ $apuesta->nombre_apuesta }}">
    </div>

    <div class="mb-3">
        <label class="form-label">Tipo de apuesta</label>
        <input type="text" name="tipo_apuesta" class="form-control" value="{{ $apuesta->tipo_apuesta }}">
    </div>

    <div class="mb-3">
        <label class="form-label">Monto</label>
        <input type="number" step="0.01" name="monto" class="form-control" value="{{ $apuesta->monto }}">
    </div>

    <div class="mb-3">
        <label class="form-label">Fecha de apuesta</label>
        <input type="date" name="fecha_apuesta" class="form-control" value="{{ $apuesta->fecha_apuesta }}">
    </div>

    <div class="mb-3">
        <label class="form-label">Estado</label>
        <select name="estado" class="form-control">
            <option value="pendiente" {{ $apuesta->estado == 'pendiente' ? 'selected' : '' }}>Pendiente</option>
            <option value="ganada" {{ $apuesta->estado == 'ganada' ? 'selected' : '' }}>Ganada</option>
            <option value="perdida" {{ $apuesta->estado == 'perdida' ? 'selected' : '' }}>Perdida</option>
        </select>
    </div>

    <button type="submit" class="btn btn-success">Actualizar</button>
    <a href="{{ route('apuestas.index') }}" class="btn btn-secondary">Regresar</a>
</form>

@endsection