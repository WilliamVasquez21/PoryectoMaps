<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Integrantes</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- Incluimos Swiper.js CSS -->
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
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
    min-height: 200vh;
}

.context {
    display: flex;
    justify-content: center;
    align-items: center;
    width: 100%;
    height: auto;
    padding: 20px 0;
    position: relative;
    z-index: 2;
    background-color: transparent;
}

.context h1 {
    text-align: center;
    color: #fff;
    font-size: 50px;
    margin: 0;
}

.area {
    background: #4e54c8;
    background: -webkit-linear-gradient(to left, #8f94fb, #4e54c8);
    width: 100%;
    height: 100vh;
    position: fixed;
    z-index: 0;
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
    justify-content: center;
    align-items: flex-start;
    flex-wrap: wrap;
    position: relative;
    z-index: 2;
    margin-top: 5vh;
    padding: 20px;
}

.col-lg-3, .col-md-4, .col-sm-6, .col-10 {
    padding: 10px;
    width: 100%;
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

.area-title {
    color: #fff;
    text-align: center;
    font-size: 30px;
    margin: 20px 0;
}

/* Estilos del carrusel */
.swiper-container {
    width: 100%;
    padding: 20px;
}

.swiper-slide {
    display: flex;
    justify-content: center;
    align-items: center;
}

.area {
    position: fixed; /* El fondo estará siempre fijo en su lugar */
    width: 100%;
    height: 100%;
    overflow: hidden;
    z-index: -1;
}

.area::before {
    content: '';
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-image: url('URL_DE_LA_IMAGEN'); /* Coloca aquí la URL de la imagen de fondo */
    background-size: contain; /* Usa contain para que la imagen se ajuste sin cortar */
    background-position: center center; /* Mantiene la imagen centrada */
    background-repeat: no-repeat; /* Evita que la imagen se repita */
    background-attachment: fixed; /* Fija la imagen de fondo */
    z-index: -1;
    min-height: 100vh; /* Asegura que cubra toda la altura de la pantalla */
}



/* Media queries para mejorar la responsividad */

/* Ajustes para tablets */
@media (max-width: 768px) {
    .profile-card-3 {
        height: auto;
    }
    
    .profile-card-3 .background-block {
        height: 120px;
    }

    .profile-card-3 .profile {
        max-width: 60px;
    }

    .profile-card-3 h2 {
        font-size: 16px;
    }

    .profile-card-3 h2 small {
        font-size: 10px;
    }
}

/* Ajustes para smartphones */
@media (max-width: 576px) {
    .context h1 {
        font-size: 35px;
    }

    .profile-card-3 {
        height: auto;
    }

    .profile-card-3 .background-block {
        height: 100px;
    }

    .profile-card-3 .profile {
        max-width: 50px;
    }

    .profile-card-3 h2 {
        font-size: 14px;
    }

    .profile-card-3 h2 small {
        font-size: 9px;
    }

    .icon-block a {
        font-size: 12px;
    }

    /* Ajuste del tamaño de los círculos en pantallas pequeñas */
    .circles li {
        width: 10px;
        height: 10px;
    }
}
    </style>
</head>
<body>

    <div class="context">
        <h1>Integrantes</h1>
    </div>

    <div class="container">
        <!-- Título del área Frontend -->
        <h2 class="area-title">Frontend</h2>
        <!-- Carrusel de perfiles Frontend -->
        <div class="swiper-container frontend-swiper">
            <div class="swiper-wrapper" id="frontend-container">
                <!-- Las tarjetas de Frontend se generarán dinámicamente aquí -->
            </div>
            <!-- Paginación del carrusel -->
            <div class="swiper-pagination"></div>
        </div>

        <!-- Título del área Backend -->
        <h2 class="area-title">Backend</h2>
        <!-- Carrusel de perfiles Backend -->
        <div class="swiper-container backend-swiper">
            <div class="swiper-wrapper" id="backend-container">
                <!-- Las tarjetas de Backend se generarán dinámicamente aquí -->
            </div>
            <!-- Paginación del carrusel -->
            <div class="swiper-pagination"></div>
        </div>

        <!-- Título del área Base de Datos -->
        <h2 class="area-title">Base de Datos</h2>
        <!-- Carrusel de perfiles Base de Datos -->
        <div class="swiper-container database-swiper">
            <div class="swiper-wrapper" id="database-container">
                <!-- Las tarjetas de Base de Datos se generarán dinámicamente aquí -->
            </div>
            <!-- Paginación del carrusel -->
            <div class="swiper-pagination"></div>
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

    <!-- Incluimos Swiper.js -->
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

    <script>
        const integrantes = [
            {
        nombre: "William Alfredo Vásquez Flores",
        puesto: "Frontend Developer",
        github: "https://github.com/WilliamAlfredo",
        linkedin: "https://www.linkedin.com/in/william-vásquez-dev",
        fondoImg: "https://upload.wikimedia.org/wikipedia/commons/c/c8/Logo_UES.jpg",
        perfilImg: "https://upload.wikimedia.org/wikipedia/commons/c/c8/Logo_UES.jpg",
        area: "frontend"
    },
    {
        nombre: "William Alexander Chávez Márquez",
        puesto: "Frontend Developer",
        github: "https://github.com/WilliamCHM",
        linkedin: "www.linkedin.com/in/william-alexander-chavez-marquez-0a9a36329",
        fondoImg: "https://upload.wikimedia.org/wikipedia/commons/c/c8/Logo_UES.jpg",
        perfilImg: "https://upload.wikimedia.org/wikipedia/commons/c/c8/Logo_UES.jpg",
        area: "frontend"
    },
    {
        nombre: "Edras Ariel Viera Lazo",
        puesto: "Frontend Developer",
        github: "https://github.com/edraslazov",
        linkedin: " http://www.linkedin.com/in/edras-ariel-viera-lazo-022a91291",
        fondoImg: "https://upload.wikimedia.org/wikipedia/commons/c/c8/Logo_UES.jpg",
        perfilImg: "https://upload.wikimedia.org/wikipedia/commons/c/c8/Logo_UES.jpg",
        area: "frontend"
    },
    {
        nombre: "René Alexander Barrera Flores",
        puesto: "Frontend Developer",
        github: "https://github.com/Sotalexx",
        linkedin: "https://www.linkedin.com/in/ren%C3%A9-barrera-02338a331/",
        fondoImg: "https://upload.wikimedia.org/wikipedia/commons/c/c8/Logo_UES.jpg",
        perfilImg: "https://upload.wikimedia.org/wikipedia/commons/c/c8/Logo_UES.jpg",
        area: "frontend"
    },
    {
        nombre: "Carlos Orlando Hernández Del Cid",
        puesto: "Frontend Developer",
        github: "https://github.com/orlxnd",
        linkedin: "https://www.linkedin.com/in/carlos-hernández-del-cid-a06471296",
        fondoImg: "https://upload.wikimedia.org/wikipedia/commons/c/c8/Logo_UES.jpg",
        perfilImg: "https://upload.wikimedia.org/wikipedia/commons/c/c8/Logo_UES.jpg",
        area: "frontend"
    },
    {
        nombre: "Gisselle Lilibeth Hernandez Lazo",
        puesto: "Frontend Developer",
        github: "",
        linkedin: "https://www.linkedin.com/in/gisselle-hernandez-aa312a294?utm_source=share&utm_campaign=share_via&utm_content=profile&utm_medium=ios_app",
        fondoImg: "https://upload.wikimedia.org/wikipedia/commons/c/c8/Logo_UES.jpg",
        perfilImg: "https://upload.wikimedia.org/wikipedia/commons/c/c8/Logo_UES.jpg",
        area: "frontend"
    },
    {
        nombre: "Kevin Nathanael Granados Pérez",
        puesto: "Frontend Developer",
        github: "https://github.com/NathanaelPerez",
        linkedin: "http://www.linkedin.com/in/kevin-nathanael-granados-perez-245318271",
        fondoImg: "https://upload.wikimedia.org/wikipedia/commons/c/c8/Logo_UES.jpg",
        perfilImg: "https://upload.wikimedia.org/wikipedia/commons/c/c8/Logo_UES.jpg",
        area: "frontend"
    },
    {
        nombre: "Jesús Steven Medrano Carballo",
        puesto: "Frontend Developer",
        github: "https://github.com/medranosteven",
        linkedin: "http://www.linkedin.com/in/jesús-steven-medrano-carballo-427a48330",
        fondoImg: "https://upload.wikimedia.org/wikipedia/commons/c/c8/Logo_UES.jpg",
        perfilImg: "https://upload.wikimedia.org/wikipedia/commons/c/c8/Logo_UES.jpg",
        area: "frontend"
    },
    {
        nombre: "Roberto Hernán Laínez Trejo",
        puesto: "Frontend Developer",
        github: "https://github.com/R0bert09",
        linkedin: "https://www.linkedin.com/in/roberto-hernán-laínez-trejo-6216a7279/",
        fondoImg: "https://upload.wikimedia.org/wikipedia/commons/c/c8/Logo_UES.jpg",
        perfilImg: "https://upload.wikimedia.org/wikipedia/commons/c/c8/Logo_UES.jpg",
        area: "frontend"
    },
    {
        nombre: "Jesús Steven Medrano Carballo",
        puesto: "Frontend Developer",
        github: "https://github.com/edraslazov",
        linkedin: "http://www.linkedin.com/in/edras-ariel-viera-lazo-022a91291",
        fondoImg: "https://upload.wikimedia.org/wikipedia/commons/c/c8/Logo_UES.jpg",
        perfilImg: "https://upload.wikimedia.org/wikipedia/commons/c/c8/Logo_UES.jpg",
        area: "frontend"
    },
    {
        nombre: "Eliseo Antonio Santos Diaz",
        puesto: "Frontend Developer",
        github: "https://github.com/EliseoSantos2468",
        linkedin: "https://www.linkedin.com/in/eliseo-antonio-santos-diaz-606389331/",
        fondoImg: "https://upload.wikimedia.org/wikipedia/commons/c/c8/Logo_UES.jpg",
        perfilImg: "https://upload.wikimedia.org/wikipedia/commons/c/c8/Logo_UES.jpg",
        area: "frontend"
    },
    {
        nombre: "Arturo Esperanza",
        puesto: "Backend Developer",
        github: "https://github.com/EliasEsperanza",
        linkedin: "https://www.linkedin.com/in/arturo-elias-torres-esperanza-3a47982a6?utm_source=share&utm_campaign=share_via&utm_content=profile&utm_medium=android_app",
        fondoImg: "https://upload.wikimedia.org/wikipedia/commons/c/c8/Logo_UES.jpg",
        perfilImg: "https://upload.wikimedia.org/wikipedia/commons/c/c8/Logo_UES.jpg",
        area: "backend"
    },
    {
        nombre: "Gabriel De la O",
        puesto: "Backend Developer",
        github: "https://github.com/Hieloeston235",
        linkedin: "",
        fondoImg: "https://upload.wikimedia.org/wikipedia/commons/c/c8/Logo_UES.jpg",
        perfilImg: "https://upload.wikimedia.org/wikipedia/commons/c/c8/Logo_UES.jpg",
        area: "backend"
    },
    {
        nombre: "Meybell Ramirez",
        puesto: "Backend Developer",
        github: "https://github.com/Meybell25",
        linkedin: "https://www.linkedin.com/in/meybell-ram%C3%ADrez-a4b5ab207?utm_source=share&utm_campaign=share_via&utm_content=profile&utm_medium=android_app",
        fondoImg: "https://upload.wikimedia.org/wikipedia/commons/c/c8/Logo_UES.jpg",
        perfilImg: "https://upload.wikimedia.org/wikipedia/commons/c/c8/Logo_UES.jpg",
        area: "backend"
    },
    {
        nombre: "Luis Cruz",
        puesto: "Backend Developer",
        github: "https://github.com/LuisCruz29",
        linkedin: "",
        fondoImg: "https://upload.wikimedia.org/wikipedia/commons/c/c8/Logo_UES.jpg",
        perfilImg: "https://upload.wikimedia.org/wikipedia/commons/c/c8/Logo_UES.jpg",
        area: "backend"
    },
    {
        nombre: "Marlon Alemán",
        puesto: "Backend Developer",
        github: "https://github.com/Alemancito",
        linkedin: "",
        fondoImg: "https://upload.wikimedia.org/wikipedia/commons/c/c8/Logo_UES.jpg",
        perfilImg: "https://upload.wikimedia.org/wikipedia/commons/c/c8/Logo_UES.jpg",
        area: "backend"
    },
    {
        nombre: "Santos Romero",
        puesto: "Backend Developer",
        github: "https://github.com/Josue04R",
        linkedin: "",
        fondoImg: "https://upload.wikimedia.org/wikipedia/commons/c/c8/Logo_UES.jpg",
        perfilImg: "https://upload.wikimedia.org/wikipedia/commons/c/c8/Logo_UES.jpg",
        area: "backend"
    },
    {
        nombre: "Ángel Ramírez",
        puesto: "Backend Developer",
        github: "https://github.com/AngelRamirez18",
        linkedin: "",
        fondoImg: "https://upload.wikimedia.org/wikipedia/commons/c/c8/Logo_UES.jpg",
        perfilImg: "https://upload.wikimedia.org/wikipedia/commons/c/c8/Logo_UES.jpg",
        area: "backend"
    },
    {
        nombre: "Diego Morataya",
        puesto: "Backend Developer",
        github: "https://github.com/DieMT10",
        linkedin: "",
        fondoImg: "https://upload.wikimedia.org/wikipedia/commons/c/c8/Logo_UES.jpg",
        perfilImg: "https://upload.wikimedia.org/wikipedia/commons/c/c8/Logo_UES.jpg",
        area: "backend"
    },
    {
        nombre: "Kevin Rodriguez",
        puesto: "Backend Developer",
        github: "https://github.com/0kev0",
        linkedin: "",
        fondoImg: "https://upload.wikimedia.org/wikipedia/commons/c/c8/Logo_UES.jpg",
        perfilImg: "https://upload.wikimedia.org/wikipedia/commons/c/c8/Logo_UES.jpg",
        area: "backend"
    },
    {
        nombre: "Rafael Lino",
        puesto: "Backend Developer",
        github: "https://github.com/Lovoh17",
        linkedin: "https://www.linkedin.com/in/rafael-lino-b62a1425b/",
        fondoImg: "https://upload.wikimedia.org/wikipedia/commons/c/c8/Logo_UES.jpg",
        perfilImg: "https://upload.wikimedia.org/wikipedia/commons/c/c8/Logo_UES.jpg",
        area: "backend"
    },
            {
        nombre: "Elian Francisco Treminio Parada",
        puesto: "Base de Datos",
        github: "https://github.com/ElianTrem",
        linkedin: "https://sv.linkedin.com/in/elian-francisco-treminio-parada-618649329",
        fondoImg: "https://upload.wikimedia.org/wikipedia/commons/c/c8/Logo_UES.jpg",
        perfilImg: "https://upload.wikimedia.org/wikipedia/commons/c/c8/Logo_UES.jpg",
        area: "database"
    },
    {
        nombre: "Yahir Ariel Nieto Amaya",
        puesto: "Base de Datos",
        github: "https://github.com/YANA021",
        linkedin: "https://www.linkedin.com/in/yahir-ariel-nieto-amaya-412857319/",
        fondoImg: "https://upload.wikimedia.org/wikipedia/commons/c/c8/Logo_UES.jpg",
        perfilImg: "https://upload.wikimedia.org/wikipedia/commons/c/c8/Logo_UES.jpg",
        area: "database"
    },
    {
        nombre: "Oscar Alejandro Bonilla Cortez",
        puesto: "Base de Datos",
        github: "https://github.com/AlejandroBC1007",
        linkedin: "https://sv.linkedin.com/in/alejandro-bonilla-6bb39b218",
        fondoImg: "https://upload.wikimedia.org/wikipedia/commons/c/c8/Logo_UES.jpg",
        perfilImg: "https://upload.wikimedia.org/wikipedia/commons/c/c8/Logo_UES.jpg",
        area: "database"
    },
    {
        nombre: "Cristina Raquel Ventura González",
        puesto: "Base de Datos",
        github: "https://github.com/RaquelVentura",
        linkedin: "https://www.linkedin.com/in/cristina-raquel-ventura-gonz%C3%A1lez-158aab330/?trk=opento_sprofile_topcard",
        fondoImg: "https://upload.wikimedia.org/wikipedia/commons/c/c8/Logo_UES.jpg",
        perfilImg: "https://upload.wikimedia.org/wikipedia/commons/c/c8/Logo_UES.jpg",
        area: "database"
    },
    {
        nombre: "Yoselin Aracely Joya Ortez",
        puesto: "Base de Datos",
        github: "https://github.com/yoselinuesfom",
        linkedin: "",
        fondoImg: "https://upload.wikimedia.org/wikipedia/commons/c/c8/Logo_UES.jpg",
        perfilImg: "https://upload.wikimedia.org/wikipedia/commons/c/c8/Logo_UES.jpg",
        area: "database"
    },
    {
        nombre: "Alexander Antolino Retana Medina",
        puesto: "Base de Datos",
        github: "https://github.com/AntolinoRetana",
        linkedin: "",
        fondoImg: "https://upload.wikimedia.org/wikipedia/commons/c/c8/Logo_UES.jpg",
        perfilImg: "https://upload.wikimedia.org/wikipedia/commons/c/c8/Logo_UES.jpg",
        area: "database"
    },
    {
        nombre: "Marvin Josué Batres Rivas",
        puesto: "Base de Datos",
        github: "https://github.com/marvinJosueBatresRivas",
        linkedin: "http://www.linkedin.com/in/marvin-josue-batres-rivas-b54aaa330",
        fondoImg: "https://upload.wikimedia.org/wikipedia/commons/c/c8/Logo_UES.jpg",
        perfilImg: "https://upload.wikimedia.org/wikipedia/commons/c/c8/Logo_UES.jpg",
        area: "database"
    },
    {
        nombre: "Miguel Alfredo Ayala Rodriguez",
        puesto: "Base de Datos",
        github: "https://github.com/m-lucy2405",
        linkedin: "http://www.linkedin.com/in/miguel-alfredo-ayala-rodr%C3%ADguez-b43198331",
        fondoImg: "https://upload.wikimedia.org/wikipedia/commons/c/c8/Logo_UES.jpg",
        perfilImg: "https://upload.wikimedia.org/wikipedia/commons/c/c8/Logo_UES.jpg",
        area: "database"
    },
    {
        nombre: "Adan Omar Quevedo Argueta",
        puesto: "Base de Datos",
        github: "pendiente",
        linkedin: "",
        fondoImg: "https://upload.wikimedia.org/wikipedia/commons/c/c8/Logo_UES.jpg",
        perfilImg: "https://upload.wikimedia.org/wikipedia/commons/c/c8/Logo_UES.jpg",
        area: "database"
    },
    {
        nombre: "Brayan Josue Granados",
        puesto: "Base de Datos",
        github: "https://github.com/BRAYANGRANADOS",
        linkedin: "",
        fondoImg: "https://upload.wikimedia.org/wikipedia/commons/c/c8/Logo_UES.jpg",
        perfilImg: "https://upload.wikimedia.org/wikipedia/commons/c/c8/Logo_UES.jpg",
        area: "database"
    }
        ];

        // Función para generar tarjetas de cada área
function generarTarjetas(area, containerId) {
    const container = document.getElementById(containerId);
    integrantes.filter(integrante => integrante.area === area).forEach(integrante => {
        const card = `
            <div class="swiper-slide">
                <div class="col-lg-3 col-md-4 col-sm-6 col-10 mx-auto my-3">
                    <div class="card profile-card-3">
                        <div class="background-block">
                            <img src="${integrante.fondoImg}" alt="profile-background" class="background" />
                        </div>
                        <div class="profile-thumb-block">
                            <img src="${integrante.perfilImg}" alt="profile-image" class="profile" />
                        </div>
                        <div class="card-content">
                            <h2>${integrante.nombre}<small><br/>${integrante.puesto}</small></h2>
                            <div class="icon-block">
                                <a href="${integrante.github}" target="_blank"><i class="fab fa-github"></i> GitHub</a>
                                <a href="${integrante.linkedin}" target="_blank"><i class="fab fa-linkedin"></i> LinkedIn</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        `;
        container.innerHTML += card;
    });
}

        // Generar tarjetas para cada área
        generarTarjetas("frontend", "frontend-container");
        generarTarjetas("backend", "backend-container");
        generarTarjetas("database", "database-container");

        // Inicializar los carruseles Swiper para cada área
        new Swiper('.frontend-swiper', {
            slidesPerView: 1,
            spaceBetween: 30,
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
        });

        new Swiper('.backend-swiper', {
            slidesPerView: 1,
            spaceBetween: 30,
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
        });

        new Swiper('.database-swiper', {
            slidesPerView: 1,
            spaceBetween: 30,
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
        });
    </script>
</body>
</html>
