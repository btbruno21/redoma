<?php
session_start();
if (!isset($_SESSION['id']) || $_SESSION['tipo_usuario'] !== 'admin') {
    header('Location: ../login');
    exit();
}
include '../classes/fornecedor.php';
$fornecedor = new Fornecedor();

if (!empty($_GET['id'])) {
    $id = base64_decode($_GET['id']);

    $fornecedor->deletar($id);
    echo '<script>alert("Fornecedor excluído com sucesso!"); window.location.href = "../index";</script>';
} else {
    echo '<script>alert("Erro ao excluir!"); window.location.href = "../index";</script>';
}
?>