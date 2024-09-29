<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Minerva Maps UES-FMO')</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/minerva.css') }}">
</head>
<body>
    <header class="header">
        <div class="busqueda">
            <h1 class="busqueda__titulo">Minerva Maps <br>UES-FMO</h1>
            <div class="boton">
                <input class="boton__texto" type="text" placeholder="Buscar en Minerva Maps">
            </div>
        </div>
        <img class="logo" src="https://upload.wikimedia.org/wikipedia/commons/f/fa/Escudo_de_la_Universidad_de_El_Salvador.svg" alt="Logo UES">
    </header>

    <!-- Botón de retorno en la parte superior izquierda -->
    <a href="{{ route('minerva.home') }}" class="circle-button">
        <div class="inner-circle">
            <i class="fas fa-arrow-left"></i>
        </div>
    </a>

    <!-- Contenedor del menú -->
    <div class="menu-container">
        @if(isset($departments) && count($departments) > 0)
            @foreach($departments as $department => $cards)
                <a href="#{{ strtolower(str_replace(' ', '', $department)) }}" class="menu-item">{{ $department }}</a>
            @endforeach
        @else
            <p>No hay departamentos disponibles en este momento.</p>
        @endif
    </div>

    <!-- Contenido Principal -->
    <div class="section-container">
        @yield('content')
    </div>

    <!-- Footer -->
    <div class="footer">
        <div class="footer-text">© Realizado por estudiantes de Ingeniería en Sistemas Informáticos 2024.</div>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/minerva.js') }}"></script>
    @yield('scripts')
</body>
</html>
