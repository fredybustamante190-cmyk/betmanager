<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>BetManager</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/535cfb49d9.js" crossorigin="anonymous"></script>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">

        <a class="navbar-brand" href="{{ route('apuestas.index') }}">
            <i class="fa-solid fa-database"></i> BetManager
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">

            @if(session('usuario_id'))
            <ul class="navbar-nav me-auto">

                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('apuestas.*') ? 'active' : '' }}" href="{{ route('apuestas.index') }}">
                        Apuestas
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('registro-financieros.*') ? 'active' : '' }}" href="{{ route('registro-financieros.index') }}">
                        Finanzas
                    </a>
                </li>

                @if(session('tipo_usuario') == 'admin')
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('usuarios.*') ? 'active' : '' }}" href="{{ route('usuarios.index') }}">
                        Usuarios
                    </a>
                </li>
                @endif

            </ul>
            @endif

            @if(session('usuario_nombre'))
                <div class="d-flex align-items-center">
                    <span class="text-white me-3">
                        {{ session('usuario_nombre') }}
                    </span>

                    <a href="{{ route('logout') }}" class="btn btn-danger btn-sm">
                        Cerrar sesión
                    </a>
                </div>
            @endif

        </div>
    </div>
</nav>

<div class="container mt-4">
    @yield('content')
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>