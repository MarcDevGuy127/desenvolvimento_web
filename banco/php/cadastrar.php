<?php
require_once '../php/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    // coletando os dados preenchidos no formulário
    $nome  = $_POST['nome'] ?? '';
    $email = $_POST['email'] ?? '';
    $telefone = $_POST['telefone'] ?? '';
    $pais = $_POST['pais'] ?? '';
    $uf = $_POST['uf'] ?? '';
    $cidade = $_POST['cidade'] ?? '';
    $bairro = $_POST['bairro'] ?? '';
    $complemento = $_POST['complemento'] ?? '';
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
    $pais = filter_var($pais, FILTER_SANITIZE_SPECIAL_CHARS);
    $uf = filter_var($uf, FILTER_SANITIZE_SPECIAL_CHARS);
    $cidade = filter_var($cidade, FILTER_SANITIZE_SPECIAL_CHARS);
    $bairro = filter_var($bairro, FILTER_SANITIZE_SPECIAL_CHARS);
    $complemento = filter_var($complemento, FILTER_SANITIZE_SPECIAL_CHARS);

    // gerando hash seguro
    $senha_hash = password_hash($senha, PASSWORD_DEFAULT);

    //efetuando registro do usuário
    try {
        $stmt = $pdo->prepare("INSERT INTO usuario (nome, email, telefone, pais, uf, cidade, bairro, complemento, senha) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([$nome, $email, $telefone, $pais, $uf, $cidade, $bairro, $complemento, $senha_hash]);

        echo "<script>alert('Cadastro realizado com sucesso!');window.location.href = '../index.html';</script>";
        exit;

    } catch (PDOException $e) {
        echo "<script>alert('Erro ao cadastrar: " . addslashes($e->getMessage()) . "'); window.history.back();</script>";
        exit;
    }
}
?>