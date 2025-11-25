<?php
session_start();
require_once '../php/config.php'; 

// verificando se o usuário está logado
if (!isset($_SESSION['id'])) {
    header(header: 'Location: ../index.html');
    exit;
}

// buscando dados do usuário logado pelo seu id
$id = $_SESSION['id'];

// realizando a query de seleção dos dados do usuário cadastrado no banco
$stmt = $pdo->prepare("SELECT nome, email, telefone, pais, uf, cidade, bairro, complemento FROM usuario WHERE id = :id");
$stmt->bindParam(':id', $id, PDO::PARAM_INT);
$stmt->execute();

// dadosUsuario representa o fetch/inclusão dos dados atualizados no banco
$dadosUsuario = $stmt->fetch(PDO::FETCH_ASSOC);

// caso não for possível efetuar a atualização o usuário não será encontrado
if (!$dadosUsuario) {
    echo "Usuário não encontrado.";
    exit;
}

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Banco</title>
    <link rel="stylesheet" href="../css/info_gerais.css" />
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
            <a href="saldo.html">Saldo</a>
          </div>
        </li>
        <li class="dropdown">
          <a href="/pages/depositar.html" class="dropbtn">Depósito</a>
          <div class="dropdown-content">
            <a href="/pages/depositar.html">Depositar</a>
            <a href="/pages/depositos.html">Histórico</a>
          </div>
        </li>
        <li class="dropdown">
          <a href="/pages/saques.html" class="dropbtn">Saque</a>
          <div class="dropdown-content">
            <a href="/pages/saques.html">Histórico</a>
          </div>
        </li>
        <li>
          <a href="/pages/contas.html">Contas</a>
        </li>
        <li class="dropdown" id="marca">
          <a href="/pages/tela_inicial.html">Northwest Bank</a>
        </li>
      </ul>
    </nav>
    <div class="painel">
      <h1>Informações Gerais</h1>
      <table border="0" cellspacing="8" cellpadding="5">
        <tr>
          <th>Nome:</th>
          <td><?= htmlspecialchars($dadosUsuario['nome']) ?></td>
        </tr>
        <tr>
          <th>Email:</th>
          <td><?= htmlspecialchars($dadosUsuario['email']) ?></td>
        </tr>
        <tr>
          <th>Telefone:</th>
          <td><?= htmlspecialchars($dadosUsuario['telefone']) ?></td>
        </tr>
        <tr>
          <th>País:</th>
          <td><?= htmlspecialchars($dadosUsuario['pais']) ?></td>
        </tr>
        <tr>
          <th>UF:</th>
          <td><?= htmlspecialchars($dadosUsuario['uf']) ?></td>
        </tr>
        <tr>
          <th>Cidade:</th>
          <td><?= htmlspecialchars($dadosUsuario['cidade']) ?></td>
        </tr>
        <tr>
          <th>Bairro:</th>
          <td><?= htmlspecialchars($dadosUsuario['bairro']) ?></td>
        </tr>
        <tr>
          <th>Complemento:</th>
          <td><?= htmlspecialchars($dadosUsuario['complemento']) ?></td>
        </tr>
      </table>
      <a href="../php/editar_info.php">
        <button>Editar</button>
      </a>
    </div>
    <footer>&copy; 2025 - Northwest Bank</footer>
  </body>
</html>