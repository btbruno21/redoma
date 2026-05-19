function showTab(event, tabName) {

    // Esconder todas as abas
    const tabContents = document.querySelectorAll('.tab-content');
    tabContents.forEach(tab => {
        tab.classList.remove('active');
    });

    // Remover active dos botões
    const tabButtons = document.querySelectorAll('.tab-button');
    tabButtons.forEach(button => {
        button.classList.remove('active');
    });

    // Mostrar aba selecionada
    document.getElementById(tabName).classList.add('active');

    // Ativar botão clicado
    event.target.classList.add('active');
}