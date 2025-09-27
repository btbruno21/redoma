<?php include 'inc/header.php';
include 'classes/produto.php';
$produto = new Produto();

?>

<main>
    <div class="container">
        <h1>Editar Produto</h1>
        <form method="post">
            <label for="nome">Nome:</label>
            <input type="text" name="nome" id="nome" value="<?php echo $info['nome']; ?>" required>

            <label for="descricao">Descrição:</label>
            <input type="text" name="descricao" id="descricao" value="<?php $info['descricao']; ?>" required>

            <label for="preco">Preço:</label>
            <input type="number" name="preco" id="preco" value="<?php $info['preco']; ?>" required>

            <label for="regiao">Região:</label>
            <input type="text" name="regiao" id="regiao" value="<?php $info['regiao']; ?>" required>

            <label for="ativo">Ativo:</label>
            

            <label for="tipo">Tipo:</label>
            <input type="text" name="tipo" id="tipo" value="<?php $info['tipo']; ?>" required>

            <label for="quantidade">Quantidade:</label>
            <input type="number" name="quantidade" id="quantidade" value="<?php $info['quantidade']; ?>" required>

            <label for="id_fornecedor">ID Fornecedor:</label>
            <input type="number" name="id_fornecedor" id="id_fornecedor" value="<?php $info['id_fornecedor']; ?>" required>

            <button type="submit">Salvar Alterações</button>
            <a href="dashboard.php" class="button">Cancelar</a>
        </form>
    </div>
</main>

