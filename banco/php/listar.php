<?php
session_start(); // iniciando sessão do usuário
require_once '../php/config.php'; // importando conexão armazenada em config.php

// verifica se o login do usuário está ativo, senão será direcionado para a tela de login.
if (!isset($_SESSION['id'])) {
    header('Location: ../pages/tela_login_adm.html');
    exit;
}

try {
    // implementando filtros de busca
    $busca = filter_input(INPUT_GET, 'busca', FILTER_SANITIZE_SPECIAL_CHARS) ?? '';
    $ordem = filter_input(INPUT_GET, 'ordem', FILTER_SANITIZE_SPECIAL_CHARS) ?? 'nome';
    $orientacao = filter_input(INPUT_GET, 'orientacao', FILTER_SANITIZE_SPECIAL_CHARS) ?? 'ASC';

    // colunas e ordenações permitidas
    $colunas = ['id', 'nome', 'email'];
    $filtros = ['ASC', 'DESC'];

    if (!in_array($ordem, $colunas)) {
        $ordem = 'nome';
    }
    if (!in_array($orientacao, $filtros)) {
        $orientacao = 'ASC';
    }

    // configurando ferramenta de busca para determinados dados especificados
    if ($busca) {
        $stmt = $pdo->prepare("
            SELECT id, nome, email, telefone 
            FROM usuario
            WHERE nome LIKE :busca OR email LIKE :busca
            ORDER BY $ordem $orientacao
        ");
        $stmt->bindValue(':busca', "%$busca%");
    } else {
        $stmt = $pdo->prepare("
            SELECT id, nome, email, telefone
            FROM usuario
            ORDER BY $ordem $orientacao
        ");
    }

    // Executa e captura resultados
    $stmt->execute();
    $usuarios = $stmt->fetchAll(PDO::FETCH_OBJ);

} catch (PDOException $e) {
    echo "Erro ao consultar: " . $e->getMessage();
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Administração - Lista de Usuários</title>
    <link rel="stylesheet" href="../css/listar.css">
</head>

<body>
    <nav>
        <ul>
            <li class="dropdown">
                <a href="../php/info_gerais_adm.php" class="dropbtn">Minha Conta</a>
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
        <h1>Lista de Usuários Cadastrados</h1>

        <!-- Campo de busca -->
        <form method="GET">
            <input type="text" name="busca" placeholder="Buscar por nome ou email" value="<?= htmlspecialchars($busca) ?>">
            <button type="submit">Buscar</button>
        </form>

        <table>
            <tr>
                <th>
                    <a href="?ordem=id&orientacao=<?= ($ordem === 'id' && $orientacao === 'ASC') ? 'DESC' : 'ASC' ?>">
                        ID
                    </a>
                </th>
                <th>
                    <a href="?ordem=nome&orientacao=<?= ($ordem === 'nome' && $orientacao === 'ASC') ? 'DESC' : 'ASC' ?>">
                        Nome
                    </a>
                </th>
                <th>
                    <a href="?ordem=email&orientacao=<?= ($ordem === 'email' && $orientacao === 'ASC') ? 'DESC' : 'ASC' ?>">
                        Email
                    </a>
                </th>
                <th>Ações</th>
            </tr>

            <?php if (empty($usuarios)): ?>
                <tr>
                    <td colspan="4">Nenhum usuário encontrado.</td>
                </tr>
            <?php else: ?>
                <?php foreach ($usuarios as $usuario): ?>
                    <tr>
                        <td><?= htmlspecialchars($usuario->id) ?></td>
                        <td><?= htmlspecialchars($usuario->nome) ?></td>
                        <td><?= htmlspecialchars($usuario->email) ?></td>
                        <td>
                            <a href="editar_usuarios.php?id=<?= $usuario->id ?>">Editar</a> |
                            <a href="excluir_usuarios.php?id=<?= $usuario->id ?>" onclick="return confirm('Tem certeza que deseja excluir?')">Excluir</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </table>
        <div class="sair">
            <a href="logout.php">Sair</a>
        </div>
    </div>
    <footer>&copy; 2025 - Northwest Bank</footer>
</body>

</html>