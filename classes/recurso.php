<?php
require_once 'conexao.php';

class Recurso
{
    protected $id;
    protected $nome;
    protected $descricao;
    protected $preco;
    protected $id_regiao; // ALTERADO
    protected $ativo;
    protected $id_fornecedor;

    protected $con;

    public function __construct()
    {
        $this->con = new Conexao();
    }

    public function criar($nome, $descricao, $preco, $id_regiao, $id_fornecedor, $con = null) // ALTERADO
    {
        try {
            if (!$con) {
                $con = $this->con->conectar();
            }

            $this->nome = $nome;
            $this->descricao = $descricao;
            $this->preco = $preco;
            $this->id_regiao = $id_regiao; // ALTERADO
            $this->id_fornecedor = $id_fornecedor;

            $sql = $con->prepare("INSERT INTO recurso (nome, descricao, preco, id_regiao, ativo, id_fornecedor) VALUES (:nome, :descricao, :preco, :id_regiao, 1, :id_fornecedor)"); // ALTERADO

            $sql->bindParam(":nome", $this->nome, PDO::PARAM_STR);
            $sql->bindParam(":descricao", $this->descricao, PDO::PARAM_STR);
            $sql->bindParam(":preco", $this->preco);
            $sql->bindParam(":id_regiao", $this->id_regiao, PDO::PARAM_INT); // ALTERADO
            $sql->bindParam(":id_fornecedor", $this->id_fornecedor, PDO::PARAM_INT);

            $sql->execute();

            return $con->lastInsertId();
        } catch (PDOException $ex) {
            throw $ex;
        }
    }

    public function editar($id, $nome, $descricao, $preco, $id_regiao, $ativo, $con = null) // ALTERADO
    {
        try {
            if (!$con) {
                $con = $this->con->conectar();
            }

            $this->id = $id;
            $this->nome = $nome;
            $this->descricao = $descricao;
            $this->preco = $preco;
            $this->id_regiao = $id_regiao; // ALTERADO
            $this->ativo = $ativo;

            $sql = $con->prepare("UPDATE recurso SET nome = :nome, descricao = :descricao, preco = :preco, id_regiao = :id_regiao, ativo = :ativo WHERE id = :id"); // ALTERADO

            $sql->bindParam(":id", $this->id, PDO::PARAM_INT);
            $sql->bindParam(":nome", $this->nome, PDO::PARAM_STR);
            $sql->bindParam(":descricao", $this->descricao, PDO::PARAM_STR);
            $sql->bindParam(":preco", $this->preco);
            $sql->bindParam(":id_regiao", $this->id_regiao, PDO::PARAM_INT); // ALTERADO
            $sql->bindParam(":ativo", $this->ativo, PDO::PARAM_BOOL);

            $sql->execute();

            return $id;
        } catch (PDOException $ex) {
            throw $ex;
        }
    }

    public function buscar($id, $con = null)
    {
        try {
            if (!$con) {
                $con = $this->con->conectar();
            }

            $sql = $con->prepare("SELECT r.*, reg.nome AS nome_regiao FROM recurso r LEFT JOIN regiao reg ON r.id_regiao = reg.id WHERE r.id = :id");

            $sql->bindParam(":id", $id, PDO::PARAM_INT);
            $sql->execute();

            $resultado = $sql->fetch(PDO::FETCH_ASSOC);
            return $resultado ? $resultado : null;
        } catch (PDOException $ex) {
            throw $ex;
        }
    }
}
