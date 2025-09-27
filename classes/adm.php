<?php
require_once 'usuario.php';

class Admin extends Usuario
{
    private $nome;
    private $permissoes;

    public function adicionar($email, $nome, $permissoes, $senha, $tipo_usuario)
    {
        $emailExistente = $this->existeEmail($email);
        if (count($emailExistente) == 0) {
            try {
                $this->con->conectar()->beginTransaction();

                $this->email = $email;
                $this->nome = $nome;
                $this->permissoes = $permissoes;
                $this->senha = password_hash($senha, PASSWORD_DEFAULT);
                $this->tipo_usuario = $tipo_usuario;

                $sql = $this->con->conectar()->prepare("INSERT INTO usuario (email, senha, tipo_usuario) VALUES (:email, :senha, :tipo_usuario)");
                $sql->bindParam(":email", $this->email, PDO::PARAM_STR);
                $sql->bindParam(":senha", $this->senha, PDO::PARAM_STR);
                $sql->bindParam(":tipo_usuario", $this->tipo_usuario, PDO::PARAM_STR);
                $sql->execute();

                $this->id = $this->con->conectar()->lastInsertId();

                $sql = $this->con->conectar()->prepare("INSERT INTO adm (id_usuario, nome, permissoes) VALUES (:id_usuario, :nome, :permissoes)");
                $sql->bindParam(":id_usuario", $this->id, PDO::PARAM_INT);
                $sql->bindParam(":nome", $this->nome, PDO::PARAM_STR);
                $sql->bindParam(":permissoes", $this->permissoes, PDO::PARAM_STR);
                $sql->execute();

                $this->con->conectar()->commit();
                return TRUE;
            } catch (PDOException $ex) {
                $this->con->conectar()->rollback();
                return 'ERRO: ' . $ex->getMessage();
            }
        } else {
            return FALSE;
        }
    }

    public function listar()
    {
        try {
            $sql = $this->con->conectar()->prepare("
            SELECT u.id, u.email, u.tipo_usuario, a.nome, a.permissoes
            FROM usuario u
            INNER JOIN adm a ON u.id = a.id_usuario
        ");
            $sql->execute();
            $admins = $sql->fetchAll(PDO::FETCH_ASSOC);

            foreach ($admins as &$admin) {
                $admin['permissoes'] = explode(',', $admin['permissoes']);
            }
            return $admins;
        } catch (PDOException $ex) {
            echo 'ERRO: ' . $ex->getMessage();
        }
    }


    public function buscar($id)
    {
        try {
            $sql = $this->con->conectar()->prepare("SELECT u.id, u.email, u.tipo_usuario, a.nome, a.permissoes FROM usuario u INNER JOIN adm a ON u.id = a.id_usuario WHERE u.id = :id");
            $sql->bindValue(':id', $id);
            $sql->execute();
            if ($sql->rowCount() > 0) {
                $admin = $sql->fetch();
                $admin['permissoes'] = explode(',', $admin['permissoes']);
                return $admin;
            } else {
                return array();
            }
        } catch (PDOException $ex) {
            echo 'ERRO: ' . $ex->getMessage();
        }
    }

    public function editar($nome, $permissoes, $email, $id)
    {
        $emailExistente = $this->existeEmail($email);
        if (count($emailExistente) > 0 && $emailExistente['id'] != $id) {
            return FALSE;
        } else {
            try {
                $this->con->conectar()->beginTransaction();

                $this->email = $email;
                $this->nome = $nome;
                $this->permissoes = $permissoes;
                $this->id = $id;

                $sql = $this->con->conectar()->prepare("UPDATE usuario SET email = :email WHERE id = :id");
                $sql->bindParam(":email", $this->email, PDO::PARAM_STR);
                $sql->bindParam(":id", $this->id, PDO::PARAM_INT);
                $sql->execute();

                $sql = $this->con->conectar()->prepare("UPDATE adm SET nome = :nome, permissoes = :permissoes WHERE id_usuario = :id_usuario");
                $sql->bindParam(":nome", $this->nome, PDO::PARAM_STR);
                $sql->bindParam(":permissoes", $this->permissoes, PDO::PARAM_STR);
                $sql->bindParam(":id_usuario", $this->id, PDO::PARAM_INT);
                $sql->execute();

                $this->con->conectar()->commit();
                return TRUE;
            } catch (PDOException $ex) {
                $this->con->conectar()->rollback();
                return 'ERRO: ' . $ex->getMessage();
            }
        }
    }

    public function deletar($id)
    {
        $usuario = $this->buscar($id);

        if (empty($usuario)) {
            return false; // Usuário não existe
        }

        try {
            $this->con->conectar()->beginTransaction();

            // 1º DELETE: Remove dados específicos do adm
            $sql = $this->con->conectar()->prepare("DELETE FROM adm WHERE id_usuario = :id");
            $sql->bindParam(':id', $id, PDO::PARAM_INT);
            $sql->execute();

            // 2º DELETE: Remove o usuário
            $sql = $this->con->conectar()->prepare("DELETE FROM usuario WHERE id = :id");
            $sql->bindParam(':id', $id, PDO::PARAM_INT);
            $sql->execute();

            $this->con->conectar()->commit();
            return true;
        } catch (PDOException $ex) {
            $this->con->conectar()->rollback();
            return 'ERRO: ' . $ex->getMessage();
        }
    }
}
