<?php include 'inc/header.php'; ?>
<main>
    <form method="POST" action="actions/adicionarRecursoSubmit.php">
        <div class="cadUser">
            <div class="input-container">
                <select id="tipoRecurso" name="tipoRecurso" required>
                    <option value="">Selecione o tipo de recurso</option>
                    <option value="local">Local</option>
                    <option value="produto">Produto</option>
                    <option value="servico">Serviço</option>
                </select>
            </div>
            <div id="cad">
                <div class="input-container">
                    <input type="text" name="nome" placeholder=" " required>
                    <label for="nome" class="input-label">Nome</label>
                </div>
                <div class="input-container">
                    <input type="text" name="descricao" placeholder=" " required>
                    <label for="descricao" class="input-label">Descrição</label>
                </div>
                <div class="input-container">
                    <input type="text" id="numero" name="preco" placeholder=" " required>
                    <label for="preco" class="input-label">Preço</label>
                </div>
                <div class="input-container">
                    <input type="text" name="regiao" placeholder=" " required>
                    <label for="regiao" class="input-label">Região</label>
                </div>
                <input type="hidden" name="id_fornecedor" value="<?php echo $_GET['id']; ?>">

                <div id="camposServico" style="display: none;">
                    <div class="input-container">
                        <input type="text" name="duracao" placeholder=" ">
                        <label for="duracao" class="input-label">Duração</label>
                    </div>
                    <div class="input-container">
                        <input type="text" name="categoria" placeholder=" ">
                        <label for="categoria" class="input-label">Categoria</label>
                    </div>
                </div>

                <div id="camposProduto" style="display: none;">
                    <div class="input-container">
                        <input type="text" name="tipo" placeholder=" ">
                        <label for="tipo" class="input-label">Tipo</label>
                    </div>
                    <div class="input-container">
                        <input type="number" name="quantidade" placeholder=" ">
                        <label for="quantidade" class="input-label">Quantidade</label>
                    </div>
                </div>

                <div id="camposLocal" style="display: none;">
                    <div class="input-container">
                        <input type="text" name="endereco" placeholder=" ">
                        <label for="endereco" class="input-label">Endereço</label>
                    </div>
                    <div class="input-container">
                        <input type="number" name="capacidade" placeholder=" ">
                        <label for="capacidade" class="input-label">Capacidade</label>
                    </div>
                </div>
            </div>
            <button type="submit">Cadastrar</button>
        </div>
    </form>
</main>

<script src="js/optionRecurso.js"></script>
<script src="js/preco.js"></script>

<?php include 'inc/footer.php'; ?>