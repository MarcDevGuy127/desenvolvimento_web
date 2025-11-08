<?php
//4. criando session
session_start();
if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit;
}
?>

<h2>Olá, <?php echo htmlspecialchars($_SESSION['email']); ?>!</h2>
<a href="../php/logout.php">Sair</a>
