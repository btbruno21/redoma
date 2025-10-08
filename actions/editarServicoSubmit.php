<?php
// error_reporting(E_ALL);
// ini_set('display_errors', 1);
session_start();
if (!isset($_SESSION['id']) || !in_array($_SESSION['tipo_usuario'], ['admin', 'fornecedor'])) {
    header('Location: ../login');
    exit();
}
include '../classes/servico.php';

$servico = new Servico();

if (!empty($_POST['id'])) {
    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];
    $preco = $_POST['preco'];
    $regiao = $_POST['regiao'];
    $ativo = $_POST['ativo'];
    $duracao = $_POST['duracao'];
    $categoria = $_POST['categoria'];

    $resultado = $servico->editarServico($id, $nome, $descricao, $preco, $regiao, $ativo, $duracao, $categoria);

    if ($resultado === TRUE) {
        echo "<script>alert('Serviço alterado com sucesso!'); window.location.href = '../dashboard';</script>";
    } else {
        echo "<script>alert('Erro ao alterar o serviço. Tente novamente.'); window.history.back();</script>";
    }
} else {
    header('Location: ../dashboard');
    exit();
}
?>