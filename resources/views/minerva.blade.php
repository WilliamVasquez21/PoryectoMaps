<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Minerva Maps UES-FMO</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/minerva.css') }}">
</head>

<body>
<<<<<<< HEAD
    <div class="row">
        <header class="header">

            <div class="col col-10">

                <p class="busqueda__titulo">Minerva Maps <br>UES-FMO</p>


                <div class="boton">
                    <svg xmlns="http://www.w3.org/2000/svg" class="type__icon" width="40" height="40" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ffffff" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0" />
                        <path d="M21 21l-6 -6" />
                    </svg>
                    <input class="boton__texto" type="text" placeholder="Buscar">
                </div>
            </div>

            <div class="col col-2">
                <img class="logo" src="https://www.uese.ues.edu.sv/images/minerva_sola_white.png" alt="Logo UES">
            </div>

        </header>
    </div>
    <!-- Contenedor del menú -->
    <div class="menu-container">
        @if(isset($departments) && count($departments) > 0)
        @foreach($departments as $department => $cards) <!-- Aquí obtienes la clave y los datos -->
        <a href="#{{ strtolower(str_replace(' ', '', $department)) }}" class="menu-item">{{ $department }}</a> <!-- $department es la clave (nombre de la zona) -->
        @endforeach
        @else
        <p>No hay departamentos disponibles en este momento.</p>
        @endif
    </div>


    <!-- Sección con las tarjetas -->
    <div class="section-container">
        @foreach($departments as $department => $cards)
        <div class="section-container" id="{{ strtolower(str_replace(' ', '', $department)) }}">
            <div class="section-title">{{ $department }}</div>
            <div class="content visible-cards">
                @foreach(array_slice($cards, 0, 8) as $card)
                <a href="{{ route('minerva-la') }}" class="card"> <!-- Enlace correcto para la ruta 'minerva-la' -->
                    <div class="card-body">
                        <img src="{{ explode(',', $card['foto'])[0] }}" alt="{{ $card['nombre'] }}" style="width: 100%; height: auto;">
                        <h3>{{ $card['nombre'] }}</h3>
                        <p>{{ $card['descripcion'] }}</p>
                        <p>Coordenadas: {{ $card['coordenadas'] }}</p>
                    </div>
                </a>

                @endforeach
            </div>

            @if(count($cards) > 8)
            <div class="content hidden-cards" id="more-{{ strtolower(str_replace(' ', '', $department)) }}" style="display: none;">
                @foreach(array_slice($cards, 8) as $card)
                <a href="{{ route('minerva-la') }}" class="card">
                    <div class="card-body">
                        <img src="{{ explode(',', $card['foto'])[0] }}" alt="{{ $card['nombre'] }}" style="width: 100%; height: auto;">
                        <h3>{{ $card['nombre'] }}</h3>
                        <p>{{ $card['descripcion'] }}</p>
                        <p>Coordenadas: {{ $card['coordenadas'] }}</p>
                    </div>
                </a>
                @endforeach
            </div>
            <div class="view-more-btn">
                <button class="btn" onclick="showMoreCards('more-{{ strtolower(str_replace(' ', '', $department)) }}')">Ver más...</button>
            </div>
            @endif
        </div>
        @endforeach
    </div>


    <div class="footer">
        <div class="footer-text">© Realizado por estudiantes de Ingeniería en Sistemas Informáticos 2024.</div>
    </div>

    <script src="{{ asset('js/minerva.js') }}"></script>
</body>

</html>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Minerva Maps UES-FMO</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/minerva.css') }}">
</head>

<body>
=======
>>>>>>> 09dc33b95f012c29b54c00418acebbdde48565c6
    <header class="header">
        <div class="busqueda">
            <h1 class="busqueda__titulo">Minerva Maps <br>UES-FMO</h1>
            <div class="boton">
                <input class="boton__texto" type="text" placeholder="Buscar en Minerva Maps">
            </div>
        </div>
        <img class="logo"
            src="https://upload.wikimedia.org/wikipedia/commons/f/fa/Escudo_de_la_Universidad_de_El_Salvador.svg"
            alt="Logo UES">
    </header>

    <!-- Contenedor del menú -->
    <div class="menu-container">
        @if(isset($departments) && count($departments) > 0)
        @foreach($departments as $department => $cards)
        <!-- Aquí obtienes la clave y los datos -->
        <a href="#{{ strtolower(str_replace(' ', '', $department)) }}" class="menu-item">{{ $department }}</a>
        <!-- $department es la clave (nombre de la zona) -->
        @endforeach
        @else
        <p>No hay departamentos disponibles en este momento.</p>
        @endif
    </div>


    <!-- Sección con las tarjetas -->
    <div class="section-container">
        @foreach($departments as $department => $cards)
        <div class="section-container" id="{{ strtolower(str_replace(' ', '', $department)) }}">
            <div class="section-title">{{ $department }}</div>
            <div class="content visible-cards">
                @foreach(array_slice($cards, 0, 8) as $card)
                <a href="{{ route('minerva-la') }}" class="card">
                    <!-- Enlace correcto para la ruta 'minerva-la' -->
                    <div class="card-body">
                        <img src="{{ explode(',', $card['foto'])[0] }}" alt="{{ $card['nombre'] }}"
                            style="width: 100%; height: auto;">
                        <h3>{{ $card['nombre'] }}</h3>
                        <p>{{ $card['descripcion'] }}</p>
                        <p>Coordenadas: {{ $card['coordenadas'] }}</p>
                    </div>
                </a>

                @endforeach
            </div>

            @if(count($cards) > 8)
            <div class="content hidden-cards" id="more-{{ strtolower(str_replace(' ', '', $department)) }}"
                style="display: none;">
                @foreach(array_slice($cards, 8) as $card)
                <a href="{{ route('minerva-la') }}" class="card">
                    <div class="card-body">
                        <img src="{{ explode(',', $card['foto'])[0] }}" alt="{{ $card['nombre'] }}"
                            style="width: 100%; height: auto;">
                        <h3>{{ $card['nombre'] }}</h3>
                        <p>{{ $card['descripcion'] }}</p>
                        <p>Coordenadas: {{ $card['coordenadas'] }}</p>
                    </div>
                </a>
                @endforeach
            </div>
            <div class="view-more-btn">
                <button class="btn"
                    onclick="showMoreCards('more-{{ strtolower(str_replace(' ', '', $department)) }}')">Ver
                    más...</button>
            </div>
            @endif
        </div>
        @endforeach
    </div>


    <div class="footer">
        <div class="footer-text">© Realizado por estudiantes de Ingeniería en Sistemas Informáticos 2024.</div>
    </div>

    <script src="{{ asset('js/minerva.js') }}"></script>
</body>

</html>