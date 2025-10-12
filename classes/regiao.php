<?php
require_once 'conexao.php';

class Regiao
{
    protected $id;
    protected $nome;

    protected $con;

    public function __construct()
    {
        $this->con = new Conexao();
    }

    public function criarRegiao($nome)
    {
        try {
            $this->nome = $nome;

            $sql = $this->con->conectar()->prepare("INSERT INTO regiao (nome) VALUES (:nome)");
            $sql->bindParam(":nome", $this->nome, PDO::PARAM_STR);
            $sql->execute();

            return TRUE;
        } catch (PDOException $ex) {
            return 'ERRO: ' . $ex->getMessage();
        }
    }

    public function listar()
    {
        try {
            // CORRIGIDO AQUI para ordenar pelo ID
            $sql = $this->con->conectar()->prepare("SELECT id, nome FROM regiao ORDER BY id ASC");
            $sql->execute();
            return $sql->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $ex) {
            return 'ERRO: ' . $ex->getMessage();
        }
    }

    public function buscarRegiao($id)
    {
        try {
            $sql = $this->con->conectar()->prepare("SELECT * FROM regiao WHERE id = :id");
            $sql->bindParam(":id", $id, PDO::PARAM_INT);
            $sql->execute();
            $regiao = $sql->fetch(PDO::FETCH_ASSOC);

            return $regiao ? $regiao : false;
        } catch (PDOException $ex) {
            return 'ERRO: ' . $ex->getMessage();
        }
    }

    public function editarRegiao($id, $nome)
    {
        try {
            $this->id = $id;
            $this->nome = $nome;

            $sql = $this->con->conectar()->prepare("UPDATE regiao SET nome = :nome WHERE id = :id");
            $sql->bindParam(":nome", $this->nome, PDO::PARAM_STR);
            $sql->bindParam(":id", $this->id, PDO::PARAM_INT);
            $sql->execute();

            return true;
        } catch (PDOException $ex) {
            return 'ERRO: ' . $ex->getMessage();
        }
    }

    public function excluir($id)
    {
        $regiao = $this->buscarRegiao($id);
        if (empty($regiao)) {
            return false;
        }

        try {
            $con = $this->con->conectar();
            $sql = $con->prepare("DELETE FROM regiao WHERE id = :id");
            $sql->bindParam(":id", $id, PDO::PARAM_INT);
            $sql->execute();

            return true;
        } catch (PDOException $ex) {
            return 'ERRO: ' . $ex->getMessage();
        }
    }
}