<?php
require_once 'classes/conexao.php';

class Usuario
{
    protected $id;
    protected $email;
    protected $senha;
    protected $permissoes;

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

    public function login($email, $senha)
    {
        $sql = $this->con->conectar()->prepare("SELECT id, email, senha FROM usuario WHERE email = :email LIMIT 1");
        $sql->bindParam(":email", $email, PDO::PARAM_STR);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $usuario = $sql->fetch(PDO::FETCH_ASSOC);

            if (password_verify($senha, $usuario['senha'])) {
                $this->id = $usuario['id'];
                $this->email = $usuario['email'];
                $this->senha = $usuario['senha'];

                return TRUE;
            }
        }
        return FALSE;
    }
}
