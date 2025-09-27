<?php
include '../classes/produto.php';
$prod = new Produto();

if (!empty($_GET['id'])) {
    $id = $_GET['id'];
    $idServ = $_GET['id_serv'];

    $prod->excluir($idServ);
    header("Location: ../dashboard.php?id=" . base64_encode($id));
} else {
    echo '<script type="text/javascript">alert("Erro ao excluir!!");</script>';
}
?>