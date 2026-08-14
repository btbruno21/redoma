<?php
include 'classes/cliente.php';

session_start();
if (!isset($_SESSION['id'])) {
    header('Location: /redoma/login');
} else {
    $id = $_SESSION['id'];
    $tipo = $_SESSION['tipo_usuario'];
    if ($tipo != 'cliente') {
        header('Location: /redoma/login');
    }
    $cliente = new Cliente;
    $info = $cliente->buscar($id);
    $name = $info['nome'];
    
    //var_dump($info);
    // $listar = $cliente->listar();
    // var_dump($listar);
}

include 'inc/header.php';
?>

<main>
    <div class="dashboard">
        <h1>Bem-vindo <?php echo $name; ?></h1>
        <div class="tabs">
            <button class="tab-button active">Meus eventos</button>
            <button class="tab-button">Minhas informações</button>
            <a href="actions/logout">Sair</a>
        </div>
    </div>
</main>