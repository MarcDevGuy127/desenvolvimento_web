<?php
require_once '../php/config.php';  // importando conexão armazenada em config.php

// coletando o id do usuário selecionado
$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

try {
    // consultando dados do usuário selecionado
    $stmt = $pdo->prepare("SELECT id, nome, email, telefone, pais, uf, cidade, bairro, complemento FROM usuario WHERE id = :id");
    $stmt->bindParam(':id', $id);
    $stmt->execute();

    // $dadosUsuario representa o fetch dos dados do usuário selecionado para edição 
    $dadosUsuario = $stmt->fetch(PDO::FETCH_ASSOC);

    // se o fetch for inconsistente o usuário não será localizado
    if (!$dadosUsuario) {
        echo "<script>alert(Usuário não encontrado.);</script>";
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
        <title>Editar Usuário - Northwest Bank</title>
        <link rel="stylesheet" href="../css/editar_usuarios.css" />
    </head>

    <body>
        <nav>
            <ul>
                <li class="dropdown">
                <a href="../php/info_gerais.php" class="dropbtn">Minha Conta</a>
                <div class="dropdown-content">
                    <a href="../php/info_gerais_adm.php">Informações Gerais</a>
                    <a href="../php/logout.php">&#x21A9; Sair</a>
                </div>
                </li>
                <li class="dropdown">
                <a href="../php/listar.php" class="dropbtn">Consultar</a>
                <div class="dropdown-content">
                    <a href="../php/listar.php">Lista de Usuários</a>
                </div>
                </li>
                <li class="dropdown" id="marca"><a href="../tela_adm.html">Administração - Northwest Bank</a></li>
            </ul>
        </nav>
        <div class="painel">
            <h1>Editar Usuário Cadastrado</h1>
            <form action="atualizar.php" method="POST">
                <input type="hidden" name="id" value="<?= $dadosUsuario['id'] ?>">

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
                <button type="submit">Salvar Alterações</button>
                <button type="button" onclick="window.location.href='listar.php'">Voltar</button>
            </form>
        </div>
        <footer>&copy; 2025 - Northwest Bank</footer>
    </body>
</html>