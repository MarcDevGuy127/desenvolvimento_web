<?php
// Conexão com o banco usando PDO
require_once 'config.php';

//sinalizando que os valores do formulario como json
header('Content-Type: application/json');

//não permitir metodo de requisição diferente
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => 'Método não permitido']);
    exit;
}

try {
    $pdo = getConnection(); //conecta conexão


    // Receber dados do formulário
    $nome         = sanitize($_POST['nome'] ?? '');
    $email        = sanitize($_POST['email'] ?? '');
    $telefone     = sanitize($_POST['telefone'] ?? '');
    $pais         = sanitize($_POST['pais'] ?? '');
    $uf           = sanitize($_POST['uf'] ?? '');
    $cidade       = sanitize($_POST['cidade'] ?? '');
    $complemento  = sanitize($_POST['bairro'] ?? '');
    $senha_usuario = sanitize($_POST['senha_usuario'] ?? '');

    /*validando dados obrigatórios
    $nome = sanitize($_POST['nome'] ?? '');
    $email = sanitize($_POST['email'] ?? '');
    $senha = $_POST['senha'] ?? '';


    #if (sizeof($senha_usuario ) >= 8 || sizeof($senha_usuario ) <= 12) {
        # code...
    #}
    */
    //impedir senhas fora do permitido
        if (empty($nome) || empty($email) || empty($senha)) {
        echo json_encode(['success' => false, 'message' => 'Nome, email e senha são obrigatórios']);
        exit;
    }
    
    if (!isValidEmail($email)) {
        echo json_encode(['success' => false, 'message' => 'Email inválido']);
        exit;
    }
    
    if (strlen($senha_usuario) < 8 || strlen($senha_usuario) > 12) {
        echo json_encode(['success' => false, 'message' => 'Senha deve ter pelo menos 8-12 caracteres']);
        exit;
    }

    $hash = password_hash($senha_usuario, PASSWORD_DEFAULT);


    // Verificar se email já existe
    $stmt = $pdo->prepare("SELECT id FROM usuarios WHERE email = ?");
    $stmt->execute([$email]);
    
    // se email existir retorna que esse email está em uso
    if ($stmt->fetch()) {
        echo json_encode(['success' => false, 'message' => 'Email já cadastrado']);
        exit;
    }
    /*
    $empresa = sanitize($_POST['empresa'] ?? '');
    $telefone = sanitize($_POST['telefone'] ?? '');
    $endereco = sanitize($_POST['endereco'] ?? '');
    $cidade = sanitize($_POST['cidade'] ?? '');
    $estado = sanitize($_POST['estado'] ?? '');
    $pais = sanitize($_POST['pais'] ?? 'Brasil');
    $cep = sanitize($_POST['cep'] ?? '');
    */

    // Inserir dados usando prepared statement
    $stmt = $pdo->prepare("INSERT INTO usuarios (nome, email, telefone, pais, uf, cidade, complemento, senha_usuario) VALUES (:nome, :email)");
    $stmt->bindParam(':nome', $nome);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':telefone', $telefone);
    $stmt->bindParam(':pais', $pais);
    $stmt->bindParam(':uf', $uf);
    $stmt->bindParam(':cidade', $cidade);
    $stmt->bindParam(':complemento', $complemento);
    $stmt->bindParam(':senha_usuario', $senha_usuario);


    if ($stmt->execute()) {
        echo "Cadastro realizado com sucesso!<br>";
        header("Location: index.html");
    } else {
        echo "Erro ao cadastrar";
    }
} catch (PDOException $e) {
    echo "Erro de conexão: " . $e->getMessage();
}
?>