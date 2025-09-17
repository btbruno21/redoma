<?php
include 'inc/header.php';
include 'classes/usuario.php';
include 'classes/fornecedor.php';
include 'classes/adm.php';
include 'classes/funcoes.php';

$usuario = new Usuario();
$tipo = $usuario->getTipoPorId($_GET['id']);
$fornecedor = new Fornecedor();
$adm = new Admin();
$funcoes = new Funcoes();

if ($tipo === 'fornecedor') {
    $info = $fornecedor->buscar($_GET['id']);
    $name = $info['nome_fantasia'];
} elseif ($tipo === 'admin') {
    $info = $adm->buscar($_GET['id']);
    $name = $info['nome'];
}
?>
<main>
    <div class="dashboard">
        <h1>Bem-vindo <?php echo $name; ?></h1>
        <?php if ($tipo === 'admin'): ?>
            <a href="cadastroUser.php">Cadastro de Usuários</a>
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
                $lista = $fornecedor->listar();
                foreach ($lista as $item):
                ?>
                    <tbody>
                        <tr>
                            <td><?php echo $item['id']; ?></td>
                            <td><?php echo $funcoes->formatarCNPJ($item['cnpj']); ?></td>
                            <td><?php echo $item['nome_fantasia']; ?></td>
                            <td><?php echo $item['telefone']; ?></td>
                            <td><?php echo $item['email']; ?></td>
                            <td class="acoes">
                                <a href="editarFornecedor.php?id=<?php echo $item['id'] ?>">EDITAR </a>
                                |
                                <a href="excluirFornecedor.php?id=<?php echo $item['id'] ?>" onclick="return confirm('Você tem certeza que quer excluir esse contato?')"> EXCLUIR</a>
                            </td>
                        </tr>
                    </tbody>
                <?php
                endforeach;
                ?>
            </table>
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
                $lista = $adm->listar();
                foreach ($lista as $item):
                ?>
                    <tbody>
                        <tr>
                            <td><?php echo $item['id']; ?></td>
                            <td><?php echo $item['nome']; ?></td>
                            <td><?php echo implode(', ', $item['permissoes']); ?></td>
                            <td><?php echo $item['email']; ?></td>
                            <td class="acoes">
                                <a href="editarAdmin.php?id=<?php echo $item['id'] ?>">EDITAR </a>
                                |
                                <a href="excluirAdmin.php?id=<?php echo $item['id'] ?>" onclick="return confirm('Você tem certeza que quer excluir esse contato?')"> EXCLUIR</a>
                            </td>
                        </tr>
                    </tbody>
                <?php
                endforeach;
                ?>
            </table>
        <?php elseif ($tipo === 'fornecedor'): ?>
        <?php else: ?>
        <?php endif; ?>
    </div>
</main>
<?php include 'inc/footer.php'; ?>