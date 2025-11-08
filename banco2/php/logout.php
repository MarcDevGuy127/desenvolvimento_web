<?php
session_start();

// apaga todas as variáveis de sessão
//$_SESSION = array();

// encerra a sessão
session_destroy();

// redireciona para a página inicial
header("Location: ../index.html");
exit;
?>
