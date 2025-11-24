<?php
session_start(); // iniciando sessão de usuário
require_once '../php/config.php'; // refenciando arquivo config

// coletando id do usuário
$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

// verificando se o usuário está logado
if (!isset($_SESSION['id'])) {
  $id = $_SESSION['id'];
}

// buscando dados através do id do usuário logado
$id = $_SESSION['id'];

try {
  // executando query de seleção de dados do usuário logado através do seu id
  $stmt = $pdo->prepare("SELECT id, nome, email, telefone, pais, uf, cidade, bairro, complemento FROM usuario WHERE id = :id");
  $stmt->bindValue(':id', $id, PDO::PARAM_INT);
  $stmt->execute();

  // dadosUsuario representa o fetch/inclusão dos dados atualizados no banco
  $dadosUsuario = $stmt->fetch(PDO::FETCH_ASSOC);

  // caso não for possível efetuar a atualização o usuário não será encontrado
  if (!$dadosUsuario) {
    echo "<p>Usuário não encontrado.</p>";
    exit;
  }

} catch (PDOException $e) {
  echo "Erro ao buscar dados: " . $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="en">

  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Banco</title>
    <link rel="stylesheet" href="../css/editar_info.css" />
  </head>

  <body>
    <nav>
      <ul>
        <li class="dropdown">
          <a href="/php/info_gerais.php" class="dropbtn">Minha Conta</a>
          <div class="dropdown-content">
            <a href="/php/info_gerais.php">Informações Gerais</a>
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
          <a href="#" class="dropbtn">Depósito</a>
          <div class="dropdown-content">
            <a href="depositar.html">Depositar</a>
            <a href="depositos.html">Histórico</a>
          </div>
        </li>
        <li class="dropdown">
          <a href="saques.html" class="dropbtn">Saque</a>
          <div class="dropdown-content">
            <a href="saques.html">Histórico</a>
          </div>
        </li>
        <li>
          <a href="contas.html">Contas</a>
        </li>
        <li class="dropdown" id="marca">
          <a href="../index.html">Northwest Bank</a>
        </li>
      </ul>
    </nav>
    <div class="painel">
      <h1>Edição de Informações Gerais</h1>
      <form action="atualizar.php" method="POST">
      <input type="hidden" name="id" value="<?= $dadosUsuario['id'] ?>">

        <fieldset>
          <legend>Informações Pessoais</legend>

          <label for="nome">Nome:</label>
          <input type="text" id="nome" name="nome" value="<?= htmlspecialchars($dadosUsuario['nome']) ?>" required />

          <label for="email">Email:</label>
          <input type="email" id="email" name="email" value="<?= htmlspecialchars($dadosUsuario['email']) ?>" required />

          <label for="telefone">Telefone:</label>
          <input type="tel" id="telefone" name="telefone" maxlength="11" value="<?= htmlspecialchars($dadosUsuario['telefone']) ?>" required />
        </fieldset>

        <fieldset>
          <legend>Endereço</legend>

          <label for="pais">País:</label>
          <input type="text" id="pais" name="pais" value="<?= htmlspecialchars($dadosUsuario['pais']) ?>" required />

          <label for="uf">UF:</label>
          <input type="text" id="uf" name="uf" maxlength="2" value="<?= htmlspecialchars($dadosUsuario['uf']) ?>" required />

          <label for="cidade">Cidade:</label>
          <input type="text" id="cidade" name="cidade" value="<?= htmlspecialchars($dadosUsuario['cidade']) ?>" required />

          <label for="bairro">Bairro:</label>
          <input type="text" id="bairro" name="bairro" value="<?= htmlspecialchars($dadosUsuario['bairro']) ?>" required />

          <label for="complemento">Complemento:</label>
          <input type="text" id="complemento" name="complemento" value="<?= htmlspecialchars($dadosUsuario['complemento']) ?>" required />
        </fieldset>
        <button type="submit" value="editar">Salvar</button>
        <button type="reset">Limpar</button>
      </form>
    </div>
    <footer>&copy; 2025 - Northwest Bank</footer>
  </body>
</html>