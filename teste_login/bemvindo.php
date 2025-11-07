<?php
//4. criando session
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit;
}
?>

<h2>Olá, <?php echo htmlspecialchars($_SESSION['usuario']); ?>!</h2>
<a href="logout.php">Sair</a>
