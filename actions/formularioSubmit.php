<?php
// error_reporting(E_ALL);
// ini_set('display_errors', 1);
include '../classes/cliente.php';
include '../classes/evento.php';

$cliente = new Cliente();
$evento = new Evento();

if (
    !empty($_POST['nome']) &&
    !empty($_POST['telefone']) &&
    !empty($_POST['email']) &&
    !empty($_POST['nivel_planejamento']) &&
    !empty($_POST['tipo_evento']) &&
    (
        ($_POST['tipo_evento'] === 'sociais' && !empty($_POST['evento-social'])) ||
        ($_POST['tipo_evento'] === 'corporativos' && !empty($_POST['evento-corporativo']))
    ) &&
    !empty($_POST['data1']) &&
    !empty($_POST['data2']) &&
    !empty($_POST['local']) &&
    isset($_POST['preco-min']) &&
    isset($_POST['preco-max']) &&
    !empty($_POST['qnt_pessoas'])
) {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $telefone = str_replace(['(', ')', '+', '-'], '', $_POST['telefone']);

    $nivel_planejamento = $_POST['nivel_planejamento'];
    $tipo_evento = $_POST['tipo_evento'];

    if ($tipo_evento === 'sociais' && !empty($_POST['evento-social'])) {
        $tipo_evento = $_POST['evento-social'];
    }
    elseif ($tipo_evento === 'corporativos' && !empty($_POST['evento-corporativo'])) {
        $tipo_evento = $_POST['evento-corporativo'];
    }

    $data1 = $_POST['data1'];
    $data2 = $_POST['data2'];
    $local = $_POST['local'];

    $orcamento_min = $_POST['preco-min'];
    $orcamento_max = $_POST['preco-max'];
    $orcamento = "R$ " . number_format($orcamento_min, 2, ',', '.') . " - R$ " . number_format($orcamento_max, 2, ',', '.');

    $qnt_pessoas = $_POST['qnt_pessoas'];
    $observacoes = $_POST['observacoes'] ?? null; // opcional

    $cliente_id = $cliente->adicionarCliente($nome, $telefone, $email);

    $evento->criarEvento($nivel_planejamento, $tipo_evento, $data1, $data2, $local, $orcamento, $qnt_pessoas, $observacoes, $cliente_id);

    echo "<script>alert('✅ Cliente cadastrado com sucesso!'); window.location.href = 'index.php';</script>";
} else {
    echo "<script>alert('⚠ Insira todas as informações obrigatórias!');</script>";
}
