<?php
//3. criando cadastro

require 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = trim($_POST['nome']);
    $senha = trim($_POST['senha']);

    if (!empty($nome) && !empty($senha)) {
        $senhaHash = password_hash($senha, PASSWORD_DEFAULT);

        $stmt = $pdo->prepare("INSERT INTO usuarios (nome, senha) VALUES (:nome, :senha)");
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':senha', $senhaHash);

        try {
            $stmt->execute();
            echo "<script>alert('Cadastro realizado com sucesso!'); window.location.href='login.php';</script>";
        } catch (PDOException $e) {
            echo "<script>alert('Usuário já existe!');</script>";
        }
    } else {
        echo "<script>alert('Preencha todos os campos!');</script>";
    }
}
?>

<form method="POST">
    <h2>Cadastrar Usuário</h2>
    <label>Nome:</label><br>
    <input type="text" name="nome" required><br><br>
    <label>Senha:</label><br>
    <input type="password" name="senha" required><br><br>
    <button type="submit">Cadastrar</button>
</form>
<a href="login.php">Já tenho conta</a>
