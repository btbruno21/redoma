<?php
require_once 'classes/usuario.php';
require_once 'classes/fornecedor.php';
require_once 'classes/adm.php';

$usuario = new Usuario();
$fornecedor = new Fornecedor();
$admin = new Admin();

if (!empty($_POST['email']) && !empty($_POST['senha'])) {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    if ($usuario->login($email, $senha)) {

        $idUsuario = $usuario->getId();
        $tipo = $usuario->getTipoUsuario();

        if ($tipo === 'fornecedor') {
            // Busca dados do fornecedor
            $dadosFornecedor = $fornecedor->buscar($idUsuario);
            if (!empty($dadosFornecedor)) {
                echo "<script>
                    alert('✅ Login Efetuado com sucesso!');
                    window.location.href = 'dashboard?id=".$dadosFornecedor['id']."';
                </script>";
            } else {
                echo "<script>
                    alert('⚠ Nenhum fornecedor encontrado para este usuário.');
                    window.location.href = 'login';
                </script>";
            }

        } elseif ($tipo === 'admin') {
            // Busca dados do admin
            $dadosAdmin = $admin->buscar($idUsuario);
            if (!empty($dadosAdmin)) {
                echo "<script>
                    alert('✅ Login Efetuado com sucesso!');
                    window.location.href = 'dashboard.php?id=".$dadosAdmin['id']."';
                </script>";
            } else {
                echo "<script>
                    alert('⚠ Nenhum admin encontrado para este usuário.');
                    window.location.href = 'login';
                </script>";
            }

        } else {
            echo "<script>
                alert('⚠ Tipo de usuário inválido.');
                window.location.href = 'login';
            </script>";
        }

    } else {
        echo "<script>
            alert('❌ Email ou senha incorretos. Tente novamente');
            window.location.href = 'login';
        </script>";
    }
}
?>
