function mostrar(id) {
  document.querySelectorAll('section').forEach(sec => sec.classList.remove('ativa'));
  document.getElementById(id).classList.add('ativa');
}