<?php
require 'recurso.php';

class Produto extends Recurso
{
    private $tipo;
    private $quantidade;

    public function __construct()
    {
        parent::__construct();
    }

    public function criarProduto($nome, $descricao, $preco, $regiao, $id_fornecedor, $tipo, $quantidade)
    {
        try {
            $con = $this->con->conectar();
            $con->beginTransaction();

            $this->id = parent::criar($nome, $descricao, $preco, $regiao, $id_fornecedor);

            $this->tipo = $tipo;
            $this->quantidade = $quantidade;

            $sql = $con->prepare("INSERT INTO produto (id_recurso, tipo, quantidade) VALUES (:id_recurso, :tipo, :quantidade)");
            $sql->bindParam(":id_recurso", $this->id, PDO::PARAM_INT);
            $sql->bindParam(":tipo", $this->tipo, PDO::PARAM_STR);
            $sql->bindParam(":quantidade", $this->quantidade, PDO::PARAM_STR);
            $sql->execute();

            $con->commit();
            return TRUE;
        } catch (PDOException $ex) {
            $con->rollback();
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

    public function buscarProduto($id)
    {
        $recurso = parent::buscar($id);

        $sql = $this->con->conectar()->prepare(
            "SELECT tipo, quantidade FROM produto WHERE id_recurso = :id"
        );
        $sql->bindParam(":id", $id, PDO::PARAM_INT);
        $sql->execute();
        $produto = $sql->fetch(PDO::FETCH_ASSOC);

        if ($recurso && $produto) {
            $produto = array_merge($recurso, $produto);
            return $produto;
        } else {
            return false;
        }
    }

    public function editarProduto($id, $nome, $descricao, $preco, $regiao, $ativo, $tipo, $quantidade)
    {
        try {
            $con = $this->con->conectar();
            $con->beginTransaction();

            $this->id = parent::editar($id, $nome, $descricao, $preco, $regiao, $ativo);

            $this->tipo = $tipo;
            $this->quantidade = $quantidade;

            $sql2 = $con->prepare("UPDATE produto SET tipo = :tipo, quantidade = :quantidade WHERE id_recurso = :id_recurso");
            $sql2->bindParam(":tipo", $this->tipo, PDO::PARAM_STR);
            $sql2->bindParam(":quantidade", $this->quantidade, PDO::PARAM_STR);
            $sql2->bindParam(":id_recurso", $this->id, PDO::PARAM_INT);
            $sql2->execute();

            $con->commit();
            return true;
        } catch (PDOException $ex) {
            $con->rollback();
            return 'ERRO: ' . $ex->getMessage();
        }
    }


    public function excluir($id){

        $produto = $this->buscarProduto($id);
        if (empty($produto)) {
            return false;
        }
        try {
            $this->con->conectar()->beginTransaction();

            $sqlS = $this->con->conectar()->prepare("DELETE FROM produto WHERE id_recurso = :id");
            $sqlS->bindParam(":id", $id, PDO::PARAM_INT);
            $sqlS->execute();

            $sqlR = $this->con->conectar()->prepare("DELETE FROM recurso WHERE id = :id");
            $sqlR->bindParam(":id", $id, PDO::PARAM_INT);
            $sqlR->execute();

            $this->con->conectar()->commit();
            return true;
        } catch (PDOException $ex) {
            $this->con->conectar()->rollback();
            return 'ERRO: ' . $ex->getMessage();
        }
    }
}
