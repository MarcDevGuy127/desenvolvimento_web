 <?php
 // Conexão com o banco usando PDO
 $dsn = "mysql:host=localhost;dbname=plataforma_banco;charset=utf8";
 $usuario = "root";
 $senha = ""; // ajuste conforme o seu ambiente
 try {
    $pdo = new PDO($dsn, $usuario, $senha);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // Receber id via GET ou POST (exemplo usando GET)
    $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
    // Deletar usuário usando prepared statement
    $stmt = $pdo->prepare("DELETE FROM usuario WHERE id = :id");
    $stmt->bindParam(':id', $id);
    if ($stmt->execute()) {
        echo "Usuário deletado com sucesso!<br>";
        header("Location: ../php/listar.php");
    } else {
        echo "Erro ao deletar";
    }
 } catch (PDOException $e) {
    echo "Erro de conexão: " . $e->getMessage();
 }
 ?>