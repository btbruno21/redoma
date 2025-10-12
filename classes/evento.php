<?php
require_once 'conexao.php';

class Evento
{
    private $id;
    private $nivel_planejamento;
    private $tipo_evento;
    private $data_estimada1;
    private $data_estimada2;
    private $local;
    private $orcamento;
    private $qnt_pessoas;
    private $observacoes;
    private $id_cliente;
    private $id_regiao; // Adicionado para consistência com as outras tabelas

    private $con;

    public function __construct()
    {
        $this->con = new Conexao();
    }

    public function criarEvento($nivel_planejamento, $tipo_evento, $data_estimada1, $data_estimada2, $local, $orcamento, $qnt_pessoas, $observacoes, $id_cliente, $id_regiao)
    {
        try {
            $this->nivel_planejamento = $nivel_planejamento;
            $this->tipo_evento = $tipo_evento;
            $this->data_estimada1 = $data_estimada1;
            $this->data_estimada2 = $data_estimada2;
            $this->local = $local;
            $this->orcamento = $orcamento;
            $this->qnt_pessoas = $qnt_pessoas;
            $this->observacoes = $observacoes;
            $this->id_cliente = $id_cliente;
            $this->id_regiao = $id_regiao;

            $sql = $this->con->conectar()->prepare("INSERT INTO evento(nivel_planejamento, tipo_evento, data_estimada1, data_estimada2, local, orcamento, qnt_pessoas, observacoes, id_cliente, id_regiao) VALUES (:nivel_planejamento, :tipo_evento, :data1, :data2, :local, :orcamento, :qnt_pessoas, :observacoes, :id_cliente, :id_regiao)");

            $sql->bindParam(":nivel_planejamento", $this->nivel_planejamento, PDO::PARAM_STR);
            $sql->bindParam(":tipo_evento", $this->tipo_evento, PDO::PARAM_STR);
            $sql->bindParam(":data1", $this->data_estimada1, PDO::PARAM_STR);
            $sql->bindParam(":data2", $this->data_estimada2, PDO::PARAM_STR);
            $sql->bindParam(":local", $this->local, PDO::PARAM_STR);
            $sql->bindParam(":orcamento", $this->orcamento, PDO::PARAM_STR);
            $sql->bindParam(":qnt_pessoas", $this->qnt_pessoas, PDO::PARAM_INT);
            $sql->bindParam(":observacoes", $this->observacoes, PDO::PARAM_STR);
            $sql->bindParam(":id_cliente", $this->id_cliente, PDO::PARAM_INT);
            $sql->bindParam(":id_regiao", $this->id_regiao, PDO::PARAM_INT);
            $sql->execute();

            return TRUE;
        } catch (PDOException $ex) {
            return 'ERRO: ' . $ex->getMessage();
        }
    }

    public function listar()
    {
        try {
            $sql = $this->con->conectar()->prepare("SELECT * FROM evento ORDER BY id ASC");
            $sql->execute();
            return $sql->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $ex) {
            return 'ERRO: ' . $ex->getMessage();
        }
    }

    public function buscarEvento($id)
    {
        try {
            $sql = $this->con->conectar()->prepare("SELECT * FROM evento WHERE id = :id");
            $sql->bindParam(":id", $id, PDO::PARAM_INT);
            $sql->execute();
            $evento = $sql->fetch(PDO::FETCH_ASSOC);

            return $evento ? $evento : false;
        } catch (PDOException $ex) {
            return 'ERRO: ' . $ex->getMessage();
        }
    }

    public function editarEvento($id, $nivel_planejamento, $tipo_evento, $data_estimada1, $data_estimada2, $local, $orcamento, $qnt_pessoas, $observacoes, $id_regiao)
    {
        try {
            $sql = $this->con->conectar()->prepare("UPDATE evento SET nivel_planejamento = :nivel, tipo_evento = :tipo, data_estimada1 = :data1, data_estimada2 = :data2, local = :local, orcamento = :orcamento, qnt_pessoas = :qnt, observacoes = :obs, id_regiao = :id_regiao WHERE id = :id");

            $sql->bindParam(":id", $id, PDO::PARAM_INT);
            $sql->bindParam(":nivel", $nivel_planejamento, PDO::PARAM_STR);
            $sql->bindParam(":tipo", $tipo_evento, PDO::PARAM_STR);
            $sql->bindParam(":data1", $data_estimada1, PDO::PARAM_STR);
            $sql->bindParam(":data2", $data_estimada2, PDO::PARAM_STR);
            $sql->bindParam(":local", $local, PDO::PARAM_STR);
            $sql->bindParam(":orcamento", $orcamento, PDO::PARAM_STR);
            $sql->bindParam(":qnt", $qnt_pessoas, PDO::PARAM_INT);
            $sql->bindParam(":obs", $observacoes, PDO::PARAM_STR);
            $sql->bindParam(":id_regiao", $id_regiao, PDO::PARAM_INT);
            $sql->execute();

            return true;
        } catch (PDOException $ex) {
            return 'ERRO: ' . $ex->getMessage();
        }
    }

    public function excluir($id)
    {
        $evento = $this->buscarEvento($id);
        if (empty($evento)) {
            return false;
        }

        try {
            $sql = $this->con->conectar()->prepare("DELETE FROM evento WHERE id = :id");
            $sql->bindParam(":id", $id, PDO::PARAM_INT);
            $sql->execute();

            return true;
        } catch (PDOException $ex) {
            return 'ERRO: ' . $ex->getMessage();
        }
    }
}