<?php
session_start();
if (!isset($_SESSION['id']) || $_SESSION['tipo_usuario'] !== 'admin') {
    header('Location: ../login');
    exit();
}
// error_reporting(E_ALL);
// ini_set('display_errors', 1);
include '../classes/fornecedor.php';
include '../classes/adm.php';
$fornecedor = new Fornecedor();
$admin = new Admin();
if (!empty($_POST['email']) && !empty($_POST['senha']) && !empty($_POST['id'])) {
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $id = $_POST['id'];

    if ($_POST['tipoPerfil'] == 'fornecedor') {
        $nome_fantasia = $_POST['nome_fantasia'];
        $cnpj = str_replace(['.', '/', '-'], '', $_POST['cnpj']);
        $telefone = str_replace(['(', ')', '+', '-'], '', $_POST['telefone']);
        $tipo_usuario = $_POST['tipoPerfil'];

        $resultado = $fornecedor->adicionar($email, $nome_fantasia, $cnpj, $telefone, $senha, $tipo_usuario);
    } elseif ($_POST['tipoPerfil'] == 'admin') {
        $nome = $_POST['nome'];
        $permissoes = !empty($_POST['permissoes']) ? implode(',', $_POST['permissoes']) : '';
        $tipo_usuario = $_POST['tipoPerfil'];

        $resultado = $admin->adicionar($email, $nome, $permissoes, $senha, $tipo_usuario);
    } else {
        echo "<script>alert('Selecione um tipo de perfil válido!'); window.history.back();</script>";
        exit;
    }

    if ($resultado === TRUE) {
        header("Location: ../dashboard");
    } elseif ($resultado === FALSE) {
        echo "<script>alert('O email informado já está cadastrado!'); window.history.back();</script>";
    } else {
        echo "<script>alert('$resultado'); window.history.back();</script>";
    }
} else {
    echo "<script>alert('Preencha todos os campos obrigatórios!'); window.history.back();</script>";
}
