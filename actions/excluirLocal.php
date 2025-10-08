<?php
session_start();
if (!isset($_SESSION['id']) || !in_array($_SESSION['tipo_usuario'], ['admin', 'fornecedor'])) {
    header('Location: ../login');
    exit();
}
include '../classes/local.php';
$loc = new Local();

if (!empty($_GET['id_serv'])) {
    $idServ = base64_decode($_GET['id_serv']);

    $loc->excluir($idServ);
    echo '<script>alert("Local excluído com sucesso!"); window.location.href = "../dashboard";</script>';
} else {
    echo '<script>alert("Erro ao excluir!"); window.location.href = "../dashboard";</script>';
}
?>