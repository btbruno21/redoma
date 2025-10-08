<?php
session_start();
if (!isset($_SESSION['id']) || !in_array($_SESSION['tipo_usuario'], ['admin', 'fornecedor'])) {
    header('Location: ../login');
    exit();
}
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
include '../classes/servico.php';
$serv = new Servico();
if (!empty($_GET['id_serv'])) {
    $idServ = base64_decode($_GET['id_serv']);

    $serv->excluir($idServ);
    echo '<script>alert("Serviço excluído com sucesso!"); window.location.href = "../dashboard";</script>';
} else {
    echo '<script>alert("Erro ao excluir!"); window.location.href = "../dashboard";</script>';
}
