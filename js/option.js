const tipoPerfil = document.getElementById('tipoPerfil');
const camposUsuario = document.getElementById('camposUsuario');
const camposAdmin = document.getElementById('camposAdmin');

tipoPerfil.addEventListener('change', function () {
    // Esconde todos os campos específicos
    camposUsuario.style.display = 'none';
    camposAdmin.style.display = 'none';

    // Mostra campos baseado na seleção
    if (this.value === 'fornecedor') {
        camposUsuario.style.display = 'block';
    } else if (this.value === 'admin') {
        camposAdmin.style.display = 'block';
    }
});