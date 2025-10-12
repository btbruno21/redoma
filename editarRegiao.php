<?php
session_start();
if (!isset($_SESSION['id']) || $_SESSION['tipo_usuario'] !== 'admin') {
    header('Location: ../login');
    exit();
}

include 'inc/header.php';
include 'classes/regiao.php';

$regiao = new Regiao();
$listaDeRegioes = $regiao->buscarRegiao(base64_decode($_GET['id']));
?>

<main>
    <form method="POST" action="actions/editarRegiaoSubmit.php">
        <div class="cadUser">
            <h1>Editar Região</h1>
            <div class="cad2">
                <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
                <div class="input-container">
                    <input type="text" name="nome" value="<?php echo $listaDeRegioes['nome']; ?>" placeholder=" " required>
                    <label for="nome" class="input-label">Nome da Região</label>
                </div>
            </div>
            <button type="submit">Editar Região</button>
        </div>
    </form>
</main>

<?php include 'inc/footer.php'; ?>