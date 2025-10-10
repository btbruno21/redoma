<?php

require_once 'conexao.php';

class Agenda
{
    private $con;

    public function __construct()
    {
        $this->con = new Conexao();
    }

    /*Lista todos os eventos confirmados para um determinado fornecedor.*/
    public function listarEventosPorFornecedor(int $id)
    {
        try {
            // A consulta SQL permanece a mesma.
            $sql = $this->con->conectar()->prepare("
                SELECT 
                    fornecedor.nome_fantasia AS nome_fornecedor, 
                    recurso.nome AS nome_recurso, 
                    evento_recurso.horario, 
                    COALESCE(evento_recurso.data_final, evento.data_estimada1) AS data_evento,
                    evento_recurso.observacoes, 
                    evento_recurso.status 
                FROM evento_recurso
                INNER JOIN recurso ON evento_recurso.id_recurso = recurso.id
                INNER JOIN fornecedor ON recurso.id_fornecedor = fornecedor.id_usuario
                INNER JOIN evento ON evento_recurso.id_evento = evento.id
                WHERE
                    evento_recurso.status = 'confirmado'
                    AND fornecedor.id_usuario = :id_usuario
            ");
            
            // Vincula o parâmetro :id_usuario ao valor da variável $id.
            $sql->bindParam(":id_usuario", $id, PDO::PARAM_INT);
            
            // Executa a consulta.
            $sql->execute();
            
            // Retorna todos os resultados como um array associativo.
            return $sql->fetchAll(PDO::FETCH_ASSOC);

        } catch (PDOException $e) {
            return [];
        }
    }
}