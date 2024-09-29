


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
          <div id="map" class="highlighted-map" style="width: 100%; height: 400px;"></div>
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
          <div id="map" class="highlighted-map" style="width: 100%; height: 400px;"></div>
      </div>
    @else
      <!-- Mensaje si no hay datos -->
      <p>No se encontró información para este elemento.</p>
    @endif
  </div>
</div>
<br><br><br>

<!-- Cargar Google Maps con coordenadas dinámicas -->
<script src="https://maps.googleapis.com/maps/api/js?key=TU_CLAVE_API_DE_GOOGLE_MAPS&callback=initMap" async defer></script>
<script>
    // Función para inicializar el mapa con las coordenadas dinámicas
    function initMap() {
        var mapOptions = {
            center: new google.maps.LatLng({{ $latitude }}, {{ $longitude }}),
            zoom: 15,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        };
        
        var map = new google.maps.Map(document.getElementById("map"), mapOptions);
        
        var marker = new google.maps.Marker({
            position: new google.maps.LatLng({{ $latitude }}, {{ $longitude }}),
            map: map,
            title: '{{ $aulaData['numero'] ?? $referenciaData['nombre'] }}'
        });
    }
</script>
@endsection
