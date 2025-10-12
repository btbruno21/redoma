<?php
// Define o tipo de conteúdo da resposta como JSON
header('Content-Type: application/json');

// Inclui a classe necessária
require_once '../classes/local.php';

// Verifica se o parâmetro id_regiao foi enviado
if (!isset($_GET['id_regiao']) || empty($_GET['id_regiao'])) {
    // Se não foi, retorna um array JSON vazio
    echo json_encode([]);
    exit();
}

try {
    // Pega o ID da região e converte para inteiro por segurança
    $id_regiao = (int)$_GET['id_regiao'];

    // Instancia a classe Local
    $local = new Local();

    // Chama o novo método para buscar locais pela região
    $locais = $local->listarPorRegiao($id_regiao);

    // Retorna os locais encontrados como JSON
    // Se nada for encontrado, será um array vazio, o que está correto.
    echo json_encode($locais);

} catch (Exception $e) {
    // Em caso de erro no servidor, retorna uma mensagem de erro
    http_response_code(500); 
    echo json_encode(['erro' => 'Falha ao buscar locais: ' . $e->getMessage()]);
}
?>