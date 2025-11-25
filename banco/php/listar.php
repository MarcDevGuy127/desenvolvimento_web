<?php
session_start();

require_once '../php/config.php';

// verificando se o usuário está logado
if (!isset($_SESSION['id'])) {
    header(header: 'Location: ../pages/tela_login_adm.html');
    exit;
}

// buscando dados do usuário logado pelo seu id
$id = $_SESSION['id'];


try {
    // inserindo filtros de busca e ordenação
    $busca = filter_input(INPUT_GET, 'busca', FILTER_SANITIZE_SPECIAL_CHARS) ?? '';
    $ordem = filter_input(INPUT_GET, 'ordem', FILTER_SANITIZE_SPECIAL_CHARS) ?? 'nome';
    $orientacao = filter_input(INPUT_GET, 'orientacao', FILTER_SANITIZE_SPECIAL_CHARS) ?? 'ASC';

    // evitando sql injection, permitindo apenas essas colunas e direções
    $colunas = ['nome', 'email']; // colunas a serem exibidas
    $filtros = ['ASC', 'DESC']; // ordens possíveis => crescentes e decrescente

    if (!in_array($ordem, $colunas)) {
        $ordem = 'nome';
    }
    if (!in_array($orientacao, $filtros)) {
        $orientacao = 'ASC';
    }

    // executando busca com query de selecao
    if ($busca) {
        $stmt = $pdo->prepare("SELECT id, nome, email, telefone FROM usuarios 
                               WHERE nome LIKE :busca OR email LIKE :busca 
                               ORDER BY $ordem $orientacao");
        $stmt->bindValue(':busca', "%$busca%");
    } else {
        $stmt = $pdo->prepare("SELECT id, nome, email, telefone FROM usuarios 
                               ORDER BY $ordem $orientacao");
    }
 
    // executando query  
    $stmt->execute();

    // executando query para exibir informações de usuarios cadastrados no banco
    $stmt = $pdo->query("SELECT id, nome, email FROM usuario");
    $usuarios = $stmt->fetchAll(PDO::FETCH_OBJ);

} catch (PDOException $e) {
    echo "Erro na consulta: " . $e->getMessage();
    die();
}
?>

 <!DOCTYPE html>
 <html lang="pt-br">
 <head>
    <meta charset="UTF-8">
    <title>Usuários Cadastrados</title>
    <link rel="stylesheet" href="/css/listar.css" />
 </head>
 <body>
    <div class="container">
        <h2 style="margin-top:40px;">Lista de Usuários Cadastrados</h2>
        <table>
            <!--Filtros-->
            <th>
                <a href="?ordem=id&orientacao=<?= $ordem === 'id' && $orientacao === 'ASC' ? 'DESC' : 'ASC' ?>">ID</a>
            </th>
            <th>
                <a href="?ordem=nome&orientacao=<?= $ordem === 'nome' && $orientacao === 'ASC' ? 'DESC' : 'ASC' ?>">Nome</a>
            </th>
            <th>
                <a href="?ordem=email&orientacao=<?= $ordem === 'email' && $orientacao === 'ASC' ? 'DESC' : 'ASC' ?>">Email</a>
            </th>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>E-mail</th>
            </tr>
            
            <?php foreach ($usuarios as $usuario): ?>
            <tr>
                <td><?= htmlspecialchars($usuario[1]) ?></td>
                <td><?= htmlspecialchars($usuario[2]) ?></td>
                <td><?= htmlspecialchars($usuario[3]) ?></td>
                <td>
                    <a href="editar.php?id=<?= $usuario[0] ?>">Editar</a> |
                    <a href="excluir.php?id=<?= $usuario[0] ?>"
                        onclick="return confirm('Tem certeza que deseja excluir?')">Excluir</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <div class="sair">
            <a href="logout.php">Sair</a>
        </div>
    </div>
 </body>
 </html>