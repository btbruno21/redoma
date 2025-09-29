<?php
require 'inc/header.php';
include 'classes/fornecedor.php';
$fornecedor = new Fornecedor();

if (!empty($_GET['id'])) {
    $id_user = base64_decode($_GET['id_user']);
    $id = base64_decode($_GET['id']);
    $info = $fornecedor->buscar($id);
    if (empty($info['email'])) {
        header("Location: /redoma");
        exit;
    }
} else {
    header("Location: /redoma");
    exit;
}
?>
<script src="https://unpkg.com/imask"></script>
<script src="js/cnpj.js"></script>

<form method="POST" action="actions/editarFornecedorSubmit.php">
    <div class="cadUser">
        <div id="cad">
        <input type="hidden" name="id_user" value="<?php echo $id_user; ?>" />
        <input type="hidden" name="id" value="<?php echo $info['id']; ?>" />
            <div class="input-container">
                <input type="mail" name="email" value="<?php echo $info['email']; ?>" required>
                <label for="email" class="input-label">Email</label>
            </div>
            <div class="input-container">
                <input type="text" name="nome_fantasia" value="<?php echo $info['nome_fantasia']; ?>" required>
                <label class="input-label">Nome Fantasia</label>
            </div>
            <div class="input-container">
                <input type="text" name="cnpj" id="cnpj" value="<?php echo $info['cnpj']; ?>" required>
                <label class="input-label">CNPJ</label>
            </div>
            <div class="input-container">
                <input type="text" id="telefone" name="telefone" value="<?php echo $info['telefone']; ?>" required>
                <label for="telefone" class="input-label">Telefone</label>
            </div>
        </div>
    <button type="submit">SALVAR</button>
    </div>
</form>

<script src="js/telefoneSubmit.js"></script>