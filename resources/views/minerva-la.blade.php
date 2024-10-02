<?php
// Establecemos un número mínimo de imágenes que queremos en el grid
$minImagesCount = 5; 

// Llenar el grid de imágenes con la última si no hay suficientes
while (count($imagenes) < $minImagesCount) {
    $imagenes[] = end($imagenes);  // Añadir la última imagen disponible hasta llenar
}

// Extraer las coordenadas de la zona relacionada si existen para aulas, o las de referencia
if (isset($zonaRelacionada['coordenadas'])) {
    $coordenadas = explode(',', $zonaRelacionada['coordenadas']);
    $latitude = $coordenadas[0] ?? '13.4834'; // Valor por defecto si no existe
    $longitude = $coordenadas[1] ?? '-88.1834'; // Valor por defecto si no existe
} elseif (isset($referenciaData['coordenadas'])) {
    $coordenadas = explode(',', $referenciaData['coordenadas']);
    $latitude = $coordenadas[0] ?? '13.4834'; // Coordenada predeterminada para referencias
    $longitude = $coordenadas[1] ?? '-88.1834'; // Coordenada predeterminada para referencias
} else {
    $latitude = '13.4834';  // Valor por defecto si no hay coordenadas
    $longitude = '-88.1834'; // Valor por defecto si no hay coordenadas
}
?>

@extends('base')

@section('title', 'Minerva Maps UES-FMO')

@php
    $hideHeader = true;
@endphp

@section('styles')
<link rel="stylesheet" href="{{ asset('css/normalize.css') }}">
<link rel="stylesheet" href="{{ asset('css/minerva-la.css') }}">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" rel="stylesheet">
@endsection

@section('content')

<!-- Botón de retorno en la parte superior izquierda -->
<a href="{{ route('minerva') }}" class="volver">
    <div class="inner-circle">
        <i class="fas fa-arrow-left"></i>
    </div>
</a>

<!-- Botón de compartir en la parte superior derecha -->
<a href="{{ route('minerva') }}" class="compartir">
    <div class="inner-circle">
        <i class="bi bi-share"></i>
    </div>
</a>

<main class="slider">
    <section class="imagenes">
        @foreach ($imagenes as $index => $imagen)
            @if ($index == 0)
                <!-- Primera imagen más grande -->
                <img class="imagenes__principal slider__foto" src="{{ $imagen }}" alt="Imagen principal" />
            @else
                <!-- Imágenes secundarias en grid -->
                <img class="imagenes__secundaria slider__foto" src="{{ $imagen }}" alt="Imagen secundaria" />
            @endif
        @endforeach

        <!-- Botón flotante sobre la última imagen del grid -->
        <div style="background: #B81414;" class="button-box" id="abrirModal">
            <i class="bi bi-plus fs-1" style="color: white;"></i>
        </div>
    </section>
</main>
  
<section class="informacion">
    @if (isset($aulaData) && $aulaData)
        <!-- Contenedor de detalles del aula -->
        <div class="datos">
            <div class="datos__titulo">{{ $aulaData['numero'] ?? 'Aula' }}</div>
            <div class="datos__ubicacion">
                <i class="bi bi-geo-alt icon"></i>
                <div class="datos-margin">{{ $zonaRelacionada['nombre'] ?? 'Sin zona asociada' }}</div>
            </div>
            <div class="datos__espacios">
                <i class="bi bi-people icon"></i>
                <div class="datos-margin">Capacidad: {{ $aulaData['capacidad'] ?? 'No especificada' }} personas</div>
            </div>
            <div class="datos__departamento">
                <i class="bi bi-map icon"></i>
                <div class="datos-margin">Coordenadas: {{ $zonaRelacionada['coordenadas'] ?? 'Sin coordenadas' }}</div>
            </div>
        </div>
        <div class="informacion__ubicacion">
            <div id="map-container" style="width: 100%; height: 400px;"></div>
        </div>

    @elseif (isset($referenciaData) && $referenciaData)
        <!-- Contenedor de detalles de la referencia -->
        <div class="datos">
            <div class="datos__titulo">{{ $referenciaData['nombre'] ?? 'Referencia' }}</div>
            @if (!empty($referenciaData['descripcion']))
                <div class="datos__ubicacion">
                    <i class="bi bi-info-circle icon"></i>
                    <div class="datos-margin">{{ $referenciaData['descripcion'] }}</div>
                </div>
            @endif
            <div class="datos__departamento">
                <i class="bi bi-geo-alt icon"></i>
                <div class="datos-margin">Coordenadas: {{ $referenciaData['coordenadas'] ?? 'Sin coordenadas' }}</div>
            </div>
        </div>
        <div class="informacion__ubicacion">
            <div id="map-container" style="width: 100%; height: 400px;"></div>
        </div>

    @else
        <p>No se encontró información para este elemento.</p>
    @endif
