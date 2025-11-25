<?php
require_once '../php/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    // coletando os dados preenchidos no formulário
    $nome  = $_POST['nome'] ?? '';
    $email = $_POST['email'] ?? '';
    $telefone = $_POST['telefone'] ?? '';
    $senha = $_POST['senha'] ?? '';
    $confirma_senha = $_POST['confirma_senha'] ?? '';

    // validação de senha
    if ($senha !== $confirma_senha) {
        echo "<script>alert('As senhas não coincidem!');</script>";
        exit;
    }

    // aplicando validação de email
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<script>alert('O email informado é inválido.');</script>";
        exit;
    }

    // aplicando tratamento nos dados
    $telefone = filter_var($telefone, FILTER_SANITIZE_SPECIAL_CHARS);

    // gerando hash seguro
    $senha_hash = password_hash($senha, PASSWORD_DEFAULT);

    //efetuando registro do usuário
    try {
        $stmt = $pdo->prepare("INSERT INTO usuario (nome, email, telefone, senha) VALUES (?, ?, ?, ?)");
        $stmt->execute([$nome, $email, $telefone, $senha_hash]);

        echo "<script>alert('Cadastro realizado com sucesso!');window.location.href = '../index.html';</script>";
        exit;

    } catch (PDOException $e) {
        echo "<script>alert('Erro ao cadastrar: " . addslashes($e->getMessage()) . "'); window.history.back();</script>";
        exit;
    }
}
?>