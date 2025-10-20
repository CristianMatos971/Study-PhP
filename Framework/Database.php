<?php

namespace Framework;

use Exception;
use PDO;
use PDOException;
use Throwable;

class Database
{
    public $conn;

    /**
     * Construtor da classe Database para se conectar com banco de dados
     *
     * @param [type] $config
     */
    public function __construct($config)
    {
        $host = $config['host'];
        $port = $config['port'];
        $dbname = $config['dbname'];
        $user = $config['user'];
        $password = $config['password'];

        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
        ];
        $dsn = "pgsql:host=$host;port=$port;dbname=$dbname";
        try {
            $this->conn = new PDO($dsn, $user, $password, $options);
            $this->conn->exec("SET search_path TO workopia, public");
            //echo 'connected sucessfully to database';
        } catch (PDOException $e) {
            throw new Exception("Database connection failed: {$e->getMessage()}");
        }
    }

    public function query($sql, $params = [])
    {
        try {
            $stmt = $this->conn->prepare($sql);

            //conectar os parametros à preparedStatements nomeados
            foreach ($params as $param => $value) {
                $stmt->bindValue(':' . $param, $value);
            }

            $stmt->execute();
            return $stmt;
        } catch (Throwable $e) {
            throw new Exception("Database connection failed: {$e->getMessage()}");
        }
    }
}
