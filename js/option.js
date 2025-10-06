document.addEventListener('DOMContentLoaded', function() {
    // --- Variáveis que você já tinha ---
    const tipoPerfil = document.getElementById('tipoPerfil');
    const camposUsuario = document.getElementById('camposUsuario');
    const camposAdmin = document.getElementById('camposAdmin');
    const form = document.querySelector('form'); // Adicionamos a referência ao formulário

    // --- Função para adicionar/remover 'required' ---
    // Esta função ajuda a não repetir código.
    function setRequired(element, isRequired) {
        const inputs = element.querySelectorAll('input[type="text"]'); // Pega apenas inputs de texto
        inputs.forEach(input => {
            input.required = isRequired;
        });
    }

    // --- Lógica para mostrar/esconder campos (seu código, melhorado) ---
    tipoPerfil.addEventListener('change', function () {
        const selectedValue = this.value;

        if (selectedValue === 'fornecedor') {
            camposUsuario.style.display = 'block';
            camposAdmin.style.display = 'none';

            // Torna os campos de fornecedor obrigatórios
            setRequired(camposUsuario, true);
            setRequired(camposAdmin, false);

        } else if (selectedValue === 'admin') {
            camposAdmin.style.display = 'block';
            camposUsuario.style.display = 'none';
            
            // Torna o campo de nome do admin obrigatório
            setRequired(camposAdmin, true);
            setRequired(camposUsuario, false);

        } else {
            camposUsuario.style.display = 'none';
            camposAdmin.style.display = 'none';

            // Remove a obrigatoriedade de todos
            setRequired(camposUsuario, false);
            setRequired(camposAdmin, false);
        }
    });

    // --- Lógica para validar permissões antes de enviar ---
    form.addEventListener('submit', function(event) {
        // Se o perfil for 'admin'
        if (tipoPerfil.value === 'admin') {
            // Conta quantas permissões foram marcadas
            const permissoesMarcadas = document.querySelectorAll('input[name="permissoes[]"]:checked').length;
            
            // Se nenhuma foi marcada, impede o envio e avisa o usuário
            if (permissoesMarcadas === 0) {
                alert('Por favor, selecione pelo menos uma permissão para o administrador.');
                event.preventDefault(); // Cancela o envio do formulário
            }
        }
    });

    // Para garantir que o estado inicial esteja correto ao carregar a página
    tipoPerfil.dispatchEvent(new Event('change'));
});