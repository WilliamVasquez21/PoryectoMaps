<?php
$images = [
    ['url' => 'https://via.placeholder.com/502x677', 'caption' => 'Imagen principal'],
    ['url' => 'https://via.placeholder.com/346x332', 'caption' => 'Imagen secundaria'],
    ['url' => 'https://via.placeholder.com/346x332', 'caption' => 'Imagen secundaria'],
    ['url' => 'https://via.placeholder.com/346x332', 'caption' => 'Imagen secundaria'],
    ['url' => 'https://via.placeholder.com/346x332', 'caption' => 'Imagen secundaria']
];

$highlightedImages = [
  [
      'url' => 'https://via.placeholder.com/712x677',
      'title' => 'Auditorio 1',
      'location' => 'CRQV+V24, San Miguel',
      'address' => 'Frente a la Plaza Roque Daltón, Costado Poniente del Parqueo de Visitantes.',
      'capacity' => '250 personas'
  ]
];
?>

<<<<<<< Updated upstream
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Minerva Maps UES-FMO</title>
    <link rel="stylesheet" href="{{ asset('css/minerva-la.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" rel="stylesheet">
</head>
<body>
=======
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

>>>>>>> Stashed changes
<!-- Botón de retorno en la parte superior izquierda -->
<a href="{{ route('minerva') }}"class="circle-button">
    <div class="inner-circle">
        <i class="fas fa-arrow-left"></i>
    </div>
</a>

<<<<<<< Updated upstream
<div class="container">
  <div class="image-grid">
    @foreach ($images as $index => $image)
      @if ($index == 0)
        <!-- Primera imagen más grande -->
        <img class="main-image" src="{{ $image['url'] }}" alt="{{ $image['caption'] }}" />
      @else
        <!-- Imágenes secundarias en grid -->
        <img class="grid-image" src="{{ $image['url'] }}" alt="{{ $image['caption'] }}" />
      @endif
    @endforeach
    
    <!-- Botón flotante sobre la última imagen del grid -->
    <div class="button-box" onclick="location.href='{{ route('minerva-overley') }}'">
      <div class="button-text">Mostrar todas las fotos</div>
=======
<!-- Botón de compartir en la parte superior derecha -->
<a href="{{ route('minerva') }}" class="compartir">
    <div class="inner-circle">
        <i class="bi bi-share"></i>
>>>>>>> Stashed changes
    </div>
  </div>
  
  <div class="container">
    <!-- Contenedor de imagen destacada y texto -->
    @foreach ($highlightedImages as $image)
    <div class="highlighted-container">
        <div class="info-box">
            <div class="auditorio-text">{{ $image['title'] }}</div>
            <div class="location">
                <i class="bi bi-geo-alt" style="font-size: 24px;"></i>
                <div class="location-text">{{ $image['location'] }}</div>
            </div>
            <div class="address">
                <i class="bi bi-map" style="font-size: 24px;"></i>
                <div class="address-text">{{ $image['address'] }}</div>
            </div>
<<<<<<< Updated upstream
            <div class="capacity">
                <i class="bi bi-people" style="font-size: 24px;"></i>
                <div class="capacity-text">{{ $image['capacity'] }}</div>
            </div>
        </div>
        <img class="highlighted-image" src="{{ $image['url'] }}" alt="{{ $image['title'] }}" />
    </div>
    @endforeach
</div>
</div>
<br><br><br>
<!-- Footer al final del contenido -->
<div class="footer">
  <div class="footer-text">© Realizado por estudiantes de Ingeniería en Sistemas Informáticos 2024.</div>
</div>

<script src="{{ asset('js/minerva.js') }}"></script>
</body>
</html>
=======
      </div>
    @else
      <!-- Mensaje si no hay datos -->
      <p>No se encontró información para este elemento.</p>
    @endif
  </div>
</section>

<script src="{{ asset('js/minerva-la.js') }}"></script>

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
       
        const titleToMatch = 'Dpto Ing y Arq';

       
        const geocodeUrl = `https://maps.googleapis.com/maps/api/geocode/json?address=${encodeURIComponent(titleToMatch)}&key=${apiKey}`;

     
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
                                stylers: [
                                    { color: "#b0e57c" }
                                ]
                            },
                            {
                                featureType: "road",
                                elementType: "geometry.stroke",
                                stylers: [
                                    { color: "#73a857" }
                                ]
                            },
                            {
                                featureType: "landscape",
                                elementType: "geometry",
                                stylers: [
                                    { color: "#cbe785" }
                                ]
                            },
                            {
                                featureType: "water",
                                elementType: "geometry.fill",
                                stylers: [
                                    { color: "#a2daf2" }
                                ]
                            },
                            {
                                featureType: "poi",
                                elementType: "geometry",
                                stylers: [
                                    { color: "#aed581" }
                                ]
                            },
                            {
                                featureType: "road.highway",
                                elementType: "geometry.fill",
                                stylers: [
                                    { color: "#c5e1a5" }
                                ]
                            },
                            {
                                featureType: "road.highway",
                                elementType: "geometry.stroke",
                                stylers: [
                                    { color: "#8bc34a" }
                                ]
                            },
                            {
                                featureType: "road.arterial",
                                elementType: "geometry",
                                stylers: [
                                    { color: "#d4e157" }
                                ]
                            }
                        ]
                    });

    
                    new google.maps.Marker({
                        position: location,
                        map: map,
                        title: titleToMatch,
                        animation: google.maps.Animation.BOUNCE 
                    });
                } else {
                    console.error('No se encontraron resultados para la ubicación solicitada.');
                }
            })
            .catch(error => {
                console.error('Error al obtener las coordenadas:', error);
            });
    }

  
    loadGoogleMapsAPI();
</script>
@endsection
>>>>>>> Stashed changes
