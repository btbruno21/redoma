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

    public function buscarPeloCpf($cpf)
    {
        try {
            $this->cpf = $cpf;

            $sql = $this->con->conectar()->prepare("SELECT id FROM cliente WHERE cpf = :cpf");
            $sql->bindParam(":cpf", $this->cpf, PDO::PARAM_STR);
            $sql->execute();

            $id = $sql->fetchColumn();

            return $id;
        } catch (PDOException $ex) {
            error_log($ex->getMessage());
            return false;
        }
    }

    // Em cliente.php - MÉTODO CORRIGIDO

    public function adicionarCliente($nome, $telefone, $email, $cpf = null) // Adicionado CPF como opcional
    {
        try {
            $this->nome = $nome;
            $this->telefone = $telefone;
            $this->email = $email;
            $this->cpf = $cpf; // Armazena o CPF também

            $sql = $this->con->conectar()->prepare("INSERT INTO cliente(nome, telefone, email, cpf) VALUES (:nome, :telefone, :email, :cpf)");
            $sql->bindParam(":nome", $this->nome, PDO::PARAM_STR);
            $sql->bindParam(":telefone", $this->telefone, PDO::PARAM_STR);
            $sql->bindParam(":email", $this->email, PDO::PARAM_STR);
            $sql->bindParam(":cpf", $this->cpf, PDO::PARAM_STR); // Adiciona o bind do CPF

            if ($sql->execute()) {
                return $this->con->conectar()->lastInsertId();
            } else {
                return false;
            }
        } catch (PDOException $ex) {
            error_log($ex->getMessage());
            return false;
        }
    }
}
