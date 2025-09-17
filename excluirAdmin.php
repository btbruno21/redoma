<?php
include 'classes/adm.php';
$admin = new Admin();

if (!empty($_GET['id'])) {
    $id = $_GET['id'];
    $admin->deletar($id);
    echo "<script>alert('Administrador excluido!!'); window.history.go(-1);</script>";
} else {
    echo '<script type="text/javascript">alert("Erro ao excluir!!");</script>';
}
?>