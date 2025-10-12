<?php
session_start();
if (!isset($_SESSION['id']) || $_SESSION['tipo_usuario'] !== 'admin') {
    header('Location: ../login');
    exit();
}
include '../classes/regiao.php';

$regiao = new Regiao();
$regiao->criarRegiao($_POST['nome']);

header('Location: ../dashboard');
?>