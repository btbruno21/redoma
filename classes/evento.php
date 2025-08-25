<?php
require 'conexao.php';

class Evento
{
    private $id;
    private $nivel_planejamento;
    private $tipo_evento;
    private $data1;
    private $data2;
    private $local;
    private $orcamento;
    private $qnt_pessoas;
    private $observacoes;

    private $con;

    public function __construct()
    {
        $this->con = new Conexao();
    }

    public function criarEvento($nivel_planejamento, $tipo_evento, $data1, $data2, $local, $orcamento, $qnt_pessoas, $observacoes)
    {

        try {
            $this->nivel_planejamento = $nivel_planejamento;
            $this->tipo_evento = $tipo_evento;
            $this->data1 = $data1;
            $this->data2 = $data2;
            $this->local = $local;
            $this->orcamento = $orcamento;
            $this->qnt_pessoas = $qnt_pessoas;
            $this->observacoes = $observacoes;

            $sql = $this->con->conectar()->prepare("INSERT INTO evento(nivel_planejamento, tipo_evento, data_estimada1, data_estimada2, local, orcamento, qnt_pessoas, observacoes) VALUES (:nivel_planejamento, :tipo_evento, :data1, :data2, :local, :orcamento, :qnt_pessoas, :observacoes)");

            $sql->bindParam(":nivel_planejamento", $this->nivel_planejamento, PDO::PARAM_STR);
            $sql->bindParam(":tipo_evento", $this->tipo_evento, PDO::PARAM_STR);
            $sql->bindParam(":data1", $this->data1, PDO::PARAM_STR);
            $sql->bindParam(":data2", $this->data2, PDO::PARAM_STR);
            $sql->bindParam(":local", $this->local, PDO::PARAM_STR);
            $sql->bindParam(":orcamento", $this->orcamento, PDO::PARAM_STR);
            $sql->bindParam(":qnt_pessoas", $this->qnt_pessoas, PDO::PARAM_STR);
            $sql->bindParam(":observacoes", $this->observacoes, PDO::PARAM_STR);
            $sql->execute();

            return array('status' => 'criado');
        } catch (PDOException $ex) {
            return array('status' => 'erro', 'mensagem' => $ex->getMessage());
        }
    }
}