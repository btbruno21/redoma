<?php
session_start();
if (!isset($_SESSION['id']) || !in_array($_SESSION['tipo_usuario'], ['admin', 'fornecedor'])) {
    header('Location: login.php');
    exit();
}
include 'inc/header.php';
include 'classes/produto.php';
if (!empty($_GET['id'])) {
    $produto = new Produto();
    $id = base64_decode($_GET['id']);
    $info = $produto->buscarProduto($id);

    if ($_SESSION['tipo_usuario'] === 'fornecedor' && $info['id_fornecedor'] != $_SESSION['id']) {
        header("Location: dashboard.php");
        exit;
    }

    if ($info == false) {
        echo "<script>window.history.back();</script>";
        exit;
    };
} else {
    header("Location: dashboard.php");
    exit;
}
?>

<main>
    <form method="POST" action="actions/editarProdutoSubmit.php">
        <input type="hidden" name="id" id="id" value="<?php echo $info['id']; ?>" required>
        <div class="cadUser">
            <h1>Editar Produto</h1>
            <div class="cad2">
                <div class="input-container">
                    <input type="text" name="nome" value="<?php echo $info['nome']; ?>" placeholder=" " required>
                    <label for="nome" class="input-label">Nome</label>
                </div>
                <div class="input-container">
                    <input type="text" name="descricao" id="descricao" value="<?php echo $info['descricao']; ?>" placeholder=" " required>
                    <label for="descricao" class="input-label">Descrição</label>
                </div>
                <div class="input-container">
                    <input type="number" name="preco" id="preco" value="<?php echo $info['preco']; ?>" placeholder=" " required>
                    <label for="preco" class="input-label">Preço</label>
                </div>
                <div class="input-container">
                    <input type="text" name="regiao" id="regiao" value="<?php echo $info['regiao']; ?>" placeholder=" " required>
                    <label for="regiao" class="input-label">Região</label>
                </div>
                <div class="input-container vertical-container">
                    <label class="toggle-label">Status</label>
                    <div class="switch-field">
                        <input type="radio" id="status_publicado" name="ativo" value="1" <?php echo ($info['ativo'] == 1) ? 'checked' : ''; ?> />
                        <label for="status_publicado">Ativo</label>
                        <input type="radio" id="status_rascunho" name="ativo" value="0" <?php echo ($info['ativo'] == 0) ? 'checked' : ''; ?> />
                        <label for="status_rascunho">Inativo</label>
                    </div>
                </div>
                <div class="input-container">
                    <input type="text" name="tipo" id="tipo" value="<?php echo $info['tipo']; ?>" placeholder=" " required>
                    <label for="tipo" class="input-label">Tipo</label>
                </div>
                <div class="input-container">
                    <input type="number" name="quantidade" id="quantidade" value="<?php echo $info['quantidade']; ?>" placeholder=" " required>
                    <label for="quantidade" class="input-label">Quantidade</label>
                </div>
            </div>
            <button type="submit">Salvar Alterações</button>
        </div>
    </form>
</main>

<?php include 'inc/footer.php' ?>