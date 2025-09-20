const tipoPerfil = document.getElementById('tipoPerfil');
const camposUsuario = document.getElementById('camposUsuario');
const camposAdmin = document.getElementById('camposAdmin');
tipoPerfil.addEventListener('change', function () {
    camposUsuario.style.display = 'none';
    camposAdmin.style.display = 'none';
    if (this.value === 'fornecedor') { camposUsuario.style.display = 'block'; }
    else if (this.value === 'admin') { camposAdmin.style.display = 'block'; }
});