</section>

<script src="{{ asset('js/minerva-la.js') }}"></script>

<!-- Modal -->
<div id="myModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <div class="carousel-container">
            <div class="carousel-images" id="carouselImages">
                @foreach ($imagenes as $imagen)
                    <img src="{{ $imagen }}" alt="Imagen del carrusel">
                @endforeach
            </div>
        </div>
        <div class="carousel-controls">
            <button class="prev" onclick="moveCarousel(-1)">&#10094;</button>
            <button class="next" onclick="moveCarousel(1)">&#10095;</button>
        </div>
    </div>
</div>

<script>
    // Inicializar el carrusel
    let currentIndex = 0;
    const images = document.querySelectorAll('#carouselImages img');
    const totalImages = images.length;

    function moveCarousel(direction) {
        currentIndex = (currentIndex + direction + totalImages) % totalImages; // Circular
        updateCarousel();
    }

    function updateCarousel() {
        images.forEach((img, index) => {
            img.style.display = index === currentIndex ? 'block' : 'none';
        });
    }

    document.getElementById("abrirModal").onclick = function() {
        document.getElementById("myModal").style.display = "block";
        updateCarousel();
    }

    document.querySelector('.close').onclick = function() {
        document.getElementById("myModal").style.display = "none";
    }

    window.onclick = function(event) {
        const modal = document.getElementById("myModal");
        if (event.target === modal) {
            modal.style.display = "none";
        }
    }

  
    const latitude = {{ $latitude }};
    const longitude = {{ $longitude }};
    const titleToMatch = '{{ $referenciaData['nombre'] ?? 'Referencia' }}'; 
    const apiKey = 'AIzaSyAPOp7CDPpzRDuYqF1z4pP1ifIPnQN0c2M'; 

    function initMap() {
        const map = new google.maps.Map(document.getElementById('map-container'), {
            center: { lat: latitude, lng: longitude },
            zoom: 19,
            styles: [
                {
                    featureType: "all",
                    elementType: "geometry.fill",
                    stylers: [{ color: "#b0e57c" }]
                },
                {
                    featureType: "road",
                    elementType: "geometry.stroke",
                    stylers: [{ color: "#73a857" }]
                },
                {
                    featureType: "landscape",
                    elementType: "geometry",
                    stylers: [{ color: "#cbe785" }]
                },
                {
                    featureType: "water",
                    elementType: "geometry.fill",
                    stylers: [{ color: "#a2daf2" }]
                },
                {
                    featureType: "poi",
                    elementType: "geometry",
                    stylers: [{ color: "#aed581" }]
                },
                {
                    featureType: "road.highway",
                    elementType: "geometry.fill",
                    stylers: [{ color: "#c5e1a5" }]
                },
                {
                    featureType: "road.highway",
                    elementType: "geometry.stroke",
                    stylers: [{ color: "#7cb342" }]
                }
            ]
        });

        const markerPosition = { lat: latitude, lng: longitude }; 

        const marker = new google.maps.Marker({
        position: markerPosition, 
        map: map,
        title: titleToMatch,
        animation: google.maps.Animation.BOUNCE 
    });
    }
</script>

<script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAPOp7CDPpzRDuYqF1z4pP1ifIPnQN0c2M&callback=initMap">
</script>

@endsection
