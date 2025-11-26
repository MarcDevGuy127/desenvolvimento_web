<?php
// definindo constantes para referenciar informações do banco de dados
define('DB_HOST', 'localhost');
define('DB_NAME', 'plataforma_banco');
define('DB_USER', 'root');
define('DB_PASS', '');

// tentando conexão com o banco, parametrizando os dados das constantes definidas
try {
    $pdo = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME.";charset=utf8", DB_USER, DB_PASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erro na conexão: " . $e->getMessage());
}
?>