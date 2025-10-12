<?php
session_start();
// Apenas administradores podem gerenciar regiões
if (!isset($_SESSION['id']) || $_SESSION['tipo_usuario'] !== 'admin') {
    header('Location: login.php');
    exit();
}

include 'inc/header.php';
?>

<main>
    <form method="POST" action="actions/adicionarRegiaoSubmit.php">
        <div class="cadUser">
            <h1>Adicionar Nova Região</h1>
            <div class="cad2">
                <div class="input-container">
                    <input type="text" name="nome" placeholder=" " required>
                    <label for="nome" class="input-label">Nome da Região</label>
                </div>
            </div>
            <button type="submit">Cadastrar Região</button>
        </div>
    </form>
</main>

<?php include 'inc/footer.php'; ?>