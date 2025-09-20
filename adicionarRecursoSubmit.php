<?php
include 'classes/produto.php';
include 'classes/local.php';
include 'classes/servico.php';

$produto = new Produto();
$local = new Local();
$servico = new Servico();

$tipoRecurso = $_POST['tipoRecurso'];
if (!empty($_POST['nome']) && !empty($_POST['descricao']) && !empty($_POST['preco']) && !empty($_POST['regiao'])) {
    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];
    $preco = str_replace(['.', ','], ['', '.'], $_POST['preco']);
    $preco = floatval($preco);
    $regiao = $_POST['regiao'];
    $ativo = TRUE;
    $id_fornecedor = $_POST['id_fornecedor'];
    if ($tipoRecurso == 'produto') {
        $tipo = $_POST['tipo'];
        $quantidade = $_POST['quantidade'];
        $resultado = $produto->criar($nome, $descricao, $preco, $regiao, $ativo, $id_fornecedor, $tipo, $quantidade);
    } elseif ($tipoRecurso == 'local') {
        $endereco = $_POST['endereco'];
        $capacidade = $_POST['capacidade'];
        $resultado = $local->criar($nome, $descricao, $preco, $regiao, $ativo, $id_fornecedor, $endereco, $capacidade);
    } elseif ($tipoRecurso == 'servico') {
        $duracao = $_POST['duracao'];
        $categoria = $_POST['categoria'];
        $resultado = $servico->criar($nome, $descricao, $preco, $regiao, $ativo, $id_fornecedor, $duracao, $categoria);
    }
    var_dump($resultado);
    // echo "<script>alert('Produto adicionado com sucesso!'); window.history.go(-2);</script>";
} else {
    echo "<script>alert('Preencha todos os campos obrigatórios!'); window.history.back();</script>";
}
