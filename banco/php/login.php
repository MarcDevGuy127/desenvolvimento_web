<?php
session_start();
require_once 'config.php'; // ajuste se necessário

$mensagem = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // sanitiza e coletar dados
    $email = trim($_POST['email'] ?? '');
    $senha = $_POST['senha'] ?? '';

    // verificar campos vazios
    if (empty($email) || empty($senha)) {
        $mensagem = "Por favor, preencha todos os campos!";
    } else {

        // buscar usuário por email
        $sql = "SELECT * FROM usuario WHERE email = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$email]);
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

        // depuração opcional:
        /*
        var_dump($email);
        var_dump($senha);
        var_dump($usuario['senha'] ?? null);
        exit;
        */

        // validar login
        if ($usuario && password_verify($senha, $usuario['senha'])) {

            // criar sessão
            $_SESSION['id'] = $usuario['id'];
            $_SESSION['nome'] = $usuario['nome'];
            $_SESSION['email'] = $usuario['email'];
            $_SESSION['logado'] = true;

            header("Location: tela_inicial.php");
            exit;

        } else {
            $mensagem = "Email ou senha incorretos!";
        }
    }
}

// exibir erro e voltar ao início
if (!empty($mensagem)) {
    echo "<script>alert('$mensagem'); window.location.href = '../index.html';</script>";
    exit;
}
?>
