document.addEventListener('DOMContentLoaded', function() {
    const tipoRecurso = document.getElementById('tipoRecurso');
    const camposServico = document.getElementById('camposServico');
    const camposProduto = document.getElementById('camposProduto');
    const camposLocal = document.getElementById('camposLocal');
    const form = document.querySelector('form');

    // Função para definir quais campos são obrigatórios
    function setRequired(element, isRequired) {
        // Encontra todos os inputs e selects que podem ser obrigatórios dentro do elemento
        const fields = element.querySelectorAll('input, select, textarea');
        fields.forEach(field => {
            // Adiciona ou remove o atributo 'required'
            field.required = isRequired;
        });
    }

    // Mostra/esconde campos e gerencia o 'required'
    tipoRecurso.addEventListener('change', function () {
        // Primeiro, esconde todos e remove a obrigatoriedade de todos
        camposServico.style.display = 'none';
        setRequired(camposServico, false);

        camposProduto.style.display = 'none';
        setRequired(camposProduto, false);

        camposLocal.style.display = 'none';
        setRequired(camposLocal, false);

        // Agora, mostra o campo selecionado e o torna obrigatório
        if (this.value === 'servico') {
            camposServico.style.display = 'block';
            setRequired(camposServico, true);
        } else if (this.value === 'produto') {
            camposProduto.style.display = 'block';
            setRequired(camposProduto, true);
        } else if (this.value === 'local') {
            camposLocal.style.display = 'block';
            setRequired(camposLocal, true);
        }
    });

    // Dispara o evento na carga da página para ajustar o estado inicial
    tipoRecurso.dispatchEvent(new Event('change'));
});