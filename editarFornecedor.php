<?php
session_start();
if (!isset($_SESSION['id']) || $_SESSION['tipo'] !== 'admin') {
    header('Location: login.php');
    exit();
}
require 'inc/header.php';
include 'classes/fornecedor.php';
$fornecedor = new Fornecedor();

if (!empty($_GET['id'])) {
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

<main>
    <form method="POST" action="actions/editarFornecedorSubmit.php">
        <div class="cadUser">
            <h1>Editar Fornecedor</h1>
            <div class="cad2">
                <input type="hidden" name="id_user" value="<?php echo $_SESSION['id']; ?>" />
                <input type="hidden" name="id" value="<?php echo $info['id']; ?>" />
                <div class="input-container">
                    <input type="mail" name="email" value="<?php echo $info['email']; ?>" placeholder=" " required>
                    <label for="email" class="input-label">Email</label>
                </div>
                <div class="input-container">
                    <input type="text" name="nome_fantasia" value="<?php echo $info['nome_fantasia']; ?>" placeholder=" " required>
                    <label class="input-label">Nome Fantasia</label>
                </div>
                <div class="input-container">
                    <input type="text" name="cnpj" id="cnpj" value="<?php echo $info['cnpj']; ?>" placeholder=" " required>
                    <label class="input-label">CNPJ</label>
                </div>
                <div class="input-container">
                    <input type="text" id="telefone" name="telefone" value="<?php echo $info['telefone']; ?>" placeholder=" " required>
                    <label for="telefone" class="input-label">Telefone</label>
                </div>
            </div>
            <button type="submit">SALVAR</button>
        </div>
    </form>
</main>
<script src="js/telefoneSubmit.js"></script>

<?php include 'inc/footer.php'; ?>