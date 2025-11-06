<?php
require_once 'conexao.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome  = $_POST['nome'];
    $email = $_POST['email'];
    $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);

    try {
        $stmt = $pdo->prepare("INSERT INTO usuarios (nome, email, senha) VALUES (?, ?, ?)");
        $stmt->execute([$nome, $email, $senha]);

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
