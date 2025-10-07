<?php

$host = "localhost";
$port = "5432";
$dbname = "first_php_project";
$user = "postgres";
$password = "postgres";

try {
    $pdo = new PDO("pgsql:host=$host;port=$port;dbname=$dbname", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->exec("SET search_path TO blog");
} catch (PDOException $e) {
    echo "Erro: " . $e->getMessage() . '<br/>';
}
