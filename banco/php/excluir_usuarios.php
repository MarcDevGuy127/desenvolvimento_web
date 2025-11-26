<?php
require_once '../php/config.php';  // importando conexão com o banco de dados

// recebendo id do usuário a ser excluído
$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

if (!$id) {
    echo "ID inválido!";
    exit;
}

try {
    // query para exclusão do usuário selecionado
    $stmt = $pdo->prepare("DELETE FROM usuario WHERE id = :id");
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);

    // após executar a exclusão redirecione administrador para a página de lista de usuários
    if ($stmt->execute()) {
        
        // redirecionando tela
        header("Location: ../php/listar.php");
        exit;

    } else {
        echo "Erro ao deletar.";
    }

} catch (PDOException $e) {
    echo "Erro: " . $e->getMessage();
}
?>
