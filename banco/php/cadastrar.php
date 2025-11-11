<?php
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
?>