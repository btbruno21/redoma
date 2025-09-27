<?php
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
include '../classes/servico.php';
$serv = new Servico();

if (!empty($_GET['id'])) {
    $id = $_GET['id'];
    $idServ = $_GET['id_serv'];

    $serv->excluir($idServ);
    header("Location: ../dashboard.php?id=" . base64_encode($id));
} else {
    echo '<script type="text/javascript">alert("Erro ao excluir!!");</script>';
}
?>