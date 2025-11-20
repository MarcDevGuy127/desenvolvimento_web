<?php
require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome  = $_POST['nome'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];
    $pais = $_POST['pais'];
    $uf = $_POST['uf'];
    $cidade = $_POST['cidade'];
    $bairro = $_POST['bairro'];
    $complemento = $_POST['complemento'];
    $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);
    $confirma_senha = password_hash($_POST['confirma_senha'], PASSWORD_DEFAULT);

    if ($senha !== $confirma_senha) {
        echo "alert('As senhas não coincidem. Tente novamente.')";
        exit;
    }

    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "alert('O email informado é inválido. Tente novamente.')";
        exit;
    }

    if (empty($telefone) || !filter_var($telefone, FILTER_SANITIZE_SPECIAL_CHARS)) {
        echo "alert('O telefone informado é inválido. Tente novamente.')";
        exit;
    }

    if (empty($pais) || !filter_var($pais, FILTER_SANITIZE_SPECIAL_CHARS)) {
        echo "alert('O país informado é inválido. Tente novamente.')";
        exit;
    }

    if (empty($uf) || !filter_var($uf, FILTER_SANITIZE_SPECIAL_CHARS)) {
        echo "alert('A unidade federativa informada é inválida. Tente novamente.')";
        exit;
    }

    if (empty($cidade) || !filter_var($cidade, FILTER_SANITIZE_SPECIAL_CHARS)) {
        echo "alert('A cidade informada é inválida. Tente novamente.')";
        exit;
    }

    if (empty($bairro) || !filter_var($bairro, FILTER_SANITIZE_SPECIAL_CHARS)) {
        echo "alert('O bairro informado é inválido. Tente novamente.')";
        exit;
    }

    if (empty($complemento) || !filter_var($complemento, FILTER_SANITIZE_SPECIAL_CHARS)) {
        echo "alert('O complemento informado é inválido. Tente novamente.')";
        exit;
    }

    try {
        $stmt = $pdo->prepare("INSERT INTO usuario (nome, email, senha, confirma_senha) VALUES (?, ?, ?, ?)");
        $stmt->execute([$nome, $email, $senha, $confirma_senha]);

        // exibindo um alert de conclusão e redirecionando para index.html
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