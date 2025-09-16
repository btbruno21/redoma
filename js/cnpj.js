const cnpjInput = document.getElementById('cnpj');

cnpjInput.addEventListener('input', function() {
    let value = this.value.replace(/\D/g, ''); // remove tudo que não é número

    if (value.length > 14) value = value.slice(0, 14); // limita a 14 dígitos

    // aplica máscara
    if (value.length > 12) {
        value = value.replace(/^(\d{2})(\d{3})(\d{3})(\d{4})(\d{1,2})/, '$1.$2.$3/$4-$5');
    } else if (value.length > 8) {
        value = value.replace(/^(\d{2})(\d{3})(\d{3})(\d{1,4})/, '$1.$2.$3/$4');
    } else if (value.length > 5) {
        value = value.replace(/^(\d{2})(\d{3})(\d{1,3})/, '$1.$2.$3');
    } else if (value.length > 2) {
        value = value.replace(/^(\d{2})(\d{1,3})/, '$1.$2');
    }

    this.value = value;
});

// Previne colar conteúdo não numérico
cnpjInput.addEventListener('paste', function(e) {
    setTimeout(() => {
        this.dispatchEvent(new Event('input'));
    }, 0);
});