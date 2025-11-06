<?php
// conexão com o banco usando PDO
require_once 'config.php';

//iniciar sessao
session_start();

//notifica se algum campo em login.html estiver vazio.
if (empty($_POST['email']) || empty($_POST['senha'])) {
    header('Location: index.html');
    echo '<h6>Usuário/Senha incorretos!</h6>';

    exit();
}

$usuario = mysqli_real_escape_string($conexao, $_POST['usuario']);
$senha = md5($_POST['senha']);
$query = "SELECT usuario FROM usuarios WHERE usuario = '{$usuario}' AND senha = 
'{$senha}'";
$result = mysqli_query($conexao, $query);
$row = mysqli_num_rows($result);

//verifica se login existe
if ($row == 1) {
    $_SESSION['usuario'] = $usuario;
    $_SESSION['senha'] = $senha;
    
    //se sim, usuario acessa a tela dele.
    header('Location: painel.html');
    exit();
} else {
    $_SESSION['nao_autenticado'] = true;

    //se não, usuario retorna a tela de login. 
    header('Location: index.php');
    exit();
}
?>