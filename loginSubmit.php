<?php
include 'classes/usuario.php';

$usuario = new Usuario();

if (!empty($_POST['email']) && !empty($_POST['senha'])) {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    if ($usuario->login($email, $senha)) {
        echo "<script>alert('✅ Login Efetuado com sucesso!'); window.location.href = 'index.php';</script>";
    } else {
        echo "<script>alert('❌ Email ou senha incorretos. Tente novamente'); window.location.href = 'index.php';</script>";
    }
}
