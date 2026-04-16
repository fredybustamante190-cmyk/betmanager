@extends('layouts.app')

@section('content')

<h2 class="mb-4">Bienvenido a BetManager ⚽</h2>

<div class="card shadow-sm mb-4">
    <div class="card-header bg-dark text-white">
        Próximos partidos de la Premier League
    </div>
    <div class="card-body">
        @if(count($partidos) > 0)
            <div class="table-responsive">
                <table class="table table-bordered table-striped align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>Fecha</th>
                            <th>Partido</th>
                            <th>Liga</th>
                            <th>Temporada</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($partidos as $partido)
                            <tr>
                                <td>{{ \Carbon\Carbon::parse($partido['dateEvent'])->format('d/m/Y') }}</td>
                                <td>{{ $partido['strEvent'] }}</td>
                                <td>{{ $partido['strLeague'] }}</td>
                                <td>{{ $partido['strSeason'] }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="alert alert-warning mb-0">
                No se pudieron cargar los partidos en este momento.
            </div>
        @endif
    </div>
</div>

<div class="mt-3 d-flex gap-2">
    <a href="{{ route('login') }}" class="btn btn-primary">Iniciar sesión</a>
    <a href="{{ route('register') }}" class="btn btn-secondary">Registrarse</a>
</div>

@endsection