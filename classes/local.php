<?php
require_once 'classes/conexao.php';

class Local extends Recurso
{
    private $endereco;
    private $capacidade;

    public function __construct()
    {
        parent::__construct();
    }

    public function criar($nome, $descricao, $preco, $regiao, $ativo, $id_fornecedor, $endereco, $capacidade)
    {
        try {
            $this->con->conectar()->beginTransaction();
            $this->nome = $nome;
            $this->descricao = $descricao;
            $this->preco = $preco;
            $this->regiao = $regiao;
            $this->ativo = $ativo;
            $this->id_fornecedor = $id_fornecedor;

            $this->endereco = $endereco;
            $this->capacidade = $capacidade;

            $sql = $this->con->conectar()->prepare("INSERT INTO recurso (nome, descricao, preco, regiao, ativo, id_fornecedor) VALUES (:nome, :descricao, :preco, :regiao, :ativo, :id_fornecedor)");
            $sql->bindParam(":nome", $this->nome, PDO::PARAM_STR);
            $sql->bindParam(":descricao", $this->descricao, PDO::PARAM_STR);
            $sql->bindParam(":preco", $this->preco, PDO::PARAM_STR);
            $sql->bindParam(":regiao", $this->regiao, PDO::PARAM_STR);
            $sql->bindParam(":ativo", $this->ativo, PDO::PARAM_STR);
            $sql->bindParam(":id_fornecedor", $this->id_fornecedor, PDO::PARAM_STR);
            $sql->execute();

            $this->id = $this->con->conectar()->lastInsertId();

            $sql = $this->con->conectar()->prepare("INSERT INTO local (id_recurso, endereco, capacidade) VALUES (:id_recurso, :endereco, :capacidade)");
            $sql->bindParam(":id_recurso", $this->id, PDO::PARAM_INT);
            $sql->bindParam(":endereco", $this->endereco, PDO::PARAM_STR);
            $sql->bindParam(":capacidade", $this->capacidade, PDO::PARAM_INT);
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
        $sql = $this->con->conectar()->prepare("SELECT r.id, r.nome, r.descricao, r.preco, r.regiao, r.ativo, l.endereco, l.capacidade, r.id_fornecedor FROM recurso r INNER JOIN local l ON r.id = l.id_recurso");
        $sql->execute();
        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }

    public function listarPorFornecedor($id_fornecedor)
    {
        $sql = $this->con->conectar()->prepare("SELECT r.id, r.nome, r.descricao, r.preco, r.regiao, r.ativo, l.endereco, l.capacidade, r.id_fornecedor FROM recurso r INNER JOIN local l ON r.id = l.id_recurso WHERE r.id_fornecedor = :id_fornecedor");
        $sql->bindParam(":id_fornecedor", $id_fornecedor, PDO::PARAM_INT);
        $sql->execute();
        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }
}
