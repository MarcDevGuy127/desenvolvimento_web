<?php
session_start();
require_once '../php/config.php'; 

// verificando se o administrador está logado
if (!isset($_SESSION['id'])) {
    header(header: 'Location: ../index.html');
    exit;
}

// buscando dados do administrador logado pelo seu id
$id = $_SESSION['id'];

// realizando a query de seleção dos dados dos administradores cadastrados no banco
$stmt = $pdo->prepare("SELECT nome, email, telefone FROM adm WHERE id = :id");
$stmt->bindParam(':id', $id, PDO::PARAM_INT);
$stmt->execute();

// dadosAdministrador representa o fetch/inclusão dos dados atualizados no banco
$dadosAdministrador = $stmt->fetch(PDO::FETCH_ASSOC);

// caso não for possível efetuar a atualização, o administrador não será encontrado
if (!$dadosAdministrador) {
    echo "administrador não encontrado.";
    exit;
}

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Banco</title>
    <link rel="stylesheet" href="../css/info_gerais_adm.css" />
  </head>
  <body>
    <nav>
      <ul>
        <li class="dropdown">
          <a href="../php/info_gerais.php" class="dropbtn">Minha Conta</a>
          <div class="dropdown-content">
            <a href="../php/info_gerais.php">Informações Gerais</a>
            <a href="../index.html">&#x21A9; Sair</a>
          </div>
        </li>
        <li class="dropdown">
          <a href="saldo.html" class="dropbtn">Consultar</a>
          <div class="dropdown-content">
            <a href="../php/listar.php">Lista de administradors</a>
          </div>
        </li>
        <li class="dropdown" id="marca">
          <a href="/pages/tela_adm.html">Administração - Northwest Bank</a>
        </li>
      </ul>
    </nav>
    <div class="painel">
      <h1>Informações Gerais de Administrador</h1>
      <table border="0" cellspacing="8" cellpadding="5">
        <tr>
          <th>Nome:</th>
          <td><?= htmlspecialchars($dadosAdministrador['nome']) ?></td>
        </tr>
        <tr>
          <th>Email:</th>
          <td><?= htmlspecialchars($dadosAdministrador['email']) ?></td>
        </tr>
        <tr>
          <th>Telefone:</th>
          <td><?= htmlspecialchars($dadosAdministrador['telefone']) ?></td>
        </tr>
      </table>
      <a href="../php/editar_info_adm.php">
        <button>Editar</button>
      </a>
    </div>
    <footer>&copy; 2025 - Northwest Bank</footer>
  </body>
</html>