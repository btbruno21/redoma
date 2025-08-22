let slideIndex = 1;

function currentSlide(n) {
  showSlide(slideIndex = n);
}

function showSlide(n) {
  let slides = document.getElementsByClassName("carousel-slide");
  let dots = document.getElementsByClassName("dot");
  
  if (n > slides.length) {slideIndex = 1}
  if (n < 1) {slideIndex = slides.length}
  
  // Adiciona animação de saída
  for (let i = 0; i < slides.length; i++) {
    if (slides[i].classList.contains("active")) {
      slides[i].classList.add("fade-out");
      setTimeout(() => {
        slides[i].classList.remove("active", "fade-out");
      }, 300);
    }
  }
  
  // Atualiza dots
  for (let i = 0; i < dots.length; i++) {
    dots[i].classList.remove("active");
  }
  
  // Adiciona animação de entrada após um delay
  setTimeout(() => {
    slides[slideIndex - 1].classList.add("active", "fade-in");
    dots[slideIndex - 1].classList.add("active");
    
    // Remove a classe de animação após completar
    setTimeout(() => {
      slides[slideIndex - 1].classList.remove("fade-in");
    }, 600);
  }, 300);
}

// Auto-play simples
setInterval(function() {
  slideIndex++;
  if (slideIndex > 4) slideIndex = 1;
  showSlide(slideIndex);
}, 3000);