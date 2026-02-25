<?php
session_start();
if ($_SESSION['tipo_usuario'] != 'admin'){
    header('Location: ../dashboard.php');
    exit();
}
include 'inc/header.php';
include 'classes/usuario.php';
include 'classes/fornecedor.php';
include 'classes/adm.php';
include 'classes/funcoes.php';
include 'classes/produto.php';
include 'classes/local.php';
include 'classes/servico.php';
include 'classes/regiao.php';

$usuario = new Usuario();
$fornecedor = new Fornecedor();
$adm = new Admin();
$regiao = new Regiao();

$funcoes = new Funcoes();

$produto = new Produto();
$local = new Local();
$servico = new Servico();

if (!isset($_SESSION['id'])) {
    header('Location: /redoma/login');
} else {
    $id = $_SESSION['id'];
    $tipo = $_SESSION['tipo_usuario'];

    if (!empty($tipo)) {
        if ($tipo === 'fornecedor') {
            $info = $fornecedor->buscar($id);
            $listaProd = $produto->listarPorFornecedor($id);
            $listaLocal = $local->listarPorFornecedor($id);
            $listaServ = $servico->listarPorFornecedor($id);
            $name = $info['nome_fantasia'];
        } elseif ($tipo === 'admin') {
            $info = $adm->buscar($id);
            $listaProd = $produto->listar();
            $listaLocal = $local->listar();
            $listaServ = $servico->listar();
            $listaForn = $fornecedor->listar();
            $listaRegioes = $regiao->listar();
            $name = $info['nome'];
            $permissoes = $info['permissoes'];
        }
    } else {
        header('Location: /redoma/login');
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br" data-bs-theme="dark">

<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>

    <!-- Bootstrap LOCAL -->
    <link rel="stylesheet" href="css/bootstrap.css">

    <style>
        body {
            background-color: #121212;
        }

        .card {
            background-color: #1e1e1e;
            border-color: #2c2c2c;
        }

        .nav-tabs .nav-link {
            color: #ccc;
        }

        .nav-tabs .nav-link.active {
            background-color: #2c2c2c;
            color: white;
            border-color: #2c2c2c;
        }

        .tab-content {
            display: none;
        }

        .tab-content.active {
            display: block;
        }
    </style>
</head>
<body>
<div class="container mt-4">
    <h1 class="mb-4">Bem-vindo <?php echo $name; ?></h1>
    <div class="mb-3">
        <a href="cadastroUser" class="btn btn-primary">
            Cadastro de Usuários
        </a>
        <a href="actions/logout" class="btn btn-danger float-end">
            Sair
        </a>
    </div>

    <!-- TABS -->
    <ul class="nav nav-tabs mb-3">
        <li class="nav-item">
            <button class="nav-link tab-button active" onclick="showTab('recursos', event)">
                Recursos
            </button>
        </li>
        <li class="nav-item">
            <button class="nav-link tab-button" onclick="showTab('gerenciar', event)">
                Gerenciar
            </button>
        </li>
    </ul>

    <div>

        <!-- TAB: RECURSOS -->
        <div class="tab-content active" id="recursos">

            <!-- PRODUTOS -->
            <div class="card mb-4">
                <div class="card-body">
                    <h4 class="mb-3">Produtos</h4>
                    <table class="table table-dark table-striped table-hover table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>NOME</th>
                                <th>DESCRIÇÃO</th>
                                <th>PREÇO</th>
                                <th>REGIÃO</th>
                                <th>TIPO</th>
                                <th>QUANTIDADE</th>
                                <th class="text-nowrap">ID FORNECEDOR</th>
                                <th>STATUS</th>
                                <th>AÇÕES</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($listaProd as $item): ?>
                            <tr>
                                <td><?php echo $item['id']; ?></td>
                                <td><?php echo $item['nome']; ?></td>
                                <td><?php echo $item['descricao']; ?></td>
                                <td><?php echo $item['preco']; ?></td>
                                <td><?php echo $item['nome_regiao'] ?? 'Sem região definida'; ?></td>
                                <td><?php echo $item['tipo']; ?></td>
                                <td><?php echo $item['quantidade']; ?></td>
                                <td><?php echo $fornecedor->getNome($item['id_fornecedor']); ?></td>
                                <td><?= $item['ativo'] ? 'Ativo' : 'Inativo' ?></td>
                                <td class="text-nowrap">
                                    <a href="editarProduto?id=<?= base64_encode($item['id']) ?>" class="btn btn-warning btn-sm">Editar</a>
                                    <a href="actions/excluirProduto?id_serv=<?= base64_encode($item['id']) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Excluir produto?')">Excluir</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- LOCAIS -->
            <div class="card mb-4">
                <div class="card-body">
                    <h4 class="mb-3">Locais</h4>
                    <table class="table table-dark table-striped table-hover table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>NOME</th>
                                <th>DESCRIÇÃO</th>
                                <th>PREÇO</th>
                                <th>REGIÃO</th>
                                <th>ENDEREÇO</th>
                                <th>CAPACIDADE</th>
                                <th class="text-nowrap">ID FORNECEDOR</th>
                                <th>STATUS</th>
                                <th>AÇÕES</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($listaLocal as $item): ?>
                            <tr>
                                <td><?php echo $item['id']; ?></td>
                                <td><?php echo $item['nome']; ?></td>
                                <td><?php echo $item['descricao']; ?></td>
                                <td><?php echo $item['preco']; ?></td>
                                <td><?php echo $item['nome_regiao'] ?? 'Sem região definida'; ?></td>
                                <td><?php echo $item['endereco']; ?></td>
                                <td><?php echo $item['capacidade']; ?></td>
                                <td><?php echo $fornecedor->getNome($item['id_fornecedor']); ?></td>
                                <td><?php echo ($item['ativo'] == 1) ? 'Ativo' : 'Inativo'; ?></td>
                                <td class="text-nowrap">
                                    <a href="editarLocal?id=<?= base64_encode($item['id']) ?>" class="btn btn-warning btn-sm">Editar</a>
                                    <a href="actions/excluirLocal?id_serv=<?= base64_encode($item['id']) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Excluir local?')">Excluir</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- SERVIÇOS -->
            <div class="card mb-4">
                <div class="card-body">
                    <h4 class="mb-3">Serviços</h4>
                    <table class="table table-dark table-striped table-hover table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>NOME</th>
                                <th>DESCRIÇÃO</th>
                                <th>PREÇO</th>
                                <th>REGIÃO</th>
                                <th>DURAÇÃO</th>
                                <th>CATEGORIA</th>
                                <th class="text-nowrap">ID FORNECEDOR</th>
                                <th>STATUS</th>
                                <th>AÇÕES</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($listaServ as $item): ?>
                            <tr>
                                <td><?php echo $item['id']; ?></td>
                                <td><?php echo $item['nome']; ?></td>
                                <td><?php echo $item['descricao']; ?></td>
                                <td><?php echo $item['preco']; ?></td>
                                <td><?php echo $item['nome_regiao'] ?? 'Sem região definida'; ?></td>
                                <td><?php echo $item['duracao']; ?></td>
                                <td><?php echo $item['categoria']; ?></td>
                                <td><?php echo $fornecedor->getNome($item['id_fornecedor']); ?></td>
                                <td><?php echo ($item['ativo'] == 1) ? 'Ativo' : 'Inativo'; ?></td>
                                <td class="text-nowrap">
                                    <a href="editarServico?id=<?= base64_encode($item['id']) ?>" class="btn btn-warning btn-sm">Editar</a>
                                    <a href="actions/excluirServico?id_serv=<?= base64_encode($item['id']) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Excluir serviço?')">Excluir</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>

        <!-- TAB: GERENCIAR -->
        <div class="tab-content" id="gerenciar">

            <!-- REGIÕES -->
            <div class="card mb-4">
                <div class="card-body">
                    <h4 class="mb-3">Regiões</h4>
                    <table class="table table-dark table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>NOME</th>
                                <th>AÇÕES</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($listaRegioes as $item): ?>
                            <tr>
                                <td><?= $item['id'] ?></td>
                                <td><?= $item['nome'] ?></td>
                                <td>
                                    <a href="editarRegiao?id=<?= base64_encode($item['id']) ?>" class="btn btn-warning btn-sm">Editar</a>
                                    <a href="actions/excluirRegiao?id=<?= base64_encode($item['id']) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Excluir região?')">Excluir</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- FORNECEDORES -->
            <div class="card mb-4">
                <div class="card-body">
                    <h4 class="mb-3">Fornecedores</h4>
                    <table class="table table-dark table-striped table-hover table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>CNPJ</th>
                                <th>NOME FANTASIA</th>
                                <th>TELEFONE</th>
                                <th>EMAIL</th>
                                <th>AÇÕES</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($listaForn as $item): ?>
                            <tr>
                                <td><?php echo $item['id']; ?></td>
                                <td><?php echo $funcoes->formatarCNPJ($item['cnpj']); ?></td>
                                <td><?php echo $item['nome_fantasia']; ?></td>
                                <td><?php echo $funcoes->formatarTelefone($item['telefone']); ?></td>
                                <td><?php echo $item['email']; ?></td>
                                <td>
                                    <a href="editarFornecedor?id=<?php echo base64_encode($item['id']) ?>" class="btn btn-warning btn-sm">Editar</a>
                                    <a href="actions/excluirFornecedor?id=<?php echo base64_encode($item['id']) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Você tem certeza que quer excluir esse contato?')">Excluir</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- ADMINISTRADORES (somente super) -->
            <?php if (in_array("super", $permissoes)): ?>
            <div class="card mb-4">
                <div class="card-body">
                    <h4 class="mb-3">Administradores</h4>
                    <table class="table table-dark table-striped table-hover table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>NOME</th>
                                <th>PERMISSÕES</th>
                                <th>EMAIL</th>
                                <th>AÇÕES</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                        $listaAdm = $adm->listar();
                        foreach ($listaAdm as $item):
                        ?>
                            <tr>
                                <td><?php echo $item['id']; ?></td>
                                <td><?php echo $item['nome']; ?></td>
                                <td><?php echo implode(', ', $item['permissoes']); ?></td>
                                <td><?php echo $item['email']; ?></td>
                                <td>
                                    <a href="editarAdmin?id=<?php echo base64_encode($item['id']) ?>" class="btn btn-warning btn-sm">Editar</a>
                                    <?php if (!in_array("super", $item['permissoes'])): ?>
                                        <a href="actions/excluirAdmin?id=<?php echo base64_encode($item['id']) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Você tem certeza que quer excluir esse contato?')">Excluir</a>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <?php endif; ?>

        </div>
    </div>
</div>
<script src="js/dashboard-menu.js"></script>
</body>
</html>