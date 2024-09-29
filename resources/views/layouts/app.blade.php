<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Minerva Maps')</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="{{ route('minerva.home') }}">Minerva Maps</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" 
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('minerva.home') }}">Zonas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('aulas.index') }}">Aulas</a>
                </li>
                <!-- Añade más enlaces según sea necesario -->
            </ul>
        </div>
    </nav>

    <div class="container mt-5">
        @yield('content')
    </div>
</body>
</html>