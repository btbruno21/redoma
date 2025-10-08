<?php
session_start();
if (!isset($_SESSION['id']) || !in_array($_SESSION['tipo_usuario'], ['admin', 'fornecedor'])) {
    header('Location: ../login');
    exit();
}

include '../classes/local.php';
$local = new Local();

if (!empty($_POST['id'])) {
    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];
    $preco = $_POST['preco'];
    $regiao = $_POST['regiao'];
    $ativo = $_POST['ativo'];
    $endereco = $_POST['endereco'];
    $capacidade = $_POST['capacidade'];

    // Chama o método para editar o local
    $resultado = $local->editarLocal($id, $nome, $descricao, $preco, $regiao, $ativo, $endereco, $capacidade);

    // Verifica o resultado e mostra a mensagem apropriada
    if ($resultado === TRUE) {
        echo "<script>alert('Local alterado com sucesso!'); window.location.href = '../dashboard';</script>";
    } else {
        echo "<script>alert('Erro ao alterar o local. Tente novamente.'); window.history.back();</script>";
    }
} else {
    // Redireciona se o acesso for direto ao arquivo, sem dados
    header('Location: ../dashboard');
    exit();
}
?>