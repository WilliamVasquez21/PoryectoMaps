<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Integrantes</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css?family=Exo:400,700');

* {
    margin: 0px;
    padding: 0px;
    box-sizing: border-box;
}

body {
    font-family: 'Exo', sans-serif;
    position: relative;
    overflow-x: hidden;
    margin: 0;
    padding: 0;
    min-height: 200vh; /* Hacemos el body más alto para probar el scroll */
}

.context {
    display: flex;
    justify-content: center; /* Centra horizontalmente */
    align-items: center; /* Centra verticalmente */
    width: 100%;
    height: auto; /* Cambia a auto para ajustarse al contenido */
    padding: 20px 0; /* Espacio adicional para evitar que se solape con otros elementos */
    position: relative; /* Cambiado de absolute a relative */
    z-index: 2; /* Las tarjetas y el título estarán sobre el fondo */
    background-color: transparent;
}

.context h1 {
    text-align: center;
    color: #fff;
    font-size: 50px;
    margin: 0; /* Asegúrate de que no haya márgenes que afecten el centrado */
}


/* Fondo animado con círculos */
.area {
    background: #4e54c8;
    background: -webkit-linear-gradient(to left, #8f94fb, #4e54c8);
    width: 100%;
    height: 100vh;
    position: fixed; /* Mantiene el fondo fijo mientras se desplaza */
    z-index: 0; /* El fondo queda detrás */
    top: 0;
    left: 0;
}

.circles {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    overflow: hidden;
}

.circles li {
    position: absolute;
    display: block;
    list-style: none;
    width: 20px;
    height: 20px;
    background: rgba(255, 255, 255, 0.2);
    animation: animate 25s linear infinite;
    bottom: -150px;
}

.circles li:nth-child(1) { left: 25%; width: 80px; height: 80px; animation-delay: 0s; }
.circles li:nth-child(2) { left: 10%; width: 20px; height: 20px; animation-delay: 2s; animation-duration: 12s; }
.circles li:nth-child(3) { left: 70%; width: 20px; height: 20px; animation-delay: 4s; }
.circles li:nth-child(4) { left: 40%; width: 60px; height: 60px; animation-delay: 0s; animation-duration: 18s; }
.circles li:nth-child(5) { left: 65%; width: 20px; height: 20px; animation-delay: 0s; }
.circles li:nth-child(6) { left: 75%; width: 110px; height: 110px; animation-delay: 3s; }
.circles li:nth-child(7) { left: 35%; width: 150px; height: 150px; animation-delay: 7s; }
.circles li:nth-child(8) { left: 50%; width: 25px; height: 25px; animation-delay: 15s; animation-duration: 45s; }
.circles li:nth-child(9) { left: 20%; width: 15px; height: 15px; animation-delay: 2s; animation-duration: 35s; }
.circles li:nth-child(10) { left: 85%; width: 150px; height: 150px; animation-delay: 0s; animation-duration: 11s; }

@keyframes animate {
    0% {
        transform: translateY(0) rotate(0deg);
        opacity: 1;
        border-radius: 0;
    }
    100% {
        transform: translateY(-1000px) rotate(720deg);
        opacity: 0;
        border-radius: 50%;
    }
}

/* Estilo para las tarjetas y centrado */
.container {
    display: flex;
    justify-content: center; /* Centra horizontalmente */
    align-items: flex-start; /* Alinea las tarjetas hacia la parte superior del contenedor */
    flex-wrap: wrap; /* Asegura que las tarjetas se distribuyan en varias filas si es necesario */
    position: relative;
    z-index: 2; /* Las tarjetas estarán sobre el fondo */
    margin-top: 5vh; /* Margen superior para evitar solapamiento con el título */
    padding: 20px; /* Añade un poco de padding para mayor espacio */
}

.col-lg-3, .col-md-4, .col-sm-6, .col-10 {
    padding: 10px;
}

.col-10 {
    max-width: 400px;
}

.profile-card-3 {
    font-family: "Open Sans", Arial, sans-serif;
    position: relative;
    overflow: hidden;
    width: 100%;
    text-align: center;
    height: 320px;
    border: none;
    margin-bottom: 20px;
}

.profile-card-3 .background-block {
    width: 100%;
    height: 160px;
    overflow: hidden;
}

.profile-card-3 .background-block .background {
    width: 100%;
    vertical-align: top;
    opacity: 0.9;
    -webkit-filter: blur(0.5px);
    filter: blur(0.5px);
    -webkit-transform: scale(1.8);
    transform: scale(2.8);
}

.profile-card-3 .card-content {
    padding: 10px;
    background: #efefef;
    height: 120px;
    border-radius: 0 0 5px 5px;
    position: relative;
}

.profile-card-3 .profile {
    border-radius: 50%;
    position: absolute;
    bottom: 60%;
    left: 50%;
    max-width: 80px;
    box-shadow: 3px 3px 20px rgba(0, 0, 0, 0.5);
    border: 2px solid rgba(255, 255, 255, 1);
    transform: translate(-50%, 0%);
}

.profile-card-3 h2 {
    font-size: 18px;
    margin-bottom: 3px;
}

.profile-card-3 h2 small {
    font-size: 12px;
}

.profile-card-3 .icon-block a {
    text-decoration: none;
    font-size: 14px;
    color: #232323;
    margin: 0 5px;
}

.profile-card-3 .icon-block i {
    font-size: 14px;
    border: 1px solid #232323;
    width: 25px;
    height: 25px;
    line-height: 25px;
    border-radius: 50%;
    display: inline-block;
    margin: 0 3px;
}

.profile-card-3 i:hover {
    background-color: #232323;
    color: #fff;
    text-decoration: none;
}
.text-center{
    text-align: center;
    color: #fff;
}

.area {
    position: absolute;
    width: 100%;
    height: 100%;
    overflow: hidden;
    z-index: -1; /* Asegura que esté detrás del contenido */
}

.area::before {
    content: '';
    position: fixed; /* La imagen de fondo permanecerá fija en su lugar */
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: linear-gradient(180deg, rgba(0, 0, 0, 0.5) 0%, rgba(0, 0, 0, 0.5) 100%), /* Color negro con 50% de opacidad */
                url(https://scontent.fsal2-1.fna.fbcdn.net/v/t39.30808-6/236899758_2992999797647318_6265414759634020742_n.jpg?_nc_cat=107&ccb=1-7&_nc_sid=127cfc&_nc_ohc=ClEysNERb4UQ7kNvgGGauNq&_nc_ht=scontent.fsal2-1.fna&_nc_gid=AmI0KEZBaPU6yos5QUd4xR_&oh=00_AYDnxUJHy3k_JbxcLdJ3Kl_1yVoYKdpENly5yvdDdMz6vg&oe=670498E6);
    background-size: cover; /* Cubre toda el área sin estirarse */
    background-position: center center; /* Centra la imagen */
    background-repeat: no-repeat; /* No repite la imagen */
    z-index: -1;
}



    </style>
</head>
<body>

    <div class="context">
        <h1>Integrantes</h1>
    </div>

    <div class="container">
        <div class="row justify-content-center" id="integrantes-container">
            <!-- Las tarjetas se generarán dinámicamente aquí -->
        </div>
    </div>

    <div class="area">
        <ul class="circles">
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
        </ul>
    </div>

    <script>
        const integrantes = [
            {
                nombre: "Justin Tim",
                puesto: "Frontend Developer",
                github: "https://github.com/justinfrontend",
                linkedin: "https://linkedin.com/in/justinfrontend",
                fondoImg: "https://images.pexels.com/photos/459225/pexels-photo-459225.jpeg?auto=compress&cs=tinysrgb&h=650&w=940",
                perfilImg: "https://randomuser.me/api/portraits/men/78.jpg"
            },
            {
                nombre: "Alex Doe",
                puesto: "Backend Developer",
                github: "https://github.com/alexbackend",
                linkedin: "https://linkedin.com/in/alexbackend",
                fondoImg: "https://images.pexels.com/photos/210241/pexels-photo-210241.jpeg?auto=compress&cs=tinysrgb&h=650&w=940",
                perfilImg: "https://randomuser.me/api/portraits/men/79.jpg"
            },
            {
                nombre: "Sarah Smith",
                puesto: "Database Administrator",
                github: "https://github.com/sarahdb",
                linkedin: "https://linkedin.com/in/sarahdb",
                fondoImg: "https://images.pexels.com/photos/235986/pexels-photo-235986.jpeg?auto=compress&cs=tinysrgb&h=650&w=940",
                perfilImg: "https://randomuser.me/api/portraits/women/78.jpg"
            }
        ];

        const integrantesContainer = document.getElementById('integrantes-container');

        integrantes.forEach(integrante => {
            const card = `
            <p class="mt-3 w-100 float-left text-center"><strong>${integrante.puesto}</strong></p>
                <div class="col-lg-3 col-md-4 col-sm-6 col-10 mx-auto my-3">
                    <div class="card profile-card-3">
                        <div class="background-block">
                            <img src="${integrante.fondoImg}" alt="profile-background" class="background" />
                        </div>
                        <div class="profile-thumb-block">
                            <img src="${integrante.perfilImg}" alt="profile-image" class="profile" />
                        </div>
                        <div class="card-content">
                            <h2>${integrante.nombre}<small>${integrante.puesto}</small></h2>
                            <div class="icon-block">
                                <a href="${integrante.github}" target="_blank"><i class="fa fa-github"></i></a>
                                <a href="${integrante.linkedin}" target="_blank"><i class="fa fa-linkedin"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            `;
            integrantesContainer.innerHTML += card;
        });
    </script>
</body>
</html>
