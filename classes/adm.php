<?php
require_once 'classes/conexao.php';

class Usuario
{
    private $id;
    private $email;
    private $senha;
    private $permissoes;

    private $con;

    public function __construct()
    {
        $this->con = new Conexao();
    }

    private function existeEmail($email)
    {
        $sql = $this->con->conectar()->prepare("SELECT id FROM usuario WHERE email = :email");
        $sql->bindParam(":email", $email, PDO::PARAM_STR);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $array = $sql->fetch(); //retorna o email encontrado
        } else {
            $array = array();
        }
        return $array;
    }

    public function adicionarUsuario($email, $nome, $senha, $permissoes)
    {
        $emailExistente = $this->existeEmail($email);
        if (count($emailExistente) == 0) {
            try {
                $this->email = $email;
                $this->senha = md5($senha);
                $this->permissoes = $permissoes;
                $sql = $this->con->conectar()->prepare("INSERT INTO usuario(nome, email, senha, permissoes) VALUES (:nome, :email, :senha, :permissoes)");
                $sql->bindParam(":email", $this->email, PDO::PARAM_STR);
                $sql->bindParam(":senha", $this->senha, PDO::PARAM_STR);
                $sql->bindParam(":permissoes", $this->permissoes, PDO::PARAM_STR);
                $sql->execute();
                return TRUE;
            } catch (PDOException $ex) {
                return 'ERRO: ' . $ex->getMessage();
            }
        } else {
            return FALSE;
        }
    }

    public function listarUsuario()
    {
        try {
            $sql = $this->con->conectar()->prepare("SELECT * FROM usuario");
            $sql->execute();
            return $sql->fetchAll();
        } catch (PDOException $ex) {
            echo 'ERRO: ' . $ex->getMessage();
        }
    }

    public function buscarUsuario($id)
    {
        try {
            $sql = $this->con->conectar()->prepare("SELECT * FROM usuario WHERE id = :id");
            $sql->bindValue(':id', $id);
            $sql->execute();
            if ($sql->rowCount() > 0) {
                $usuario = $sql->fetch();
                if (!empty($usuario['permissoes'])) {
                    $usuario['permissoes'] = explode(",", $usuario['permissoes']);
                } else {
                    $usuario['permissoes'] = [];
                }

                return $usuario;
            } else {
                return array();
            }
        } catch (PDOException $ex) {
            echo 'ERRO: ' . $ex->getMessage();
        }
    }

    public function editarUsuario($nome, $email, $permissoes, $id)
    {
        $emailExistente = $this->existeEmail($email);
        if (count($emailExistente) > 0 && $emailExistente['id'] != $id) {
            return FALSE;
        } else {
            try {
                $sql = $this->con->conectar()->prepare("UPDATE usuario SET nome = :nome, email = :email, permissoes = :permissoes WHERE id = :id");
                $sql->bindValue(':nome', $nome);
                $sql->bindValue(':email', $email);
                $sql->bindValue(':permissoes', $permissoes);
                $sql->bindValue(':id', $id);
                $sql->execute();
                return TRUE;
            } catch (PDOException $ex) {
                echo 'ERRO: ' . $ex->getMessage();
            }
        }
    }

    public function deletarUsuario($id)
    {
        // Primeiro busca o usuário
        $usuario = $this->buscarUsuario($id);

        if (empty($usuario)) {
            // Usuário não existe
            return false;
        }

        try {
            $sql = $this->con->conectar()->prepare("DELETE FROM usuario WHERE id = :id");
            $sql->bindValue(':id', $id);
            $sql->execute();
            return true; // delete realizado com sucesso
        } catch (PDOException $ex) {
            echo 'ERRO: ' . $ex->getMessage();
            return false;
        }
    }
}