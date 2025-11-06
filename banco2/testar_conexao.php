<?php

// Detalhes de conexão com o banco de dados fornecidos pelo usuário
$servername = "localhost";        // O host do seu servidor MySQL
$username = "root";             // O nome de usuário para acesso ao MySQL
$password = "";                 // A senha para o usuário (vazio, conforme fornecido)
$dbname = "plataforma_banco";   // O nome do banco de dados específico a ser testado

// Tenta estabelecer a conexão com o banco de dados
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica se houve algum erro na conexão
if ($conn->connect_error) {
    // Se a conexão falhou, exibe uma mensagem de erro e interrompe a execução
    die("Falha na conexão com o banco de dados '$dbname': " . $conn->connect_error);
}

// Se a conexão foi bem-sucedida, exibe uma mensagem de sucesso
echo "Conexão com o banco de dados '$dbname' bem-sucedida!   ";

// Fecha a conexão com o banco de dados
$conn->close();

?>