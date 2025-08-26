<?php
require_once 'conexao.php';

class Cliente
{
    private $id;
    private $nome;
    private $telefone;
    private $email;
    private $cpf;

    private $con;

    public function __construct()
    {
        $this->con = new Conexao();
    }

    public function adicionarCliente($nome, $telefone, $email)
    {

        try {
            $this->nome = $nome;
            $this->telefone = $telefone;
            $this->email = $email;

            $sql = $this->con->conectar()->prepare("INSERT INTO cliente(nome, telefone, email) VALUES (:nome, :telefone, :email)");
            $sql->bindParam(":nome", $this->nome, PDO::PARAM_STR);
            $sql->bindParam(":telefone", $this->telefone, PDO::PARAM_STR);
            $sql->bindParam(":email", $this->email, PDO::PARAM_STR);
            $sql->execute();

            return $this->con->conectar()->lastInsertId();

            return array('status' => 'criado');
        } catch (PDOException $ex) {
            return array('status' => 'erro', 'mensagem' => $ex->getMessage());
        }
    }
}