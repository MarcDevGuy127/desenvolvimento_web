<?php
session_start();
require_once 'config.php';

$mensagem = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = trim($_POST['email']);
    $senha = $_POST['senha'];

    if (empty($email) || empty($senha)) {
        $mensagem = "Por favor, preencha todos os campos!";
    } else {
        // Buscar usuário pelo email
        $sql = "SELECT * FROM usuario WHERE email = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$email]);
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($usuario && password_verify($senha, $usuario['senha_usuario'])) {
            // Login bem-sucedido
            $_SESSION['id'] = $usuario['id'];
            $_SESSION['nome'] = $usuario['nome'];
            $_SESSION['email'] = $usuario['email'];
            $_SESSION['logado'] = true;
            
            header("Location: ../php/tela_inicial.php");
            exit();
        } else {
            $mensagem = "Email ou senha incorretos!";
        }
    }
}

// Se houver mensagem de erro, mostra no HTML
if (!empty($mensagem)) {
    echo "<script>alert('$mensagem'); window.location.href = '../index.html';</script>";
    exit();
}
?>