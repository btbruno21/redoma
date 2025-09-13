<?php
require_once 'classes/conexao.php';
$con = new Conexao();
$con->conectar();

echo password_hash("1234", PASSWORD_DEFAULT);

?>