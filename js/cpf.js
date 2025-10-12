document.addEventListener('DOMContentLoaded', function() {
    const cpfField = document.getElementById('cpf');
    if (cpfField) {
        const cpfMaskOptions = {
            mask: '000.000.000-00'
        };
        const mask = IMask(cpfField, cpfMaskOptions);
    }
});