<?php
class Conexao
{
    private $usuario;
    private $senha;
    private $banco;
    private $servidor;
    private $port;

    private static $pdo;

    public function __construct()
    {
        $this->servidor = "localhost";
        $this->banco = "redoma";
        $this->usuario = "root";
        $this->senha = "";
        $this->port = 3307;
    }

    public function conectar()
    {
        try {
            if (is_null(self::$pdo)) {
                self::$pdo = new PDO("mysql:host=" . $this->servidor . ";port=" . $this->port . ";dbname=" . $this->banco, $this->usuario, $this->senha);
            }
            echo "Conectou!!";
            return self::$pdo;
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
    }
}
