<?php
session_start();
if (!isset($_SESSION['id']) || $_SESSION['tipo_usuario'] !== 'admin') {
    header('Location: ../login');
    exit();
}
include '../classes/regiao.php';
$regiao = new Regiao();

if (!empty($_GET['id'])) {
    $id = base64_decode($_GET['id']);

    $regiao->excluirRegiao($id);
    echo '<script>alert("Região excluída com sucesso!"); window.location.href = "../index.php";</script>';
} else {
    echo '<script>alert("Erro ao excluir!"); window.location.href = "../index.php";</script>';
}
?>