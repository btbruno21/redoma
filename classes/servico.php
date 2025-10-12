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

    public function criarServico($nome, $descricao, $preco, $id_regiao, $id_fornecedor, $duracao, $categoria) // ALTERADO
    {
        try {
            $con = $this->con->conectar();
            $con->beginTransaction();

            $this->id = parent::criar($nome, $descricao, $preco, $id_regiao, $id_fornecedor, $con); // ALTERADO

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

    // ... dentro da classe Servico ...

    public function listar()
    {
        $sql = $this->con->conectar()->prepare("
        SELECT r.id, r.nome, r.descricao, r.preco, reg.nome AS nome_regiao, r.ativo, s.duracao, s.categoria, r.id_fornecedor 
        FROM recurso r 
        INNER JOIN servico s ON r.id = s.id_recurso
        LEFT JOIN regiao reg ON r.id_regiao = reg.id
    ");
        $sql->execute();
        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }

    public function listarPorFornecedor($id_fornecedor)
    {
        $sql = $this->con->conectar()->prepare("
        SELECT r.id, r.nome, r.descricao, r.preco, reg.nome AS nome_regiao, r.ativo, s.duracao, s.categoria, r.id_fornecedor 
        FROM recurso r 
        INNER JOIN servico s ON r.id = s.id_recurso 
        LEFT JOIN regiao reg ON r.id_regiao = reg.id
        WHERE r.id_fornecedor = :id_fornecedor
    ");
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

    public function editarServico($id, $nome, $descricao, $preco, $id_regiao, $ativo, $duracao, $categoria) // ALTERADO
    {
        try {
            $con = $this->con->conectar();
            $con->beginTransaction();

            parent::editar($id, $nome, $descricao, $preco, $id_regiao, $ativo, $con); // ALTERADO

            $this->duracao = $duracao;
            $this->categoria = $categoria;

            $sql2 = $con->prepare("UPDATE servico SET duracao = :duracao, categoria = :categoria WHERE id_recurso = :id_recurso");
            $sql2->bindParam(":duracao", $this->duracao, PDO::PARAM_STR);
            $sql2->bindParam(":categoria", $this->categoria, PDO::PARAM_STR);
            $sql2->bindParam(":id_recurso", $id, PDO::PARAM_INT);
            $sql2->execute();

            $con->commit();
            return true;
        } catch (PDOException $ex) {
            $con->rollback();
            return 'ERRO: ' . $ex->getMessage();
        }
    }

    public function excluir($id)
    {
        $servico = $this->buscarServico($id);
        if (empty($servico)) {
            return false;
        }
        try {
            $con = $this->con->conectar();
            $con->beginTransaction();

            $sqlS = $con->prepare("DELETE FROM servico WHERE id_recurso = :id");
            $sqlS->bindParam(":id", $id, PDO::PARAM_INT);
            $sqlS->execute();

            $sqlR = $con->prepare("DELETE FROM recurso WHERE id = :id");
            $sqlR->bindParam(":id", $id, PDO::PARAM_INT);
            $sqlR->execute();

            $con->commit();
            return true;
        } catch (PDOException $ex) {
            $con->rollback();
            return 'ERRO: ' . $ex->getMessage();
        }
    }
}
