<?php include 'inc/header.php'; ?>
<main>
    <form method="POST" action="cadastroUserSubmit.php">
        <div class="cadUser">
            <div class="input-container">
                <select id="tipoPerfil" name="tipoPerfil" required>
                    <option value="">Selecione o tipo de perfil</option>
                    <option value="fornecedor">Fornecedor</option>
                    <option value="admin">Administrador</option>
                </select>
            </div>
            <div id="cad">
                <div class="input-container">
                    <input type="mail" name="email" placeholder=" " required>
                    <label for="email" class="input-label">Email</label>
                </div>
                <div class="input-container">
                    <input type="password" name="senha" id="senhaInput" placeholder=" " required>
                    <label for="senha" class="input-label">Senha</label>
                    <img src="img/eye-slash-solid-full.svg" alt="Mostrar senha" id="eyeClosed">
                    <img src="img/eye-solid-full.svg" alt="Ocultar senha" id="eyeOpen" style="display: none;">
                </div>

                <div id="camposUsuario" class="campos-especificos" style="display: none;">
                    <div class="input-container">
                        <input type="text" name="nome_fantasia" placeholder=" ">
                        <label class="input-label">Nome Fantasia</label>
                    </div>
                    <div class="input-container">
                        <input type="text" name="cnpj" id="cnpj" placeholder=" ">
                        <label class="input-label">CNPJ</label>
                    </div>
                    <div class="input-container">
                        <input type="text" id="telefone" name="telefone" placeholder=" ">
                        <label for="telefone" class="input-label">Telefone</label>
                    </div>
                </div>

                <div id="camposAdmin" class="campos-especificos" style="display: none;">
                    <div class="input-container">
                        <input type="text" name="nome" placeholder=" ">
                        <label class="input-label">Nome</label>
                    </div>
                    <div class="input-container">
                        <div class="checkbox-group">
                            <label class="input-label">Permissões</label>
                            <label>
                                <input type="checkbox" name="permissoes[]" value="criar"> Criar
                            </label>
                            <label>
                                <input type="checkbox" name="permissoes[]" value="editar"> Editar
                            </label>
                            <label>
                                <input type="checkbox" name="permissoes[]" value="excluir"> Excluir
                            </label>
                            <label>
                                <input type="checkbox" name="permissoes[]" value="super"> Super
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <button type="submit">Cadastrar</button>
        </div>
    </form>
</main>

<script src="js/option.js"></script>
<script src="js/senha.js"></script>
<script src="https://unpkg.com/imask"></script>
<script src="js/telefone.js"></script>
<script src="js/cnpj.js"></script>

<?php include 'inc/footer.php'; ?>