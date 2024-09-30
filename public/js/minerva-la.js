const sliderContainer = document.querySelector('.imagenes');
const fotos = document.querySelectorAll('.slider__foto'); // Asegúrate de que esta clase esté bien aplicada
const totalFotos = fotos.length;

let index = 0;
let startX = 0;
let endX = 0;

function showSlide(slideIndex) {
    if (slideIndex >= totalFotos) {
        index = 0;
    } else if (slideIndex < 0) {
        index = totalFotos - 1;
    } else {
        index = slideIndex;
    }
    sliderContainer.style.transform = `translateX(${-index * 100}%)`;
}

function handleTouchStart(event) {
    startX = event.touches[0].clientX;
}

function handleTouchMove(event) {
    endX = event.touches[0].clientX;
}

function handleTouchEnd() {
    const diffX = startX - endX;
    if (Math.abs(diffX) > 50) { // Ajusta el valor según tu preferencia
        if (diffX > 0) {
            showSlide(index + 1); // Deslizar hacia la izquierda
        } else {
            showSlide(index - 1); // Deslizar hacia la derecha
        }
    }
}

// Inicializa el slider mostrando la primera imagen
showSlide(index);

// Agrega eventos táctiles al contenedor de imágenes
sliderContainer.addEventListener('touchstart', handleTouchStart);
sliderContainer.addEventListener('touchmove', handleTouchMove);
sliderContainer.addEventListener('touchend', handleTouchEnd);

// Evento para volver a la primera imagen cuando el ancho sea mayor a 768px
window.addEventListener('resize', () => {
    if (window.innerWidth >= 768) {
        showSlide(0); // Vuelve a la primera imagen
    }
});
