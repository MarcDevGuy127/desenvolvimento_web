<?php
// Conexão com o banco usando PDO
$dsn = "mysql:host=localhost;dbname=plataforma_banco;charset=utf8";
$usuario = "root";
$senha = ""; // ajuste conforme o seu ambiente
try {
    $pdo = new PDO($dsn, $usuario, $senha);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Receber dados do formulário
    $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
    $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_SPECIAL_CHARS);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $telefone = filter_input(INPUT_POST, 'telefone', FILTER_SANITIZE_SPECIAL_CHARS);
    $pais = filter_input(INPUT_POST, 'pais', FILTER_SANITIZE_SPECIAL_CHARS);
    $uf = filter_input(INPUT_POST, 'uf', FILTER_SANITIZE_SPECIAL_CHARS);
    $cidade = filter_input(INPUT_POST, 'cidade', FILTER_SANITIZE_SPECIAL_CHARS);
    $complemento = filter_input(INPUT_POST, 'bairro', FILTER_SANITIZE_SPECIAL_CHARS);

    // Atualizar dados usando prepared statement
    $stmt = $pdo->prepare("
    UPDATE usuario 
    SET 
        nome = :nome,
        email = :email,
        telefone = :telefone,
        pais = :pais,
        uf = :uf,
        cidade = :cidade,
        complemento = :complemento
    WHERE id = :id
    ");

    $stmt->bindParam(':id', $id);
    $stmt->bindParam(':nome', $nome);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':telefone', $telefone);
    $stmt->bindParam(':pais', $pais);
    $stmt->bindParam(':uf', $uf);
    $stmt->bindParam(':cidade', $cidade);
    $stmt->bindParam(':complemento', $complemento);

    $stmt->execute();

    if ($stmt->execute()) {
        echo "Cadastro atualizado com sucesso!<br>";
        header("Location: index.php");
    } else {
        echo "Erro ao atualizar";
    }
} catch (PDOException $e) {
    echo "Erro de conexão: " . $e->getMessage();
}
?>