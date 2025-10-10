<?php
session_start();
header('Content-Type: application/json');

// Inclui a classe necessária.
require_once '../classes/agenda.php';

// Verifica se o usuário está logado.
if (!isset($_SESSION['id'])) {
    http_response_code(403); // Proibido
    echo json_encode(['erro' => 'Acesso não autorizado.']);
    exit();
}

try {
    // Pega o ID do fornecedor logado a partir da sessão.
    $id_fornecedor_logado = $_SESSION['id'];

    // Instancia a classe Agenda.
    $agenda = new Agenda();

    // Chama o método que agora retorna um array de eventos.
    $eventos = $agenda->listarEventosPorFornecedor($id_fornecedor_logado);

    // Retorna os eventos como JSON.
    // Se nenhum evento for encontrado, $eventos será um array vazio,
    // o que é o comportamento esperado pelo FullCalendar.
    echo json_encode($eventos);

} catch (Exception $e) {
    // Define o código de status HTTP para erro interno do servidor.
    http_response_code(500); 
    // Retorna uma mensagem de erro genérica em formato JSON.
    echo json_encode(['erro' => 'Falha ao processar a solicitação: ' . $e->getMessage()]);
}

?>