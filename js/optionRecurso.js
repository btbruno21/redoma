const tipoRecurso = document.getElementById('tipoRecurso');
const camposServico = document.getElementById('camposServico');
const camposProduto = document.getElementById('camposProduto');
const camposLocal = document.getElementById('camposLocal');

// Função para esconder todos os campos
function esconderCampos() {
    camposServico.style.display = 'none';
    camposProduto.style.display = 'none';
    camposLocal.style.display = 'none';
}

// Mostra campos baseado na seleção
tipoRecurso.addEventListener('change', function () {
    esconderCampos();

    if (this.value === 'servico') {
        camposServico.style.display = 'block';
    } else if (this.value === 'produto') {
        camposProduto.style.display = 'block';
    } else if (this.value === 'local') {
        camposLocal.style.display = 'block';
    }
});

// Garantir que o campo correto esteja visível antes do submit
const form = document.querySelector('form');
form.addEventListener('submit', () => {
    if (tipoRecurso.value === 'produto') camposProduto.style.display = 'block';
    if (tipoRecurso.value === 'servico') camposServico.style.display = 'block';
    if (tipoRecurso.value === 'local') camposLocal.style.display = 'block';
});
