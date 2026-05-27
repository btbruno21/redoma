document.addEventListener('DOMContentLoaded', function () {

    const regiaoSelect = document.getElementById('id_regiao');
    const localSelect = document.getElementById('local');

    regiaoSelect.addEventListener('change', function () {

        const idRegiao = this.value;

        // volta pro estado padrão
        localSelect.disabled = true;
        localSelect.innerHTML = `
            <option value="">Carregando...</option>
        `;

        // sem região
        if (!idRegiao) {

            localSelect.innerHTML = `
                <option value="">
                    Primeiro, selecione uma região
                </option>
            `;

            return;
        }

        fetch(`actions/buscarLocais.php?id_regiao=${idRegiao}`)
            .then(response => response.json())
            .then(data => {

                // limpa tudo
                localSelect.innerHTML = '';

                // NÃO TEM LOCAIS
                if (data.length === 0) {

                    localSelect.innerHTML = `
                        <option value="">
                            Nenhum local encontrado na região
                        </option>
                    `;

                    localSelect.disabled = true;

                    return;
                }

                // TEM LOCAIS
                localSelect.innerHTML = `
                    <option value="">
                        Selecione um local
                    </option>
                `;

                data.forEach(local => {

                    localSelect.innerHTML += `
                        <option value="${local.nome}">
                            ${local.nome}
                        </option>
                    `;
                });

                // opção extra
                localSelect.innerHTML += `
                    <option value="outro_local">
                        Já tenho um local / Informar depois
                    </option>
                `;

                // desbloqueia
                localSelect.disabled = false;
            })
            .catch(() => {

                localSelect.innerHTML = `
                    <option value="">
                        Erro ao carregar
                    </option>
                `;

                localSelect.disabled = true;
            });
    });
});