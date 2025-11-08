<?php
require_once 'config.php';
session_start();

$mensagem = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = trim($_POST['email']);
    $senha_usuario = $_POST['senha_usuario'];

    $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE nome = :nome");
    $stmt->bindParam(':nome', $nome);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

        //verificando login de usuário, com usuario e senha correspondente
        if (password_verify($senha_usuario, $usuario['senha_usuario'])) {
            $_SESSION['usuario'] = $usuario['nome'];
            header("Location: tela_inicial.php");
            exit;
        } else {
            echo "<script>alert('Senha incorreta!');</script>";
        }
    } else {
        echo "<script>alert('Usuário não encontrado!');</script>";
    }

    //verificando se os campos foram preenchidos
    if (empty($email) || empty($senha_usuario)) {
        $mensagem = "Por favor, preencha todos os campos!";
    }
}

/*
$_SESSION['id'] = $usuario['id'];
$_SESSION['nome'] = $usuario['nome'];
$_SESSION['email'] = $usuario['email'];
$_SESSION['logado'] = true;
            
header("Location: ../pages/tela_inicial.php");
exit();*/

// Se houver mensagem de erro, mostra no HTML
if (!empty($mensagem)) {
    echo "<script>alert('$mensagem'); window.location.href = '../index.html';</script>";
    exit;
}
?>