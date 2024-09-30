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
<link rel="stylesheet" href="{{ asset('css/minerva-la.css') }}">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" rel="stylesheet">
<style>
        .map-wrapper {
            width: 600px; /* Ajusta el ancho del mapa */
            height: 400px; /* Ajusta la altura del mapa */
            border: 1px solid #ccc;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #fff;
        }

        #map-container {
            width: 100%;
            height: 100%;
        }
    </style>
@endsection

@section('content')

<!-- Botón de retorno en la parte superior izquierda -->
<a href="{{ route('minerva') }}" class="circle-button">
    <div class="inner-circle">
        <i class="fas fa-arrow-left"></i>
    </div>
</a>

<!-- Contenedor principal -->
<div class="container">
  <!-- Cuadrícula de imágenes -->
  <div class="image-grid">
    @foreach ($imagenes as $index => $imagen)
      @if ($index == 0)
        <!-- Primera imagen más grande -->
        <img class="main-image" src="{{ $imagen }}" alt="Imagen principal" />
      @else
        <!-- Imágenes secundarias en grid -->
        <img class="grid-image" src="{{ $imagen }}" alt="Imagen secundaria" />
      @endif
    @endforeach
    
    <!-- Botón flotante sobre la última imagen del grid -->
    <div class="button-box" onclick="location.href='{{ route('minerva-overley') }}'">
      <div class="button-text">Mostrar todas las fotos</div>
    </div>
  </div>
  
  <!-- Contenedor de detalles y mapa -->
  <div class="container">
    @if (isset($aulaData) && $aulaData)
      <!-- Contenedor de detalles del aula -->
      <div class="highlighted-container">
          <div class="info-box">
              <div class="auditorio-text">{{ $aulaData['numero'] ?? 'Aula' }}</div>
              <div class="location">
                  <i class="bi bi-geo-alt icon"></i>
                  <div class="location-text">{{ $zonaRelacionada['nombre'] ?? 'Sin zona asociada' }}</div>
              </div>
              <div class="capacity">
                  <i class="bi bi-people icon"></i>
                  <div class="capacity-text">Capacidad: {{ $aulaData['capacidad'] ?? 'No especificada' }} personas</div>
              </div>
              <div class="coordinates">
                  <i class="bi bi-map icon"></i>
                  <div class="location-text">Coordenadas: {{ $zonaRelacionada['coordenadas'] ?? 'Sin coordenadas' }}</div>
              </div>
          </div>
          <!-- Contenedor para Google Maps -->
          <div class="map-wrapper">
                <div id="map-container"></div>
            </div>
      </div>

    @elseif (isset($referenciaData) && $referenciaData)
      <!-- Contenedor de detalles de la referencia -->
      <div class="highlighted-container">
          <div class="info-box">
              <div class="auditorio-text">{{ $referenciaData['nombre'] ?? 'Referencia' }}</div>
              
              <!-- Descripción de la referencia con ícono -->
              @if (!empty($referenciaData['descripcion']))
                  <div class="description">
                      <i class="bi bi-info-circle icon"></i>
                      <div class="location-text">{{ $referenciaData['descripcion'] }}</div>
                  </div>
              @endif

              <!-- Coordenadas de la referencia -->
              <div class="location">
                  <i class="bi bi-geo-alt icon"></i>
                  <div class="location-text">Coordenadas: {{ $referenciaData['coordenadas'] ?? 'Sin coordenadas' }}</div>
              </div>
          </div>
          <!-- Contenedor para Google Maps -->
            <div class="map-wrapper">
                <div id="map-container"></div>
            </div>
      </div>
    @else
      <!-- Mensaje si no hay datos -->
      <p>No se encontró información para este elemento.</p>
    @endif
  </div>
</div>
<br><br><br>

<!-- Cargar Google Maps con coordenadas dinámicas -->
<script>
    const apiKey = 'AIzaSyAPOp7CDPpzRDuYqF1z4pP1ifIPnQN0c2M';

    function loadGoogleMapsAPI() {
        const script = document.createElement('script');
        script.src = https://maps.googleapis.com/maps/api/js?key=${apiKey};
        script.async = true;
        script.defer = true;
        script.onload = initMap;
        document.head.appendChild(script);
    }

    function initMap() {
        const titleToMatch = 'Dpto Ing y Arq'; // Cambia esto según sea necesario.

        const geocodeUrl = https://maps.googleapis.com/maps/api/geocode/json?address=${encodeURIComponent(titleToMatch)}&key=${apiKey};

        fetch(geocodeUrl)
            .then(response => response.json())
            .then(data => {
                if (data.status === 'OK' && data.results.length > 0) {
                    const location = data.results[0].geometry.location;

                    const map = new google.maps.Map(document.getElementById('map-container'), {
                        center: location,
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
                                stylers: [{ color: "#8bc34a" }]
                            },
                            {
                                featureType: "road.arterial",
                                elementType: "geometry",
                                stylers: [{ color: "#d4e157" }]
                            },
                            {
                                featureType: "road.local",
                                elementType: "geometry",
                                stylers: [{ color: "#ffeb3b" }]
                            },
                        ]
                    });

                    new google.maps.Marker({
                        position: location,
                        map: map,
                        title: titleToMatch
                    });
                } else {
                    console.error('Error fetching geocode data:', data.status);
                }
            })
            .catch(error => {
                console.error('Error fetching geocode:', error);
            });
    }

    // Iniciar Google Maps API
    loadGoogleMapsAPI();

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

    // Cerrar modal si se hace clic fuera de él
    window.onclick = function(event) {
        const modal = document.getElementById("myModal");
        if (event.target === modal) {
            modal.style.display = "none";
        }
    }
</script>
<script src="{{ asset('js/model.js') }}"></script>
@endsection