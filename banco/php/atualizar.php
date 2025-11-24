<?php
require_once '../php/config.php';

try {
    $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
    $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_SPECIAL_CHARS);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $telefone = filter_input(INPUT_POST, 'telefone', FILTER_SANITIZE_SPECIAL_CHARS);
    $pais = filter_input(INPUT_POST, 'pais', FILTER_SANITIZE_SPECIAL_CHARS);
    $uf = filter_input(INPUT_POST, 'uf', FILTER_SANITIZE_SPECIAL_CHARS);
    $cidade = filter_input(INPUT_POST, 'cidade', FILTER_SANITIZE_SPECIAL_CHARS);
    $complemento = filter_input(INPUT_POST, 'bairro', FILTER_SANITIZE_SPECIAL_CHARS);

    // Verificar se o novo e-mail já existe em outro usuário
    $verifica = $pdo->prepare("SELECT id FROM usuarios WHERE email = :email AND id != :id");
    $verifica->bindParam(':email', $email);
    $verifica->bindParam(':id', $id);
    $verifica->execute();

    if ($verifica->rowCount() > 0) {
        echo "<script>
            alert('Este e-mail já está em uso por outro usuário.');
            window.location.href = 'editar_info.php?id=$id';
        </script>";
        exit;
    }

    $stmt = $pdo->prepare("UPDATE usuario SET nome = :nome, email = :email, telefone = :telefone, pais = :pais,
        uf = :uf, cidade = :cidade, complemento = :complemento WHERE id = :id");

    // dados a serem atualizados
    $stmt->bindParam(':id', $id);
    $stmt->bindParam(':nome', $nome);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':telefone', $telefone);
    $stmt->bindParam(':pais', $pais);
    $stmt->bindParam(':uf', $uf);
    $stmt->bindParam(':cidade', $cidade);
    $stmt->bindParam(':complemento', $complemento);

    // executando atualização de dados
    $stmt->execute();

    $dadosUsuario = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$dadosUsuario) {
        echo "<p>Usuário não encontrado.</p>";
        exit;
    }

    if ($stmt->execute()) {
        echo "<script>
            alert('Dados atualizados com sucesso!');
            window.location.href = 'listar.php';
        </script>";
    } else {
        echo "<script>
            alert('Erro ao atualizar.');
            window.location.href = 'editar_info.php?id=$id';
        </script>";
    }

} catch (PDOException $e) {
    echo "Erro: " . $e->getMessage();
}
?>
