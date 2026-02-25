document.addEventListener('DOMContentLoaded', function() {
    const regiaoSelect = document.getElementById('id_regiao');
    const localSelect = document.getElementById('local');

    regiaoSelect.addEventListener('change', function() {
        const idRegiao = this.value;

        localSelect.innerHTML = '<option value="">Carregando...</option>';
        localSelect.disabled = true;

        if (!idRegiao) {
            localSelect.innerHTML = '<option value="">Primeiro, selecione uma região</option>';
            return;
        }

        // Faz a chamada para a nossa API
        fetch(`actions/buscarLocais.php?id_regiao=${idRegiao}`)
            .then(response => response.json())
            .then(data => {
                localSelect.innerHTML = '<option value="">Selecione um local</option>';

                data.forEach(local => {
                    const option = document.createElement('option');
                    option.value = local.nome;
                    option.textContent = local.nome;
                    localSelect.appendChild(option);
                });

                // Adiciona a opção "Já tenho um local" no final da lista
                const outraOpcao = document.createElement('option');
                outraOpcao.value = 'outro_local';
                outraOpcao.textContent = 'Já tenho um local / Informar depois';
                localSelect.appendChild(outraOpcao);

                localSelect.disabled = false;
            })
            .catch(error => {
                console.error('Erro ao buscar locais:', error);
                localSelect.innerHTML = '<option value="">Erro ao carregar</option>';
            });
    });
});