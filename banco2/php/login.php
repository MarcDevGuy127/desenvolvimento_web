<?php
session_start();
require_once 'config.php';

$mensagem = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = trim($_POST['email']);
    $senha_usuario = $_POST['senha_usuario'];

    if (empty($email) || empty($senha_usuario)) {
        $mensagem = "Por favor, preencha todos os campos!";
    } else {
        // Buscar usuário pelo email
        $sql = "SELECT * FROM usuarios WHERE email = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$email]);
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
        
        // DEBUG: Verificar o que está vindo do banco
        echo "<pre>";
        echo "Email digitado: " . $email . "\n";
        echo "Senha digitada: " . $senha_usuario . "\n";
        echo "Usuário encontrado: ";
        print_r($usuario);
        
        if ($usuario) {
            echo "Hash no banco: " . $usuario['senha_usuario'] . "\n";
            echo "Verificação password_verify: ";
            var_dump(password_verify($senha_usuario, $usuario['senha_usuario']));
            
            // Tentativa alternativa: verificar senha em texto puro (se foi cadastrada sem hash)
            echo "Comparação direta: ";
            var_dump($senha_usuario === $usuario['senha_usuario']);
        }
        echo "</pre>";
        
        // Login bem-sucedido
        if ($usuario) {
            // Tentativa 1: Verificar com password_verify (senha com hash)
            if (password_verify($senha_usuario, $usuario['senha_usuario'])) {
                $_SESSION['usuario_id'] = $usuario['id'];
                $_SESSION['nome'] = $usuario['nome'];
                $_SESSION['email'] = $usuario['email'];
                $_SESSION['logado'] = true;
                
                header("Location: ../pages/tela_inicial.php");
                exit();
            }
            // Tentativa 2: Verificar diretamente (senha sem hash)
            else if ($senha_usuario === $usuario['senha_usuario']) {
                $_SESSION['usuario_id'] = $usuario['id'];
                $_SESSION['nome'] = $usuario['nome'];
                $_SESSION['email'] = $usuario['email'];
                $_SESSION['logado'] = true;
                
                header("Location: ../pages/tela_inicial.php");
                exit();
            }
            else {
                $mensagem = "Email ou senha incorretos!";
            }
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