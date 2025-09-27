<?php
include '../classes/local.php';
$loc = new Local();

if (!empty($_GET['id'])) {
    $id = $_GET['id'];
    $idServ = $_GET['id_serv'];

    $loc->excluir($idServ);
    header("Location: ../dashboard.php?id=" . base64_encode($id));
} else {
    echo '<script type="text/javascript">alert("Erro ao excluir!!");</script>';
}
?>