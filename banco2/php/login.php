<?php
session_start();
require_once 'config.php';

$mensagem = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = trim($_POST['email']);
    $senha_usuario = $_POST['senha_usuario'];

    // Correção: usar a mesma variável do formulário
    if (empty($email) || empty($senha_usuario)) {
        $mensagem = "Por favor, preencha todos os campos!";
    } else {
        // Buscar usuário pelo email
        $sql = "SELECT * FROM usuarios WHERE email = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$email]);
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
        
        // Correção: usar $senha_usuario que vem do formulário
        if ($usuario && password_verify($senha_usuario, $usuario['senha_usuario'])) {
            // Login bem-sucedido
            $_SESSION['usuario_id'] = $usuario['id'];
            $_SESSION['nome'] = $usuario['nome'];
            $_SESSION['email'] = $usuario['email'];
            $_SESSION['logado'] = true;
            
            // Correção: redirecionar para o PHP, não para HTML
            header("Location: ../pages/tela_inicial.php");
            exit();
        } else {
            $mensagem = "Email ou senha incorretos!";
        }
    }
}

// Se houver mensagem de erro, mostra no HTML
if (!empty($mensagem)) {
    echo "<script>alert('$mensagem'); window.location.href = '../index.html';</script>";
}
?>