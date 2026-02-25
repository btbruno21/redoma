function toggleDadosCadastrados() {
    // Pega os elementos do DOM
    const checkbox = document.getElementById('usar-dados-cadastrados');
    const dadosNovos = document.getElementById('dados-novos');
    const dadosCadastrados = document.getElementById('dados-cadastrados');

    // Pega os inputs para gerenciar o 'required'
    const nomeInput = document.getElementById('nome');
    const telefoneInput = document.getElementById('telefone');
    const emailInput = document.getElementById('email');
    const cpfInput = document.getElementById('cpf');

    if (checkbox.checked) {
        // Se o checkbox estiver marcado: mostra CPF, esconde os outros
        dadosNovos.style.display = 'none';
        dadosCadastrados.style.display = 'block';

        // Torna o CPF obrigatório e os outros não
        cpfInput.required = true;
        nomeInput.required = false;
        telefoneInput.required = false;
        emailInput.required = false;

    } else {
        // Se o checkbox não estiver marcado: esconde CPF, mostra os outros
        dadosNovos.style.display = 'block';
        dadosCadastrados.style.display = 'none';

        // Torna os campos de novo usuário obrigatórios e o CPF não
        cpfInput.required = false;
        nomeInput.required = true;
        telefoneInput.required = true;
        emailInput.required = true;
    }
}