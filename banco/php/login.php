<?php
// conexão com o banco usando PDO
$dsn = "mysql:host=localhost;dbname=plataforma_banco;charset=utf8";
$usuario = "root";
$senha = ""; // ajuste conforme o seu ambiente

session_start();
include('conexao.php');
if (empty($_POST['email']) || empty($_POST['senha'])) {
    header('Location: index.php');
    exit();
}
$usuario = mysqli_real_escape_string($conexao, $_POST['usuario']);
$senha = md5($_POST['senha']);
$query = "SELECT usuario FROM usuarios WHERE usuario = '{$usuario}' AND senha = 
'{$senha}'";
$result = mysqli_query($conexao, $query);
$row = mysqli_num_rows($result);

//verifica login
if ($row == 1) {
    $_SESSION['usuario'] = $usuario;
    header('Location: painel.php');
    exit();
} else {
    $_SESSION['nao_autenticado'] = true;
    header('Location: index.php');
    exit();
}
?>