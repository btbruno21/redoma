<?php
session_start();
if (!isset($_SESSION['id']) || $_SESSION['tipo_usuario'] !== 'admin') {
    header('Location: login.php');
    exit();
}
include 'inc/header.php';
include 'classes/produto.php';
include 'classes/regiao.php';
$regiao = new Regiao();
$regioes = $regiao->listar();
if (!empty($_GET['id'])) {
    if (!is_numeric($_GET['id'])){
        $produto = new Produto();
        $id = base64_decode($_GET['id']);
        $info = $produto->buscarProduto($id);
    }
    else {
        header("Location: index.php");
        exit;
    }
} else {
    header("Location: index.php");
    exit;
}
?>

<div class="container mt-4 d-flex flex-column align-items-center" data-bs-theme="dark">
    <h1 class="mb-4 w-100 text-center">Editar Produto</h1>
    <div class="card" style="background-color:#1e1e1e; border-color:#2c2c2c; width:100%; max-width:650px;">
        <div class="card-body">
            <form method="POST" action="actions/editarProdutoSubmit.php">
                <input type="hidden" name="id" value="<?php echo $info['id']; ?>">

                <div class="mb-3">
                    <input type="text" name="nome" class="form-control" placeholder="Nome"
                           value="<?php echo $info['nome']; ?>" required>
                </div>

                <div class="mb-3">
                    <input type="text" name="descricao" class="form-control" placeholder="Descrição"
                           value="<?php echo $info['descricao']; ?>" required>
                </div>

                <div class="mb-3">
                    <input type="number" name="preco" class="form-control" placeholder="Preço"
                           value="<?php echo $info['preco']; ?>" required>
                </div>

                <div class="mb-3">
                    <select name="id_regiao" class="form-select" required>
                        <option value="">Selecione uma região</option>
                        <?php foreach ($regioes as $reg): ?>
                            <option value="<?php echo htmlspecialchars($reg['id']); ?>"
                                <?php if ($info['id_regiao'] == $reg['id']) echo 'selected'; ?>>
                                <?php echo htmlspecialchars($reg['nome']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label text-muted">Status</label>
                    <div class="d-flex gap-3">
                        <div class="form-check">
                            <input type="radio" class="form-check-input" id="status_ativo" name="ativo" value="1"
                                   <?php echo ($info['ativo'] == 1) ? 'checked' : ''; ?>>
                            <label class="form-check-label" for="status_ativo">Ativo</label>
                        </div>
                        <div class="form-check">
                            <input type="radio" class="form-check-input" id="status_inativo" name="ativo" value="0"
                                   <?php echo ($info['ativo'] == 0) ? 'checked' : ''; ?>>
                            <label class="form-check-label" for="status_inativo">Inativo</label>
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <input type="text" name="tipo" class="form-control" placeholder="Tipo"
                           value="<?php echo $info['tipo']; ?>" required>
                </div>

                <div class="mb-3">
                    <input type="number" name="quantidade" class="form-control" placeholder="Quantidade"
                           value="<?php echo $info['quantidade']; ?>" required>
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-primary d-block mx-auto">Salvar Alterações</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include 'inc/footer.php' ?>