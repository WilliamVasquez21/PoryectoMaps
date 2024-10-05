@extends('base')

@section('title', 'Minerva Maps UES-FMO')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<link rel="stylesheet" href="{{ asset('./css/minerva.css') }}">

<!-- Sección con las tarjetas -->
<div class="container-fluid">
    <div class="row m-3">
        @foreach($departments as $department => $cards)
        <div class="col-12 mb-6" id="{{ strtolower(str_replace(' ', '', $department)) }}">
            <h2 class="section-title">{{ $department }}</h2>
            <div class="row">
                @foreach(array_slice($cards, 0, 8) as $card)
                @if(isset($card['id']) && isset($card['nombre']))
                <div class="col-md-3 mb-4">
                    <div class="card h-100 d-flex flex-column">
                        <!-- Mostrar la primera foto de referencias o aulas si están disponibles -->
                        @if(isset($card['fotos']) && count($card['fotos']) > 0)
                            <!-- Comprobar si es una referencia o un aula -->
                            @if(isset($card['descripcion']))
                                <!-- Es una referencia -->
                                <a href="{{ route('minerva-la.referencia', ['id' => $card['id']]) }}" class="text-decoration-none">
                                    <img src="{{ $card['fotos'][0] }}" class="card-img-top img-fluid" alt="{{ $card['nombre'] }}">
                                </a>
                            @elseif(isset($card['zonaRelacionada']['nombre']))
                                <!-- Es un aula y mostramos zonaRelacionada.nombre -->
                                <a href="{{ route('minerva-la.aula', ['id' => $card['id']]) }}" class="text-decoration-none">
                                    <img src="{{ $card['fotos'][0] }}" class="card-img-top img-fluid" alt="{{ $card['nombre'] }}">
                                </a>
                            @endif
                        @else
                        <!-- Imagen por defecto si no hay fotos -->
                        <img src="https://via.placeholder.com/150" class="card-img-top img-fluid" alt="{{ $card['nombre'] }}">
                        @endif

                        <div class="mt-3">
                            <h5 class="title-card">{{ $card['nombre'] }}</h5>
                            <p class="card-text text-card">
                                <!-- Mostrar descripción para referencias o zonaRelacionada.nombre para aulas -->
                                {{ $card['descripcion'] ?? $card['zonaRelacionada']['nombre'] ?? 'No description available' }}
                            </p>
                        </div>
                    </div>
                </div>
                @endif
                @endforeach
            </div>

            @if(count($cards) > 8)
            <div class="col-13 mb-4" id="more-{{ strtolower(str_replace(' ', '', $department)) }}" style="display: none;">
                <div class="row">
                    @foreach(array_slice($cards, 8) as $card)
                    @if(isset($card['id']) && isset($card['nombre']))
                    <div class="col-md-3 mb-4 card-container">
                        <div class="card h-100 d-flex flex-column">
                            <!-- Mostrar la primera foto de referencias o aulas si están disponibles -->
                            @if(isset($card['fotos']) && count($card['fotos']) > 0)
                                <!-- Comprobar si es una referencia o un aula -->
                                @if(isset($card['descripcion']))
                                    <!-- Es una referencia -->
                                    <a href="{{ route('minerva-la.referencia', ['id' => $card['id']]) }}" class="text-decoration-none">
                                        <img src="{{ $card['fotos'][0] }}" class="card-img-top img-fluid" alt="{{ $card['nombre'] }}">
                                    </a>
                                @elseif(isset($card['zonaRelacionada']['nombre']))
                                    <!-- Es un aula y mostramos zonaRelacionada.nombre -->
                                    <a href="{{ route('minerva-la.aula', ['id' => $card['id']]) }}" class="text-decoration-none">
                                        <img src="{{ $card['fotos'][0] }}" class="card-img-top img-fluid" alt="{{ $card['nombre'] }}">
                                    </a>
                                @endif
                            @else
                            <!-- Imagen por defecto si no hay fotos -->
                            <img src="https://via.placeholder.com/150" class="card-img-top img-fluid" alt="{{ $card['nombre'] }}">
                            @endif

                            <div class="mt-3">
                                <h5 class="title-card">{{ $card['nombre'] }}</h5>
                                <p class="card-text text-card">
                                    <!-- Mostrar descripción para referencias o zonaRelacionada.nombre para aulas -->
                                    {{ $card['descripcion'] ?? $card['zonaRelacionada']['nombre'] ?? 'No description available' }}
                                </p>
                            </div>
                        </div>
                    </div>
                    @endif
                    @endforeach
                </div>
            </div>

            <!-- Botón para ver más tarjetas -->
            <div class="text-center">
                <button class="btn2" id="toggle-{{ strtolower(str_replace(' ', '', $department)) }}" onclick="showMoreCards('more-{{ strtolower(str_replace(' ', '', $department)) }}', this)">
                    Ver más
                </button>
            </div>
            @endif
        </div>
        @endforeach
    </div>
</div>
@endsection

<!-- Modal Bootstrap -->
<div class="modal fade" id="welcomeModal" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-centered-custom">
        <div class="modal-content">
            <div class="modal-header position-relative p-0">
                <img src="https://i.pinimg.com/originals/59/05/20/590520c029d4c0445ecdcbb617193d62.png" alt="Bienvenido" class="img-fluid w-100">
                <!-- Botón de cerrar personalizado -->
                <button type="button" class="close-btn position-absolute top-0 end-0 m-3" id="floatingCloseBtn" aria-label="Close">&times;</button>
            </div>
            <div class="modal-body text-center">
                <h2 class="fw-bold text-maroon">¡Bienvenido a Minerva Maps UES-FMO!</h2>
                <p class="mt-3">La herramienta perfecta para localizar aulas y sitios clave de la universidad. Navega fácilmente por el campus, encuentra tu aula para el próximo examen o descubre lugares importantes.</p>
                <p>¡Explora el mapa y optimiza tu experiencia universitaria en la UES-FMO!</p>
            </div>
        </div>
    </div>
</div>
