<?php
session_start();
include 'classes/usuario.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (!empty($_POST['email']) && !empty($_POST['senha'])) {

        $email = trim($_POST['email']);
        $senha = $_POST['senha'];

        $usuario = new Usuario();
        $dadosUsuario = $usuario->login($email, $senha);

        if ($dadosUsuario) {

            session_regenerate_id(true);

            $_SESSION['id'] = $dadosUsuario['id'];
            $_SESSION['tipo_usuario'] = $dadosUsuario['tipo_usuario'];

            header('Location: index.php');
            exit();
        }
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-dark">
    <main class="d-flex align-items-center justify-content-center vh-100" data-bs-theme="dark">

        <form method="POST" class="card p-4 shadow" style="width: 100%; max-width: 400px;">
            <h1 class="text-center mb-4">Login</h1>

            <div class="form-floating mb-3">
                <input
                    type="email"
                    class="form-control"
                    id="email"
                    name="email"
                    placeholder="name@example.com"
                    required
                >
                <label for="email">Email</label>
            </div>

            <div class="form-floating mb-4">
                <input
                    type="password"
                    class="form-control"
                    id="senhaInput"
                    name="senha"
                    placeholder="Senha"
                    required
                >
                <label for="senhaInput">Senha</label>
            </div>

            <button type="submit" class="btn btn-primary w-100">
                Entrar
            </button>
        </form>

    </main>
</body>
</html>