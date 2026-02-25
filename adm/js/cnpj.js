document.addEventListener('DOMContentLoaded', function() {
    const cnpjInput = document.getElementById('cnpj');

    function formatCNPJ(value) {
        value = value.replace(/\D/g, ''); // só números
        if (value.length > 14) value = value.slice(0, 14);
        value = value.replace(/^(\d{2})(\d)/, '$1.$2');
        value = value.replace(/^(\d{2})\.(\d{3})(\d)/, '$1.$2.$3');
        value = value.replace(/\.(\d{3})(\d)/, '.$1/$2');
        value = value.replace(/(\d{4})(\d{1,2})$/, '$1-$2');
        return value;
    }

    // Aplica máscara no valor carregado
    cnpjInput.value = formatCNPJ(cnpjInput.value);

    // Aplica máscara enquanto digita
    cnpjInput.addEventListener('input', function() {
        this.value = formatCNPJ(this.value);
    });

    // Previne colar conteúdo não numérico
    cnpjInput.addEventListener('paste', function(e) {
        setTimeout(() => {
            this.value = formatCNPJ(this.value);
        }, 0);
    });
});