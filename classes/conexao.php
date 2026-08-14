<?php
require __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/..');
$dotenv->load();

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
        $this->servidor = $_ENV['DB_HOST'];
        $this->banco = $_ENV['DB_DATABASE'];
        $this->usuario = $_ENV['DB_USERNAME'];
        $this->senha = $_ENV['DB_PASSWORD'];
        $this->port = $_ENV['DB_PORT'];
    }

    public function conectar()
    {
        try {
            if (is_null(self::$pdo)) {
                self::$pdo = new PDO("mysql:host=" . $this->servidor . ";port=" . $this->port . ";dbname=" . $this->banco, $this->usuario, $this->senha);
            }
            // echo "Conectou!!";
            return self::$pdo;
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
    }
}
