<?php
session_start();
require_once '../php/config.php'; // <-- seu arquivo de conexão PDO

// Verifica se o usuário está logado
if (!isset($_SESSION['id'])) {
    header(header: 'Location: ../index.html');
    exit;
}

// Busca dados do usuário logado
$id = $_SESSION['id'];

$stmt = $pdo->prepare("SELECT nome, email, telefone, pais, uf, cidade, bairro, complemento FROM usuarios WHERE id = :id");
$stmt->bindParam(':id', $id, PDO::PARAM_INT);
$stmt->execute();

$usuario = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$usuario) {
    echo "Usuário não encontrado.";
    exit;
}
?>