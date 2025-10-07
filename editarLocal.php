<?php 
session_start();
if (!isset($_SESSION['id']) || !in_array($_SESSION['tipo_usuario'], ['admin', 'fornecedor'])) {
    header('Location: login.php');
    exit();
}
include 'inc/header.php';
include 'classes/local.php';
$local = new Local();
if (!empty($_GET['id'])) {
    $id = base64_decode($_GET['id']);
    $info = $local->buscarLocal($id);
    
    // VERIFICAÇÃO DE SEGURANÇA: Fornecedor só pode editar seus próprios recursos
    if ($_SESSION['tipo'] === 'fornecedor' && $info['id_fornecedor'] != $_SESSION['id']) {
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
    <form method="POST" action="actions/editarLocalSubmit.php">
        <input type="hidden" name="id" id="id" value="<?php echo $info['id']; ?>" required>
        <div class="cadUser">
            <h1>Editar Local</h1>
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
                    <input type="text" name="endereco" id="endereco" value="<?php echo $info['endereco']; ?>" placeholder=" " required>
                    <label for="endereco" class="input-label">Endereço</label>
                </div>
                <div class="input-container">
                    <input type="number" name="capacidade" id="capacidade" value="<?php echo $info['capacidade']; ?>" placeholder=" " required>
                    <label for="capacidade" class="input-label">Capacidade</label>
                </div>
            </div>
            <button type="submit">Salvar Alterações</button>
        </div>
    </form>
</main>

<?php include 'inc/footer.php' ?>
