<?php
//4. criando session
session_start();
if (!isset($_SESSION['email'])) {
    header("Location: tela_login_adm.php");
    exit;
}

// pegando o e-mail da sessão
$email = $_SESSION['email'];

// incluindo html
include '../pages/tela_adm.html';
?>