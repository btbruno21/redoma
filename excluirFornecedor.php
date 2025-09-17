<?php
include 'classes/fornecedor.php';
$fornecedor = new Fornecedor();

if (!empty($_GET['id'])) {
    $id = $_GET['id'];
    $fornecedor->deletar($id);
    echo "<script>alert('Fornecedor excluido!!'); window.history.go(-1);</script>";
} else {
    echo '<script type="text/javascript">alert("Erro ao excluir!!");</script>';
}
?>