<?php
session_start();
if (!isset($_SESSION['id']) || $_SESSION['tipo_usuario'] !== 'admin') {
    header('Location: login.php');
    exit();
}
include 'inc/header.php';
include 'classes/regiao.php';
include 'classes/fornecedor.php';

$regiao = new Regiao();
$regioes = $regiao->listar();

$fornecedores = new Fornecedor();
$listFornecedores = $fornecedores->listarNome();
?>

<div class="container mt-4 d-flex flex-column align-items-center" data-bs-theme="dark">
    <h1 class="mb-4 w-100 text-center">Adicionar Recurso</h1>
    <div class="card" style="background-color:#1e1e1e; border-color:#2c2c2c; width:100%; max-width:650px;">
        <div class="card-body">
            <form method="POST" action="actions/adicionarRecursoSubmit.php">

                <div class="mb-3">
                    <select id="fornecedor" name="fornecedor" class="form-select" required>
                        <option value="">Selecione o Fornecedor</option>
                        <?php foreach ($listFornecedores as $item): ?>
                            <option value="<?php echo $item['id_usuario'] ?>"><?php echo $item['nome_fantasia'] ?></option>
                        <?php endforeach ?>
                    </select>
                </div>

                <div class="mb-3">
                    <select id="tipoRecurso" name="tipoRecurso" class="form-select" required>
                        <option value="">Selecione o tipo de recurso</option>
                        <option value="local">Local</option>
                        <option value="produto">Produto</option>
                        <option value="servico">Serviço</option>
                    </select>
                </div>
                <div class="mb-3">
                    <input type="text" name="nome" class="form-control" placeholder="Nome" required>
                </div>
                <div class="mb-3">
                    <textarea class="form-control" name="descricao" placeholder="Descrição"></textarea>
                </div>
                <div class="mb-3">
                    <input type="text" id="numero" name="preco" class="form-control" placeholder="Preço" required>
                </div>
                <div class="mb-3">
                    <select name="id_regiao" id="id_regiao" class="form-select" required>
                        <option value="">Selecione uma região</option>
                        <?php foreach ($regioes as $reg): ?>
                            <option value="<?php echo htmlspecialchars($reg['id']); ?>">
                                <?php echo htmlspecialchars($reg['nome']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <!-- Campos Serviço -->
                <div id="camposServico" style="display: none;">
                    <div class="mb-3">
                        <input type="text" name="duracao" class="form-control" placeholder="Duração">
                    </div>
                    <div class="mb-3">
                        <input type="text" name="categoria" class="form-control" placeholder="Categoria">
                    </div>
                </div>

                <!-- Campos Produto -->
                <div id="camposProduto" style="display: none;">
                    <div class="mb-3">
                        <input type="text" name="tipo" class="form-control" placeholder="Tipo">
                    </div>
                    <div class="mb-3">
                        <input type="number" name="quantidade" class="form-control" placeholder="Quantidade">
                    </div>
                </div>

                <!-- Campos Local -->
                <div id="camposLocal" style="display: none;">
                    <div class="mb-3">
                        <input type="text" name="endereco" class="form-control" placeholder="Endereço">
                    </div>
                    <div class="mb-3">
                        <input type="number" name="capacidade" class="form-control" placeholder="Capacidade">
                    </div>
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-primary d-block mx-auto">Cadastrar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="js/optionRecurso.js"></script>
<script src="js/preco.js"></script>

<?php include 'inc/footer.php'; ?>