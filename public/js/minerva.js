// Función para mostrar más tarjetas (sin cambios)
function showMoreCards(sectionId) {
  const hiddenCards = document.getElementById(sectionId);
  if (hiddenCards.style.display === "none") {
    hiddenCards.style.display = "grid";
  } else {
    hiddenCards.style.display = "none";
  }
}

// Cambiar texto al botón
function showMoreCards(elementId, button) {
  const moreCards = document.getElementById(elementId);
  
  if (moreCards.style.display === "none") {
      moreCards.style.display = "block"; 
      button.innerText = "Ver menos"; 
  } else {
      moreCards.style.display = "none"; 
      button.innerText = "Ver más"; 
  }
}

// Funcionalidad para buscar por nombre o departamento
const searchInput = document.querySelector('.boton__texto');
searchInput.addEventListener('input', function () {
  const searchTerm = this.value.toLowerCase();
  const sections = document.querySelectorAll('.col-12');  
  
  sections.forEach(section => {
    const departmentTitle = section.querySelector('h2.section-title').textContent.toLowerCase(); 
    const cards = section.querySelectorAll('.card'); 
    let hasVisibleCard = false;
    
    cards.forEach(card => {
      const cardTitle = card.querySelector('.title-card').textContent.toLowerCase(); 
      if (cardTitle.includes(searchTerm) || departmentTitle.includes(searchTerm)) {
        card.parentElement.style.display = "block"; 
        hasVisibleCard = true;
      } else {
        card.parentElement.style.display = "none"; // Ocultar la tarjeta si no coincide
      }
    });
    
    // Mostrar u ocultar secciones basadas en si hay tarjetas visibles
    if (hasVisibleCard || departmentTitle.includes(searchTerm)) {
      section.style.display = "block"; // Mostrar la sección si hay tarjetas visibles
    } else {
      section.style.display = "none"; // Ocultar la sección si no hay tarjetas visibles
    }
  });
});

document.addEventListener("DOMContentLoaded", function() {
  if (!localStorage.getItem("hasVisited")) {
      var myModal = new bootstrap.Modal(document.getElementById('welcomeModal'), {
          keyboard: true,
          backdrop: true
      });
      myModal.show(); 
      localStorage.setItem("hasVisited", "true");
  }

  // Funcionalidad del botón 
  var closeBtn = document.getElementById('floatingCloseBtn');
  closeBtn.onclick = function() {
      var myModalEl = document.getElementById('welcomeModal');
      var modalInstance = bootstrap.Modal.getInstance(myModalEl);
      modalInstance.hide(); 
  };

  // Cerrar el modal 
  var modalEl = document.getElementById('welcomeModal');
  modalEl.addEventListener('hidden.bs.modal', function () {
      closeBtn.remove(); 
  });
});

//Mouse en moviles
const menuContainer = document.querySelector('.menu-container');
let isDown = false;
let startX;
let scrollLeft;

menuContainer.addEventListener('mousedown', (e) => {
    isDown = true;
    menuContainer.classList.add('active');
    startX = e.pageX - menuContainer.offsetLeft;
    scrollLeft = menuContainer.scrollLeft;
});

menuContainer.addEventListener('mouseleave', () => {
    isDown = false;
    menuContainer.classList.remove('active');
});

menuContainer.addEventListener('mouseup', () => {
    isDown = false;
    menuContainer.classList.remove('active');
});

menuContainer.addEventListener('mousemove', (e) => {
    if (!isDown) return; 
    e.preventDefault();
    const x = e.pageX - menuContainer.offsetLeft;
    const walk = (x - startX) * 2; 
    menuContainer.scrollLeft = scrollLeft - walk;
});
