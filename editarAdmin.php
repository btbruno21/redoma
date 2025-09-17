<?php
require 'inc/header.php';
include 'classes/adm.php';
$admin = new Admin();

if (!empty($_GET['id'])) {
    $id = $_GET['id'];
    $info = $admin->buscar($id);
    $permissoes = $info['permissoes'];
    if (empty($info['email'])) {
        header("Location: /redoma");
        exit;
    }
} else {
    header("Location: /redoma");
    exit;
}
?>
<form method="POST" action="editarAdminSubmit.php">
    <div class="cadUser">
        <div id="cad">
            <input type="hidden" name="id" value="<?php echo $info['id']; ?>" />
            <div class="input-container">
                <input type="mail" name="email" value="<?php echo $info['email']; ?>" required>
                <label for="email" class="input-label">Email</label>
            </div>
            <div class="input-container">
                <input type="text" name="nome" value="<?php echo $info['nome']; ?>" required>
                <label class="input-label">Nome</label>
            </div>
            <div class="checkbox-group">
                <label class="input-label">Permissões</label>
                <label>
                    <input type="checkbox" name="permissoes[]" value="criar" <?php if (in_array("criar", $permissoes)) echo "checked"; ?>> Criar
                </label>
                <label>
                    <input type="checkbox" name="permissoes[]" value="editar" <?php if (in_array("editar", $permissoes)) echo "checked"; ?>> Editar
                </label>
                <label>
                    <input type="checkbox" name="permissoes[]" value="excluir" <?php if (in_array("excluir", $permissoes)) echo "checked"; ?>> Excluir
                </label>
                <label>
                    <input type="checkbox" name="permissoes[]" value="super" <?php if (in_array("super", $permissoes)) echo "checked"; ?>> Super
                </label>
            </div>
        </div>
        <button type="submit">SALVAR</button>
    </div>
</form>