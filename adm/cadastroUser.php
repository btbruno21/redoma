<?php 
session_start();
if (!isset($_SESSION['id']) || $_SESSION['tipo_usuario'] !== 'admin') {
    header('Location: login.php');
    exit();
}
include 'inc/header.php';
?>

<div class="container mt-4 d-flex flex-column align-items-center" data-bs-theme="dark">
    <h1 class="mb-4 w-100 text-center">Cadastro de Usuário</h1>
    
    <div class="card" style="background-color:#1e1e1e; border-color:#2c2c2c; width: 100%; max-width: 650px;">
        <div class="card-body">
            <form method="POST" action="actions/cadastroUserSubmit.php">
                <input type="hidden" name="id" value="<?php echo $_SESSION['id']; ?>">

                <div class="mb-3">
                    <select id="tipoPerfil" name="tipoPerfil" class="form-select" required>
                        <option value="">Selecione o tipo de perfil</option>
                        <option value="fornecedor">Fornecedor</option>
                        <option value="admin">Administrador</option>
                    </select>
                </div>

                <div class="mb-3">
                    <input type="email" name="email" class="form-control" placeholder="Email" required>
                </div>

                <div class="mb-3 position-relative">
                    <input type="password" name="senha" id="senhaInput" class="form-control" placeholder="Senha" required>
                    <img src="img/eye-slash-solid-full.svg" alt="Mostrar senha" id="eyeClosed"
                         style="position:absolute; right:10px; top:50%; transform:translateY(-50%); cursor:pointer; width:20px;">
                    <img src="img/eye-solid-full.svg" alt="Ocultar senha" id="eyeOpen"
                         style="display:none; position:absolute; right:10px; top:50%; transform:translateY(-50%); cursor:pointer; width:20px;">
                </div>

                <!-- Campos Fornecedor -->
                <div id="camposUsuario" class="campos-especificos" style="display: none;">
                    <div class="mb-3">
                        <input type="text" name="nome_fantasia" class="form-control" placeholder="Nome Fantasia">
                    </div>
                    <div class="mb-3">
                        <input type="text" name="cnpj" id="cnpj" class="form-control" placeholder="CNPJ">
                    </div>
                    <div class="mb-3">
                        <input type="text" id="telefone" name="telefone" class="form-control" placeholder="Telefone">
                    </div>
                </div>

                <!-- Campos Admin -->
                <div id="camposAdmin" class="campos-especificos" style="display: none;">
                    <div class="mb-3">
                        <input type="text" name="nome" class="form-control" placeholder="Nome">
                    </div>
                    <div class="mb-3">
                        <label class="form-label text-muted">Permissões</label>
                        <div class="d-flex gap-3">
                            <div class="form-check">
                                <input type="checkbox" name="permissoes[]" value="geral" class="form-check-input" id="permGeral">
                                <label class="form-check-label" for="permGeral">Geral</label>
                            </div>
                            <div class="form-check">
                                <input type="checkbox" name="permissoes[]" value="super" class="form-check-input" id="permSuper">
                                <label class="form-check-label" for="permSuper">Super</label>
                            </div>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary w-100">Cadastrar</button>
            </form>
        </div>
    </div>
</div>

<script src="js/option.js"></script>
<script src="js/senha.js"></script>
<script src="https://unpkg.com/imask"></script>
<script src="js/telefone.js"></script>
<script src="js/cnpj.js"></script>

<?php include 'inc/footer.php'; ?>