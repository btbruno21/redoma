<?php
session_start();
if (!isset($_SESSION['id']) || !in_array($_SESSION['tipo_usuario'], ['admin', 'fornecedor'])) {
    header('Location: ../login');
    exit();
}

include '../classes/produto.php';
$produto = new Produto();

if (!empty($_POST['id'])) {
    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];
    $preco = $_POST['preco'];
    $regiao = $_POST['id_regiao'];
    $ativo = $_POST['ativo'];
    $tipo = $_POST['tipo'];
    $quantidade = $_POST['quantidade'];

    $resultado = $produto->editarProduto($id, $nome, $descricao, $preco, $regiao, $ativo, $tipo, $quantidade);

    if ($resultado === TRUE) {
        echo "<script>alert('Produto alterado com sucesso!'); window.location.href = '../dashboard';</script>";
    } else {
        echo "<script>alert('Erro ao alterar o produto. Tente novamente.'); window.history.back();</script>";
    }
} else {
    header('Location: ../dashboard');
    exit();
}
?>