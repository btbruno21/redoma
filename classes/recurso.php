<?php
require_once 'classes/conexao.php';

class Recurso{
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
}