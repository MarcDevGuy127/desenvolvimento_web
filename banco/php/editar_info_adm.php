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
  $stmt = $pdo->prepare("SELECT id, nome, email, telefone, senha FROM adm WHERE id = :id");
  $stmt->bindValue(':id', $id, PDO::PARAM_INT);
  $stmt->execute();

  // dadosAdministrador representa o fetch/inclusão dos dados atualizados no banco
  $dadosAdministrador = $stmt->fetch(PDO::FETCH_ASSOC);

  // caso não for possível efetuar a atualização o usuário não será encontrado
  if (!$dadosAdministrador) {
    echo "<p>Administrador não encontrado.</p>";
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
    <title>Administração - Northwest Bank</title>
    <link rel="stylesheet" href="../css/editar_info_adm.css" />
  </head>

  <body>
    <nav>
      <ul>
        <li class="dropdown">
          <a href="/php/info_gerais.php" class="dropbtn">Minha Conta</a>
          <div class="dropdown-content">
            <a href="/php/info_gerais_adm.php">Informações Gerais</a>
            <a href="../index.html">&#x21A9; Sair</a>
          </div>
        </li>
        <li class="dropdown">
          <a href="saldo.html" class="dropbtn">Consultar</a>
          <div class="dropdown-content">
            <a href="/php/listar.php">Lista de Usuários</a>
          </div>
        </li>
        <li class="dropdown" id="marca">
          <a href="../php/tela_adm.php">Administração - Northwest Bank</a>
        </li>
      </ul>
    </nav>
    <div class="painel">
      <h1>Edição de Informações Administrador</h1>
      <form action="../php/atualizar_adm.php" method="POST">
      <input type="hidden" name="id" value="<?= $dadosAdministrador['id'] ?>">

        <fieldset>
          <legend>Informações Pessoais</legend>

          <label for="nome">Nome:</label>
          <input type="text" id="nome" name="nome" value="<?= htmlspecialchars($dadosAdministrador['nome']) ?>" required />

          <label for="email">Email:</label>
          <input type="email" id="email" name="email" value="<?= htmlspecialchars($dadosAdministrador['email']) ?>" required />

          <label for="telefone">Telefone:</label>
          <input type="tel" id="telefone" name="telefone" minlength="11" maxlength="12" value="<?= htmlspecialchars($dadosAdministrador['telefone']) ?>" required />
        </fieldset>

        <fieldset>
          <legend>Trocar Senha</legend>

          <label for="senha">Digite uma nova senha:</label>
          <input type="text" id="senha" name="senha" minlength="8" maxlength="12" required />

          <label for="confirma_senha">Digite novamente:</label>
          <input type="text" id="confirma_senha" name="confirma_senha" minlength="8" maxlength="12" required />
        </fieldset>
        <button type="submit" value="editar">Salvar</button>
        <button type="reset">Limpar</button>
      </form>
    </div>
    <footer>&copy; 2025 - Northwest Bank</footer>
  </body>
</html>