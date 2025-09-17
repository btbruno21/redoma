<?php
require_once 'classes/conexao.php';

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

    protected function existeEmail($email)
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

    public function login($email, $senha)
    {
        $sql = $this->con->conectar()->prepare(
            "SELECT id, email, senha, tipo_usuario FROM usuario WHERE email = :email LIMIT 1"
        );
        $sql->bindParam(":email", $email, PDO::PARAM_STR);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $usuario = $sql->fetch(PDO::FETCH_ASSOC);

            if (password_verify($senha, $usuario['senha'])) {
                $this->id = $usuario['id'];
                $this->email = $usuario['email'];
                $this->senha = $usuario['senha'];
                $this->tipo_usuario = $usuario['tipo_usuario'];

                return TRUE;
            }
        }
        return FALSE;
    }


    public function getId()
    {
        return $this->id;
    }

    public function getTipoUsuario()
    {
        return $this->tipo_usuario;
    }

    public function getTipoPorId($id)
    {
        try {
            $sql = $this->con->conectar()->prepare("SELECT tipo_usuario FROM usuario WHERE id = :id LIMIT 1");
            $sql->bindParam(":id", $id, PDO::PARAM_INT);
            $sql->execute();

            if ($sql->rowCount() > 0) {
                $usuario = $sql->fetch(PDO::FETCH_ASSOC);
                return $usuario['tipo_usuario'];
            } else {
                return null; // ID não existe
            }
        } catch (PDOException $ex) {
            return null;
        }
    }
}
