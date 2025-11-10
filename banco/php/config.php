<?php
//definindo config
define('DB_HOST', 'localhost');
define('DB_NAME', 'plataforma_banco');
define('DB_USER', 'root');
define('DB_PASS', '');

// Iniciar sessão
session_start();

function getConnection() {
    try {
        $pdo = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME.";charset=utf8",
        DB_USER,
        DB_PASS,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false
        ]
    );
    return $pdo;
    //metodo anterior de: $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        error_log("Erro de conexão: " . $e->getMessage()); //log de erros
        die("Erro na conexão: " . $e->getMessage());
    }
}

// Função para verificar se o usuário está logado
function estaLogado() {
    return isset($_SESSION['email']);
}

// Função para redirecionar se não estiver logado
function solicitaLogin() {
    if (!estaLogado()) {
        header('Location: ../index.html');
        exit;
    }
}

// Função para sanitizar dado
function tratar($dado) {
    return htmlspecialchars(strip_tags(trim($dado)));
}

// Função para validar email
function emailValido($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

// Função para gerar hash de senha
function hashSenha($senha_usuario) {
    return password_hash($senha_usuario, PASSWORD_DEFAULT);
}

// Função para verificar senha
function verificaSenha($senha_usuario, $hash) {
    return password_verify($senha_usuario, $hash);
}
?>