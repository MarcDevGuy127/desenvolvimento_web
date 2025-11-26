<?php
require_once '../php/config.php'; // refenciando arquivo config

// validando dados filtrados
$id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
$nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_SPECIAL_CHARS);
$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
$telefone = filter_input(INPUT_POST, 'telefone', FILTER_SANITIZE_SPECIAL_CHARS);
$pais = filter_input(INPUT_POST, 'pais', FILTER_SANITIZE_SPECIAL_CHARS);
$uf = filter_input(INPUT_POST, 'uf', FILTER_SANITIZE_SPECIAL_CHARS);
$cidade = filter_input(INPUT_POST, 'cidade', FILTER_SANITIZE_SPECIAL_CHARS);
$bairro = filter_input(INPUT_POST, 'bairro', FILTER_SANITIZE_SPECIAL_CHARS);
$complemento = filter_input(INPUT_POST, 'complemento', FILTER_SANITIZE_SPECIAL_CHARS);

// se id, nome ou email forem diferentes, os dados são inválidos.
if (!$id || !$nome || !$email) {
    echo "<script>
        alert('Dados inválidos.');
        window.location.href = '../php/editar_info.php?id=$id';
    </script>";
    exit;
}

try {

    // query para verficar se já existe usuário com o mesmo e-mail informado
    $verifica = $pdo->prepare(
        "SELECT id FROM usuario WHERE email = :email AND id != :id"
    );
    $verifica->bindValue(':email', $email);
    $verifica->bindValue(':id', $id, PDO::PARAM_INT);
    $verifica->execute();

    if ($verifica->rowCount() > 0) {
        echo "<script>
            alert('Este e-mail já está em uso por outro usuário.');
            window.location.href = '../php/editar_info.php?id=$id';
        </script>";
        exit;
    }

    // query para executar atualização de dados
    $stmt = $pdo->prepare(
        "UPDATE usuario 
         SET nome = :nome, email = :email, telefone = :telefone, pais = :pais,
             uf = :uf, cidade = :cidade, bairro = :bairro, complemento = :complemento 
         WHERE id = :id"
    );

    // coletando valores alterados
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    $stmt->bindValue(':nome', $nome);
    $stmt->bindValue(':email', $email);
    $stmt->bindValue(':telefone', $telefone);
    $stmt->bindValue(':pais', $pais);
    $stmt->bindValue(':uf', $uf);
    $stmt->bindValue(':cidade', $cidade);
    $stmt->bindValue(':bairro', $bairro);
    $stmt->bindValue(':complemento', $complemento);

    // executando atualização dos dados
    $stmt->execute();

    // mensagem para informar que os dados foram atualizados
    echo "<script>
        alert('Dados atualizados com sucesso!');
        window.location.href = '../pages/tela_inicial.html';
    </script>";

} catch (PDOException $e) {
    echo "Erro: " . $e->getMessage();
}
?>