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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Minerva Maps UES-FMO</title>
    <link rel="stylesheet" href="css/minerva-la.css">
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
</head>
<body>

<a href="minerva.php" class="circle-button">
    <div class="inner-circle">
        <i class="fas fa-arrow-left"></i>
    </div>
</a>

<!-- Contenedor principal -->
<div class="container">
  <!-- Cuadrícula de imágenes -->
  <div class="image-grid">
    <?php foreach ($images as $index => $image): ?>
      <?php if ($index == 0): ?>
     
        <img class="main-image" src="<?= $image['url'] ?>" alt="<?= $image['caption'] ?>" />
      <?php else: ?>
        
        <img class="grid-image" src="<?= $image['url'] ?>" alt="<?= $image['caption'] ?>" />
      <?php endif; ?>
    <?php endforeach; ?>
    
   
    <div class="button-box" onclick="location.href='minerva-overley.php'">
      <div class="button-text">Mostrar todas las fotos</div>
    </div>
  </div>
  
  <!-- Contenedor de detalles y mapa -->
  <div class="container">
   
    <?php foreach ($highlightedImages as $image): ?>
    <div class="highlighted-container">
        <div class="info-box">
            <div class="auditorio-text"><?= $image['title'] ?></div>
            <div class="location">
                <i class="bi bi-geo-alt" style="font-size: 24px;"></i>
                <div class="location-text"><?= $image['location'] ?></div>
            </div>
            <div class="address">
                <i class="bi bi-map" style="font-size: 24px;"></i>
                <div class="address-text"><?= $image['address'] ?></div>
            </div>
            <div class="capacity">
                <i class="bi bi-people" style="font-size: 24px;"></i>
                <div class="capacity-text"><?= $image['capacity'] ?></div>
            </div>
        </div>

       
        <div class="map-wrapper">
            <div id="map-container"></div>
        </div>
    </div>
    <?php endforeach; ?>
</div>
</div>
<br><br><br>

<div class="footer">
  <div class="footer-text">© Realizado por estudiantes de Ingeniería en Sistemas Informáticos 2024.</div>
</div>

<script src="js/minerva.js"></script>


<script>
   
    const apiKey = 'AIzaSyAPOp7CDPpzRDuYqF1z4pP1ifIPnQN0c2M';

    function loadGoogleMapsAPI() {
        const script = document.createElement('script');
        script.src = `https://maps.googleapis.com/maps/api/js?key=${apiKey}`;
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
</body>
</html>
