<?php
require_once 'config.php';
session_start();

$mensagem = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = trim($_POST['email']);
    $senha_usuario = trim($_POST['senha_usuario']);

    // Verifica se os campos foram preenchidos
    if (empty($email) || empty($senha_usuario)) {
        echo "<script>alert('Por favor, preencha todos os campos!'); window.location.href = '../index.html';</script>";
        exit;
    }

    // Busca o usuário pelo email
    $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE email = :email");
    $stmt->bindParam(':email', $email);
    $stmt->execute();

    // Se encontrou o usuário
    if ($stmt->rowCount() > 0) {
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

        // Verifica a senha (comparando com a hash do banco)
        if (password_verify($senha_usuario, $usuario['senha_usuario'])) {
            $_SESSION['email'] = $usuario['email'];
            header("Location: ../pages/tela_inicial.php");
            exit;
        } else {
            echo "<script>alert('Senha incorreta!'); window.location.href = '../index.html';</script>";
            exit;
        }
    } else {
        echo "<script>alert('Usuário não encontrado!'); window.location.href = '../index.html';</script>";
        exit;
    }
}
?>
