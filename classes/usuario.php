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

        if ($sql->rowCount() == 0) {
            return false;
        }
        $usuario = $sql->fetch(PDO::FETCH_ASSOC);

        if (password_verify($senha, $usuario['senha'])) {
            $this->id = $usuario['id'];
            $this->email = $usuario['email'];
            $this->tipo_usuario = $usuario['tipo_usuario'];

            return true;
        }
        return false;
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

    // public function criar($email, $senha, $tipo_usuario) {
    //     try {
    //         // Verifica se o email já existe
    //         $sql = $this->con->conectar()->prepare("SELECT id FROM usuario WHERE email = :email LIMIT 1");
    //         $sql->bindParam(":email", $email, PDO::PARAM_STR);
    //         $sql->execute();

    //         if ($sql->rowCount() > 0) {
    //             // Email já cadastrado
    //             return false;
    //         }

    //         // Criptografa a senha
    //         $senhaHash = password_hash($senha, PASSWORD_DEFAULT);

    //         // Insere o novo usuário
    //         $sql = $this->con->conectar()->prepare(
    //             "INSERT INTO usuario (email, senha, tipo_usuario) VALUES (:email, :senha, :tipo_usuario)"
    //         );
    //         $sql->bindParam(":email", $email, PDO::PARAM_STR);
    //         $sql->bindParam(":senha", $senhaHash, PDO::PARAM_STR);
    //         $sql->bindParam(":tipo_usuario", $tipo_usuario, PDO::PARAM_STR);

    //         if ($sql->execute()) {
    //             return true;
    //         } else {
    //             return false;
    //         }
    //     } catch (PDOException $ex) {
    //         return false;
    //     }
    // }
}
