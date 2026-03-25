<?php
session_start();
if (!isset($_SESSION['id']) || $_SESSION['tipo_usuario'] !== 'admin') {
    header('Location: ../login');
    exit();
}
include '../classes/produto.php';
$prod = new Produto();

if (!empty($_GET['id_serv'])) {
    $idServ = base64_decode($_GET['id_serv']);

    $prod->excluir($idServ);
    echo '<script>alert("Produto excluído com sucesso!"); window.location.href = "../index.php";</script>';
} else {
    echo '<script>alert("Erro ao excluir!"); window.location.href = "../index.php";</script>';
}
?>