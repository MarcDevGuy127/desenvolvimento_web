 <?php
 $dsn = "mysql:host=localhost;dbname=plataforma_banco;charset=utf8";
 $usuario = "root";
 $senha = "";
 try {
    $pdo = new PDO($dsn, $usuario, $senha);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Consulta usando retorno como objeto
    $stmt = $pdo->query("SELECT * FROM usuarios");
    $usuarios = $stmt->fetchAll(PDO::FETCH_OBJ);
 } catch(PDOException $e) {
    echo "Erro de conexão: " . $e->getMessage();
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
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>E-mail</th>
            </tr>
            <?php foreach($usuarios as $u): ?>
            <tr>
                <td><?= $u->id ?></td>
                <td><?= $u->nome ?></td>
                <td><?= $u->email ?></td>
            </tr>
            <?php endforeach; ?>
        </table>
        <div class="sair">
            <a href="index.html">Sair</a>
        </div>
    </div>
 </body>
 </html>