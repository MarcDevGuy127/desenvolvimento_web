<?php
require_once '../php/config.php';

// consultando determinados dados dos usuários cadastrados
$sql = $pdo->prepare("SELECT id, nome, email, telefone, pais, uf, cidade, bairro, complemento FROM usuario");
$sql->execute();

$usuario = $sql->fetchAll(PDO::FETCH_ASSOC);
?>