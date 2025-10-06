<?php
require_once 'conexao.php';

class Recurso
{
    protected $id;
    protected $nome;
    protected $descricao;
    protected $preco;
    protected $regiao;
    protected $ativo;
    protected $id_fornecedor;

    protected $con;

    protected function __construct()
    {
        $this->con = new Conexao();
    }

    protected function criar($nome, $descricao, $preco, $regiao, $id_fornecedor, $con = null)
    {
        try {
            if (!$con) {
                $con = $this->con->conectar();
            }

            $this->nome = $nome;
            $this->descricao = $descricao;
            $this->preco = $preco;
            $this->regiao = $regiao;
            $this->id_fornecedor = $id_fornecedor;

            $sql = $con->prepare("INSERT INTO recurso (nome, descricao, preco, regiao, ativo, id_fornecedor) VALUES (:nome, :descricao, :preco, :regiao, 1, :id_fornecedor)");
            $sql->bindParam(":nome", $nome, PDO::PARAM_STR);
            $sql->bindParam(":descricao", $descricao, PDO::PARAM_STR);
            $sql->bindParam(":preco", $preco);
            $sql->bindParam(":regiao", $regiao, PDO::PARAM_STR);
            $sql->bindParam(":id_fornecedor", $id_fornecedor, PDO::PARAM_INT);

            $sql->execute();

            return $con->lastInsertId();
        } catch (PDOException $ex) {
            throw $ex;
        }
    }

    public function editar($id, $nome, $descricao, $preco, $regiao, $ativo, $con = null)
    {
        try {
            if (!$con) {
                $con = $this->con->conectar();
            }

            $this->id = $id;
            $this->nome = $nome;
            $this->descricao = $descricao;
            $this->preco = $preco;
            $this->regiao = $regiao;
            $this->ativo = $ativo;

            $sql = $con->prepare("UPDATE recurso SET nome = :nome, descricao = :descricao, preco = :preco, regiao = :regiao, ativo = :ativo WHERE id = :id");
            $sql->bindParam(":id", $this->id, PDO::PARAM_INT);
            $sql->bindParam(":nome", $this->nome, PDO::PARAM_STR);
            $sql->bindParam(":descricao", $this->descricao, PDO::PARAM_STR);
            $sql->bindParam(":preco", $this->preco);
            $sql->bindParam(":regiao", $this->regiao, PDO::PARAM_STR);
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

            $sql = $con->prepare("SELECT * FROM recurso WHERE id = :id");
            $sql->bindParam(":id", $id, PDO::PARAM_INT);
            $sql->execute();

            $resultado = $sql->fetch(PDO::FETCH_ASSOC);
            return $resultado ? $resultado : null;
        } catch (PDOException $ex) {
            throw $ex;
        }
    }
}