<?php
require_once '../php/config.php'; // refenciando arquivo config

// validando dados filtrados
$id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
$nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_SPECIAL_CHARS);
$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
$telefone = filter_input(INPUT_POST, 'telefone', FILTER_SANITIZE_SPECIAL_CHARS);

// se id, nome ou email forem diferentes, os dados são inválidos.
if (!$id || !$nome || !$email) {
    echo "<script>
        alert('Dados inválidos.');
        window.location.href = 'editar_info.php?id=$id';
    </script>";
    exit;
}

try {

    // verificar se outro usuário usa o mesmo e-mail
    $verifica = $pdo->prepare(
        "SELECT id FROM adm WHERE email = :email AND id != :id"
    );
    $verifica->bindValue(':email', $email);
    $verifica->bindValue(':id', $id, PDO::PARAM_INT);
    $verifica->execute();

    if ($verifica->rowCount() > 0) {
        echo "<script>
            alert('Este e-mail já está em uso por outro administrador.');
            window.location.href = 'editar_info.php?id=$id';
        </script>";
        exit;
    }

    // query para executar atualização de dados
    $stmt = $pdo->prepare(
        "UPDATE adm 
                SET nome = :nome, email = :email, telefone = :telefone
                WHERE id = :id"
    );

    // coletando valores alterados
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    $stmt->bindValue(':nome', $nome);
    $stmt->bindValue(':email', $email);
    $stmt->bindValue(':telefone', $telefone);

    $stmt->execute();

    // mensagem de que os dados foram atualizados!
    echo "<script>
        alert('Dados atualizados com sucesso!');
        window.location.href = '../pages/tela_inicial.html';
    </script>";

} catch (PDOException $e) {
    echo "Erro: " . $e->getMessage();
}
?>