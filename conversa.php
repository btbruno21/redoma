<?php
session_start();

// ===== CONFIG =====
$python = "/opt/lampp/htdocs/redoma/py/venv/bin/python";
$script = "/opt/lampp/htdocs/redoma/py/conversa.py";

// ===== RESET =====
if (isset($_POST['reset'])) {
    session_destroy();
    header("Location: chat.php");
    exit;
}

// ===== INICIALIZA =====
if (!isset($_SESSION['chat'])) {
    $_SESSION['chat'] = [];
}
if (!isset($_SESSION['encerrado'])) {
    $_SESSION['encerrado'] = false;
}

// ===== DEFINIR EVENTO =====
if (isset($_POST['evento_id'])) {

    $_SESSION['evento_id'] = $_POST['evento_id'];
    $_SESSION['chat'] = [];
    $_SESSION['encerrado'] = false;

    $evento_id = $_SESSION['evento_id'];

    $cmd = "$python $script "
        . escapeshellarg($evento_id) . " "
        . escapeshellarg("") . " "
        . escapeshellarg("[]")
        . " 2>&1";

    $output = shell_exec($cmd);

    if (!$output) {
        $output = "⚠️ Erro ao gerar pacotes.";
    }

    $_SESSION['chat'][] = [
        "role" => "ia",
        "msg" => $output
    ];
}

// ===== PEGAR EVENTO =====
$evento_id = $_SESSION['evento_id'] ?? null;

// ===== ENVIO DE MENSAGEM =====
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["mensagem"]) && $evento_id) {

    if ($_SESSION['encerrado']) {
        return;
    }

    $mensagem = trim($_POST["mensagem"]);

    if (!empty($mensagem)) {

        // detectar encerramento manual
        $msg_lower = strtolower($mensagem);
        if (strpos($msg_lower, "finalizar") !== false || strpos($msg_lower, "confirmar") !== false) {

            $_SESSION['encerrado'] = true;

            $_SESSION['chat'][] = [
                "role" => "user",
                "msg" => $mensagem
            ];

            $_SESSION['chat'][] = [
                "role" => "ia",
                "msg" => "✅ Conversa encerrada com sucesso!"
            ];

        } else {

            // salvar user
            $_SESSION['chat'][] = [
                "role" => "user",
                "msg" => $mensagem
            ];

            $historico_json = json_encode($_SESSION['chat']);

            $cmd = "$python $script "
                . escapeshellarg($evento_id) . " "
                . escapeshellarg($mensagem) . " "
                . escapeshellarg($historico_json)
                . " 2>&1";

            $output = shell_exec($cmd);

            if (!$output) {
                $output = "⚠️ Erro: resposta vazia da IA.";
            }

            // detectar encerramento via IA
            if (strpos($output, "[ENCERRAR]") !== false) {
                $_SESSION['encerrado'] = true;
                $output = str_replace("[ENCERRAR]", "", $output);
            }

            // salvar IA
            $_SESSION['chat'][] = [
                "role" => "ia",
                "msg" => $output
            ];
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Planejador de Eventos IA</title>

<style>
body {
    font-family: Arial;
    max-width: 800px;
    margin: auto;
    background: #f5f5f5;
}

h2 {
    text-align: center;
}

.chat {
    background: white;
    padding: 15px;
    height: 400px;
    overflow-y: auto;
    border-radius: 10px;
    border: 1px solid #ccc;
}

.msg {
    margin-bottom: 10px;
    padding: 10px;
    border-radius: 8px;
}

.user {
    background: #d1e7ff;
    text-align: right;
}

.ia {
    background: #e2ffe2;
    text-align: left;
}

form {
    margin-top: 10px;
    display: flex;
    gap: 10px;
}

input {
    flex: 1;
    padding: 10px;
}

button {
    padding: 10px;
    cursor: pointer;
}
</style>

</head>
<body>

<h2>Planejador de Eventos IA</h2>

<?php if (!$evento_id): ?>

<!-- SELECIONAR EVENTO -->
<form method="post">
    <input type="number" name="evento_id" placeholder="Digite o ID do evento" required>
    <button type="submit">Selecionar Evento</button>
</form>

<?php else: ?>

<p><b>Evento selecionado:</b> <?= $evento_id ?></p>

<!-- CHAT -->
<div class="chat">
<?php
foreach ($_SESSION['chat'] as $msg) {
    $classe = $msg['role'] == 'user' ? 'user' : 'ia';
    echo "<div class='msg $classe'><b>" .
         ($msg['role'] == 'user' ? 'Você' : 'IA') .
         ":</b><br>" . nl2br(htmlspecialchars($msg['msg'])) .
         "</div>";
}
?>
</div>

<?php if (!$_SESSION['encerrado']): ?>

<!-- INPUT -->
<form method="post">
    <input type="text" name="mensagem" placeholder="Digite sua mensagem..." required>
    <button type="submit">Enviar</button>
</form>

<?php else: ?>

<p style="color: green;"><b>✅ Conversa encerrada</b></p>

<?php endif; ?>

<!-- RESET -->
<form method="post">
    <button name="reset">Trocar Evento</button>
</form>

<?php endif; ?>

</body>
</html>