<?php
// arquivo php destinado para configurações.
// Definindo constantes de conexão com o banco
define('DB_HOST', 'localhost');      // especificando servidor local XAMPP
define('DB_USER', 'root');           // especificando usuário padrão do MySQL no XAMPP
define('DB_PASS', '');               // especificando senha de acesso ao banco padrão (vazia)
define('DB_NAME', 'plataforma_banco');      // especificando nome do banco

/*
// configurações de constantes extras

// Configurações de email
define('SMTP_HOST', '');
define('SMTP_PORT', 'numeroaqui');
define('SMTP_USER', '');
define('SMTP_PASS', '');
define('SMTP_FROM', '');
define('SMTP_FROM_NAME', 'nomeaqui');

// Configurações gerais
define('SITE_URL', 'https://site.com.br');
define('UPLOAD_PATH', 'pasta'); */

// Iniciar sessão
session_start();

// Função para conectar ao banco de dados
function getConnection() {
    try {
        $pdo = new PDO(
            "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8mb4",
            DB_USER,
            DB_PASS,
            [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false
            ]
        );
        return $pdo;
    } catch (PDOException $e) {
        error_log("Erro de conexão: " . $e->getMessage());
        die("Erro de conexão com o banco de dados");
    }
}

// Função para verificar se o usuário está logado
function isLoggedIn() {
    return isset($_SESSION['usuario']);
}

// Função para redirecionar se não estiver logado
function requireLogin() {
    if (!isLoggedIn()) {
        header('Location: ../index.html');//se não logado vai para a tela de login
        exit;
    }
}

/* Função para sanitizar dados
function sanitize($data) {
    return htmlspecialchars(strip_tags(trim($data)));
}*/

// Função para validar email
function isValidEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

// Função para gerar hash de senha
function hashPassword($senha) {
    return password_hash($senha, PASSWORD_DEFAULT);
}

// Função para verificar senha
function verifyPassword($senha, $hash) {
    return password_verify($senha, $hash);
}
?>