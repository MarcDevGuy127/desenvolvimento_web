<?php
require_once 'config.php';

// Destruir sessão e sair
session_destroy();

// Redirecionar para página de login
header('Location: ../index.html');
exit;
?>