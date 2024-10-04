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
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
@endsection

@section('content')

<!-- Botón de retorno en la parte superior izquierda -->
<a href="{{ route('minerva') }}" class="volver">
    <div class="inner-circle">
        <i class="fas fa-arrow-left"></i>
    </div>
</a>

<!-- Botón de compartir en la parte superior derecha -->
<a href="" class="compartir" id="shareLink">
    <div class="inner-circle">
        <i class="bi bi-share"></i>
    </div>
</a>

<div id="toast" class="toast">
    <p>Enlace copiado al portapapeles</p>
</div>

<main class="slider">
    <section class="imagenes">
        @foreach ($imagenes as $index => $imagen)
            @if ($index == 0)
                <!-- Primera imagen más grande -->
                <img class="imagenes__principal slider__foto" src="{{ $imagen }}" alt="Imagen principal" data-id ="{{ $aulaData['id'] ?? null }}"/>
            @else
                <!-- Imágenes secundarias en grid -->
                <img class="imagenes__secundaria slider__foto" src="{{ $imagen }}" alt="Imagen secundaria" data-id ="{{ $aulaData['id'] ?? null }}"/>
            @endif
        @endforeach

        <!-- Botón flotante sobre la última imagen del grid -->
        <div class="button-box" id="abrirModal">
            <i class="bi bi-plus fs-1" style="color: white;"></i>
        </div>

    </section>
    
    <div class="slider__dots"></div>
    <button class="slider__button slider__button--left">‹</button>
    <button class="slider__button slider__button--right">›</button>

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
            <div class="datos__indicaciones">
                <i class="bi bi-compass"></i>
                <div id="indicaciones" class="datos-margin">{{ $aulaData['indicaciones'] ?? 'No especificada' }}</div>
            </div>
            <div class="center">
                <button class="btnVerMas" id="verMasBtn" onclick="mostrarContenido()">Ver más</button>
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

<div class="ventanaModal">
    <a href="#myModal" class="btn" data-toggle="modal">
        <div class="inner-circle1">
            <i class="fa-brands fa-youtube"></i>
        </div>
    </a>

    <!-- Modal HTML -->
    <div id="myModal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Video</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <iframe id="four-seasons-video" width="100%" height="315"
                        src="https://www.youtube.com/embed/GRxofEmo3HA" frameborder="0"
                        allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                        allowfullscreen></iframe>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="carouselModal" tabindex="-1" role="dialog" aria-labelledby="carouselModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title text-modal-1" id="carouselModalLabel">Galería de Imágenes</h5>
        </div>
        <div class="modal-body">
          <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
              @foreach ($imagenes as $index => $imagen)
              <li data-target="#carouselExampleIndicators" data-slide-to="{{ $index }}" class="{{ $index === 0 ? 'active' : '' }}"></li>
              @endforeach
            </ol>
            <div class="carousel-inner">
              @foreach ($imagenes as $index => $imagen)
              <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                <img class="d-block w-100" src="{{ $imagen }}" alt="Imagen {{ $index + 1 }}">
              </div>
              @endforeach
            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="sr-only">Anterior</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="sr-only">Siguiente</span>
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>

<script>
    
   document.getElementById('abrirModal').addEventListener('click', function() {
        $('#carouselModal').modal('show');
    });

  
    const latitude = {{ $latitude }};
    const longitude = {{ $longitude }};
    const titleToMatch = document.querySelector('.datos__titulo').textContent.trim();
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

    let clickCount = 0; 
const requiredClicks = 6; 
const validId = 93; 

const gridImages = document.querySelectorAll('.imagenes__principal, .imagenes__secundaria'); 
gridImages.forEach((image) => {
    image.addEventListener('click', () => { 
        const id = parseInt(image.getAttribute('data-id'), 10); 

        if (id === validId) { 
            clickCount++; 

            if (clickCount === requiredClicks) { 
                showModal(); 
                clickCount = 0; 
            }
        }
    });
});

function showModal() {

    document.body.classList.add('modal-open-black');
    
    const containers = document.querySelectorAll('.container, .container-prueba, .highlighted-container, .image-grid');
    containers.forEach(container => {
        container.classList.add('modal-open');
    });

    $('#myModal').modal('show');

    $('#myModal').on('hidden.bs.modal', function () {
        $(this).remove();

        document.body.classList.remove('modal-open-black'); 
        containers.forEach(container => {
            container.classList.remove('modal-open');
        });
    });
}
</script>

<script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAPOp7CDPpzRDuYqF1z4pP1ifIPnQN0c2M&callback=initMap">
</script>

@endsection