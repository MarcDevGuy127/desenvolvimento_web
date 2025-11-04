<?php
// Conexão com o banco usando PDO
$dsn = "mysql:host=localhost;dbname=plataforma_banco;charset=utf8";
$usuario = "root";
$senha = ""; // ajuste conforme o seu ambiente
try {
    $pdo = new PDO($dsn, $usuario, $senha);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // Receber dados do formulário
    $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_SPECIAL_CHARS);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $telefone = filter_input(INPUT_POST, 'telefone', FILTER_SANITIZE_SPECIAL_CHARS);
    $pais = filter_input(INPUT_POST, 'pais', FILTER_SANITIZE_SPECIAL_CHARS);
    $uf = filter_input(INPUT_POST, 'uf', FILTER_SANITIZE_SPECIAL_CHARS);
    $cidade = filter_input(INPUT_POST, 'cidade', FILTER_SANITIZE_SPECIAL_CHARS);
    $complemento = filter_input(INPUT_POST, 'bairro', FILTER_SANITIZE_SPECIAL_CHARS);

    // Inserir dados usando prepared statement
    $stmt = $pdo->prepare("INSERT INTO usuarios (nome, email, telefone, pais, uf, cidade, complemento) VALUES (:nome, :email)");
    $stmt->bindParam(':nome', $nome);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':telefone', $telefone);
    $stmt->bindParam(':pais', $pais);
    $stmt->bindParam(':uf', $uf);
    $stmt->bindParam(':cidade', $cidade);
    $stmt->bindParam(':complemento', $complemento);

    if ($stmt->execute()) {
        echo "Cadastro realizado com sucesso!<br>";
    } else {
        echo "Erro ao cadastrar";
    }
} catch (PDOException $e) {
    echo "Erro de conexão: " . $e->getMessage();
}
?>