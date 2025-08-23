<?php
include 'classes/cliente.php';
$cliente = new Cliente();

if ($_POST['nome'] && $_POST['telefone'] && $_POST['email']) {
    $nome = $_POST['nome'];
    $email = $_POST['email'];

    $telefone = str_replace(['(', ')', '+', '-'], '', $_POST['telefone']);

    $cliente->adicionarCliente($nome, $telefone, $email, $cpf);
    echo "<script>alert('✅ Cliente cadastrado com sucesso!');
                window.location.href = 'index.php'; </script>";
} else {
    echo "<script>alert('⚠ Insira todas as informações!');</script>";
}
