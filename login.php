<?php include 'inc/header.php';
include 'classes/usuario.php';
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!empty($_POST['email']) && !empty($_POST['senha'])) {
        $email = $_POST['email'];
        $senha = $_POST['senha'];

        $usuario = new Usuario();
        $dadosUsuario = $usuario->login($email, $senha);
        if ($dadosUsuario) {
            $_SESSION['id'] = $dadosUsuario['id'];
            $_SESSION['tipo_usuario'] = $dadosUsuario['tipo_usuario'];
            // $_SESSION['id'] = $dadosUsuario['id'];

            header('Location: dashboard');
            exit();
        } else {
            echo "<script>alert('Email ou senha incorretos');</script>";
        }
    } else {
        echo "<script>alert('Preencha todos os campos');</script>";
    }
}
?>
<main>
    <form method="POST">
        <div class="login">
            <h1>Login</h1>
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
            <a href="#">Esqueceu sua senha?</a>
            <button type="submit">Entrar</button>
        </div>
    </form>
</main>

<script src="js/senha.js"></script>
<?php include 'inc/footer.php'; ?>