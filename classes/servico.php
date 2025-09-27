<?php
require_once 'recurso.php';

class Servico extends Recurso
{
    private $duracao;
    private $categoria;

    public function __construct()
    {
        parent::__construct();
    }

    public function criarServico($nome, $descricao, $preco, $regiao, $id_fornecedor, $duracao, $categoria)
    {
        try {
            $con = $this->con->conectar();
            $con->beginTransaction();

            $this->id = parent::criar($nome, $descricao, $preco, $regiao, $id_fornecedor, $con);

            $this->duracao = $duracao;
            $this->categoria = $categoria;

            $sql = $con->prepare("INSERT INTO servico (id_recurso, duracao, categoria) VALUES (:id_recurso, :duracao, :categoria)");
            $sql->bindParam(":id_recurso", $this->id, PDO::PARAM_INT);
            $sql->bindParam(":duracao", $this->duracao, PDO::PARAM_STR);
            $sql->bindParam(":categoria", $this->categoria, PDO::PARAM_STR);
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
        $sql = $this->con->conectar()->prepare("SELECT r.id, r.nome, r.descricao, r.preco, r.regiao, r.ativo, s.duracao, s.categoria, r.id_fornecedor FROM recurso r INNER JOIN servico s ON r.id = s.id_recurso");
        $sql->execute();
        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }

    public function listarPorFornecedor($id_fornecedor)
    {
        $sql = $this->con->conectar()->prepare("SELECT r.id, r.nome, r.descricao, r.preco, r.regiao, r.ativo, s.duracao, s.categoria, r.id_fornecedor FROM recurso r INNER JOIN servico s ON r.id = s.id_recurso WHERE r.id_fornecedor = :id_fornecedor");
        $sql->bindParam(":id_fornecedor", $id_fornecedor, PDO::PARAM_INT);
        $sql->execute();
        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }

    public function buscarServico($id)
    {
        $recurso = parent::buscar($id);

        $sql = $this->con->conectar()->prepare(
            "SELECT duracao, categoria FROM servico WHERE id_recurso = :id"
        );
        $sql->bindParam(":id", $id, PDO::PARAM_INT);
        $sql->execute();
        $servico = $sql->fetch(PDO::FETCH_ASSOC);

        if ($recurso && $servico) {
            $servico = array_merge($recurso, $servico);
            return $servico;
        } else {
            return false;
        }
    }

    public function editarServico($id, $nome, $descricao, $preco, $regiao, $ativo, $duracao, $categoria)
    {
        try {
            $con = $this->con->conectar();
            $con->beginTransaction();

            $this->id = parent::editar($id, $nome, $descricao, $preco, $regiao, $ativo);
            
            $this->duracao = $duracao;
            $this->categoria = $categoria;

            $sql2 = $con->prepare("UPDATE servico SET duracao = :duracao, categoria = :categoria WHERE id_recurso = :id_recurso");
            $sql2->bindParam(":duracao", $this->duracao, PDO::PARAM_STR);
            $sql2->bindParam(":categoria", $this->categoria, PDO::PARAM_STR);
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

        $servico = $this->buscarServico($id);
        if (empty($servico)) {
            return false;
        }
        try {
            $this->con->conectar()->beginTransaction();

            $sqlS = $this->con->conectar()->prepare("DELETE FROM servico WHERE id_recurso = :id");
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