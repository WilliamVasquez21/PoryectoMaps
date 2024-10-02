const apiKey = 'AIzaSyAPOp7CDPpzRDuYqF1z4pP1ifIPnQN0c2M'; // Reemplaza con tu API Key real

// Función para hacer la geocodificación inversa y obtener la dirección a partir de las coordenadas
function obtenerDireccionPorCoordenadas(latitude, longitude) {
    const geocodeUrl = `https://maps.googleapis.com/maps/api/geocode/json?latlng=${latitude},${longitude}&key=${apiKey}`;

    fetch(geocodeUrl)
        .then(response => response.json())
        .then(data => {
            if (data.status === 'OK' && data.results.length > 0) {
                const direccion = data.results[0].formatted_address;
                document.getElementById('direccion').innerText = `Dirección: ${direccion}`;
            } else {
                document.getElementById('direccion').innerText = 'No se pudo obtener la dirección';
            }
        })
        .catch(error => {
            console.error('Error al obtener la dirección:', error);
            document.getElementById('direccion').innerText = 'Error al obtener la dirección';
        });
}

// Llamar a la función para obtener la dirección usando las coordenadas
obtenerDireccionPorCoordenadas(latitude, longitude);

// Función para cargar el API de Google Maps
function loadGoogleMapsAPI() {
    const script = document.createElement('script');
    script.src = `https://maps.googleapis.com/maps/api/js?key=${apiKey}`;
    script.async = true;
    script.defer = true;
    script.onload = initMap;
    document.head.appendChild(script);
}

// Función para inicializar el mapa de Google Maps
function initMap() {
    // Geocodificación para encontrar la ubicación con el nombre dinámico de referencia
    const geocodeUrl = `https://maps.googleapis.com/maps/api/geocode/json?address=${encodeURIComponent(titleToMatch)}&key=${apiKey}`;

    fetch(geocodeUrl)
        .then(response => response.json())
        .then(data => {
            if (data.status === 'OK' && data.results.length > 0) {
                const location = data.results[0].geometry.location;

                // Inicialización del mapa
                const map = new google.maps.Map(document.getElementById('map-container'), {
                    center: location,
                    zoom: 19,
                    styles: [
                        { featureType: "all", elementType: "geometry.fill", stylers: [{ color: "#b0e57c" }] },
                        { featureType: "road", elementType: "geometry.stroke", stylers: [{ color: "#73a857" }] },
                        { featureType: "landscape", elementType: "geometry", stylers: [{ color: "#cbe785" }] },
                        { featureType: "water", elementType: "geometry.fill", stylers: [{ color: "#a2daf2" }] },
                        { featureType: "poi", elementType: "geometry", stylers: [{ color: "#aed581" }] },
                        { featureType: "road.highway", elementType: "geometry.fill", stylers: [{ color: "#c5e1a5" }] },
                        { featureType: "road.highway", elementType: "geometry.stroke", stylers: [{ color: "#8bc34a" }] },
                        { featureType: "road.arterial", elementType: "geometry", stylers: [{ color: "#d4e157" }] }
                    ]
                });

                // Marcador animado en el mapa
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

// Cargar Google Maps
loadGoogleMapsAPI();
