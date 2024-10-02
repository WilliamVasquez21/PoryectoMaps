const sliderContainer = document.querySelector('.imagenes');
const fotos = document.querySelectorAll('.slider__foto');
const totalFotos = fotos.length;
const dotsContainer = document.querySelector('.slider__dots');
const leftButton = document.querySelector('.slider__button--left');
const rightButton = document.querySelector('.slider__button--right');

let index = 0;
let startX = 0;
let endX = 0;

// Crear los circulitos según la cantidad de imágenes
function createDots() {
    for (let i = 0; i < totalFotos; i++) {
        const dot = document.createElement('button');
        dot.classList.add('slider__dot');
        if (i === 0) dot.classList.add('active'); // Activar el primer dot por defecto
        dot.addEventListener('click', () => showSlide(i));
        dotsContainer.appendChild(dot);
    }
}

function updateDots() {
    const dots = document.querySelectorAll('.slider__dot');
    dots.forEach(dot => dot.classList.remove('active'));
    dots[index].classList.add('active');
}

function showSlide(slideIndex) {
    if (slideIndex >= totalFotos) {
        index = 0;
    } else if (slideIndex < 0) {
        index = totalFotos - 1;
    } else {
        index = slideIndex;
    }
    sliderContainer.style.transform = `translateX(${-index * 100}%)`;
    updateDots(); // Actualizar los dots
}

function handleTouchStart(event) {
    startX = event.touches[0].clientX;
}

function handleTouchMove(event) {
    endX = event.touches[0].clientX;
}

function handleTouchEnd() {
    const diffX = startX - endX;
    if (Math.abs(diffX) > 50) {
        if (diffX > 0) {
            showSlide(index + 1);
        } else {
            showSlide(index - 1);
        }
    }
}

function handleRightClick() {
    showSlide(index + 1);
}

function handleLeftClick() {
    showSlide(index - 1);
}

// Inicializa el slider
createDots();
showSlide(index);

// Agregar eventos de navegación por botones
rightButton.addEventListener('click', handleRightClick);
leftButton.addEventListener('click', handleLeftClick);

// Eventos táctiles
sliderContainer.addEventListener('touchstart', handleTouchStart);
sliderContainer.addEventListener('touchmove', handleTouchMove);
sliderContainer.addEventListener('touchend', handleTouchEnd);

// Reaccionar al cambio de tamaño de ventana
window.addEventListener('resize', () => {
    if (window.innerWidth >= 768) {
        showSlide(0); // Vuelve a la primera imagen
    }
});
