<?php
// error_reporting(E_ALL);
// ini_set('display_errors', 1);
include '../classes/cliente.php';
include '../classes/evento.php';

$cliente = new Cliente();
$evento = new Evento();

$id = null;

if (isset($_POST['usar_dados_cadastrados']) && $_POST['usar_dados_cadastrados'] == 'on') {
    if (!empty($_POST['cpf'])) {
        $cpf = preg_replace('/[^0-9]/', '', $_POST['cpf']);
        $id = $cliente->buscarPeloCpf($cpf);

        if ($id === false) {
            echo "<script>alert('⚠ CPF não encontrado em nosso cadastro. Verifique o número ou cadastre-se como um novo cliente.'); window.history.back();</script>";
            exit();
        }
    } else {
        echo "<script>alert('⚠ O campo CPF é obrigatório quando a opção de usar dados cadastrados está marcada.'); window.history.back();</script>";
        exit();
    }
}
else {
    if (!empty($_POST['nome']) && !empty($_POST['telefone']) && !empty($_POST['email'])) {
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $telefone = str_replace(['(', ')', '+', '-'], '', $_POST['telefone']);

        $id = $cliente->adicionarCliente($nome, $telefone, $email);
    }
}
if (
    $id &&
    !empty($_POST['nivel_planejamento']) &&
    !empty($_POST['tipo_evento']) &&
    (
        ($_POST['tipo_evento'] === 'sociais' && !empty($_POST['evento-social'])) ||
        ($_POST['tipo_evento'] === 'corporativos' && !empty($_POST['evento-corporativo']))
    ) &&
    !empty($_POST['data1']) &&
    !empty($_POST['data2']) &&
    !empty($_POST['id_regiao']) &&
    !empty($_POST['local']) &&
    isset($_POST['preco-min']) &&
    isset($_POST['preco-max']) &&
    !empty($_POST['qnt_pessoas'])
) {
    $nivel_planejamento = $_POST['nivel_planejamento'];
    $tipo_evento = $_POST['tipo_evento'];

    if ($tipo_evento === 'sociais' && !empty($_POST['evento-social'])) {
        $tipo_evento = $_POST['evento-social'];
    } elseif ($tipo_evento === 'corporativos' && !empty($_POST['evento-corporativo'])) {
        $tipo_evento = $_POST['evento-corporativo'];
    }

    $data1 = $_POST['data1'];
    $data2 = $_POST['data2'];
    $id_regiao = $_POST['id_regiao'];
    $local = $_POST['local'];

    if ($local === 'outro_local') {
        $local = NULL;
    }

    $orcamento_min = $_POST['preco-min'];
    $orcamento_max = $_POST['preco-max'];
    $orcamento = "R$ " . number_format($orcamento_min, 2, ',', '.') . " - R$ " . number_format($orcamento_max, 2, ',', '.');

    $qnt_pessoas = $_POST['qnt_pessoas'];
    $observacoes = $_POST['observacoes'] ?? null;

    $evento->criarEvento($nivel_planejamento, $tipo_evento, $data1, $data2, $local, $orcamento, $qnt_pessoas, $observacoes, $id, $id_regiao);

    echo "<script>alert('✅ Orçamento solicitado com sucesso!'); window.location.href = '/redoma';</script>";
} else {
    echo "<script>alert('⚠ Por favor, preencha todos os campos obrigatórios!'); window.history.back();</script>";
}