<?php
session_start();
if (!isset($_SESSION['id']) || $_SESSION['tipo_usuario'] !== 'admin') {
    header('Location: ../login');
    exit();
}
include '../classes/adm.php';

$admin = new Admin();
if (!empty($_POST['id'])) {
    $email = $_POST['email'];
    $nome = $_POST['nome'];
    $permissoes = !empty($_POST['permissoes'])? implode(',', $_POST['permissoes']): '';

    $id = $_POST['id'];
    $id_user = $_POST['id_user'];

    $resultado = $admin->editar($nome, $permissoes, $email, $id);
}

if ($resultado === TRUE) {
    echo "<script>alert('Alteração realizada com sucesso!'); window.location.href = '../dashboard';</script>";
}