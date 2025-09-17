<?php
include 'classes/adm.php';

$admin = new Admin();
if (!empty($_POST['id'])) {
    $email = $_POST['email'];
    $nome = $_POST['nome'];
    $permissoes = !empty($_POST['permissoes'])? implode(',', $_POST['permissoes']): '';

    $id = $_POST['id'];

    $resultado = $admin->editar($nome, $permissoes, $email, $id);
}

if ($resultado === TRUE) {
    echo "<script>alert('Alteração realizada com sucesso!'); window.history.go(-2);</script>";
}