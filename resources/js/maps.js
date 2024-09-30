// Clave API de Google Maps
const apiKey = 'AIzaSyAPOp7CDPpzRDuYqF1z4pP1ifIPnQN0c2M';

// Función para cargar la API de Google Maps de forma asíncrona
function loadGoogleMapsAPI() {
    const script = document.createElement('script');
    script.src = `https://maps.googleapis.com/maps/api/js?key=${apiKey}`;
    script.async = true;
    script.defer = true;
    script.onload = initMap;
    document.head.appendChild(script);
}

// Función para inicializar el mapa
function initMap() {
    // Obtener el texto del div con clase "auditorio-text"
    const titleToMatch = document.querySelector('.auditorio-text').innerText;

    // Construir la URL para la API de Geocoding usando el texto obtenido
    const geocodeUrl = `https://maps.googleapis.com/maps/api/geocode/json?address=${encodeURIComponent(titleToMatch)}&key=${apiKey}`;

    // Hacer la solicitud a la API de Google Maps usando fetch
    fetch(geocodeUrl)
        .then(response => response.json())
        .then(data => {
            if (data.status === 'OK' && data.results.length > 0) {
                // Obtener las coordenadas de la respuesta
                const location = data.results[0].geometry.location;

                // Crear el mapa centrado en las coordenadas obtenidas
                const map = new google.maps.Map(document.getElementById('map-container'), {
                    center: location,
                    zoom: 19,
                    styles: [ /* Estilos personalizados del mapa */ ]
                });

                // Crear un marcador en la ubicación obtenida
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

// Llamar a la función para cargar la API de Google Maps
loadGoogleMapsAPI();
