<?php
require_once 'recurso.php';

class Local extends Recurso
{
    private $endereco;
    private $capacidade;

    public function __construct()
    {
        parent::__construct();
    }

    public function criarLocal($nome, $descricao, $preco, $id_regiao, $id_fornecedor, $endereco, $capacidade) // ALTERADO
    {
        try {
            $con = $this->con->conectar();
            $con->beginTransaction();

            $this->id = parent::criar($nome, $descricao, $preco, $id_regiao, $id_fornecedor, $con); // ALTERADO

            $this->endereco = $endereco;
            $this->capacidade = $capacidade;

            $sql = $con->prepare("INSERT INTO local (id_recurso, endereco, capacidade) VALUES (:id_recurso, :endereco, :capacidade)");
            $sql->bindParam(":id_recurso", $this->id, PDO::PARAM_INT);
            $sql->bindParam(":endereco", $this->endereco, PDO::PARAM_STR);
            $sql->bindParam(":capacidade", $this->capacidade, PDO::PARAM_INT);
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
        // A query agora inclui o LEFT JOIN com a tabela regiao
        $sql = $this->con->conectar()->prepare("
        SELECT r.id, r.nome, r.descricao, r.preco, reg.nome AS nome_regiao, r.ativo, l.endereco, l.capacidade, r.id_fornecedor 
        FROM recurso r 
        INNER JOIN local l ON r.id = l.id_recurso
        LEFT JOIN regiao reg ON r.id_regiao = reg.id
    ");
        $sql->execute();
        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }

    public function listarPorFornecedor($id_fornecedor)
    {
        // A query agora inclui o LEFT JOIN com a tabela regiao
        $sql = $this->con->conectar()->prepare("
        SELECT r.id, r.nome, r.descricao, r.preco, reg.nome AS nome_regiao, r.ativo, l.endereco, l.capacidade, r.id_fornecedor 
        FROM recurso r 
        INNER JOIN local l ON r.id = l.id_recurso 
        LEFT JOIN regiao reg ON r.id_regiao = reg.id
        WHERE r.id_fornecedor = :id_fornecedor
    ");
        $sql->bindParam(":id_fornecedor", $id_fornecedor, PDO::PARAM_INT);
        $sql->execute();
        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }

    public function buscarLocal($id)
    {
        $recurso = parent::buscar($id);

        $sql = $this->con->conectar()->prepare(
            "SELECT endereco, capacidade FROM local WHERE id_recurso = :id"
        );
        $sql->bindParam(":id", $id, PDO::PARAM_INT);
        $sql->execute();
        $local = $sql->fetch(PDO::FETCH_ASSOC);

        if ($recurso && $local) {
            $local = array_merge($recurso, $local);
            return $local;
        } else {
            return false;
        }
    }

    public function editarLocal($id, $nome, $descricao, $preco, $id_regiao, $ativo, $endereco, $capacidade) // ALTERADO
    {
        try {
            $con = $this->con->conectar();
            $con->beginTransaction();

            parent::editar($id, $nome, $descricao, $preco, $id_regiao, $ativo, $con); // ALTERADO

            $sql2 = $con->prepare("UPDATE local SET endereco = :endereco, capacidade = :capacidade WHERE id_recurso = :id_recurso");
            $sql2->bindParam(":endereco", $endereco, PDO::PARAM_STR);
            $sql2->bindParam(":capacidade", $capacidade, PDO::PARAM_INT);
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
        $produto = $this->buscarLocal($id);
        if (empty($produto)) {
            return false;
        }
        try {
            $con = $this->con->conectar();
            $con->beginTransaction();

            $sqlS = $con->prepare("DELETE FROM local WHERE id_recurso = :id");
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

    public function listarPorRegiao($id_regiao)
    {
        try {
            $sql = $this->con->conectar()->prepare("
                SELECT r.id, r.nome 
                FROM recurso r 
                INNER JOIN local l ON r.id = l.id_recurso 
                WHERE r.id_regiao = :id_regiao AND r.ativo = 1
                ORDER BY r.nome ASC
            ");
            $sql->bindParam(":id_regiao", $id_regiao, PDO::PARAM_INT);
            $sql->execute();
            return $sql->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $ex) {
            return [];
        }
    }
}
