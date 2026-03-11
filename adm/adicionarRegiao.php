<?php
session_start();
if (!isset($_SESSION['id']) || $_SESSION['tipo_usuario'] !== 'admin') {
    header('Location: login.php');
    exit();
}
include 'inc/header.php';
?>

<div class="container mt-4 d-flex flex-column align-items-center" data-bs-theme="dark">
    <h1 class="mb-4 w-100 text-center">Adicionar Nova Região</h1>
    <div class="card" style="background-color:#1e1e1e; border-color:#2c2c2c; width:100%; max-width:650px;">
        <div class="card-body">
            <form method="POST" action="actions/adicionarRegiaoSubmit.php">
                <div class="mb-3">
                    <input type="text" name="nome" class="form-control" placeholder="Nome da Região" required>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary d-block mx-auto">Cadastrar Região</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include 'inc/footer.php'; ?>