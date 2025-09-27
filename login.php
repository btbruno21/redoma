<?php include 'inc/header.php'; ?>
<main>
    <form method="POST" action="actions/loginSubmit.php">
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