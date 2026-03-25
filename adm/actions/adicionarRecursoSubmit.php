<?php
session_start();
if (!isset($_SESSION['id']) || $_SESSION['tipo_usuario'] !== 'admin') {
    header('Location: ../login');
    exit();
}
include '../classes/produto.php';
include '../classes/local.php';
include '../classes/servico.php';

$produto = new Produto();
$local = new Local();
$servico = new Servico();

$tipoRecurso = $_POST['tipoRecurso'];
if (!empty($_POST['nome']) && !empty($_POST['descricao']) && !empty($_POST['preco']) && !empty($_POST['id_regiao'])) {
    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];
    $preco = str_replace(['.', ','], ['', '.'], $_POST['preco']);
    $preco = floatval($preco);
    $regiao = $_POST['id_regiao'];
    $id_fornecedor = $_POST['fornecedor'];

    if ($tipoRecurso == 'produto' && !empty($_POST['tipo']) && !empty($_POST['quantidade'])) {
        $tipo = $_POST['tipo'];
        $quantidade = $_POST['quantidade'];
        $resultado = $produto->criarProduto($nome, $descricao, $preco, $regiao, $id_fornecedor, $tipo, $quantidade);
        echo "<script>alert('Produto adicionado com sucesso!'); window.location.href = '../index.php';</script>";
        exit();

    } elseif ($tipoRecurso == 'local' && !empty($_POST['endereco']) && !empty($_POST['capacidade'])) {
        $endereco = $_POST['endereco'];
        $capacidade = $_POST['capacidade'];
        $resultado = $local->criarLocal($nome, $descricao, $preco, $regiao, $id_fornecedor, $endereco, $capacidade);
        echo "<script>alert('Local adicionado com sucesso!'); window.location.href = '../index.php';</script>";
        exit();

    } elseif ($tipoRecurso == 'servico' && !empty($_POST['duracao']) && !empty($_POST['categoria'])) {
        $duracao = $_POST['duracao'];
        $categoria = $_POST['categoria'];
        $resultado = $servico->criarServico($nome, $descricao, $preco, $regiao, $id_fornecedor, $duracao, $categoria);
        echo "<script>alert('Serviço adicionado com sucesso!'); window.location.href = '../index.php';</script>";
        exit();
        
    } else {
        echo "<script>alert('Os campos nao foram preenchidos corretamente!');</script>";
    }
} else {
    echo "<script>alert('Preencha todos os campos obrigatórios!'); window.history.back();</script>";
}
