<?php
include 'inc/header.php';
include 'classes/usuario.php';
include 'classes/fornecedor.php';
include 'classes/adm.php';

$usuario = new Usuario();
$tipo = $usuario->getTipoPorId($_GET['id']);

if ($tipo === 'fornecedor') {
    $fornecedor = new Fornecedor();
    $info = $fornecedor->buscar($_GET['id']);
    $name = $info['nome_fantasia'];
} elseif ($tipo === 'admin') {
    $adm = new Admin();
    $info = $adm->buscar($_GET['id']);
    $name = $info['nome'];
}
?>
<main>
    <div class="dashboard">
        <h1>Bem-vindo <?php echo $name;?></h1>
        <?php if ($tipo === 'admin'): ?>
            <a href="cadastroUser.php">Cadastro de Usuários</a>
        <?php elseif ($tipo === 'fornecedor'): ?>
        <?php else: ?>
        <?php endif; ?>
    </div>
</main>
<?php include 'inc/footer.php'; ?>