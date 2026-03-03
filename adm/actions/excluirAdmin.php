<?php
session_start();
if (!isset($_SESSION['id']) || $_SESSION['tipo_usuario'] !== 'admin') {
    header('Location: ../login');
    exit();
}
include '../classes/adm.php';
$admin = new Admin();

if (!empty($_GET['id'])) {
    $id = base64_decode($_GET['id']);

    $admin->deletar($id);
    echo '<script>alert("Administrador excluído com sucesso!"); window.location.href = "../index";</script>';
} else {
    echo '<script>alert("Erro ao excluir!"); window.location.href = "../index";</script>';
}
?>