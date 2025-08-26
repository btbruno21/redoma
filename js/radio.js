document.querySelectorAll('input[type=radio][name="tipo_evento"]').forEach(radio => {
    radio.addEventListener('change', function () {
        // Esconde todos os blocos de radios filhos
        document.querySelectorAll('.campos-extra').forEach(div => div.style.display = 'none');
        // Mostra apenas o vinculado ao radio principal
        const target = this.getAttribute('data-target');
        document.getElementById(target).style.display = 'block';
    });
});