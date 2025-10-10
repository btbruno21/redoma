<?php
include 'inc/header.php';
include 'classes/usuario.php';
include 'classes/fornecedor.php';
include 'classes/adm.php';
include 'classes/funcoes.php';
include 'classes/produto.php';
include 'classes/local.php';
include 'classes/servico.php';

$usuario = new Usuario();
$fornecedor = new Fornecedor();
$adm = new Admin();

$funcoes = new Funcoes();

$produto = new Produto();
$local = new Local();
$servico = new Servico();

session_start();
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
            $name = $info['nome'];
            $permissoes = $info['permissoes'];
        }
    } else {
        header('Location: /redoma/login');
    }
}
?>
<main>
    <div class="dashboard">
        <h1>Bem-vindo <?php echo $name; ?></h1>

        <?php if ($tipo === 'admin' || $tipo === 'fornecedor'): ?>

            <!-- Botão de cadastro -->
            <div class="button-dashboard">
                <?php if ($tipo === 'admin'): ?>
                    <a href="cadastroUser.php">Cadastro de Usuários</a>
                <?php else: ?>
                    <a href="adicionarRecursos.php">Cadastro de Recursos</a>
                <?php endif; ?>
            </div>

            <!-- Sistema de Abas -->
            <div class="tabs">
                <button class="tab-button active" onclick="showTab('recursos')">Recursos</button>
                <?php if ($tipo === 'admin'): ?>
                    <button class="tab-button" onclick="showTab('usuarios')">Usuários</button>
                <?php elseif ($tipo === 'fornecedor'): ?>
                    <button class="tab-button" onclick="window.location.href='agenda'">Calendário</button>
                <?php endif; ?>
                <a href="actions/logout.php">Sair</a>
            </div>

            <!-- Aba de Recursos -->
            <div id="recursos" class="tab-content active">
                <div class="table">
                    <h1 class="titulo">Produtos</h1>
                    <table class="tabela">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>NOME</th>
                                <th>DESCRIÇÃO</th>
                                <th>PREÇO</th>
                                <th>REGIÃO</th>
                                <th>TIPO</th>
                                <th>QUANTIDADE</th>
                                <?php if ($tipo === 'admin'): ?>
                                    <th>ID FORNECEDOR</th>
                                <?php endif; ?>
                                <th>STATUS</th>
                                <th>AÇÕES</th>
                            </tr>
                        </thead>
                        <?php foreach ($listaProd as $item): ?>
                            <tbody>
                                <tr>
                                    <td><?php echo $item['id']; ?></td>
                                    <td><?php echo $item['nome']; ?></td>
                                    <td><?php echo $item['descricao']; ?></td>
                                    <td><?php echo $item['preco']; ?></td>
                                    <td><?php echo $item['regiao']; ?></td>
                                    <td><?php echo $item['tipo']; ?></td>
                                    <td><?php echo $item['quantidade']; ?></td>
                                    <?php if ($tipo === 'admin'): ?>
                                        <td><?php echo $item['id_fornecedor']; ?></td>
                                    <?php endif; ?>
                                    <td><?php echo ($item['ativo'] == 1) ? 'Ativo' : 'Inativo'; ?></td>
                                    <td class="acoes">
                                        <a href="editarProduto.php?id=<?php echo base64_encode($item['id']) ?>">EDITAR</a>
                                        |
                                        <a href="actions/excluirProduto.php?id_serv=<?php echo base64_encode($item['id']) ?>" onclick="return confirm('Você tem certeza que quer excluir esse produto?')">EXCLUIR</a>
                                    </td>
                                </tr>
                            </tbody>
                        <?php endforeach; ?>
                    </table>
                </div>

                <!-- Tabela de Locais -->
                <div class="table">
                    <h1 class="titulo">Locais</h1>
                    <table class="tabela">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>NOME</th>
                                <th>DESCRIÇÃO</th>
                                <th>PREÇO</th>
                                <th>REGIÃO</th>
                                <th>ENDEREÇO</th>
                                <th>CAPACIDADE</th>
                                <?php if ($tipo === 'admin'): ?>
                                    <th>ID FORNECEDOR</th>
                                <?php endif; ?>
                                <th>STATUS</th>
                                <th>AÇÕES</th>
                            </tr>
                        </thead>
                        <?php foreach ($listaLocal as $item): ?>
                            <tbody>
                                <tr>
                                    <td><?php echo $item['id']; ?></td>
                                    <td><?php echo $item['nome']; ?></td>
                                    <td><?php echo $item['descricao']; ?></td>
                                    <td><?php echo $item['preco']; ?></td>
                                    <td><?php echo $item['regiao']; ?></td>
                                    <td><?php echo $item['endereco']; ?></td>
                                    <td><?php echo $item['capacidade']; ?></td>
                                    <?php if ($tipo === 'admin'): ?>
                                        <td><?php echo $item['id_fornecedor']; ?></td>
                                    <?php endif; ?>
                                    <td><?php echo ($item['ativo'] == 1) ? 'Ativo' : 'Inativo'; ?></td>
                                    <td class="acoes">
                                        <a href="editarLocal.php?id=<?php echo base64_encode($item['id']) ?>">EDITAR</a>
                                        |
                                        <a href="actions/excluirLocal.php?id_serv=<?php echo base64_encode($item['id']) ?>" onclick="return confirm('Você tem certeza que quer excluir esse local?')">EXCLUIR</a>
                                    </td>
                                </tr>
                            </tbody>
                        <?php endforeach; ?>
                    </table>
                </div>

                <!-- Tabela de Serviços -->
                <div class="table">
                    <h1 class="titulo">Serviços</h1>
                    <table class="tabela">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>NOME</th>
                                <th>DESCRIÇÃO</th>
                                <th>PREÇO</th>
                                <th>REGIÃO</th>
                                <th>DURAÇÃO</th>
                                <th>CATEGORIA</th>
                                <?php if ($tipo === 'admin'): ?>
                                    <th>ID FORNECEDOR</th>
                                <?php endif; ?>
                                <th>STATUS</th>
                                <th>AÇÕES</th>
                            </tr>
                        </thead>
                        <?php foreach ($listaServ as $item): ?>
                            <tbody>
                                <tr>
                                    <td><?php echo $item['id']; ?></td>
                                    <td><?php echo $item['nome']; ?></td>
                                    <td><?php echo $item['descricao']; ?></td>
                                    <td><?php echo $item['preco']; ?></td>
                                    <td><?php echo $item['regiao']; ?></td>
                                    <td><?php echo $item['duracao']; ?></td>
                                    <td><?php echo $item['categoria']; ?></td>
                                    <?php if ($tipo === 'admin'): ?>
                                        <td><?php echo $item['id_fornecedor']; ?></td>
                                    <?php endif; ?>
                                    <td><?php echo ($item['ativo'] == 1) ? 'Ativo' : 'Inativo'; ?></td>
                                    <td class="acoes">
                                        <a href="editarServico.php?id=<?php echo base64_encode($item['id']) ?>">EDITAR</a>
                                        |
                                        <a href="actions/excluirServico.php?id_serv=<?php echo base64_encode($item['id']) ?>" onclick="return confirm('Você tem certeza que quer excluir esse serviço?')">EXCLUIR</a>
                                    </td>
                                </tr>
                            </tbody>
                        <?php endforeach; ?>
                    </table>
                </div>
            </div>

            <?php if ($tipo === 'admin'): ?>
                <!-- Aba de Usuários -->
                <div id="usuarios" class="tab-content">
                    <!-- Tabela de Fornecedores -->
                    <div class="table">
                        <h1 class="titulo">Fornecedores</h1>
                        <table class="tabela">
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
                            <?php
                            foreach ($listaForn as $item):
                            ?>
                                <tbody>
                                    <tr>
                                        <td><?php echo $item['id']; ?></td>
                                        <td><?php echo $funcoes->formatarCNPJ($item['cnpj']); ?></td>
                                        <td><?php echo $item['nome_fantasia']; ?></td>
                                        <td><?php echo $funcoes->formatarTelefone($item['telefone']); ?></td>
                                        <td><?php echo $item['email']; ?></td>
                                        <td class="acoes">
                                            <a href="editarFornecedor.php?id=<?php echo base64_encode($item['id']) ?>">EDITAR</a>
                                            |
                                            <a href="actions/excluirFornecedor.php?id=<?php echo base64_encode($item['id']) ?>" onclick="return confirm('Você tem certeza que quer excluir esse contato?')">EXCLUIR</a>
                                        </td>
                                    </tr>
                                </tbody>
                            <?php endforeach; ?>
                        </table>
                    </div>

                    <?php if (in_array("super", $permissoes)): ?>
                        <!-- Tabela de Administradores -->
                        <div class="table">
                            <h1 class="titulo">Administradores</h1>
                            <table class="tabela">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>NOME</th>
                                        <th>PERMISSÕES</th>
                                        <th>EMAIL</th>
                                        <th>AÇÕES</th>
                                    </tr>
                                </thead>
                                <?php
                                $listaAdm = $adm->listar();
                                foreach ($listaAdm as $item):
                                ?>
                                    <tbody>
                                        <tr>
                                            <td><?php echo $item['id']; ?></td>
                                            <td><?php echo $item['nome']; ?></td>
                                            <td><?php echo implode(', ', $item['permissoes']); ?></td>
                                            <td><?php echo $item['email']; ?></td>
                                            <td class="acoes">
                                                <a href="editarAdmin.php?id=<?php echo base64_encode($item['id']) ?>">EDITAR</a>
                                                <?php if (!in_array("super", $item['permissoes'])): ?>
                                                    |
                                                    <a href="actions/excluirAdmin.php?id=<?php echo base64_encode($item['id']) ?>" onclick="return confirm('Você tem certeza que quer excluir esse contato?')">EXCLUIR</a>
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                    </tbody>
                                <?php endforeach; ?>
                            </table>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
        <?php endif; ?>
    </div>
</main>
<script src="js/dashboard-menu.js"></script>
<?php include 'inc/footer.php'; ?>