<?php
session_start();
require_once 'config.php'; // ajuste se necessário

$mensagem = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // sanitiza e coletar dados
    $email = trim($_POST['email'] ?? '');
    $senha = $_POST['senha'] ?? '';

    // verificar campos vazios
    if (empty($email) || empty($senha)) {
        $mensagem = "Por favor, preencha todos os campos!";
    } else {

        // buscar usuário por email
        $sql = "SELECT * FROM adm WHERE email = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$email]);
        $adm = $stmt->fetch(PDO::FETCH_ASSOC);

        // depuração opcional:
        /*
        var_dump($email);
        var_dump($senha);
        var_dump($adm['senha'] ?? null);
        exit;
        */

        // validar login
        if ($adm && password_verify($senha, $adm['senha'])) {

            // criar sessão
            $_SESSION['id'] = $adm['id'];
            $_SESSION['nome'] = $adm['nome'];
            $_SESSION['email'] = $adm['email'];
            $_SESSION['logado'] = true;

            header("Location: tela_adm.php");
            exit;

        } else {
            $mensagem = "Email ou senha incorretos!";
        }
    }
}

// exibir erro e voltar ao início
if (!empty($mensagem)) {
    echo "<script>alert('$mensagem'); window.location.href = '../pages/tela_login_adm.html';</script>";
    exit;
}
?>
