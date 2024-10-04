const sliderContainer = document.querySelector('.imagenes');
const fotos = document.querySelectorAll('.slider__foto');
const totalFotos = fotos.length;
const dotsContainer = document.querySelector('.slider__dots');
const leftButton = document.querySelector('.slider__button--left');
const rightButton = document.querySelector('.slider__button--right');

let index = 0;
let startX = 0;
let endX = 0;

/*slider*/
function createDots() {
    for (let i = 0; i < totalFotos; i++) {
        const dot = document.createElement('button');
        dot.classList.add('slider__dot');
        if (i === 0) dot.classList.add('active'); 
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
/* fin slider*/

/*copiar link de referencia*/
document.getElementById('shareLink').addEventListener('click', function(event) {
    event.preventDefault(); 
    
    // Crear un elemento temporal de input para copiar el enlace
    const tempInput = document.createElement('input');
    tempInput.value = this.href;
    document.body.appendChild(tempInput);
    tempInput.select();
    document.execCommand('copy');
    document.body.removeChild(tempInput);

    // Mostrar el toast de confirmación
    showToast();
});

function showToast() {
    const toast = document.getElementById('toast');
    toast.classList.add('show');

    // Ocultar el toast después de 3 segundos
    setTimeout(() => {
        toast.classList.remove('show');
    }, 3000); // 3 segundos
}

/*fin copiar link de referencia*/

/*btn mostrar mas*/
const MAX_CHARACTERS = 100;
let isExpanded = false;

function mostrarContenido() {
  const indicaciones = document.getElementById("indicaciones");
  const fullText = indicaciones.dataset.fulltext;
  const boton = document.getElementById("verMasBtn");

  if (!isExpanded) {
    indicaciones.textContent = fullText;
    boton.textContent = "Ver menos";
    isExpanded = true;
  } else {
    indicaciones.textContent = fullText.substring(0, MAX_CHARACTERS) + "...";
    boton.textContent = "Ver más";
    isExpanded = false;
  }
}

document.addEventListener("DOMContentLoaded", function () {
  const indicaciones = document.getElementById("indicaciones");
  const fullText = indicaciones.textContent; 

  
  indicaciones.dataset.fulltext = fullText;

  if (fullText.length > MAX_CHARACTERS) {
    indicaciones.textContent = fullText.substring(0, MAX_CHARACTERS) + "...";
  }
});

/modal/
$(document).ready(function() {
    $('#myModal').modal({
        show: false
    });

$('.ventanaModal a').click(function(e) {
    e.preventDefault();
    $('#myModal').modal('show');
});
$(document).on('click', function(e) {
    if ($(e.target).is('.modal')) {
        $('#myModal').modal('hide');
        }
    });
});
  