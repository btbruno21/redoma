<?php
session_start();
if (!isset($_SESSION['id']) || $_SESSION['tipo_usuario'] !== 'admin') {
    header('Location: ../login');
    exit();
}
include '../classes/regiao.php';

$regiao = new Regiao();
$regiao->editarRegiao(base64_decode($_POST['id']), $_POST['nome']);

header('Location: ../dashboard');