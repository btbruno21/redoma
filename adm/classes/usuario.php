<?php
require_once 'conexao.php';

class Usuario
{
    protected $id;
    protected $email;
    protected $senha;
    protected $tipo_usuario;
    protected $con;

    public function __construct()
    {
        $this->con = new Conexao();
    }

    // getters (mínimo necessário)
    public function getId()
    {
        return $this->id;
    }

    public function getTipoUsuario()
    {
        return $this->tipo_usuario;
    }

    protected function existeEmail($email)
    {
        $sql = $this->con->conectar()->prepare(
            "SELECT id FROM usuario WHERE email = :email"
        );
        $sql->bindParam(":email", $email, PDO::PARAM_STR);
        $sql->execute();

        return $sql->fetch(PDO::FETCH_ASSOC) ?: [];
    }

    public function login($email, $senha)
    {
        try {
            $sql = $this->con->conectar()->prepare(
                "SELECT id, email, senha, tipo_usuario FROM usuario WHERE email = :email LIMIT 1"
            );
            $sql->bindParam(":email", $email, PDO::PARAM_STR);
            $sql->execute();

            $usuario = $sql->fetch(PDO::FETCH_ASSOC);
            if (!$usuario)
                return false;

            if (password_verify($senha, $usuario['senha'])) {
                unset($usuario['senha']); // não retorna a senha
                return $usuario; // retorna array
            }

            return false;

        } catch (PDOException $e) {
            return false;
        }
    }
}
