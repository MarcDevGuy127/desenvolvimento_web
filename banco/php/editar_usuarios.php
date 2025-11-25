<?php
require_once '../php/config.php';  // importa a conexão armazenada em $pdo

// coletando o ID
$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

try {
    $stmt = $pdo->prepare("SELECT * FROM usuario WHERE id = :id");
    $stmt->bindParam(':id', $id);
    $stmt->execute();

    $dadosUsuario = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$dadosUsuario) {
        echo "<p>Usuário não encontrado.</p>";
        exit;
    }

} catch (PDOException $e) {
    echo "Erro: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title>Editar Usuário</title>
        <link rel="stylesheet" href="../css/editar_usuarios.css" />
    </head>

    <body>
        <h2>Editar Usuário</h2>
        <form action="atualizar.php" method="POST">
            <input type="hidden" name="id" value="<?= $dadosUsuario['id'] ?>">

            <label>Nome:</label>
            <input type="text" name="nome" value="<?= htmlspecialchars($dadosUsuario['nome']) ?>" required>

            <label>Email:</label>
            <input type="email" name="email" value="<?= htmlspecialchars($dadosUsuario['email']) ?>" required>

            <label>Email:</label>
            <input type="email" name="email" value="<?= htmlspecialchars($dadosUsuario['email']) ?>" required>

            <button type="submit">Salvar Alterações</button>
        </form>
        <fieldset>
          <legend>Informações Pessoais</legend>

          <label for="nome">Nome:</label>
          <input type="text" id="nome" name="nome" value="<?= htmlspecialchars($dadosUsuario['nome']) ?>" required />

          <label for="email">Email:</label>
          <input type="email" id="email" name="email" value="<?= htmlspecialchars($dadosUsuario['email']) ?>" required />
          
          <label for="telefone">Telefone:</label>
          <input type="tel" id="telefone" name="telefone" value="<?= htmlspecialchars($dadosUsuario['telefone']) ?>" maxlength="12" required />        
        </fieldset>

        <fieldset>
          <legend>Endereço</legend>

          <label for="pais">País:</label>
          <input type="text" id="pais" name="pais" value="<?= htmlspecialchars($dadosUsuario['pais']) ?>" maxlength="35" required />

          <label for="uf">UF:</label>
          <input type="text" id="uf" name="uf" value="<?= htmlspecialchars($dadosUsuario['uf']) ?>" minlength="2" maxlength="2" required />

          <label for="cidade">Cidade:</label>
          <input type="text" id="cidade" name="cidade" value="<?= htmlspecialchars($dadosUsuario['cidade']) ?>" maxlength="35" required />

          <label for="bairro">Bairro:</label>
          <input type="text" id="bairro" name="bairro" value="<?= htmlspecialchars($dadosUsuario['bairro']) ?>" maxlength="35" required />

          <label for="complemento">Complemento:</label>
        <input type="text" id="complemento" name="complemento" value="<?= htmlspecialchars($dadosUsuario['complemento']) ?>" minlength="20" maxlength="150" required />

        </fieldset>

        <fieldset>
          <legend>Definição de Senha</legend>

          <label for="senha">Digite a senha:</label>
          <input type="password" id="senha" name="senha" minlength="8" maxlength="12" required/>

          <label for="confirma_senha">Digite novamente:</label>
          <input type="password" id="confirma_senha" name="confirma_senha" minlength="8" maxlength="12" required/>
        </fieldset>
        <button type="submit" value="editar">Salvar</button>
        <button type="button" onclick="window.location.href='listar.php'">Voltar</button>
    </body>
</html>