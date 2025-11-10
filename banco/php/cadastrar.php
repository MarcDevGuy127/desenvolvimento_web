<?php
// trazendo conexão com o banco
require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome  = $_POST['nome'];
    $email = $_POST['email'];
    $senha_usuario = password_hash($_POST['senha_usuario'], PASSWORD_DEFAULT);

    try {
        $stmt = $pdo->prepare("INSERT INTO usuarios (nome, email, senha_usuario) VALUES (?, ?, ?)");
        $stmt->execute([$nome, $email, $senha_usuario]);

        // Exibe um alerta e redireciona para index.html
        echo "<script>
                alert('Cadastro realizado com sucesso!');
                window.location.href = '../index.html';
              </script>";
        exit;

    } catch (PDOException $e) {
        echo "<script>
                alert('Erro ao cadastrar: " . addslashes($e->getMessage()) . "');
                window.history.back();
              </script>";
        exit;
    }
}

/*
try {
    $pdo = getConnection(); //conecta conexão


    // Receber dados do formulário
    $nome          = $_POST['nome'];
    $email         = $_POST['email'];
    $telefone      = $_POST['telefone'];
    $pais          = $_POST['pais'];
    $uf            = $_POST['uf'];
    $cidade        = $_POST['cidade'];
    $complemento   = $_POST['complemento'];
    $senha_usuario = $_POST['senha_usuario'];

    /* Inserir dados usando prepared statement
    $stmt = $pdo->prepare("INSERT INTO usuarios (nome, email, telefone, pais, uf, cidade, complemento, senha_usuario) VALUES (:nome, :email)");
    $stmt->bindParam(':nome', $nome);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':telefone', $telefone);
    $stmt->bindParam(':pais', $pais);
    $stmt->bindParam(':uf', $uf);
    $stmt->bindParam(':cidade', $cidade);
    $stmt->bindParam(':complemento', $complemento);
    $stmt->bindParam(':senha_usuario', $senha_usuario);

*/
?>