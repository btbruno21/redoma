<?php
require 'classes/recurso.php';

class Produto extends Recurso
{
    private $tipo;
    private $quantidade;

    public function __construct()
    {
        parent::__construct();
    }

    public function criar($nome, $descricao, $preco, $regiao, $ativo, $id_fornecedor, $tipo, $quantidade)
    {
        try {
            $this->con->conectar()->beginTransaction();
            $this->nome = $nome;
            $this->descricao = $descricao;
            $this->preco = $preco;
            $this->regiao = $regiao;
            $this->ativo = $ativo;
            $this->id_fornecedor = $id_fornecedor;

            $this->tipo = $tipo;
            $this->quantidade = $quantidade;

            $sql = $this->con->conectar()->prepare("INSERT INTO recurso (nome, descricao, preco, regiao, ativo, id_fornecedor) VALUES (:nome, :descricao, :preco, :regiao, :ativo, :id_fornecedor)");
            $sql->bindParam(":nome", $this->nome, PDO::PARAM_STR);
            $sql->bindParam(":descricao", $this->descricao, PDO::PARAM_STR);
            $sql->bindParam(":preco", $this->preco, PDO::PARAM_STR);
            $sql->bindParam(":regiao", $this->regiao, PDO::PARAM_STR);
            $sql->bindParam(":ativo", $this->ativo, PDO::PARAM_STR);
            $sql->bindParam(":id_fornecedor", $this->id_fornecedor, PDO::PARAM_STR);
            $sql->execute();

            $this->id = $this->con->conectar()->lastInsertId();

            $sql = $this->con->conectar()->prepare("INSERT INTO produto (id_recurso, tipo, quantidade) VALUES (:id_recurso, :tipo, :quantidade)");
            $sql->bindParam(":id_recurso", $this->id, PDO::PARAM_INT);
            $sql->bindParam(":tipo", $this->tipo, PDO::PARAM_STR);
            $sql->bindParam(":quantidade", $this->quantidade, PDO::PARAM_STR);
            $sql->execute();

            $this->con->conectar()->commit();
            return TRUE;
        } catch (PDOException $ex) {
            $this->con->conectar()->rollback();
            return 'ERRO: ' . $ex->getMessage();
        }
    }

    public function listar()
    {
        $sql = $this->con->conectar()->prepare("SELECT r.id, r.nome, r.descricao, r.preco, r.regiao, r.ativo, p.tipo, p.quantidade, r.id_fornecedor FROM recurso r INNER JOIN produto p ON r.id = p.id_recurso");
        $sql->execute();
        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }

    public function listarPorFornecedor($id_fornecedor)
    {
        $sql = $this->con->conectar()->prepare("SELECT r.id, r.nome, r.descricao, r.preco, r.regiao, r.ativo, p.tipo, p.quantidade, r.id_fornecedor FROM recurso r INNER JOIN produto p ON r.id = p.id_recurso WHERE r.id_fornecedor = :id_fornecedor");
        $sql->bindParam(":id_fornecedor", $id_fornecedor, PDO::PARAM_INT);
        $sql->execute();
        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }

    public function editar($id, $nome, $descricao, $preco, $regiao, $ativo, $id_fornecedor, $tipo, $quantidade)
    {
        try {
            $this->con->conectar()->beginTransaction();
            $this->nome = $nome;
            $this->descricao = $descricao;
            $this->preco = $preco;
            $this->regiao = $regiao;
            $this->ativo = $ativo;
            $this->id_fornecedor = $id_fornecedor;
            $this->tipo = $tipo;
            $this->quantidade = $quantidade;
            $this->id = $id;
            $sql = $this->con->conectar()->prepare("UPDATE recurso SET nome = :nome, descricao = :descricao, preco = :preco, regiao = :regiao, ativo = :ativo, id_fornecedor = :id_fornecedor WHERE id = :id");
            $sql->bindParam(":id", $id, PDO::PARAM_INT);
            $sql->bindParam(":nome", $nome, PDO::PARAM_STR);
            $sql->bindParam(":descricao", $descricao, PDO::PARAM_STR);
            $sql->bindParam(":preco", $preco, PDO::PARAM_STR);
            $sql->bindParam(":regiao", $regiao, PDO::PARAM_STR);
            $sql->bindParam(":ativo", $ativo, PDO::PARAM_STR);
            $sql->bindParam(":id_fornecedor", $id_fornecedor, PDO::PARAM_INT);
            $sql->bindParam(":tipo", $tipo, PDO::PARAM_STR);
            $sql->bindParam(":quantidade", $quantidade, PDO::PARAM_STR);
            $sql->execute();
            return TRUE;
        } catch (PDOException $ex) {
            $this->con->conectar()->rollback();
            return 'ERRO: ' . $ex->getMessage();
        }
    }
}
