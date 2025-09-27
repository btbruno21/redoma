<?php
include '../classes/fornecedor.php';

$fornecedor = new Fornecedor();
if (!empty($_POST['id'])) {
    $email = $_POST['email'];
    $nome_fantasia = $_POST['nome_fantasia'];
    $cnpj = str_replace(['.', '/', '-'], '', $_POST['cnpj']);
    $telefone = str_replace(['(', ')', '+', '-'], '', $_POST['telefone']);

    $id = $_POST['id'];

    $resultado = $fornecedor->editar($nome_fantasia, $cnpj, $telefone, $email, $id);
}

if ($resultado === TRUE) {
    echo "<script>alert('Alteração realizada com sucesso!'); window.history.go(-2);</script>";
}