<?php
require_once '../php/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome  = $_POST['nome'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];
    $pais = $_POST['pais'];
    $uf = $_POST['uf'];
    $cidade = $_POST['cidade'];
    $bairro = $_POST['bairro'];
    $complemento = $_POST['complemento'];
    $senha = $_POST['senha'];
    $confirma_senha = $_POST['confirma_senha'];

    if ($senha == $confirma_senha) {

        $senha = password_hash($senha, PASSWORD_DEFAULT);
        echo "
        <script>
            alert('As senhas não coincidem. Tente novamente.');
        </script>";
        exit;
    }

    if ($senha !== $confirma_senha) {
        echo "
        <script>
            alert('As senhas não coincidem. Tente novamente.');
        </script>";
        exit;
    }

    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "
        <script>
            alert('O email informado é inválido. Tente novamente.');
        </script>";
        exit;
    }

    if (empty($telefone) || !filter_var($telefone, FILTER_SANITIZE_SPECIAL_CHARS)) {
        echo "
        <script>
            alert('O telefone informado é inválido. Tente novamente.');
        </script>";
        exit;
    }

    if (empty($pais) || !filter_var($pais, FILTER_SANITIZE_SPECIAL_CHARS)) {
        echo "
        <script>
            alert('O país informado é inválido. Tente novamente.');
        </script>";
        exit;
    }

    if (empty($uf) || !filter_var($uf, FILTER_SANITIZE_SPECIAL_CHARS)) {
        echo "
        <script>
            alert('A unidade federativa informada é inválida. Tente novamente.');
        </script>";
        exit;
    }

    if (empty($cidade) || !filter_var($cidade, FILTER_SANITIZE_SPECIAL_CHARS)) {
        echo "
        <script>
            alert('A cidade informada é inválida. Tente novamente.');
        </script>";
        exit;
    }

    if (empty($bairro) || !filter_var($bairro, FILTER_SANITIZE_SPECIAL_CHARS)) {
        echo "
        <script>
            alert('O bairro informado é inválido. Tente novamente.');
        </script>";
        exit;
    }

    if (empty($complemento) || !filter_var($complemento, FILTER_SANITIZE_SPECIAL_CHARS)) {
        echo "
        <script>
            alert('O complemento informado é inválido. Tente novamente.');
        </script>";
        exit;
    }

    try {
        $stmt = $pdo->prepare("INSERT INTO usuario (nome, email, telefone, pais, uf, cidade, bairro, complemento, senha, confirma_senha) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([$nome, $email, $telefone, $pais, $uf, $cidade, $bairro, $complemento, $senha, $confirma_senha]);

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